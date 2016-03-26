#!/bin/bash
echo 'Installing app'
composer install
echo ""
echo "$(tput setaf 0)$(tput setab 2)Confifure servers.yml properly then run:$(tput sgr 0)"
echo "sudo -H -u www-data vendor/deployer/deployer/bin/dep deploy dev"
echo ""
