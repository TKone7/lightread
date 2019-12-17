<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 22.11.19
 * Time: 12:44
 */

namespace services;


interface MarketDataService
{
    const SATS_PER_BTC = 100000000;

    /**
     * Current price
     *
     * Current price either cached (during time specified in price.tolerance) or retrieved from an API.
     * @param $crypto
     * @param $fiat
     * @return float price of the given currency pair
     * @throws Exception
     */
    public function getPrice(bool $force_refresh = false, $crypto = 'BTC', $fiat = 'CHF'):float ;

    /**
     * Converts any given satoshi value to USD
     * @param int $sat_val
     * @return float
     * @throws Exception
     */
    public function convertSatToUsd($sat_val);

    /**
     * Converts a satoshi value to USD and does some string formatting
     *
     * @param $sat_val
     * @return String
     * @throws Exception
     */
    public function convertSatToUsdFormat($sat_val): String;

}