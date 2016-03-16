#!/bin/bash
echo 'Installing app'
composer install
echo 'Trying to start deploy manually from www-data user'
sudo -H -u www-data vendor/deployer/deployer/bin/dep deploy dev
