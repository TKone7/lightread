<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.ChannelBalanceResponse</code>
 */
class ChannelBalanceResponse extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; Sum of channels balances denominated in satoshis
     *
     * Generated from protobuf field <code>int64 balance = 1[json_name = "balance"];</code>
     */
    private $balance = 0;
    /**
     *&#47; Sum of channels pending balances denominated in satoshis
     *
     * Generated from protobuf field <code>int64 pending_open_balance = 2[json_name = "pending_open_balance"];</code>
     */
    private $pending_open_balance = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type int|string $balance
     *          &#47; Sum of channels balances denominated in satoshis
     *     @type int|string $pending_open_balance
     *          &#47; Sum of channels pending balances denominated in satoshis
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     *&#47; Sum of channels balances denominated in satoshis
     *
     * Generated from protobuf field <code>int64 balance = 1[json_name = "balance"];</code>
     * @return int|string
     */
    public function getBalance()
    {
        return $this->balance;
    }

    /**
     *&#47; Sum of channels balances denominated in satoshis
     *
     * Generated from protobuf field <code>int64 balance = 1[json_name = "balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->balance = $var;

        return $this;
    }

    /**
     *&#47; Sum of channels pending balances denominated in satoshis
     *
     * Generated from protobuf field <code>int64 pending_open_balance = 2[json_name = "pending_open_balance"];</code>
     * @return int|string
     */
    public function getPendingOpenBalance()
    {
        return $this->pending_open_balance;
    }

    /**
     *&#47; Sum of channels pending balances denominated in satoshis
     *
     * Generated from protobuf field <code>int64 pending_open_balance = 2[json_name = "pending_open_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setPendingOpenBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->pending_open_balance = $var;

        return $this;
    }

}

