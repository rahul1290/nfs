<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//$active_group = 'stag';
$active_group = 'prod';
$query_builder = TRUE;

$db['stag'] = array(
	'dsn'	=> '',
	'hostname' => '192.168.25.13',
	'username' => 'sa',
	'password' => 'ibc24@123',
	'database' => 'Newsflow',
	'dbdriver' => 'sqlsrv',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);

$db['prod'] = array(
    'dsn'	=> '',
    'hostname' => '192.168.25.29',
	'username' => 'mplm',
	'password' => '!mplm@1234#',
	'database' => 'Newsflow',
    'dbdriver' => 'sqlsrv',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);
