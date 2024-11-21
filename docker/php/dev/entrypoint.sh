#!/bin/sh

##crontab /cronjob
##cron -f

#ln -sf /proc/1/fd/1 /dev/stdout
#ln -sf /proc/1/fd/2 /dev/stderr

chown root:root /root/.ssh/*
chown root:root /etc/ssh/sshd_config.d/*

service ssh restart

/usr/bin/supervisord -c /etc/supervisor/supervisord.conf &

docker-php-entrypoint php-fpm
