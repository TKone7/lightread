<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.PendingUpdate</code>
 */
class PendingUpdate extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bytes txid = 1[json_name = "txid"];</code>
     */
    private $txid = '';
    /**
     * Generated from protobuf field <code>uint32 output_index = 2[json_name = "output_index"];</code>
     */
    private $output_index = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $txid
     *     @type int $output_index
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>bytes txid = 1[json_name = "txid"];</code>
     * @return string
     */
    public function getTxid()
    {
        return $this->txid;
    }

    /**
     * Generated from protobuf field <code>bytes txid = 1[json_name = "txid"];</code>
     * @param string $var
     * @return $this
     */
    public function setTxid($var)
    {
        GPBUtil::checkString($var, False);
        $this->txid = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 output_index = 2[json_name = "output_index"];</code>
     * @return int
     */
    public function getOutputIndex()
    {
        return $this->output_index;
    }

    /**
     * Generated from protobuf field <code>uint32 output_index = 2[json_name = "output_index"];</code>
     * @param int $var
     * @return $this
     */
    public function setOutputIndex($var)
    {
        GPBUtil::checkUint32($var);
        $this->output_index = $var;

        return $this;
    }

}
