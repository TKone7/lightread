<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.ChannelEventUpdate</code>
 */
class ChannelEventUpdate extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.lnrpc.ChannelEventUpdate.UpdateType type = 5[json_name = "type"];</code>
     */
    private $type = 0;
    protected $channel;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Lnrpc\Channel $open_channel
     *     @type \Lnrpc\ChannelCloseSummary $closed_channel
     *     @type \Lnrpc\ChannelPoint $active_channel
     *     @type \Lnrpc\ChannelPoint $inactive_channel
     *     @type int $type
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.Channel open_channel = 1[json_name = "open_channel"];</code>
     * @return \Lnrpc\Channel
     */
    public function getOpenChannel()
    {
        return $this->readOneof(1);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.Channel open_channel = 1[json_name = "open_channel"];</code>
     * @param \Lnrpc\Channel $var
     * @return $this
     */
    public function setOpenChannel($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\Channel::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelCloseSummary closed_channel = 2[json_name = "closed_channel"];</code>
     * @return \Lnrpc\ChannelCloseSummary
     */
    public function getClosedChannel()
    {
        return $this->readOneof(2);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelCloseSummary closed_channel = 2[json_name = "closed_channel"];</code>
     * @param \Lnrpc\ChannelCloseSummary $var
     * @return $this
     */
    public function setClosedChannel($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\ChannelCloseSummary::class);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelPoint active_channel = 3[json_name = "active_channel"];</code>
     * @return \Lnrpc\ChannelPoint
     */
    public function getActiveChannel()
    {
        return $this->readOneof(3);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelPoint active_channel = 3[json_name = "active_channel"];</code>
     * @param \Lnrpc\ChannelPoint $var
     * @return $this
     */
    public function setActiveChannel($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\ChannelPoint::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelPoint inactive_channel = 4[json_name = "inactive_channel"];</code>
     * @return \Lnrpc\ChannelPoint
     */
    public function getInactiveChannel()
    {
        return $this->readOneof(4);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelPoint inactive_channel = 4[json_name = "inactive_channel"];</code>
     * @param \Lnrpc\ChannelPoint $var
     * @return $this
     */
    public function setInactiveChannel($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\ChannelPoint::class);
        $this->writeOneof(4, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelEventUpdate.UpdateType type = 5[json_name = "type"];</code>
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelEventUpdate.UpdateType type = 5[json_name = "type"];</code>
     * @param int $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkEnum($var, \Lnrpc\ChannelEventUpdate_UpdateType::class);
        $this->type = $var;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannel()
    {
        return $this->whichOneof("channel");
    }

}

