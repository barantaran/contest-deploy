<?php
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
