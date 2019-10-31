<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.UnlockWalletRequest</code>
 */
class UnlockWalletRequest extends \Google\Protobuf\Internal\Message
{
    /**
     **
     *wallet_password should be the current valid passphrase for the daemon. This
     *will be required to decrypt on-disk material that the daemon requires to
     *function properly.
     *
     * Generated from protobuf field <code>bytes wallet_password = 1;</code>
     */
    private $wallet_password = '';
    /**
     **
     *recovery_window is an optional argument specifying the address lookahead
     *when restoring a wallet seed. The recovery window applies to each
     *individual branch of the BIP44 derivation paths. Supplying a recovery
     *window of zero indicates that no addresses should be recovered, such after
     *the first initialization of the wallet.
     *
     * Generated from protobuf field <code>int32 recovery_window = 2;</code>
     */
    private $recovery_window = 0;
    /**
     **
     *channel_backups is an optional argument that allows clients to recover the
     *settled funds within a set of channels. This should be populated if the
     *user was unable to close out all channels and sweep funds before partial or
     *total data loss occurred. If specified, then after on-chain recovery of
     *funds, lnd begin to carry out the data loss recovery protocol in order to
     *recover the funds in each channel from a remote force closed transaction.
     *
     * Generated from protobuf field <code>.lnrpc.ChanBackupSnapshot channel_backups = 3;</code>
     */
    private $channel_backups = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $wallet_password
     *          *
     *          wallet_password should be the current valid passphrase for the daemon. This
     *          will be required to decrypt on-disk material that the daemon requires to
     *          function properly.
     *     @type int $recovery_window
     *          *
     *          recovery_window is an optional argument specifying the address lookahead
     *          when restoring a wallet seed. The recovery window applies to each
     *          individual branch of the BIP44 derivation paths. Supplying a recovery
     *          window of zero indicates that no addresses should be recovered, such after
     *          the first initialization of the wallet.
     *     @type \Lnrpc\ChanBackupSnapshot $channel_backups
     *          *
     *          channel_backups is an optional argument that allows clients to recover the
     *          settled funds within a set of channels. This should be populated if the
     *          user was unable to close out all channels and sweep funds before partial or
     *          total data loss occurred. If specified, then after on-chain recovery of
     *          funds, lnd begin to carry out the data loss recovery protocol in order to
     *          recover the funds in each channel from a remote force closed transaction.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     **
     *wallet_password should be the current valid passphrase for the daemon. This
     *will be required to decrypt on-disk material that the daemon requires to
     *function properly.
     *
     * Generated from protobuf field <code>bytes wallet_password = 1;</code>
     * @return string
     */
    public function getWalletPassword()
    {
        return $this->wallet_password;
    }

    /**
     **
     *wallet_password should be the current valid passphrase for the daemon. This
     *will be required to decrypt on-disk material that the daemon requires to
     *function properly.
     *
     * Generated from protobuf field <code>bytes wallet_password = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setWalletPassword($var)
    {
        GPBUtil::checkString($var, False);
        $this->wallet_password = $var;

        return $this;
    }

    /**
     **
     *recovery_window is an optional argument specifying the address lookahead
     *when restoring a wallet seed. The recovery window applies to each
     *individual branch of the BIP44 derivation paths. Supplying a recovery
     *window of zero indicates that no addresses should be recovered, such after
     *the first initialization of the wallet.
     *
     * Generated from protobuf field <code>int32 recovery_window = 2;</code>
     * @return int
     */
    public function getRecoveryWindow()
    {
        return $this->recovery_window;
    }

    /**
     **
     *recovery_window is an optional argument specifying the address lookahead
     *when restoring a wallet seed. The recovery window applies to each
     *individual branch of the BIP44 derivation paths. Supplying a recovery
     *window of zero indicates that no addresses should be recovered, such after
     *the first initialization of the wallet.
     *
     * Generated from protobuf field <code>int32 recovery_window = 2;</code>
     * @param int $var
     * @return $this
     */
    public function setRecoveryWindow($var)
    {
        GPBUtil::checkInt32($var);
        $this->recovery_window = $var;

        return $this;
    }

    /**
     **
     *channel_backups is an optional argument that allows clients to recover the
     *settled funds within a set of channels. This should be populated if the
     *user was unable to close out all channels and sweep funds before partial or
     *total data loss occurred. If specified, then after on-chain recovery of
     *funds, lnd begin to carry out the data loss recovery protocol in order to
     *recover the funds in each channel from a remote force closed transaction.
     *
     * Generated from protobuf field <code>.lnrpc.ChanBackupSnapshot channel_backups = 3;</code>
     * @return \Lnrpc\ChanBackupSnapshot
     */
    public function getChannelBackups()
    {
        return $this->channel_backups;
    }

    /**
     **
     *channel_backups is an optional argument that allows clients to recover the
     *settled funds within a set of channels. This should be populated if the
     *user was unable to close out all channels and sweep funds before partial or
     *total data loss occurred. If specified, then after on-chain recovery of
     *funds, lnd begin to carry out the data loss recovery protocol in order to
     *recover the funds in each channel from a remote force closed transaction.
     *
     * Generated from protobuf field <code>.lnrpc.ChanBackupSnapshot channel_backups = 3;</code>
     * @param \Lnrpc\ChanBackupSnapshot $var
     * @return $this
     */
    public function setChannelBackups($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\ChanBackupSnapshot::class);
        $this->channel_backups = $var;

        return $this;
    }

}

