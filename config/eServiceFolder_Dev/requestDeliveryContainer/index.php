<?php
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$Modul Integrasi$                                                         	  |
  | Author                  : -				                                                          |
  | Template Created Date	: 22-Des-2014                                                             |
  | Template Version        : 1.0                                                                     |
  | Library					: nusoap																  |
  | Template File           : index.php register_service.php sql_collection.php db_collection.php     |
  |							  data_collection.php f_testService.php exmp_testService.php			  |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By | 
  |---------------------------------------------------------------------------------------------------|

  +---------------------------------------------------------------------------------------------------+
  | Program Unit Name        : trackingContainer                                                  	  |
  | Description              : Service pack for tracking container                    			      |
  | Author                   : -                                                        			  |
  | Created Date             : 03-Feb-2015                                                            |
  | Last Update Date         :                                                                        |
  | Version                  : 1.0                                                                    |
  |---------------------------------------------------------------------------------------------------|
  | $Modification History$                                                                            |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By |
  +---------------------------------------------------------------------------------------------------+
  */
//======= LIST OF SERVICE ===============//
//sample basic service
include "f_testService.php";
//tracking service
include "f_getVesselList.php";
include "f_getListContainer.php";
include "f_getVesselVoyage.php";
include "f_getDetailContainer.php";
include "f_createRequestDelivery.php";
include "f_addDetailContainer.php";
include "f_delDetailContainer.php";
include "f_getDetailDelivery.php";
include "f_getRequestDelivery.php";
include "f_getRequestDeliveryHeader.php";
include "f_saveRequestDelivery.php";
include "f_getPDFProformaContainer.php";
include "f_getPDFNotaContainer.php";
include "f_getCardContainer.php";
include "f_getCardContainerThermal.php";
include "f_getPDFCardContainer.php";

//======= nusoap library ========//
require_once "lib/nusoap.php";
//======= SQL Collection ========//
require_once "sql_collection.php";
//======= Data Collection ========//
require_once "data_collection.php";
//======= Database Collection ========//
require_once "db_collection.php";
//======= Register Service ========//
require_once "register_service.php";