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
set(
    'shared_dirs', [
    'public/files',
    'config',
    ]
);

task(
    'deploy', [
    'deploy:prepare',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:vendors',
    'deploy:symlink',
    'cleanup',
    ]
)->desc('Deploy project');

task(
    'deploy:mysql', function () {
        run(
            "mysql -u" . env("mysql_user")
            . " -h" . env("mysql_host")
            . " -p" . env("mysql_pass")
            ." contest < " . env("deploy_path") . "/current/db/migrations/init.sql"
        );
    }
)->desc("Deploying SQL Scheme");

after('deploy', 'deploy:mysql');
