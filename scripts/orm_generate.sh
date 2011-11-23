#!/bin/bash

php scripts/doctrine.php orm:generate-proxies
php scripts/doctrine.php orm:generate-repositories library/
