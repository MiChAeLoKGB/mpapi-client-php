<?php
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use MPAPI\Services\Client;
use MPAPI\Services\Orders;
use MPAPI\Entity\Order;

require __DIR__ . '/../vendor/autoload.php';

$mpapiClient = new Client('your_client_id');

$logger = new Logger('loggerName');
$logger->pushHandler(new StreamHandler('./elog.log', Logger::INFO));
// set logger into MP API client
$mpapiClient->setLogger($logger);

// initialize orders synchronizer
$orders = new Orders($mpapiClient);

// get all open orders
$openOrders = $orders->get()->open();
// print of open orders
foreach ($openOrders as $orderId) {
	print('Open order: ' . $orderId . PHP_EOL);
}

// get all unconfirmed orders
$unconfirmedOrders = $orders->get()->unconfirmed();
// print list of unconfirmed orders
foreach ($unconfirmedOrders as $orderId) {
	print('Unconfirmed order: ' . $orderId . PHP_EOL);
}

// get all orders data
$ordersList = $orders->get()->all();
// print list of all orders data
var_dump($ordersList);

if (!empty($openOrders)) {
	// get order detail
	/* @var MPAPI\Entity\Order $order */
	$order = $orders->get()->detail($openOrders[0]);
	// print order detail
	var_dump($order->getData());

	// update order status
	$responseStatus = $orders->put()->status($order->getOrderId(), Order::STATUS_SHIPPING);
	// true or exception
	var_dump($responseStatus);
}