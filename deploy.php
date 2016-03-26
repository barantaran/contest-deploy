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
    'log'
    ]
);

task(
    'migrate', function () {
        shell_exec("current/vendor/robmorgan/phinx/bin/phinx migrate -c phinx.yml");
    }
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
    'migrate'
    ]
)->desc('Deploy project');
