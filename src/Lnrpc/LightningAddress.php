<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.LightningAddress</code>
 */
class LightningAddress extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; The identity pubkey of the Lightning node
     *
     * Generated from protobuf field <code>string pubkey = 1[json_name = "pubkey"];</code>
     */
    private $pubkey = '';
    /**
     *&#47; The network location of the lightning node, e.g. `69.69.69.69:1337` or `localhost:10011`
     *
     * Generated from protobuf field <code>string host = 2[json_name = "host"];</code>
     */
    private $host = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $pubkey
     *          &#47; The identity pubkey of the Lightning node
     *     @type string $host
     *          &#47; The network location of the lightning node, e.g. `69.69.69.69:1337` or `localhost:10011`
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     *&#47; The identity pubkey of the Lightning node
     *
     * Generated from protobuf field <code>string pubkey = 1[json_name = "pubkey"];</code>
     * @return string
     */
    public function getPubkey()
    {
        return $this->pubkey;
    }

    /**
     *&#47; The identity pubkey of the Lightning node
     *
     * Generated from protobuf field <code>string pubkey = 1[json_name = "pubkey"];</code>
     * @param string $var
     * @return $this
     */
    public function setPubkey($var)
    {
        GPBUtil::checkString($var, True);
        $this->pubkey = $var;

        return $this;
    }

    /**
     *&#47; The network location of the lightning node, e.g. `69.69.69.69:1337` or `localhost:10011`
     *
     * Generated from protobuf field <code>string host = 2[json_name = "host"];</code>
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     *&#47; The network location of the lightning node, e.g. `69.69.69.69:1337` or `localhost:10011`
     *
     * Generated from protobuf field <code>string host = 2[json_name = "host"];</code>
     * @param string $var
     * @return $this
     */
    public function setHost($var)
    {
        GPBUtil::checkString($var, True);
        $this->host = $var;

        return $this;
    }

}
