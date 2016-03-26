<?php
/**
 * Contest web application deployer tool
 *
 * PHP version 5
 *
 * @category Deployer
 * @package  Bt-contest
 * @author   barantaran <yourchev@gmail.com>
 * @license  https://opensource.org/licenses/BSD-3-Clause BSD 3-Clause License
 * @link     https://github.com/bt-contest
 */

require "vendor/autoload.php";
use GitHubWebhook\Handler,
    Monolog\Handler\StreamHandler,
    Monolog\Logger;

$githubWebhookSecret = "GjkmLbhfr2016KM";

$handler = new Handler($githubWebhookSecret, __DIR__);
$logHandler = new StreamHandler('deploy.log', Logger::INFO);

$handler->startLogger($logHandler);

$handler->masterMerge(
    function ($data) {
        putenv("HOME=/home/barantaran");
        shell_exec("/home/www/contest/vendor/deployer/deployer/bin/dep deploy dev >> deploy.log 2>>deploy.log &");
        echo "deploying";
    }
);

echo $handler->handle();
