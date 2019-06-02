#!/bin/bash 
set -e 

# echo 'se esta ejecutando el script'
service mysql start 
mysql -u root < /mysql/laboratory.sql 
service mysql stop 