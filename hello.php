<?php

require __DIR__ . '/vendor/autoload.php';
// require_once('mongo');

define("DB_HOST", "mongodb://f45:YPNoHE8iXCtdzrH5McNFmr_E3VrBeCBW6NmBtwG7AIYFyDluuPPX18Y8hpDbd7vmLdqbuDnTtscJ2KHwcL9wAQ@candidate.59.mongolayer.com:10378,candidate.61.mongolayer.com:10260/app45285157");

$mongo = new MongoDB\Client(DB_HOST);
$database = $mongo->app45285157;

$analytics = $database->analytics;
$user = $database->user;

$resultFindUser = $user->findOne(['email' => 'root@bywave.com.au']);

echo "<pre>";
 print_r($resultFindUser->email); 
 die;
echo "</pre>";

/*echo "Hello World!\n\n";
echo "Starting HelloWorker at ".date('r')."\n";

for ($i = 1; $i <= 5; $i++) {
    echo "Sleep $i\n";

    echo "Payload: ";
	print_r(IronWorker\Runtime::getPayload(true));

	echo "\nConfig: ";
	print_r(IronWorker\Runtime::getConfig(true));

    sleep(1);
}
echo "HelloWorker completed at ".date('r');*/


// $ironmq = new \IronMQ\IronMQ();
// $ironmq->postMessage('Some Queue', "Hello world By Michelle");
// $msg = $ironmq->getMessage('Some Queue');
// var_dump($msg);


