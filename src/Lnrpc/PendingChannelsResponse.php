<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lnrpc.PendingChannelsResponse</code>
 */
class PendingChannelsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; The balance in satoshis encumbered in pending channels
     *
     * Generated from protobuf field <code>int64 total_limbo_balance = 1[json_name = "total_limbo_balance"];</code>
     */
    private $total_limbo_balance = 0;
    /**
     *&#47; Channels pending opening
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.PendingOpenChannel pending_open_channels = 2[json_name = "pending_open_channels"];</code>
     */
    private $pending_open_channels;
    /**
     *&#47; Channels pending closing
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.ClosedChannel pending_closing_channels = 3[json_name = "pending_closing_channels"];</code>
     */
    private $pending_closing_channels;
    /**
     *&#47; Channels pending force closing
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.ForceClosedChannel pending_force_closing_channels = 4[json_name = "pending_force_closing_channels"];</code>
     */
    private $pending_force_closing_channels;
    /**
     *&#47; Channels waiting for closing tx to confirm
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.WaitingCloseChannel waiting_close_channels = 5[json_name = "waiting_close_channels"];</code>
     */
    private $waiting_close_channels;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     *&#47; The balance in satoshis encumbered in pending channels
     *
     * Generated from protobuf field <code>int64 total_limbo_balance = 1[json_name = "total_limbo_balance"];</code>
     * @return int|string
     */
    public function getTotalLimboBalance()
    {
        return $this->total_limbo_balance;
    }

    /**
     *&#47; The balance in satoshis encumbered in pending channels
     *
     * Generated from protobuf field <code>int64 total_limbo_balance = 1[json_name = "total_limbo_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setTotalLimboBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->total_limbo_balance = $var;

        return $this;
    }

    /**
     *&#47; Channels pending opening
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.PendingOpenChannel pending_open_channels = 2[json_name = "pending_open_channels"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPendingOpenChannels()
    {
        return $this->pending_open_channels;
    }

    /**
     *&#47; Channels pending opening
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.PendingOpenChannel pending_open_channels = 2[json_name = "pending_open_channels"];</code>
     * @param \Lnrpc\PendingChannelsResponse_PendingOpenChannel[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPendingOpenChannels($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\PendingChannelsResponse_PendingOpenChannel::class);
        $this->pending_open_channels = $arr;

        return $this;
    }

    /**
     *&#47; Channels pending closing
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.ClosedChannel pending_closing_channels = 3[json_name = "pending_closing_channels"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPendingClosingChannels()
    {
        return $this->pending_closing_channels;
    }

    /**
     *&#47; Channels pending closing
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.ClosedChannel pending_closing_channels = 3[json_name = "pending_closing_channels"];</code>
     * @param \Lnrpc\PendingChannelsResponse_ClosedChannel[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPendingClosingChannels($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\PendingChannelsResponse_ClosedChannel::class);
        $this->pending_closing_channels = $arr;

        return $this;
    }

    /**
     *&#47; Channels pending force closing
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.ForceClosedChannel pending_force_closing_channels = 4[json_name = "pending_force_closing_channels"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPendingForceClosingChannels()
    {
        return $this->pending_force_closing_channels;
    }

    /**
     *&#47; Channels pending force closing
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.ForceClosedChannel pending_force_closing_channels = 4[json_name = "pending_force_closing_channels"];</code>
     * @param \Lnrpc\PendingChannelsResponse_ForceClosedChannel[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPendingForceClosingChannels($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\PendingChannelsResponse_ForceClosedChannel::class);
        $this->pending_force_closing_channels = $arr;

        return $this;
    }

    /**
     *&#47; Channels waiting for closing tx to confirm
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.WaitingCloseChannel waiting_close_channels = 5[json_name = "waiting_close_channels"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getWaitingCloseChannels()
    {
        return $this->waiting_close_channels;
    }

    /**
     *&#47; Channels waiting for closing tx to confirm
     *
     * Generated from protobuf field <code>repeated .lnrpc.PendingChannelsResponse.WaitingCloseChannel waiting_close_channels = 5[json_name = "waiting_close_channels"];</code>
     * @param \Lnrpc\PendingChannelsResponse_WaitingCloseChannel[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setWaitingCloseChannels($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\PendingChannelsResponse_WaitingCloseChannel::class);
        $this->waiting_close_channels = $arr;

        return $this;
    }

}

