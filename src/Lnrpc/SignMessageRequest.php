<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: lnd.proto

namespace Lnrpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;
use Google\Protobuf\Internal\GPBWrapperUtils;

/**
 * Generated from protobuf message <code>lnrpc.SignMessageRequest</code>
 */
class SignMessageRequest extends \Google\Protobuf\Internal\Message
{
    /**
     *&#47; The message to be signed
     *
     * Generated from protobuf field <code>bytes msg = 1[json_name = "msg"];</code>
     */
    private $msg = '';

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $msg
     *          &#47; The message to be signed
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Lnd::initOnce();
        parent::__construct($data);
    }

    /**
     *&#47; The message to be signed
     *
     * Generated from protobuf field <code>bytes msg = 1[json_name = "msg"];</code>
     * @return string
     */
    public function getMsg()
    {
        return $this->msg;
    }

    /**
     *&#47; The message to be signed
     *
     * Generated from protobuf field <code>bytes msg = 1[json_name = "msg"];</code>
     * @param string $var
     * @return $this
     */
    public function setMsg($var)
    {
        GPBUtil::checkString($var, False);
        $this->msg = $var;

        return $this;
    }

}

