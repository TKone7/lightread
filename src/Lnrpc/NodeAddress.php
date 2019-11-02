<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.NodeAddress</code>
 */
class NodeAddress extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string network = 1[json_name = "network"];</code>
     */
    private $network = '';
    /**
     * Generated from protobuf field <code>string addr = 2[json_name = "addr"];</code>
     */
    private $addr = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $network
     *     @type string $addr
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string network = 1[json_name = "network"];</code>
     * @return string
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * Generated from protobuf field <code>string network = 1[json_name = "network"];</code>
     * @param string $var
     * @return $this
     */
    public function setNetwork($var)
    {
        GPBUtil::checkString($var, True);
        $this->network = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string addr = 2[json_name = "addr"];</code>
     * @return string
     */
    public function getAddr()
    {
        return $this->addr;
    }

    /**
     * Generated from protobuf field <code>string addr = 2[json_name = "addr"];</code>
     * @param string $var
     * @return $this
     */
    public function setAddr($var)
    {
        GPBUtil::checkString($var, True);
        $this->addr = $var;

        return $this;
    }

}
