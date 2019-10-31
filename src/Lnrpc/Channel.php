<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.Channel</code>
 */
class Channel extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; Whether this channel is active or not
     *
     * Generated from protobuf field <code>bool active = 1[json_name = "active"];</code>
     */
    private $active = false;
    /**
     *&#47; The identity pubkey of the remote node
     *
     * Generated from protobuf field <code>string remote_pubkey = 2[json_name = "remote_pubkey"];</code>
     */
    private $remote_pubkey = '';
    /**
     **
     *The outpoint (txid:index) of the funding transaction. With this value, Bob
     *will be able to generate a signature for Alice's version of the commitment
     *transaction.
     *
     * Generated from protobuf field <code>string channel_point = 3[json_name = "channel_point"];</code>
     */
    private $channel_point = '';
    /**
     **
     *The unique channel ID for the channel. The first 3 bytes are the block
     *height, the next 3 the index within the block, and the last 2 bytes are the
     *output index for the channel.
     *
     * Generated from protobuf field <code>uint64 chan_id = 4[json_name = "chan_id"];</code>
     */
    private $chan_id = 0;
    /**
     *&#47; The total amount of funds held in this channel
     *
     * Generated from protobuf field <code>int64 capacity = 5[json_name = "capacity"];</code>
     */
    private $capacity = 0;
    /**
     *&#47; This node's current balance in this channel
     *
     * Generated from protobuf field <code>int64 local_balance = 6[json_name = "local_balance"];</code>
     */
    private $local_balance = 0;
    /**
     *&#47; The counterparty's current balance in this channel
     *
     * Generated from protobuf field <code>int64 remote_balance = 7[json_name = "remote_balance"];</code>
     */
    private $remote_balance = 0;
    /**
     **
     *The amount calculated to be paid in fees for the current set of commitment
     *transactions. The fee amount is persisted with the channel in order to
     *allow the fee amount to be removed and recalculated with each channel state
     *update, including updates that happen after a system restart.
     *
     * Generated from protobuf field <code>int64 commit_fee = 8[json_name = "commit_fee"];</code>
     */
    private $commit_fee = 0;
    /**
     *&#47; The weight of the commitment transaction
     *
     * Generated from protobuf field <code>int64 commit_weight = 9[json_name = "commit_weight"];</code>
     */
    private $commit_weight = 0;
    /**
     **
     *The required number of satoshis per kilo-weight that the requester will pay
     *at all times, for both the funding transaction and commitment transaction.
     *This value can later be updated once the channel is open.
     *
     * Generated from protobuf field <code>int64 fee_per_kw = 10[json_name = "fee_per_kw"];</code>
     */
    private $fee_per_kw = 0;
    /**
     *&#47; The unsettled balance in this channel
     *
     * Generated from protobuf field <code>int64 unsettled_balance = 11[json_name = "unsettled_balance"];</code>
     */
    private $unsettled_balance = 0;
    /**
     **
     *The total number of satoshis we've sent within this channel.
     *
     * Generated from protobuf field <code>int64 total_satoshis_sent = 12[json_name = "total_satoshis_sent"];</code>
     */
    private $total_satoshis_sent = 0;
    /**
     **
     *The total number of satoshis we've received within this channel.
     *
     * Generated from protobuf field <code>int64 total_satoshis_received = 13[json_name = "total_satoshis_received"];</code>
     */
    private $total_satoshis_received = 0;
    /**
     **
     *The total number of updates conducted within this channel.
     *
     * Generated from protobuf field <code>uint64 num_updates = 14[json_name = "num_updates"];</code>
     */
    private $num_updates = 0;
    /**
     **
     *The list of active, uncleared HTLCs currently pending within the channel.
     *
     * Generated from protobuf field <code>repeated .lnrpc.HTLC pending_htlcs = 15[json_name = "pending_htlcs"];</code>
     */
    private $pending_htlcs;
    /**
     **
     *The CSV delay expressed in relative blocks. If the channel is force closed,
     *we will need to wait for this many blocks before we can regain our funds.
     *
     * Generated from protobuf field <code>uint32 csv_delay = 16[json_name = "csv_delay"];</code>
     */
    private $csv_delay = 0;
    /**
     *&#47; Whether this channel is advertised to the network or not.
     *
     * Generated from protobuf field <code>bool private = 17[json_name = "private"];</code>
     */
    private $private = false;
    /**
     *&#47; True if we were the ones that created the channel.
     *
     * Generated from protobuf field <code>bool initiator = 18[json_name = "initiator"];</code>
     */
    private $initiator = false;
    /**
     *&#47; A set of flags showing the current state of the channel.
     *
     * Generated from protobuf field <code>string chan_status_flags = 19[json_name = "chan_status_flags"];</code>
     */
    private $chan_status_flags = '';
    /**
     *&#47; The minimum satoshis this node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 local_chan_reserve_sat = 20[json_name = "local_chan_reserve_sat"];</code>
     */
    private $local_chan_reserve_sat = 0;
    /**
     **
     *The minimum satoshis the other node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 remote_chan_reserve_sat = 21[json_name = "remote_chan_reserve_sat"];</code>
     */
    private $remote_chan_reserve_sat = 0;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type bool $active
     *          &#47; Whether this channel is active or not
     *     @type string $remote_pubkey
     *          &#47; The identity pubkey of the remote node
     *     @type string $channel_point
     *          *
     *          The outpoint (txid:index) of the funding transaction. With this value, Bob
     *          will be able to generate a signature for Alice's version of the commitment
     *          transaction.
     *     @type int|string $chan_id
     *          *
     *          The unique channel ID for the channel. The first 3 bytes are the block
     *          height, the next 3 the index within the block, and the last 2 bytes are the
     *          output index for the channel.
     *     @type int|string $capacity
     *          &#47; The total amount of funds held in this channel
     *     @type int|string $local_balance
     *          &#47; This node's current balance in this channel
     *     @type int|string $remote_balance
     *          &#47; The counterparty's current balance in this channel
     *     @type int|string $commit_fee
     *          *
     *          The amount calculated to be paid in fees for the current set of commitment
     *          transactions. The fee amount is persisted with the channel in order to
     *          allow the fee amount to be removed and recalculated with each channel state
     *          update, including updates that happen after a system restart.
     *     @type int|string $commit_weight
     *          &#47; The weight of the commitment transaction
     *     @type int|string $fee_per_kw
     *          *
     *          The required number of satoshis per kilo-weight that the requester will pay
     *          at all times, for both the funding transaction and commitment transaction.
     *          This value can later be updated once the channel is open.
     *     @type int|string $unsettled_balance
     *          &#47; The unsettled balance in this channel
     *     @type int|string $total_satoshis_sent
     *          *
     *          The total number of satoshis we've sent within this channel.
     *     @type int|string $total_satoshis_received
     *          *
     *          The total number of satoshis we've received within this channel.
     *     @type int|string $num_updates
     *          *
     *          The total number of updates conducted within this channel.
     *     @type \Lnrpc\HTLC[]|\Google\Protobuf\Internal\RepeatedField $pending_htlcs
     *          *
     *          The list of active, uncleared HTLCs currently pending within the channel.
     *     @type int $csv_delay
     *          *
     *          The CSV delay expressed in relative blocks. If the channel is force closed,
     *          we will need to wait for this many blocks before we can regain our funds.
     *     @type bool $private
     *          &#47; Whether this channel is advertised to the network or not.
     *     @type bool $initiator
     *          &#47; True if we were the ones that created the channel.
     *     @type string $chan_status_flags
     *          &#47; A set of flags showing the current state of the channel.
     *     @type int|string $local_chan_reserve_sat
     *          &#47; The minimum satoshis this node is required to reserve in its balance.
     *     @type int|string $remote_chan_reserve_sat
     *          *
     *          The minimum satoshis the other node is required to reserve in its balance.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     *&#47; Whether this channel is active or not
     *
     * Generated from protobuf field <code>bool active = 1[json_name = "active"];</code>
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     *&#47; Whether this channel is active or not
     *
     * Generated from protobuf field <code>bool active = 1[json_name = "active"];</code>
     * @param bool $var
     * @return $this
     */
    public function setActive($var)
    {
        GPBUtil::checkBool($var);
        $this->active = $var;

        return $this;
    }

    /**
     *&#47; The identity pubkey of the remote node
     *
     * Generated from protobuf field <code>string remote_pubkey = 2[json_name = "remote_pubkey"];</code>
     * @return string
     */
    public function getRemotePubkey()
    {
        return $this->remote_pubkey;
    }

    /**
     *&#47; The identity pubkey of the remote node
     *
     * Generated from protobuf field <code>string remote_pubkey = 2[json_name = "remote_pubkey"];</code>
     * @param string $var
     * @return $this
     */
    public function setRemotePubkey($var)
    {
        GPBUtil::checkString($var, True);
        $this->remote_pubkey = $var;

        return $this;
    }

    /**
     **
     *The outpoint (txid:index) of the funding transaction. With this value, Bob
     *will be able to generate a signature for Alice's version of the commitment
     *transaction.
     *
     * Generated from protobuf field <code>string channel_point = 3[json_name = "channel_point"];</code>
     * @return string
     */
    public function getChannelPoint()
    {
        return $this->channel_point;
    }

    /**
     **
     *The outpoint (txid:index) of the funding transaction. With this value, Bob
     *will be able to generate a signature for Alice's version of the commitment
     *transaction.
     *
     * Generated from protobuf field <code>string channel_point = 3[json_name = "channel_point"];</code>
     * @param string $var
     * @return $this
     */
    public function setChannelPoint($var)
    {
        GPBUtil::checkString($var, True);
        $this->channel_point = $var;

        return $this;
    }

    /**
     **
     *The unique channel ID for the channel. The first 3 bytes are the block
     *height, the next 3 the index within the block, and the last 2 bytes are the
     *output index for the channel.
     *
     * Generated from protobuf field <code>uint64 chan_id = 4[json_name = "chan_id"];</code>
     * @return int|string
     */
    public function getChanId()
    {
        return $this->chan_id;
    }

    /**
     **
     *The unique channel ID for the channel. The first 3 bytes are the block
     *height, the next 3 the index within the block, and the last 2 bytes are the
     *output index for the channel.
     *
     * Generated from protobuf field <code>uint64 chan_id = 4[json_name = "chan_id"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setChanId($var)
    {
        GPBUtil::checkUint64($var);
        $this->chan_id = $var;

        return $this;
    }

    /**
     *&#47; The total amount of funds held in this channel
     *
     * Generated from protobuf field <code>int64 capacity = 5[json_name = "capacity"];</code>
     * @return int|string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     *&#47; The total amount of funds held in this channel
     *
     * Generated from protobuf field <code>int64 capacity = 5[json_name = "capacity"];</code>
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
     *&#47; This node's current balance in this channel
     *
     * Generated from protobuf field <code>int64 local_balance = 6[json_name = "local_balance"];</code>
     * @return int|string
     */
    public function getLocalBalance()
    {
        return $this->local_balance;
    }

    /**
     *&#47; This node's current balance in this channel
     *
     * Generated from protobuf field <code>int64 local_balance = 6[json_name = "local_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setLocalBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->local_balance = $var;

        return $this;
    }

    /**
     *&#47; The counterparty's current balance in this channel
     *
     * Generated from protobuf field <code>int64 remote_balance = 7[json_name = "remote_balance"];</code>
     * @return int|string
     */
    public function getRemoteBalance()
    {
        return $this->remote_balance;
    }

    /**
     *&#47; The counterparty's current balance in this channel
     *
     * Generated from protobuf field <code>int64 remote_balance = 7[json_name = "remote_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setRemoteBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->remote_balance = $var;

        return $this;
    }

    /**
     **
     *The amount calculated to be paid in fees for the current set of commitment
     *transactions. The fee amount is persisted with the channel in order to
     *allow the fee amount to be removed and recalculated with each channel state
     *update, including updates that happen after a system restart.
     *
     * Generated from protobuf field <code>int64 commit_fee = 8[json_name = "commit_fee"];</code>
     * @return int|string
     */
    public function getCommitFee()
    {
        return $this->commit_fee;
    }

    /**
     **
     *The amount calculated to be paid in fees for the current set of commitment
     *transactions. The fee amount is persisted with the channel in order to
     *allow the fee amount to be removed and recalculated with each channel state
     *update, including updates that happen after a system restart.
     *
     * Generated from protobuf field <code>int64 commit_fee = 8[json_name = "commit_fee"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setCommitFee($var)
    {
        GPBUtil::checkInt64($var);
        $this->commit_fee = $var;

        return $this;
    }

    /**
     *&#47; The weight of the commitment transaction
     *
     * Generated from protobuf field <code>int64 commit_weight = 9[json_name = "commit_weight"];</code>
     * @return int|string
     */
    public function getCommitWeight()
    {
        return $this->commit_weight;
    }

    /**
     *&#47; The weight of the commitment transaction
     *
     * Generated from protobuf field <code>int64 commit_weight = 9[json_name = "commit_weight"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setCommitWeight($var)
    {
        GPBUtil::checkInt64($var);
        $this->commit_weight = $var;

        return $this;
    }

    /**
     **
     *The required number of satoshis per kilo-weight that the requester will pay
     *at all times, for both the funding transaction and commitment transaction.
     *This value can later be updated once the channel is open.
     *
     * Generated from protobuf field <code>int64 fee_per_kw = 10[json_name = "fee_per_kw"];</code>
     * @return int|string
     */
    public function getFeePerKw()
    {
        return $this->fee_per_kw;
    }

    /**
     **
     *The required number of satoshis per kilo-weight that the requester will pay
     *at all times, for both the funding transaction and commitment transaction.
     *This value can later be updated once the channel is open.
     *
     * Generated from protobuf field <code>int64 fee_per_kw = 10[json_name = "fee_per_kw"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setFeePerKw($var)
    {
        GPBUtil::checkInt64($var);
        $this->fee_per_kw = $var;

        return $this;
    }

    /**
     *&#47; The unsettled balance in this channel
     *
     * Generated from protobuf field <code>int64 unsettled_balance = 11[json_name = "unsettled_balance"];</code>
     * @return int|string
     */
    public function getUnsettledBalance()
    {
        return $this->unsettled_balance;
    }

    /**
     *&#47; The unsettled balance in this channel
     *
     * Generated from protobuf field <code>int64 unsettled_balance = 11[json_name = "unsettled_balance"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setUnsettledBalance($var)
    {
        GPBUtil::checkInt64($var);
        $this->unsettled_balance = $var;

        return $this;
    }

    /**
     **
     *The total number of satoshis we've sent within this channel.
     *
     * Generated from protobuf field <code>int64 total_satoshis_sent = 12[json_name = "total_satoshis_sent"];</code>
     * @return int|string
     */
    public function getTotalSatoshisSent()
    {
        return $this->total_satoshis_sent;
    }

    /**
     **
     *The total number of satoshis we've sent within this channel.
     *
     * Generated from protobuf field <code>int64 total_satoshis_sent = 12[json_name = "total_satoshis_sent"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setTotalSatoshisSent($var)
    {
        GPBUtil::checkInt64($var);
        $this->total_satoshis_sent = $var;

        return $this;
    }

    /**
     **
     *The total number of satoshis we've received within this channel.
     *
     * Generated from protobuf field <code>int64 total_satoshis_received = 13[json_name = "total_satoshis_received"];</code>
     * @return int|string
     */
    public function getTotalSatoshisReceived()
    {
        return $this->total_satoshis_received;
    }

    /**
     **
     *The total number of satoshis we've received within this channel.
     *
     * Generated from protobuf field <code>int64 total_satoshis_received = 13[json_name = "total_satoshis_received"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setTotalSatoshisReceived($var)
    {
        GPBUtil::checkInt64($var);
        $this->total_satoshis_received = $var;

        return $this;
    }

    /**
     **
     *The total number of updates conducted within this channel.
     *
     * Generated from protobuf field <code>uint64 num_updates = 14[json_name = "num_updates"];</code>
     * @return int|string
     */
    public function getNumUpdates()
    {
        return $this->num_updates;
    }

    /**
     **
     *The total number of updates conducted within this channel.
     *
     * Generated from protobuf field <code>uint64 num_updates = 14[json_name = "num_updates"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setNumUpdates($var)
    {
        GPBUtil::checkUint64($var);
        $this->num_updates = $var;

        return $this;
    }

    /**
     **
     *The list of active, uncleared HTLCs currently pending within the channel.
     *
     * Generated from protobuf field <code>repeated .lnrpc.HTLC pending_htlcs = 15[json_name = "pending_htlcs"];</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getPendingHtlcs()
    {
        return $this->pending_htlcs;
    }

    /**
     **
     *The list of active, uncleared HTLCs currently pending within the channel.
     *
     * Generated from protobuf field <code>repeated .lnrpc.HTLC pending_htlcs = 15[json_name = "pending_htlcs"];</code>
     * @param \Lnrpc\HTLC[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setPendingHtlcs($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Lnrpc\HTLC::class);
        $this->pending_htlcs = $arr;

        return $this;
    }

    /**
     **
     *The CSV delay expressed in relative blocks. If the channel is force closed,
     *we will need to wait for this many blocks before we can regain our funds.
     *
     * Generated from protobuf field <code>uint32 csv_delay = 16[json_name = "csv_delay"];</code>
     * @return int
     */
    public function getCsvDelay()
    {
        return $this->csv_delay;
    }

    /**
     **
     *The CSV delay expressed in relative blocks. If the channel is force closed,
     *we will need to wait for this many blocks before we can regain our funds.
     *
     * Generated from protobuf field <code>uint32 csv_delay = 16[json_name = "csv_delay"];</code>
     * @param int $var
     * @return $this
     */
    public function setCsvDelay($var)
    {
        GPBUtil::checkUint32($var);
        $this->csv_delay = $var;

        return $this;
    }

    /**
     *&#47; Whether this channel is advertised to the network or not.
     *
     * Generated from protobuf field <code>bool private = 17[json_name = "private"];</code>
     * @return bool
     */
    public function getPrivate()
    {
        return $this->private;
    }

    /**
     *&#47; Whether this channel is advertised to the network or not.
     *
     * Generated from protobuf field <code>bool private = 17[json_name = "private"];</code>
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
     *&#47; True if we were the ones that created the channel.
     *
     * Generated from protobuf field <code>bool initiator = 18[json_name = "initiator"];</code>
     * @return bool
     */
    public function getInitiator()
    {
        return $this->initiator;
    }

    /**
     *&#47; True if we were the ones that created the channel.
     *
     * Generated from protobuf field <code>bool initiator = 18[json_name = "initiator"];</code>
     * @param bool $var
     * @return $this
     */
    public function setInitiator($var)
    {
        GPBUtil::checkBool($var);
        $this->initiator = $var;

        return $this;
    }

    /**
     *&#47; A set of flags showing the current state of the channel.
     *
     * Generated from protobuf field <code>string chan_status_flags = 19[json_name = "chan_status_flags"];</code>
     * @return string
     */
    public function getChanStatusFlags()
    {
        return $this->chan_status_flags;
    }

    /**
     *&#47; A set of flags showing the current state of the channel.
     *
     * Generated from protobuf field <code>string chan_status_flags = 19[json_name = "chan_status_flags"];</code>
     * @param string $var
     * @return $this
     */
    public function setChanStatusFlags($var)
    {
        GPBUtil::checkString($var, True);
        $this->chan_status_flags = $var;

        return $this;
    }

    /**
     *&#47; The minimum satoshis this node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 local_chan_reserve_sat = 20[json_name = "local_chan_reserve_sat"];</code>
     * @return int|string
     */
    public function getLocalChanReserveSat()
    {
        return $this->local_chan_reserve_sat;
    }

    /**
     *&#47; The minimum satoshis this node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 local_chan_reserve_sat = 20[json_name = "local_chan_reserve_sat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setLocalChanReserveSat($var)
    {
        GPBUtil::checkInt64($var);
        $this->local_chan_reserve_sat = $var;

        return $this;
    }

    /**
     **
     *The minimum satoshis the other node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 remote_chan_reserve_sat = 21[json_name = "remote_chan_reserve_sat"];</code>
     * @return int|string
     */
    public function getRemoteChanReserveSat()
    {
        return $this->remote_chan_reserve_sat;
    }

    /**
     **
     *The minimum satoshis the other node is required to reserve in its balance.
     *
     * Generated from protobuf field <code>int64 remote_chan_reserve_sat = 21[json_name = "remote_chan_reserve_sat"];</code>
     * @param int|string $var
     * @return $this
     */
    public function setRemoteChanReserveSat($var)
    {
        GPBUtil::checkInt64($var);
        $this->remote_chan_reserve_sat = $var;

        return $this;
    }

}

