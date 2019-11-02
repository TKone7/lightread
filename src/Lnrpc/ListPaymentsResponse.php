<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.ListPaymentsResponse</code>
 */
class ListPaymentsResponse extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; The list of payments
     *
     * Generated from protobuf field <code>repeated .lnrpc.Payment payments = 1[json_name = "payments"];</code>
     */
    private $payments;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Lnrpc\Payment[]|\Google\Protobuf\Internal\RepeatedField $payments
     *          &#47; The list of payments
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     *&#47; The list of payments
     *
     * Generated from protobuf field <code>repeated .lnrpc.Payment payments = 1[json_name = "payments"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     *&#47; The list of payments
     *
     * Generated from protobuf field <code>repeated .lnrpc.Payment payments = 1[json_name = "payments"];</code>
     * @param \Lnrpc\Payment[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPayments($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\Payment::class);
        $this->payments = $arr;

        return $this;
    }

}
