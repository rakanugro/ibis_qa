<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = FALSE;

//$db['default']['hostname'] = '10.10.32.25:1521/ORCL';
$db['default']['hostname'] = '10.10.33.85:1521/ESERVICEDB';//'10.10.12.214:1521/PELDB'
$db['default']['username'] = 'IBIS';//IBIS
$db['default']['password'] = 'ibis123';//ibis123
$db['default']['database'] = 'IBIS';//IBIS
$db['default']['dbdriver'] = 'oci8';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = FALSE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = TRUE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = FALSE;
$db['default']['stricton'] = FALSE;

$db['forum']['hostname'] = '10.10.33.85:1521/ESERVICEDB';//'10.10.12.214:1521/PELDB'
$db['forum']['username'] = 'INVOICE';//IBIS
$db['forum']['password'] = 'invoiceIPC';//ibis123
$db['forum']['database'] = 'invoice_consolidasi';//IBIS
$db['forum']['dbdriver'] = 'oci8';
$db['forum']['dbprefix'] = '';
$db['forum']['pconnect'] = FALSE;
$db['forum']['db_debug'] = TRUE;
$db['forum']['cache_on'] = TRUE;
$db['forum']['cachedir'] = '';
$db['forum']['char_set'] = 'utf8';
$db['forum']['dbcollat'] = 'utf8_general_ci';
$db['forum']['swap_pre'] = '';
$db['forum']['autoinit'] = FALSE;
$db['forum']['stricton'] = FALSE;							 

// customer
/*
$db['customer']['hostname'] = '10.10.12.204:1521/ORCL';
$db['customer']['username'] = 'CUSTOMER';
$db['customer']['password'] = 'customerkitasemua';
$db['customer']['database'] = 'CUSTOMER';
$db['customer']['dbdriver'] = 'oci8';
$db['customer']['dbprefix'] = '';
$db['customer']['pconnect'] = TRUE;
$db['customer']['db_debug'] = TRUE;
$db['customer']['cache_on'] = FALSE;
$db['customer']['cachedir'] = '';
$db['customer']['char_set'] = 'utf8';
$db['customer']['dbcollat'] = 'utf8_general_ci';
$db['customer']['swap_pre'] = '';
$db['customer']['autoinit'] = TRUE;
$db['customer']['stricton'] = FALSE;

$db['billing_all']['hostname'] = '10.10.12.204:1521/ORCL';
$db['billing_all']['username'] = 'BILLING_ALL';
$db['billing_all']['password'] = 'b1lling_4ll';
$db['billing_all']['database'] = 'BILLING_ALL';
$db['billing_all']['dbdriver'] = 'oci8';
$db['billing_all']['dbprefix'] = '';
$db['billing_all']['pconnect'] = TRUE;
$db['billing_all']['db_debug'] = TRUE;
$db['billing_all']['cache_on'] = FALSE;
$db['billing_all']['cachedir'] = '';
$db['billing_all']['char_set'] = 'utf8';
$db['billing_all']['dbcollat'] = 'utf8_general_ci';
$db['billing_all']['swap_pre'] = '';
$db['billing_all']['autoinit'] = TRUE;
$db['billing_all']['stricton'] = FALSE;
*/
/* End of file database.php */
/* Location: ./application/config/database.php */