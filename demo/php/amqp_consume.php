<?php
$conn = new AMQPConnection(array(
    'login' => 'guest',
    'password' => 'guest'
));
if ($conn->connect()) {
    echo "Established a connection to the broker<br>";
} else {
    exit("Cannot connect to the broker");
}
$c = new AMQPChannel($conn);
$q = new AMQPQueue($c);
$q->setName('q1');
$q->declareQueue();
//消息获取
$m = $q->get(AMQP_AUTOACK) ;
var_dump($m);
//$q->consume('callback', AMQP_AUTOACK);
//function callback($envelope, $queue)
//{
//    var_dump($envelope, $queue);
//}
$conn->disconnect();
