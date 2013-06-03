<?php

require_once __DIR__.'/../vendor/autoload.php';

$wh = new WebHook\WebHook(__DIR__);
$wh->addCommand('git status');
$wh->run();