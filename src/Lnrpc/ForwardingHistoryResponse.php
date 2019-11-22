<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lnrpc.ForwardingHistoryResponse</code>
 */
class ForwardingHistoryResponse extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; A list of forwarding events from the time slice of the time series specified in the request.
     *
     * Generated from protobuf field <code>repeated .lnrpc.ForwardingEvent forwarding_events = 1[json_name = "forwarding_events"];</code>
     */
    private $forwarding_events;
    /**
     *&#47; The index of the last time in the set of returned forwarding events. Can be used to seek further, pagination style.
     *
     * Generated from protobuf field <code>uint32 last_offset_index = 2[json_name = "last_offset_index"];</code>
     */
    private $last_offset_index = 0;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     *&#47; A list of forwarding events from the time slice of the time series specified in the request.
     *
     * Generated from protobuf field <code>repeated .lnrpc.ForwardingEvent forwarding_events = 1[json_name = "forwarding_events"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getForwardingEvents()
    {
        return $this->forwarding_events;
    }

    /**
     *&#47; A list of forwarding events from the time slice of the time series specified in the request.
     *
     * Generated from protobuf field <code>repeated .lnrpc.ForwardingEvent forwarding_events = 1[json_name = "forwarding_events"];</code>
     * @param \Lnrpc\ForwardingEvent[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setForwardingEvents($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\ForwardingEvent::class);
        $this->forwarding_events = $arr;

        return $this;
    }

    /**
     *&#47; The index of the last time in the set of returned forwarding events. Can be used to seek further, pagination style.
     *
     * Generated from protobuf field <code>uint32 last_offset_index = 2[json_name = "last_offset_index"];</code>
     * @return int
     */
    public function getLastOffsetIndex()
    {
        return $this->last_offset_index;
    }

    /**
     *&#47; The index of the last time in the set of returned forwarding events. Can be used to seek further, pagination style.
     *
     * Generated from protobuf field <code>uint32 last_offset_index = 2[json_name = "last_offset_index"];</code>
     * @param int $var
     * @return $this
     */
    public function setLastOffsetIndex($var)
    {
        GPBUtil::checkUint32($var);
        $this->last_offset_index = $var;

        return $this;
    }

}

