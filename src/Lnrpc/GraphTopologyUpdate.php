<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.GraphTopologyUpdate</code>
 */
class GraphTopologyUpdate extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .lnrpc.NodeUpdate node_updates = 1;</code>
     */
    private $node_updates;
    /**
     * Generated from protobuf field <code>repeated .lnrpc.ChannelEdgeUpdate channel_updates = 2;</code>
     */
    private $channel_updates;
    /**
     * Generated from protobuf field <code>repeated .lnrpc.ClosedChannelUpdate closed_chans = 3;</code>
     */
    private $closed_chans;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Lnrpc\NodeUpdate[]|\Google\Protobuf\Internal\RepeatedField $node_updates
     *     @type \Lnrpc\ChannelEdgeUpdate[]|\Google\Protobuf\Internal\RepeatedField $channel_updates
     *     @type \Lnrpc\ClosedChannelUpdate[]|\Google\Protobuf\Internal\RepeatedField $closed_chans
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>repeated .lnrpc.NodeUpdate node_updates = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getNodeUpdates()
    {
        return $this->node_updates;
    }

    /**
     * Generated from protobuf field <code>repeated .lnrpc.NodeUpdate node_updates = 1;</code>
     * @param \Lnrpc\NodeUpdate[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setNodeUpdates($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\NodeUpdate::class);
        $this->node_updates = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .lnrpc.ChannelEdgeUpdate channel_updates = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getChannelUpdates()
    {
        return $this->channel_updates;
    }

    /**
     * Generated from protobuf field <code>repeated .lnrpc.ChannelEdgeUpdate channel_updates = 2;</code>
     * @param \Lnrpc\ChannelEdgeUpdate[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setChannelUpdates($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\ChannelEdgeUpdate::class);
        $this->channel_updates = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>repeated .lnrpc.ClosedChannelUpdate closed_chans = 3;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getClosedChans()
    {
        return $this->closed_chans;
    }

    /**
     * Generated from protobuf field <code>repeated .lnrpc.ClosedChannelUpdate closed_chans = 3;</code>
     * @param \Lnrpc\ClosedChannelUpdate[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setClosedChans($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\ClosedChannelUpdate::class);
        $this->closed_chans = $arr;

        return $this;
    }

}

