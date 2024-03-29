<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lnrpc.PendingChannelsResponse.PendingChannel</code>
 */
class PendingChannelsResponse_PendingChannel extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string remote_node_pub = 1[json_name = "remote_node_pub"];</code>
     */
    private $remote_node_pub = '';
    /**
     * Generated from protobuf field <code>string channel_point = 2[json_name = "channel_point"];</code>
     */
    private $channel_point = '';
    /**
     * Generated from protobuf field <code>int64 capacity = 3[json_name = "capacity"];</code>
     */
    private $capacity = 0;
    /**
     * Generated from protobuf field <code>int64 local_balance = 4[json_name = "local_balance"];</code>
     */
    private $local_balance = 0;
    /**
     * Generated from protobuf field <code>int64 remote_balance = 5[json_name = "remote_balance"];</code>
     */
    private $remote_balance = 0;
    /**
     *&#47; The minimum satoshis this node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 local_chan_reserve_sat = 6[json_name = "local_chan_reserve_sat"];</code>
     */
    private $local_chan_reserve_sat = 0;
    /**
     **
     *The minimum satoshis the other node is required to reserve in its
     *balance.
     *
     * Generated from protobuf field <code>int64 remote_chan_reserve_sat = 7[json_name = "remote_chan_reserve_sat"];</code>
     */
    private $remote_chan_reserve_sat = 0;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>string remote_node_pub = 1[json_name = "remote_node_pub"];</code>
     * @return string
     */
    public function getRemoteNodePub()
    {
        return $this->remote_node_pub;
    }

    /**
     * Generated from protobuf field <code>string remote_node_pub = 1[json_name = "remote_node_pub"];</code>
     * @param string $var
     * @return $this
     */
    public function setRemoteNodePub($var)
    {
        GPBUtil::checkString($var, True);
        $this->remote_node_pub = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string channel_point = 2[json_name = "channel_point"];</code>
     * @return string
     */
    public function getChannelPoint()
    {
        return $this->channel_point;
    }

    /**
     * Generated from protobuf field <code>string channel_point = 2[json_name = "channel_point"];</code>
     * @param string $var
     * @return $this
     */
    public function setChannelPoint($var)
    {
        GPBUtil::checkString($var, True);
        $this->channel_point = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 capacity = 3[json_name = "capacity"];</code>
     * @return int|string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Generated from protobuf field <code>int64 capacity = 3[json_name = "capacity"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setCapacity($var)
    {
        GPBUtil::checkInt64($var);
        $this->capacity = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 local_balance = 4[json_name = "local_balance"];</code>
     * @return int|string
     */
    public function getLocalBalance()
    {
        return $this->local_balance;
    }

    /**
     * Generated from protobuf field <code>int64 local_balance = 4[json_name = "local_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setLocalBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->local_balance = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 remote_balance = 5[json_name = "remote_balance"];</code>
     * @return int|string
     */
    public function getRemoteBalance()
    {
        return $this->remote_balance;
    }

    /**
     * Generated from protobuf field <code>int64 remote_balance = 5[json_name = "remote_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setRemoteBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->remote_balance = $var;

        return $this;
    }

    /**
     *&#47; The minimum satoshis this node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 local_chan_reserve_sat = 6[json_name = "local_chan_reserve_sat"];</code>
     * @return int|string
     */
    public function getLocalChanReserveSat()
    {
        return $this->local_chan_reserve_sat;
    }

    /**
     *&#47; The minimum satoshis this node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 local_chan_reserve_sat = 6[json_name = "local_chan_reserve_sat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setLocalChanReserveSat($var)
    {
        GPBUtil::checkInt64($var);
        $this->local_chan_reserve_sat = $var;

        return $this;
    }

    /**
     **
     *The minimum satoshis the other node is required to reserve in its
     *balance.
     *
     * Generated from protobuf field <code>int64 remote_chan_reserve_sat = 7[json_name = "remote_chan_reserve_sat"];</code>
     * @return int|string
     */
    public function getRemoteChanReserveSat()
    {
        return $this->remote_chan_reserve_sat;
    }

    /**
     **
     *The minimum satoshis the other node is required to reserve in its
     *balance.
     *
     * Generated from protobuf field <code>int64 remote_chan_reserve_sat = 7[json_name = "remote_chan_reserve_sat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setRemoteChanReserveSat($var)
    {
        GPBUtil::checkInt64($var);
        $this->remote_chan_reserve_sat = $var;

        return $this;
    }

}

