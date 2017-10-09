#!/bin/bash
git pull
php app/console assets:install web
rm -rf app/cache/prod/*