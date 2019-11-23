<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 22.11.19
 * Time: 12:49
 */

namespace services;


use config\Config;
use dao\PriceDAO;

class MarketDataServiceImpl implements MarketDataService
{
    private static $instance = NULL;

    protected function __construct()
    {
    }
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function getPriceCached($crypto,$fiat):float{
        //try chached first. If it's within 15 min it's still ok.
        $tolerance = Config::get('price.tolerance');
        // database access to check if cached is still valid : return
        $last_record = (new PriceDAO())->readLast($crypto,$fiat);
        if(!is_null($last_record)){
            $now = new \DateTime('now', new \DateTimeZone(date_default_timezone_get()));
            $last_time = date_create_from_format('Y-m-d H:i:s',$last_record['fld_price_update']);
            $diff = $now->diff($last_time);
            $min_diff = $diff->i;
        }

        if(is_null($last_record) || $min_diff > $tolerance){
            return $this->getFromApi($crypto,$fiat);
        }else{
            return floatval($last_record['fld_price_value']);
        }
    }

    private function getFromApi($crypto,$fiat):float {
        // $crypto must be bitcoin
        $crypto_id = 1;
        // $fiat must be USD see ref: https://coinmarketcap.com/api/documentation/v1/#section/Standards-and-Conventions
        $fiat_id = 2781;
        // do the actual request to CMC
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
        $parameters = [
            'id' => strval($crypto_id),
            'convert_id' => strval($fiat_id)];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: '. Config::get('api.key')
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, array(
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        $arr = json_decode($response); // print json decoded response
        if($arr->status->error_code == 0){
            // OK
            $usd_quote = $arr->data->{$crypto_id}->quote->{$fiat_id};
            $price = $usd_quote->price;
            $last_updated = (new \DateTime('@' .strtotime($usd_quote->last_updated)))->setTimezone(new \DateTimeZone(date_default_timezone_get()));

            // write new price to the database
            (new PriceDAO())->insert($price,$crypto,$fiat,$last_updated);

            return $price;
        }else{
            //catch error
            print $arr->status->error_message;
        }
        curl_close($curl); // Close request
    }

    public function getPrice(bool $force_refresh = false, $crypto = 'BTC', $fiat = 'USD'): float
    {
        // @todo implement other currencies than BTC and USD
        if (!($crypto==='BTC' and $fiat==='USD')) {
            throw new \Exception('Currently only BTC and USD are allowed, input was ' . $crypto . " and " . $fiat);
        }
        if ($force_refresh){
            return $this->getFromApi($crypto,$fiat);
        }
        return $this->getPriceCached($crypto,$fiat);
    }

    public function convertSatToUsd($sat_val){
        $price_btc = $this->getPrice();
        $price_sat = $price_btc / self::SATS_PER_BTC;
        $usd_val = $price_sat * $sat_val;
        return $usd_val;
    }
    public function convertSatToUsdFormat($sat_val): String
    {
        $usd_val = $this->convertSatToUsd($sat_val);
        if($usd_val < 1){
            return round($usd_val * 100) . " cts.";
        }else{
            return '$' . round($usd_val, 2);
        }
    }
}