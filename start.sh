#!/usr/bin/env bash
set -e

exec php -S 0.0.0.0:${PORT:-10000} -t public server.php
