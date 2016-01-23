<?php
$conn = new AMQPConnection(array(
    'host' => '127.0.0.1',
    'port' => 5672,
    'vhost' => '/', //默认虚拟机
    'login' => 'guest', //默认用户
    'password' => 'guest'
));
$conn->connect();

// 频道 管道
$c = new AMQPChannel($conn);

// 交换机
$e = new AMQPExchange($c);
$e->setName('e1');
$e->setType(AMQP_EX_TYPE_DIRECT);//direct类型
$e->setFlags(AMQP_DURABLE);//持久化
echo 'exchange status:'.$e->declareExchange().'<br>';
// 将队列和交换机绑定，交换机publish的消息才能到达队列
$q = new AMQPQueue($c);
$q->setName('q1');
$q->setFlags(AMQP_DURABLE);
echo 'Queue q1 Bind:'.$q->bind('e1', '');

$e->publish('msg');
