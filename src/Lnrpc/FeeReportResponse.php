<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lnrpc.FeeReportResponse</code>
 */
class FeeReportResponse extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; An array of channel fee reports which describes the current fee schedule for each channel.
     *
     * Generated from protobuf field <code>repeated .lnrpc.ChannelFeeReport channel_fees = 1[json_name = "channel_fees"];</code>
     */
    private $channel_fees;
    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 24 hrs.
     *
     * Generated from protobuf field <code>uint64 day_fee_sum = 2[json_name = "day_fee_sum"];</code>
     */
    private $day_fee_sum = 0;
    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 1 week.
     *
     * Generated from protobuf field <code>uint64 week_fee_sum = 3[json_name = "week_fee_sum"];</code>
     */
    private $week_fee_sum = 0;
    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 1 month.
     *
     * Generated from protobuf field <code>uint64 month_fee_sum = 4[json_name = "month_fee_sum"];</code>
     */
    private $month_fee_sum = 0;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     *&#47; An array of channel fee reports which describes the current fee schedule for each channel.
     *
     * Generated from protobuf field <code>repeated .lnrpc.ChannelFeeReport channel_fees = 1[json_name = "channel_fees"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getChannelFees()
    {
        return $this->channel_fees;
    }

    /**
     *&#47; An array of channel fee reports which describes the current fee schedule for each channel.
     *
     * Generated from protobuf field <code>repeated .lnrpc.ChannelFeeReport channel_fees = 1[json_name = "channel_fees"];</code>
     * @param \Lnrpc\ChannelFeeReport[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setChannelFees($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\ChannelFeeReport::class);
        $this->channel_fees = $arr;

        return $this;
    }

    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 24 hrs.
     *
     * Generated from protobuf field <code>uint64 day_fee_sum = 2[json_name = "day_fee_sum"];</code>
     * @return int|string
     */
    public function getDayFeeSum()
    {
        return $this->day_fee_sum;
    }

    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 24 hrs.
     *
     * Generated from protobuf field <code>uint64 day_fee_sum = 2[json_name = "day_fee_sum"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setDayFeeSum($var)
    {
        GPBUtil::checkUint64($var);
        $this->day_fee_sum = $var;

        return $this;
    }

    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 1 week.
     *
     * Generated from protobuf field <code>uint64 week_fee_sum = 3[json_name = "week_fee_sum"];</code>
     * @return int|string
     */
    public function getWeekFeeSum()
    {
        return $this->week_fee_sum;
    }

    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 1 week.
     *
     * Generated from protobuf field <code>uint64 week_fee_sum = 3[json_name = "week_fee_sum"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setWeekFeeSum($var)
    {
        GPBUtil::checkUint64($var);
        $this->week_fee_sum = $var;

        return $this;
    }

    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 1 month.
     *
     * Generated from protobuf field <code>uint64 month_fee_sum = 4[json_name = "month_fee_sum"];</code>
     * @return int|string
     */
    public function getMonthFeeSum()
    {
        return $this->month_fee_sum;
    }

    /**
     *&#47; The total amount of fee revenue (in satoshis) the switch has collected over the past 1 month.
     *
     * Generated from protobuf field <code>uint64 month_fee_sum = 4[json_name = "month_fee_sum"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setMonthFeeSum($var)
    {
        GPBUtil::checkUint64($var);
        $this->month_fee_sum = $var;

        return $this;
    }

}

