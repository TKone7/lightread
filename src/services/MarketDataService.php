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

    public function getPrice(bool $force_refresh = false, $crypto = 'BTC', $fiat = 'CHF'):float ;

}