<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lnrpc.WalletBalanceResponse</code>
 */
class WalletBalanceResponse extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; The balance of the wallet
     *
     * Generated from protobuf field <code>int64 total_balance = 1[json_name = "total_balance"];</code>
     */
    private $total_balance = 0;
    /**
     *&#47; The confirmed balance of a wallet(with >= 1 confirmations)
     *
     * Generated from protobuf field <code>int64 confirmed_balance = 2[json_name = "confirmed_balance"];</code>
     */
    private $confirmed_balance = 0;
    /**
     *&#47; The unconfirmed balance of a wallet(with 0 confirmations)
     *
     * Generated from protobuf field <code>int64 unconfirmed_balance = 3[json_name = "unconfirmed_balance"];</code>
     */
    private $unconfirmed_balance = 0;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     *&#47; The balance of the wallet
     *
     * Generated from protobuf field <code>int64 total_balance = 1[json_name = "total_balance"];</code>
     * @return int|string
     */
    public function getTotalBalance()
    {
        return $this->total_balance;
    }

    /**
     *&#47; The balance of the wallet
     *
     * Generated from protobuf field <code>int64 total_balance = 1[json_name = "total_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setTotalBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->total_balance = $var;

        return $this;
    }

    /**
     *&#47; The confirmed balance of a wallet(with >= 1 confirmations)
     *
     * Generated from protobuf field <code>int64 confirmed_balance = 2[json_name = "confirmed_balance"];</code>
     * @return int|string
     */
    public function getConfirmedBalance()
    {
        return $this->confirmed_balance;
    }

    /**
     *&#47; The confirmed balance of a wallet(with >= 1 confirmations)
     *
     * Generated from protobuf field <code>int64 confirmed_balance = 2[json_name = "confirmed_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setConfirmedBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->confirmed_balance = $var;

        return $this;
    }

    /**
     *&#47; The unconfirmed balance of a wallet(with 0 confirmations)
     *
     * Generated from protobuf field <code>int64 unconfirmed_balance = 3[json_name = "unconfirmed_balance"];</code>
     * @return int|string
     */
    public function getUnconfirmedBalance()
    {
        return $this->unconfirmed_balance;
    }

    /**
     *&#47; The unconfirmed balance of a wallet(with 0 confirmations)
     *
     * Generated from protobuf field <code>int64 unconfirmed_balance = 3[json_name = "unconfirmed_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setUnconfirmedBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->unconfirmed_balance = $var;

        return $this;
    }

}

