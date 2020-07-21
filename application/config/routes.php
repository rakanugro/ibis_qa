<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "main";
$route['404_override'] = '';

#MASTER ENTITY
$route['einvoice/administrasi/masterentity'] = 'einvoice/entity/masterentity';
$route['einvoice/administrasi/masterentity/masterentity'] = 'einvoice/entity/masterentity';
$route['einvoice/administrasi/masterentitysearch'] = 'einvoice/entity/masterentitysearch';
$route['einvoice/administrasi/masterentitysave'] = 'einvoice/entity/masterentitysave';
$route['einvoice/administrasi/masterentityedit'] = 'einvoice/entity/masterentityedit';
$route['einvoice/administrasi/masterentityupdate'] = 'einvoice/entity/masterentityupdate';
$route['einvoice/administrasi/masterentityhapus'] = 'einvoice/entity/masterentityhapus';
$route['einvoice/administrasi/mastermateraisearch'] = 'einvoice/entity/mastermateraisearch';
$route['einvoice/administrasi/mastermateraisave'] = 'einvoice/entity/mastermateraisave';
$route['einvoice/administrasi/mastermateraiedit'] = 'einvoice/entity/mastermateraiedit';
$route['einvoice/administrasi/mastermateraiupdate'] = 'einvoice/entity/mastermateraiupdate';
$route['einvoice/administrasi/mastermateraihapus'] = 'einvoice/entity/mastermateraihapus';
$route['einvoice/administrasi/masterfaktur'] = 'einvoice/entity/masterfaktur';
$route['einvoice/administrasi/masterfaktursearch'] = 'einvoice/entity/masterfaktursearch';
$route['einvoice/administrasi/masterfaktursave'] = 'einvoice/entity/masterfaktursave';
$route['einvoice/administrasi/masterfakturedit'] = 'einvoice/entity/masterfakturedit';
$route['einvoice/administrasi/masterfakturupdate'] = 'einvoice/entity/masterfakturupdate';
$route['einvoice/administrasi/masterfakturhapus'] = 'einvoice/entity/masterfakturhapus';
$route['einvoice/administrasi/masterbanksearch'] = 'einvoice/entity/masterbanksearch';
$route['einvoice/administrasi/masterbanksave'] = 'einvoice/entity/masterbanksave';
$route['einvoice/administrasi/masterbankedit'] = 'einvoice/entity/masterbankedit';
$route['einvoice/administrasi/masterbankupdate'] = 'einvoice/entity/masterbankupdate';
$route['einvoice/administrasi/masterbankhapus'] = 'einvoice/entity/masterbankhapus';
$route['einvoice/administrasi/mastersignbanksearch'] = 'einvoice/entity/mastersignbanksearch';
$route['einvoice/administrasi/mastersignbanksave'] = 'einvoice/entity/mastersignbanksave';
$route['einvoice/administrasi/mastersignbankedit'] = 'einvoice/entity/mastersignbankedit';
$route['einvoice/administrasi/mastersignbankupdate'] = 'einvoice/entity/mastersignbankupdate';
$route['einvoice/administrasi/mastersignbankhapus'] = 'einvoice/entity/mastersignbankhapus';

#E-Materai add by Solihin : 11 Oct 2019
$route['einvoice/administrasi/mastermaterai/mastermaterai'] = 'einvoice/entity/mastermaterai';
$route['einvoice/administrasi/searchmastermaterai'] = 'einvoice/entity/searchmastermaterai';
$route['einvoice/administrasi/savemastermaterai'] = 'einvoice/entity/savemastermaterai';
$route['einvoice/administrasi/editmastermaterai'] = 'einvoice/entity/editmastermaterai';
$route['einvoice/administrasi/updatemastermaterai'] = 'einvoice/entity/updatemastermaterai';

#MASTER UNIT
$route['einvoice/administrasi/masterpejabatsave'] = 'einvoice/unit/masterpejabatsave';
$route['einvoice/administrasi/masterpejabatupdate'] = 'einvoice/unit/masterpejabatupdate';

#BARANG 
// $route['einvoice/nota/cetak_barang'] = 'einvoice/barang/cetak_barang';
$route['einvoice/nota/cetak_barang/barang/(:any)'] = 'einvoice/barang/cetak_barang/barang/$1';
$route['einvoice/nota/barangsearch'] = 'einvoice/barang/barangsearch';

#Usaha Terminal add by SIGMA : 24 Oct 2019
$route['einvoice/nota/usaha_terminal']                      = 'einvoice/nota_cabang/usaha_terminal';
$route['einvoice/nota/usaha_terminal/createusahaterminal']  = 'einvoice/nota_cabang/usaha_terminalcreate';

#KOREKSI 
$route['einvoice/nota/koreksi'] = 'einvoice/koreksi';


#PFD Barcode
$route['cetak/(:any)'] = 'einvoice/cetak/mytoken/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */