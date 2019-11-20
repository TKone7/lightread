<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 04.11.19
 * Time: 10:22
 */

namespace rpcclient;

use config\Config;
use dao\NodeDAO;
use Grpc\ChannelCredentials;
use Lnrpc\LightningClient;

class RpcClient
{
    private static $node = "lndpi";
    private static $clientInstance = null;

    protected function __construct($node)
    {
        putenv('GRPC_SSL_CIPHER_SUITES=HIGH+ECDSA');
        if(!is_null(Config::get($node.".ip"))){
            $lndIp = Config::get($node.".ip");
            $ssl = file_get_contents(Config::get($node.".ssl"));
            $macaroon = file_get_contents(Config::get($node.".macaroon"));
        }else{
            $nd = new NodeDAO();
            $node = $nd->readActive();
            $ssl = $node["fld_node_tls"];
            $macaroon = hex2bin($node["fld_node_macaroon"]);
            $lndIp = $node["fld_node_ip"];
        }
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