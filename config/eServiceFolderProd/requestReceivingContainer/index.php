<?php
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$Modul Integrasi$                                                         	  |
  | Author                  : Endang Fiansyah				                                          |
  | Owner                   : IPC				                                                      |
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
  | Program Unit Name        : request receiving container                                            |
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
//Request Receiving service
include "f_requestReceivingHeader.php";
include "f_getReqRecHead.php";
include "f_getRequestReceivingHeader.php";
include "f_getRequestReceivingHeaderCompressed.php";
include "f_requestReceivingDetail.php";
include "f_getPDFProformaContainer.php";
include "f_getPDFNotaContainer.php";
include "f_getAutoPOD.php";
include "f_getCarrierContainer.php";
include "f_getListContainer.php";
include "f_getCommodityContainer.php";
include "f_submitRequestReceiving.php";
include "f_getPDFCardContainer.php";
include "f_delDetailContainer.php";
include "f_cancelReceiving.php";
include "f_getCountContainer.php";
include "f_cancelBooking.php";

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