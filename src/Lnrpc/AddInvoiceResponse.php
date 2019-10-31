<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.AddInvoiceResponse</code>
 */
class AddInvoiceResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>bytes r_hash = 1[json_name = "r_hash"];</code>
     */
    private $r_hash = '';
    /**
     **
     *A bare-bones invoice for a payment within the Lightning Network.  With the
     *details of the invoice, the sender has all the data necessary to send a
     *payment to the recipient.
     *
     * Generated from protobuf field <code>string payment_request = 2[json_name = "payment_request"];</code>
     */
    private $payment_request = '';
    /**
     **
     *The "add" index of this invoice. Each newly created invoice will increment
     *this index making it monotonically increasing. Callers to the
     *SubscribeInvoices call can use this to instantly get notified of all added
     *invoices with an add_index greater than this one.
     *
     * Generated from protobuf field <code>uint64 add_index = 16[json_name = "add_index"];</code>
     */
    private $add_index = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $r_hash
     *     @type string $payment_request
     *          *
     *          A bare-bones invoice for a payment within the Lightning Network.  With the
     *          details of the invoice, the sender has all the data necessary to send a
     *          payment to the recipient.
     *     @type int|string $add_index
     *          *
     *          The "add" index of this invoice. Each newly created invoice will increment
     *          this index making it monotonically increasing. Callers to the
     *          SubscribeInvoices call can use this to instantly get notified of all added
     *          invoices with an add_index greater than this one.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>bytes r_hash = 1[json_name = "r_hash"];</code>
     * @return string
     */
    public function getRHash()
    {
        return $this->r_hash;
    }

    /**
     * Generated from protobuf field <code>bytes r_hash = 1[json_name = "r_hash"];</code>
     * @param string $var
     * @return $this
     */
    public function setRHash($var)
    {
        GPBUtil::checkString($var, False);
        $this->r_hash = $var;

        return $this;
    }

    /**
     **
     *A bare-bones invoice for a payment within the Lightning Network.  With the
     *details of the invoice, the sender has all the data necessary to send a
     *payment to the recipient.
     *
     * Generated from protobuf field <code>string payment_request = 2[json_name = "payment_request"];</code>
     * @return string
     */
    public function getPaymentRequest()
    {
        return $this->payment_request;
    }

    /**
     **
     *A bare-bones invoice for a payment within the Lightning Network.  With the
     *details of the invoice, the sender has all the data necessary to send a
     *payment to the recipient.
     *
     * Generated from protobuf field <code>string payment_request = 2[json_name = "payment_request"];</code>
     * @param string $var
     * @return $this
     */
    public function setPaymentRequest($var)
    {
        GPBUtil::checkString($var, True);
        $this->payment_request = $var;

        return $this;
    }

    /**
     **
     *The "add" index of this invoice. Each newly created invoice will increment
     *this index making it monotonically increasing. Callers to the
     *SubscribeInvoices call can use this to instantly get notified of all added
     *invoices with an add_index greater than this one.
     *
     * Generated from protobuf field <code>uint64 add_index = 16[json_name = "add_index"];</code>
     * @return int|string
     */
    public function getAddIndex()
    {
        return $this->add_index;
    }

    /**
     **
     *The "add" index of this invoice. Each newly created invoice will increment
     *this index making it monotonically increasing. Callers to the
     *SubscribeInvoices call can use this to instantly get notified of all added
     *invoices with an add_index greater than this one.
     *
     * Generated from protobuf field <code>uint64 add_index = 16[json_name = "add_index"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setAddIndex($var)
    {
        GPBUtil::checkUint64($var);
        $this->add_index = $var;

        return $this;
    }

}

