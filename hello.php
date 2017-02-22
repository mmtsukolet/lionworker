<?php

require __DIR__ . '/vendor/autoload.php';

// LIVE
// define("DB_HOST", "mongodb://f45:YPNoHE8iXCtdzrH5McNFmr_E3VrBeCBW6NmBtwG7AIYFyDluuPPX18Y8hpDbd7vmLdqbuDnTtscJ2KHwcL9wAQ@candidate.59.mongolayer.com:10378,candidate.61.mongolayer.com:10260/app45285157");

// STAGING
define("DB_HOST", "mongodb://	heroku:vjiNeS_vRxpR6I9L49cvRyVz7TyWm8x9lJHR7SNwrgajnZcurSUlQI3cdKtZn5FmG89Qy1aQQGAZOyvVF3azqw@candidate.4.mongolayer.com:11191,candidate.19.mongolayer.com:11495/app45507208");

$mongo = new MongoDB\Client(DB_HOST);
// $database = $mongo->app45285157; //LIVE
$database = $mongo->app45285157; //STAGING

/** DB */
$analytics = $database->analytics;
$user = $database->user;
/** end DB */

/** Sample Payloads */
// $samplePayload = file_get_contents(__DIR__ . "/hello.payload.json");
// $decodedPayload = json_decode($samplePayload, true);
/** end Sample Payloads */

$decodedPayload = IronWorker\Runtime::getPayload(true);

$data = [];
foreach ($decodedPayload as $key => $value) {

	$currentUser = $user->findOne([
		'serial' => (int) $value['serial'],
		'name' => $value['name']
	]);

	if ($currentUser && $currentUser->name) {
		
		// Look for `workouttimestamp` on `Analytics`
		$isExistDataOnAnalytics = $analytics->findOne([
			'workouttimestamp' => $decodedPayload['workouttimestamp'], 
			'useremail' => $currentUser->email
		]);

		if (!$isExistDataOnAnalytics->workouttimestamp) {

			// Prepare Data Later will do bulk insert OR Insert right away ? 
			$insertOneResult = $analytics->insertOne([
				'useremail' => $currentUser->email,
			    'max' => $value['max'],
			    'bpmmax' => $value['bpmmax'],
			    'totalpoints' => $value['totalpoints'],
			    'name' => $value['name'],
			    'data' => [],
			    'columns' => $value['columns'],
			    'totalcalories' => $value['totalcalories'],
			    'serial' => $value['serial'],
			    'bpmmin' => $value['bpmmin'],
			    'hr70plus' => $value['hr70plus'],
			    'workouttimestamp' => $decodedPayload['workouttimestamp'],
			    'workoutlogo' => $decodedPayload['workoutlogo'],
			    'workouttime' => $decodedPayload['workouttime'],
			    'workoutname' => $decodedPayload['workoutname'],
			    'workoutdate' => $decodedPayload['workoutdate']
			]);
		}
	}
}

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


