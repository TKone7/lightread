<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.OpenChannelRequest</code>
 */
class OpenChannelRequest extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; The pubkey of the node to open a channel with
     *
     * Generated from protobuf field <code>bytes node_pubkey = 2[json_name = "node_pubkey"];</code>
     */
    private $node_pubkey = '';
    /**
     *&#47; The hex encoded pubkey of the node to open a channel with
     *
     * Generated from protobuf field <code>string node_pubkey_string = 3[json_name = "node_pubkey_string"];</code>
     */
    private $node_pubkey_string = '';
    /**
     *&#47; The number of satoshis the wallet should commit to the channel
     *
     * Generated from protobuf field <code>int64 local_funding_amount = 4[json_name = "local_funding_amount"];</code>
     */
    private $local_funding_amount = 0;
    /**
     *&#47; The number of satoshis to push to the remote side as part of the initial commitment state
     *
     * Generated from protobuf field <code>int64 push_sat = 5[json_name = "push_sat"];</code>
     */
    private $push_sat = 0;
    /**
     *&#47; The target number of blocks that the funding transaction should be confirmed by.
     *
     * Generated from protobuf field <code>int32 target_conf = 6;</code>
     */
    private $target_conf = 0;
    /**
     *&#47; A manual fee rate set in sat/byte that should be used when crafting the funding transaction.
     *
     * Generated from protobuf field <code>int64 sat_per_byte = 7;</code>
     */
    private $sat_per_byte = 0;
    /**
     *&#47; Whether this channel should be private, not announced to the greater network.
     *
     * Generated from protobuf field <code>bool private = 8[json_name = "private"];</code>
     */
    private $private = false;
    /**
     *&#47; The minimum value in millisatoshi we will require for incoming HTLCs on the channel.
     *
     * Generated from protobuf field <code>int64 min_htlc_msat = 9[json_name = "min_htlc_msat"];</code>
     */
    private $min_htlc_msat = 0;
    /**
     *&#47; The delay we require on the remote's commitment transaction. If this is not set, it will be scaled automatically with the channel size.
     *
     * Generated from protobuf field <code>uint32 remote_csv_delay = 10[json_name = "remote_csv_delay"];</code>
     */
    private $remote_csv_delay = 0;
    /**
     *&#47; The minimum number of confirmations each one of your outputs used for the funding transaction must satisfy.
     *
     * Generated from protobuf field <code>int32 min_confs = 11[json_name = "min_confs"];</code>
     */
    private $min_confs = 0;
    /**
     *&#47; Whether unconfirmed outputs should be used as inputs for the funding transaction.
     *
     * Generated from protobuf field <code>bool spend_unconfirmed = 12[json_name = "spend_unconfirmed"];</code>
     */
    private $spend_unconfirmed = false;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $node_pubkey
     *          &#47; The pubkey of the node to open a channel with
     *     @type string $node_pubkey_string
     *          &#47; The hex encoded pubkey of the node to open a channel with
     *     @type int|string $local_funding_amount
     *          &#47; The number of satoshis the wallet should commit to the channel
     *     @type int|string $push_sat
     *          &#47; The number of satoshis to push to the remote side as part of the initial commitment state
     *     @type int $target_conf
     *          &#47; The target number of blocks that the funding transaction should be confirmed by.
     *     @type int|string $sat_per_byte
     *          &#47; A manual fee rate set in sat/byte that should be used when crafting the funding transaction.
     *     @type bool $private
     *          &#47; Whether this channel should be private, not announced to the greater network.
     *     @type int|string $min_htlc_msat
     *          &#47; The minimum value in millisatoshi we will require for incoming HTLCs on the channel.
     *     @type int $remote_csv_delay
     *          &#47; The delay we require on the remote's commitment transaction. If this is not set, it will be scaled automatically with the channel size.
     *     @type int $min_confs
     *          &#47; The minimum number of confirmations each one of your outputs used for the funding transaction must satisfy.
     *     @type bool $spend_unconfirmed
     *          &#47; Whether unconfirmed outputs should be used as inputs for the funding transaction.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     *&#47; The pubkey of the node to open a channel with
     *
     * Generated from protobuf field <code>bytes node_pubkey = 2[json_name = "node_pubkey"];</code>
     * @return string
     */
    public function getNodePubkey()
    {
        return $this->node_pubkey;
    }

    /**
     *&#47; The pubkey of the node to open a channel with
     *
     * Generated from protobuf field <code>bytes node_pubkey = 2[json_name = "node_pubkey"];</code>
     * @param string $var
     * @return $this
     */
    public function setNodePubkey($var)
    {
        GPBUtil::checkString($var, False);
        $this->node_pubkey = $var;

        return $this;
    }

    /**
     *&#47; The hex encoded pubkey of the node to open a channel with
     *
     * Generated from protobuf field <code>string node_pubkey_string = 3[json_name = "node_pubkey_string"];</code>
     * @return string
     */
    public function getNodePubkeyString()
    {
        return $this->node_pubkey_string;
    }

    /**
     *&#47; The hex encoded pubkey of the node to open a channel with
     *
     * Generated from protobuf field <code>string node_pubkey_string = 3[json_name = "node_pubkey_string"];</code>
     * @param string $var
     * @return $this
     */
    public function setNodePubkeyString($var)
    {
        GPBUtil::checkString($var, True);
        $this->node_pubkey_string = $var;

        return $this;
    }

    /**
     *&#47; The number of satoshis the wallet should commit to the channel
     *
     * Generated from protobuf field <code>int64 local_funding_amount = 4[json_name = "local_funding_amount"];</code>
     * @return int|string
     */
    public function getLocalFundingAmount()
    {
        return $this->local_funding_amount;
    }

    /**
     *&#47; The number of satoshis the wallet should commit to the channel
     *
     * Generated from protobuf field <code>int64 local_funding_amount = 4[json_name = "local_funding_amount"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setLocalFundingAmount($var)
    {
        GPBUtil::checkInt64($var);
        $this->local_funding_amount = $var;

        return $this;
    }

    /**
     *&#47; The number of satoshis to push to the remote side as part of the initial commitment state
     *
     * Generated from protobuf field <code>int64 push_sat = 5[json_name = "push_sat"];</code>
     * @return int|string
     */
    public function getPushSat()
    {
        return $this->push_sat;
    }

    /**
     *&#47; The number of satoshis to push to the remote side as part of the initial commitment state
     *
     * Generated from protobuf field <code>int64 push_sat = 5[json_name = "push_sat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setPushSat($var)
    {
        GPBUtil::checkInt64($var);
        $this->push_sat = $var;

        return $this;
    }

    /**
     *&#47; The target number of blocks that the funding transaction should be confirmed by.
     *
     * Generated from protobuf field <code>int32 target_conf = 6;</code>
     * @return int
     */
    public function getTargetConf()
    {
        return $this->target_conf;
    }

    /**
     *&#47; The target number of blocks that the funding transaction should be confirmed by.
     *
     * Generated from protobuf field <code>int32 target_conf = 6;</code>
     * @param int $var
     * @return $this
     */
    public function setTargetConf($var)
    {
        GPBUtil::checkInt32($var);
        $this->target_conf = $var;

        return $this;
    }

    /**
     *&#47; A manual fee rate set in sat/byte that should be used when crafting the funding transaction.
     *
     * Generated from protobuf field <code>int64 sat_per_byte = 7;</code>
     * @return int|string
     */
    public function getSatPerByte()
    {
        return $this->sat_per_byte;
    }

    /**
     *&#47; A manual fee rate set in sat/byte that should be used when crafting the funding transaction.
     *
     * Generated from protobuf field <code>int64 sat_per_byte = 7;</code>
     * @param int|string $var
     * @return $this
     */
    public function setSatPerByte($var)
    {
        GPBUtil::checkInt64($var);
        $this->sat_per_byte = $var;

        return $this;
    }

    /**
     *&#47; Whether this channel should be private, not announced to the greater network.
     *
     * Generated from protobuf field <code>bool private = 8[json_name = "private"];</code>
     * @return bool
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     *&#47; Whether this channel should be private, not announced to the greater network.
     *
     * Generated from protobuf field <code>bool private = 8[json_name = "private"];</code>
     * @param bool $var
     * @return $this
     */
    public function setPrivate($var)
    {
        GPBUtil::checkBool($var);
        $this->private = $var;

        return $this;
    }

    /**
     *&#47; The minimum value in millisatoshi we will require for incoming HTLCs on the channel.
     *
     * Generated from protobuf field <code>int64 min_htlc_msat = 9[json_name = "min_htlc_msat"];</code>
     * @return int|string
     */
    public function getMinHtlcMsat()
    {
        return $this->min_htlc_msat;
    }

    /**
     *&#47; The minimum value in millisatoshi we will require for incoming HTLCs on the channel.
     *
     * Generated from protobuf field <code>int64 min_htlc_msat = 9[json_name = "min_htlc_msat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setMinHtlcMsat($var)
    {
        GPBUtil::checkInt64($var);
        $this->min_htlc_msat = $var;

        return $this;
    }

    /**
     *&#47; The delay we require on the remote's commitment transaction. If this is not set, it will be scaled automatically with the channel size.
     *
     * Generated from protobuf field <code>uint32 remote_csv_delay = 10[json_name = "remote_csv_delay"];</code>
     * @return int
     */
    public function getRemoteCsvDelay()
    {
        return $this->remote_csv_delay;
    }

    /**
     *&#47; The delay we require on the remote's commitment transaction. If this is not set, it will be scaled automatically with the channel size.
     *
     * Generated from protobuf field <code>uint32 remote_csv_delay = 10[json_name = "remote_csv_delay"];</code>
     * @param int $var
     * @return $this
     */
    public function setRemoteCsvDelay($var)
    {
        GPBUtil::checkUint32($var);
        $this->remote_csv_delay = $var;

        return $this;
    }

    /**
     *&#47; The minimum number of confirmations each one of your outputs used for the funding transaction must satisfy.
     *
     * Generated from protobuf field <code>int32 min_confs = 11[json_name = "min_confs"];</code>
     * @return int
     */
    public function getMinConfs()
    {
        return $this->min_confs;
    }

    /**
     *&#47; The minimum number of confirmations each one of your outputs used for the funding transaction must satisfy.
     *
     * Generated from protobuf field <code>int32 min_confs = 11[json_name = "min_confs"];</code>
     * @param int $var
     * @return $this
     */
    public function setMinConfs($var)
    {
        GPBUtil::checkInt32($var);
        $this->min_confs = $var;

        return $this;
    }

    /**
     *&#47; Whether unconfirmed outputs should be used as inputs for the funding transaction.
     *
     * Generated from protobuf field <code>bool spend_unconfirmed = 12[json_name = "spend_unconfirmed"];</code>
     * @return bool
     */
    public function getSpendUnconfirmed()
    {
        return $this->spend_unconfirmed;
    }

    /**
     *&#47; Whether unconfirmed outputs should be used as inputs for the funding transaction.
     *
     * Generated from protobuf field <code>bool spend_unconfirmed = 12[json_name = "spend_unconfirmed"];</code>
     * @param bool $var
     * @return $this
     */
    public function setSpendUnconfirmed($var)
    {
        GPBUtil::checkBool($var);
        $this->spend_unconfirmed = $var;

        return $this;
    }

}
