<?php
require_once('init_autoloader.php');
use Zend\Mail;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

/******* CONFIG *******/
$options   = new SmtpOptions(array(
    'name'              => '',
    'host'              => '',
    'port'              => 587, // Use TLS
    'connection_class'  => 'plain',
    'connection_config' => array(
        'username' => '',
        'password' => '',
        'ssl'      => 'tls',
    ),
));
/**********************/

// Setup SMTP transport using PLAIN authentication over TLS
$transport = new SmtpTransport();
$transport->setOptions($options);

$mail = new Mail\Message();
$mail->setBody('This is the text of the email.');
$mail->setFrom('Freeaqingme@example.org', 'Sender\'s name');
$mail->addTo('Matthew@example.com', 'Name of recipient');
$mail->setSubject('TestSubject');

echo 'Sending first mail...' . PHP_EOL;
$transport->send($mail);
echo 'Sleeping 5 minutes...' . PHP_EOL;
sleep(300);
echo '5 minutes passed.' . PHP_EOL;
echo 'Sleeping 10 more seconds...' . PHP_EOL;
sleep(10);

echo 'Sending second mail...' . PHP_EOL;
try {
    $transport->send($mail);
	echo 'Success!' . PHP_EOL;
} catch (Exception $e) {
    echo 'Exception: ';
    var_dump($e);
}
