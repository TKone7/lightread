<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.RoutingPolicy</code>
 */
class RoutingPolicy extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>uint32 time_lock_delta = 1[json_name = "time_lock_delta"];</code>
     */
    private $time_lock_delta = 0;
    /**
     * Generated from protobuf field <code>int64 min_htlc = 2[json_name = "min_htlc"];</code>
     */
    private $min_htlc = 0;
    /**
     * Generated from protobuf field <code>int64 fee_base_msat = 3[json_name = "fee_base_msat"];</code>
     */
    private $fee_base_msat = 0;
    /**
     * Generated from protobuf field <code>int64 fee_rate_milli_msat = 4[json_name = "fee_rate_milli_msat"];</code>
     */
    private $fee_rate_milli_msat = 0;
    /**
     * Generated from protobuf field <code>bool disabled = 5[json_name = "disabled"];</code>
     */
    private $disabled = false;
    /**
     * Generated from protobuf field <code>uint64 max_htlc_msat = 6[json_name = "max_htlc_msat"];</code>
     */
    private $max_htlc_msat = 0;
    /**
     * Generated from protobuf field <code>uint32 last_update = 7[json_name = "last_update"];</code>
     */
    private $last_update = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int $time_lock_delta
     *     @type int|string $min_htlc
     *     @type int|string $fee_base_msat
     *     @type int|string $fee_rate_milli_msat
     *     @type bool $disabled
     *     @type int|string $max_htlc_msat
     *     @type int $last_update
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>uint32 time_lock_delta = 1[json_name = "time_lock_delta"];</code>
     * @return int
     */
    public function getTimeLockDelta()
    {
        return $this->time_lock_delta;
    }

    /**
     * Generated from protobuf field <code>uint32 time_lock_delta = 1[json_name = "time_lock_delta"];</code>
     * @param int $var
     * @return $this
     */
    public function setTimeLockDelta($var)
    {
        GPBUtil::checkUint32($var);
        $this->time_lock_delta = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 min_htlc = 2[json_name = "min_htlc"];</code>
     * @return int|string
     */
    public function getMinHtlc()
    {
        return $this->min_htlc;
    }

    /**
     * Generated from protobuf field <code>int64 min_htlc = 2[json_name = "min_htlc"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setMinHtlc($var)
    {
        GPBUtil::checkInt64($var);
        $this->min_htlc = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 fee_base_msat = 3[json_name = "fee_base_msat"];</code>
     * @return int|string
     */
    public function getFeeBaseMsat()
    {
        return $this->fee_base_msat;
    }

    /**
     * Generated from protobuf field <code>int64 fee_base_msat = 3[json_name = "fee_base_msat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setFeeBaseMsat($var)
    {
        GPBUtil::checkInt64($var);
        $this->fee_base_msat = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 fee_rate_milli_msat = 4[json_name = "fee_rate_milli_msat"];</code>
     * @return int|string
     */
    public function getFeeRateMilliMsat()
    {
        return $this->fee_rate_milli_msat;
    }

    /**
     * Generated from protobuf field <code>int64 fee_rate_milli_msat = 4[json_name = "fee_rate_milli_msat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setFeeRateMilliMsat($var)
    {
        GPBUtil::checkInt64($var);
        $this->fee_rate_milli_msat = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>bool disabled = 5[json_name = "disabled"];</code>
     * @return bool
     */
    public function getDisabled()
    {
        return $this->disabled;
    }

    /**
     * Generated from protobuf field <code>bool disabled = 5[json_name = "disabled"];</code>
     * @param bool $var
     * @return $this
     */
    public function setDisabled($var)
    {
        GPBUtil::checkBool($var);
        $this->disabled = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint64 max_htlc_msat = 6[json_name = "max_htlc_msat"];</code>
     * @return int|string
     */
    public function getMaxHtlcMsat()
    {
        return $this->max_htlc_msat;
    }

    /**
     * Generated from protobuf field <code>uint64 max_htlc_msat = 6[json_name = "max_htlc_msat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setMaxHtlcMsat($var)
    {
        GPBUtil::checkUint64($var);
        $this->max_htlc_msat = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 last_update = 7[json_name = "last_update"];</code>
     * @return int
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Generated from protobuf field <code>uint32 last_update = 7[json_name = "last_update"];</code>
     * @param int $var
     * @return $this
     */
    public function setLastUpdate($var)
    {
        GPBUtil::checkUint32($var);
        $this->last_update = $var;

        return $this;
    }

}

