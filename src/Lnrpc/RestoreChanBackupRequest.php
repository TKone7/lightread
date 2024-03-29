<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: rpc.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>lnrpc.RestoreChanBackupRequest</code>
 */
class RestoreChanBackupRequest extends \Google\Protobuf\Internal\Message
{
    protected $backup;

    public function __construct() {
        \GPBMetadata\Rpc::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelBackups chan_backups = 1[json_name = "chan_backups"];</code>
     * @return \Lnrpc\ChannelBackups
     */
    public function getChanBackups()
    {
        return $this->readOneof(1);
    }

    /**
     * Generated from protobuf field <code>.lnrpc.ChannelBackups chan_backups = 1[json_name = "chan_backups"];</code>
     * @param \Lnrpc\ChannelBackups $var
     * @return $this
     */
    public function setChanBackups($var)
    {
        GPBUtil::checkMessage($var, \Lnrpc\ChannelBackups::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * Generated from protobuf field <code>bytes multi_chan_backup = 2[json_name = "multi_chan_backup"];</code>
     * @return string
     */
    public function getMultiChanBackup()
    {
        return $this->readOneof(2);
    }

    /**
     * Generated from protobuf field <code>bytes multi_chan_backup = 2[json_name = "multi_chan_backup"];</code>
     * @param string $var
     * @return $this
     */
    public function setMultiChanBackup($var)
    {
        GPBUtil::checkString($var, False);
        $this->writeOneof(2, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getBackup()
    {
        return $this->whichOneof("backup");
    }

}

