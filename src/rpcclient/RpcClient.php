<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 04.11.19
 * Time: 10:22
 */

namespace rpcclient;

use config\Config;
use Lnrpc\LightningClient;
use Grpc\ChannelCredentials;

class RpcClient
{
    private static $node = "lndbob";
    private static $clientInstance = null;

    protected function __construct($node)
    {
        putenv('GRPC_SSL_CIPHER_SUITES=HIGH+ECDSA');
        $lndIp = Config::get($node.".ip");
        $ssl = file_get_contents(Config::get($node.".ssl"));
        $macaroon = file_get_contents(Config::get($node.".macaroon"));
        $metadataCallback = function ($metadata) use ($macaroon) {
            return ['macaroon' => [bin2hex($macaroon)]];
        };
        try{
            self::$clientInstance = new LightningClient($lndIp, [
                'credentials' => ChannelCredentials::createSsl($ssl),
                'update_metadata' => $metadataCallback
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
            echo "something went wrong";
        }

    }

    public static function connect()
    {
        if (self::$clientInstance) {
            return self::$clientInstance;
        }

        new self(self::$node);

        return self::$clientInstance;
    }

}