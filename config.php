<?php

require_once 'vendor/autoload.php';

$google_client = new Google_Client();

$google_client->setClientId('1007699865443-9fk0st2n5h8vrkgs2hcg213bkcjnhq5j.apps.googleusercontent.com');

$google_client->setClientSecret('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');

$google_client->setRedirectUri('http://localhost/wbs-time-tracker/google-callback.php');

$google_client->addScope('email');

$google_client->addScope('profile');

?>
