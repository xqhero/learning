<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: test.proto

namespace Grpc;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>grpc.TestReply</code>
 */
class TestReply extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>repeated .grpc.TestReply.GetData getdataarr = 1;</code>
     */
    private $getdataarr;

    public function __construct() {
        \GPBMetadata\Test::initOnce();
        parent::__construct();
    }

    /**
     * Generated from protobuf field <code>repeated .grpc.TestReply.GetData getdataarr = 1;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getGetdataarr()
    {
        return $this->getdataarr;
    }

    /**
     * Generated from protobuf field <code>repeated .grpc.TestReply.GetData getdataarr = 1;</code>
     * @param \Grpc\TestReply_GetData[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setGetdataarr($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::MESSAGE, \Grpc\TestReply_GetData::class);
        $this->getdataarr = $arr;

        return $this;
    }

}

