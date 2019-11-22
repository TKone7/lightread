<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 22.11.19
 * Time: 12:49
 */

namespace services;


use config\Config;

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

    private function getPriceCached():float{
        //try chached first
        // database access to check if cached is still valid : return

        // if cached is unavailable / outdated, call the api
        // getFromApi()
        return $this->getFromApi();
    }

    private function getFromApi():float {
        // do the actual request to CMC
        $url = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
        $parameters = [
            'id' => '1', // 1 represents bitcoin
            'convert_id' => '2785' // represents SCHF (Coin Market Cap ID) see ref: https://coinmarketcap.com/api/documentation/v1/#section/Standards-and-Conventions
        ];

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
            $chf_quote = $arr->data->{'1'}->quote->{'2785'};
            $price = $chf_quote->price;
            $last_updated = (new \DateTime('@' .strtotime($chf_quote->last_updated)))->setTimezone(new \DateTimeZone(date_default_timezone_get()));

            // write new price to the database

            // return double
            return $price;
        }else{
            //catch error
            print $arr->status->error_message;
        }
        curl_close($curl); // Close request

        return 1;
    }

    public function getPrice(bool $force_refresh = false, $crypto = 'BTC', $fiat = 'CHF'): float
    {
        // @todo implement other currencies than BTC and CHF
        if (!($crypto==='BTC' and $fiat==='CHF')) {
            throw new \Exception('Currently only BTC and CHF are allowed, input was ' . $crypto . " and " . $fiat);
        }
        if ($force_refresh){
            return $this->getFromApi();
        }
        return $this->getPriceCached();
    }
}