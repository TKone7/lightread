<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 **
 *A fully authenticated channel along with all its unique attributes.
 *Once an authenticated channel announcement has been processed on the network,
 *then an instance of ChannelEdgeInfo encapsulating the channels attributes is
 *stored. The other portions relevant to routing policy of a channel are stored
 *within a ChannelEdgePolicy for each direction of the channel.
 *
 * Generated from protobuf message <code>lnrpc.ChannelEdge</code>
 */
class ChannelEdge extends \Google\Protobuf\Internal\Message
{
    /**
     **
     *The unique channel ID for the channel. The first 3 bytes are the block
     *height, the next 3 the index within the block, and the last 2 bytes are the
     *output index for the channel.
     *
     * Generated from protobuf field <code>uint64 channel_id = 1[json_name = "channel_id"];</code>
     */
    private $channel_id = 0;
    /**
     * Generated from protobuf field <code>string chan_point = 2[json_name = "chan_point"];</code>
     */
    private $chan_point = '';
    /**
     * Generated from protobuf field <code>uint32 last_update = 3[json_name = "last_update", deprecated = true];</code>
     */
    private $last_update = 0;
    /**
     * Generated from protobuf field <code>string node1_pub = 4[json_name = "node1_pub"];</code>
     */
    private $node1_pub = '';
    /**
     * Generated from protobuf field <code>string node2_pub = 5[json_name = "node2_pub"];</code>
     */
    private $node2_pub = '';
    /**
     * Generated from protobuf field <code>int64 capacity = 6[json_name = "capacity"];</code>
     */
    private $capacity = 0;
    /**
     * Generated from protobuf field <code>.lnrpc.RoutingPolicy node1_policy = 7[json_name = "node1_policy"];</code>
     */
    private $node1_policy = null;
    /**
     * Generated from protobuf field <code>.lnrpc.RoutingPolicy node2_policy = 8[json_name = "node2_policy"];</code>
     */
    private $node2_policy = null;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     **
     *The unique channel ID for the channel. The first 3 bytes are the block
     *height, the next 3 the index within the block, and the last 2 bytes are the
     *output index for the channel.
     *
     * Generated from protobuf field <code>uint64 channel_id = 1[json_name = "channel_id"];</code>
     * @return int|string
     */
    public function getChannelId()
    {
        return $this->channel_id;
    }

    /**
     **
     *The unique channel ID for the channel. The first 3 bytes are the block
     *height, the next 3 the index within the block, and the last 2 bytes are the
     *output index for the channel.
     *
     * Generated from protobuf field <code>uint64 channel_id = 1[json_name = "channel_id"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setChannelId($var)
    {
        GPBUtil::checkUint64($var);
        $this->channel_id = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string chan_point = 2[json_name = "chan_point"];</code>
     * @return string
     */
    public function getChanPoint()
    {
        return $this->chan_point;
    }

    /**
     * Generated from protobuf field <code>string chan_point = 2[json_name = "chan_point"];</code>
     * @param string $var
     * @return $this
     */
    public function setChanPoint($var)
    {
        GPBUtil::checkString($var, True);
        $this->chan_point = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>uint32 last_update = 3[json_name = "last_update", deprecated = true];</code>
     * @return int
     */
    public function getLastUpdate()
    {
        return $this->last_update;
    }

    /**
     * Generated from protobuf field <code>uint32 last_update = 3[json_name = "last_update", deprecated = true];</code>
     * @param int $var
     * @return $this
     */
    public function setLastUpdate($var)
    {
        GPBUtil::checkUint32($var);
        $this->last_update = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string node1_pub = 4[json_name = "node1_pub"];</code>
     * @return string
     */
    public function getNode1Pub()
    {
        return $this->node1_pub;
    }

    /**
     * Generated from protobuf field <code>string node1_pub = 4[json_name = "node1_pub"];</code>
     * @param string $var
     * @return $this
     */
    public function setNode1Pub($var)
    {
        GPBUtil::checkString($var, True);
        $this->node1_pub = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string node2_pub = 5[json_name = "node2_pub"];</code>
     * @return string
     */
    public function getNode2Pub()
    {
        return $this->node2_pub;
    }

    /**
     * Generated from protobuf field <code>string node2_pub = 5[json_name = "node2_pub"];</code>
     * @param string $var
     * @return $this
     */
    public function setNode2Pub($var)
    {
        GPBUtil::checkString($var, True);
        $this->node2_pub = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>int64 capacity = 6[json_name = "capacity"];</code>
     * @return int|string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Generated from protobuf field <code>int64 capacity = 6[json_name = "capacity"];</code>
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
     * Generated from protobuf field <code>.lnrpc.RoutingPolicy node1_policy = 7[json_name = "node1_policy"];</code>
     * @return \Lnrpc\RoutingPolicy
     */
    public function getNode1Policy()
    {
        return $this->node1_policy;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.RoutingPolicy node1_policy = 7[json_name = "node1_policy"];</code>
     * @param \Lnrpc\RoutingPolicy $var
     * @return $this
     */
    public function setNode1Policy($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\RoutingPolicy::class);
        $this->node1_policy = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.RoutingPolicy node2_policy = 8[json_name = "node2_policy"];</code>
     * @return \Lnrpc\RoutingPolicy
     */
    public function getNode2Policy()
    {
        return $this->node2_policy;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.RoutingPolicy node2_policy = 8[json_name = "node2_policy"];</code>
     * @param \Lnrpc\RoutingPolicy $var
     * @return $this
     */
    public function setNode2Policy($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\RoutingPolicy::class);
        $this->node2_policy = $var;

        return $this;
    }

}

