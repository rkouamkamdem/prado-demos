<?php

$basePath=dirname(__FILE__);
$assetsPath=$basePath.'/assets';
$runtimePath=$basePath.'/protected/runtime';

if(!is_writable($assetsPath))
	die("Please make sure that the directory $assetsPath is writable by Web server process.");
if(!is_writable($runtimePath))
	die("Please make sure that the directory $runtimePath is writable by Web server process.");

require './vendor/autoload.php';
$application = new \Prado\TApplication;
$application->run(); // $tPageService = new \Prado\Web\Services\TPageService();  $tPageService->setDefaultPage("");