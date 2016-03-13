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

require 'recipe/composer.php';

serverList('servers.yml');

set('repository', 'https://github.com/barantaran/contest-server.git');

task(
    'deploy:mysql', function () {
        run(
            "mysql -u" . env("mysql_user")
            . " -p" . env("mysql_pass")
            ." contest < " . env("deploy_path") . "/current/db/migrations/init.sql"
        );
    }
)->desc("Deploying SQL Scheme");

after('deploy', 'deploy:mysql');
