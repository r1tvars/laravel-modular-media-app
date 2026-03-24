#!/usr/bin/env bash

set -e

case "${NGINX_TEMPLATE:-full}" in
  catalog)
    cp /etc/nginx/templates/catalog.conf /etc/nginx/conf.d/default.conf
    ;;
  campaigns)
    cp /etc/nginx/templates/campaigns.conf /etc/nginx/conf.d/default.conf
    ;;
  *)
    cp /etc/nginx/templates/full.conf /etc/nginx/conf.d/default.conf
    ;;
esac

php-fpm -D
exec nginx -g "daemon off;"
