<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lnrpc.ForwardingEvent</code>
 */
class ForwardingEvent extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; Timestamp is the time (unix epoch offset) that this circuit was completed.
     *
     * Generated from protobuf field <code>uint64 timestamp = 1[json_name = "timestamp"];</code>
     */
    private $timestamp = 0;
    /**
     *&#47; The incoming channel ID that carried the HTLC that created the circuit.
     *
     * Generated from protobuf field <code>uint64 chan_id_in = 2[json_name = "chan_id_in"];</code>
     */
    private $chan_id_in = 0;
    /**
     *&#47; The outgoing channel ID that carried the preimage that completed the circuit.
     *
     * Generated from protobuf field <code>uint64 chan_id_out = 4[json_name = "chan_id_out"];</code>
     */
    private $chan_id_out = 0;
    /**
     *&#47; The total amount (in satoshis) of the incoming HTLC that created half the circuit.
     *
     * Generated from protobuf field <code>uint64 amt_in = 5[json_name = "amt_in"];</code>
     */
    private $amt_in = 0;
    /**
     *&#47; The total amount (in satoshis) of the outgoing HTLC that created the second half of the circuit.
     *
     * Generated from protobuf field <code>uint64 amt_out = 6[json_name = "amt_out"];</code>
     */
    private $amt_out = 0;
    /**
     *&#47; The total fee (in satoshis) that this payment circuit carried.
     *
     * Generated from protobuf field <code>uint64 fee = 7[json_name = "fee"];</code>
     */
    private $fee = 0;
    /**
     *&#47; The total fee (in milli-satoshis) that this payment circuit carried.
     *
     * Generated from protobuf field <code>uint64 fee_msat = 8[json_name = "fee_msat"];</code>
     */
    private $fee_msat = 0;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     *&#47; Timestamp is the time (unix epoch offset) that this circuit was completed.
     *
     * Generated from protobuf field <code>uint64 timestamp = 1[json_name = "timestamp"];</code>
     * @return int|string
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     *&#47; Timestamp is the time (unix epoch offset) that this circuit was completed.
     *
     * Generated from protobuf field <code>uint64 timestamp = 1[json_name = "timestamp"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setTimestamp($var)
    {
        GPBUtil::checkUint64($var);
        $this->timestamp = $var;

        return $this;
    }

    /**
     *&#47; The incoming channel ID that carried the HTLC that created the circuit.
     *
     * Generated from protobuf field <code>uint64 chan_id_in = 2[json_name = "chan_id_in"];</code>
     * @return int|string
     */
    public function getChanIdIn()
    {
        return $this->chan_id_in;
    }

    /**
     *&#47; The incoming channel ID that carried the HTLC that created the circuit.
     *
     * Generated from protobuf field <code>uint64 chan_id_in = 2[json_name = "chan_id_in"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setChanIdIn($var)
    {
        GPBUtil::checkUint64($var);
        $this->chan_id_in = $var;

        return $this;
    }

    /**
     *&#47; The outgoing channel ID that carried the preimage that completed the circuit.
     *
     * Generated from protobuf field <code>uint64 chan_id_out = 4[json_name = "chan_id_out"];</code>
     * @return int|string
     */
    public function getChanIdOut()
    {
        return $this->chan_id_out;
    }

    /**
     *&#47; The outgoing channel ID that carried the preimage that completed the circuit.
     *
     * Generated from protobuf field <code>uint64 chan_id_out = 4[json_name = "chan_id_out"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setChanIdOut($var)
    {
        GPBUtil::checkUint64($var);
        $this->chan_id_out = $var;

        return $this;
    }

    /**
     *&#47; The total amount (in satoshis) of the incoming HTLC that created half the circuit.
     *
     * Generated from protobuf field <code>uint64 amt_in = 5[json_name = "amt_in"];</code>
     * @return int|string
     */
    public function getAmtIn()
    {
        return $this->amt_in;
    }

    /**
     *&#47; The total amount (in satoshis) of the incoming HTLC that created half the circuit.
     *
     * Generated from protobuf field <code>uint64 amt_in = 5[json_name = "amt_in"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setAmtIn($var)
    {
        GPBUtil::checkUint64($var);
        $this->amt_in = $var;

        return $this;
    }

    /**
     *&#47; The total amount (in satoshis) of the outgoing HTLC that created the second half of the circuit.
     *
     * Generated from protobuf field <code>uint64 amt_out = 6[json_name = "amt_out"];</code>
     * @return int|string
     */
    public function getAmtOut()
    {
        return $this->amt_out;
    }

    /**
     *&#47; The total amount (in satoshis) of the outgoing HTLC that created the second half of the circuit.
     *
     * Generated from protobuf field <code>uint64 amt_out = 6[json_name = "amt_out"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setAmtOut($var)
    {
        GPBUtil::checkUint64($var);
        $this->amt_out = $var;

        return $this;
    }

    /**
     *&#47; The total fee (in satoshis) that this payment circuit carried.
     *
     * Generated from protobuf field <code>uint64 fee = 7[json_name = "fee"];</code>
     * @return int|string
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     *&#47; The total fee (in satoshis) that this payment circuit carried.
     *
     * Generated from protobuf field <code>uint64 fee = 7[json_name = "fee"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setFee($var)
    {
        GPBUtil::checkUint64($var);
        $this->fee = $var;

        return $this;
    }

    /**
     *&#47; The total fee (in milli-satoshis) that this payment circuit carried.
     *
     * Generated from protobuf field <code>uint64 fee_msat = 8[json_name = "fee_msat"];</code>
     * @return int|string
     */
    public function getFeeMsat()
    {
        return $this->fee_msat;
    }

    /**
     *&#47; The total fee (in milli-satoshis) that this payment circuit carried.
     *
     * Generated from protobuf field <code>uint64 fee_msat = 8[json_name = "fee_msat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setFeeMsat($var)
    {
        GPBUtil::checkUint64($var);
        $this->fee_msat = $var;

        return $this;
    }

}

