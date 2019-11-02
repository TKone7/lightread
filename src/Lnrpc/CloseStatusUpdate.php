<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.CloseStatusUpdate</code>
 */
class CloseStatusUpdate extends \Google\Protobuf\Internal\Message
{
    protected $update;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Lnrpc\PendingUpdate $close_pending
     *     @type \Lnrpc\ChannelCloseUpdate $chan_close
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.PendingUpdate close_pending = 1[json_name = "close_pending"];</code>
     * @return \Lnrpc\PendingUpdate
     */
    public function getClosePending()
    {
        return $this->readOneof(1);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.PendingUpdate close_pending = 1[json_name = "close_pending"];</code>
     * @param \Lnrpc\PendingUpdate $var
     * @return $this
     */
    public function setClosePending($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\PendingUpdate::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelCloseUpdate chan_close = 3[json_name = "chan_close"];</code>
     * @return \Lnrpc\ChannelCloseUpdate
     */
    public function getChanClose()
    {
        return $this->readOneof(3);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelCloseUpdate chan_close = 3[json_name = "chan_close"];</code>
     * @param \Lnrpc\ChannelCloseUpdate $var
     * @return $this
     */
    public function setChanClose($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\ChannelCloseUpdate::class);
        $this->writeOneof(3, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getUpdate()
    {
        return $this->whichOneof("update");
    }

}
