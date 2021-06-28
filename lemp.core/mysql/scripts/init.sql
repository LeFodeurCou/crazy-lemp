create user if not exists 'webapp'@'%' identified by 'webapp';

create database if not exists `webapp`;

use webapp;

grant all privileges on `webapp` to 'webapp'@'%';
grant all privileges on `webapp`.* to 'webapp'@'%';
