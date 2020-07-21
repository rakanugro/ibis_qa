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
  | Program Unit Name        : trackVesselService                                                  	  |
  | Description              : Service pack for tracking vessel service                    			  |
  | Author                   : -                                                        			  |
  | Created Date             : 03-Feb-2015                                                            |
  | Last Update Date         :                                                                        |
  | Version                  : 1.0                                                                    |
  |---------------------------------------------------------------------------------------------------|
  | $Modification History$                                                                            |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By |
  | Add service getKdAgen						05/03/2014							  Tofan			  |
  | Add service getPDFDTJK						11/03/2014							  Tofan			  |
  | Add service getPDFDPJK						11/03/2014							  Tofan			  |
  +---------------------------------------------------------------------------------------------------+
  */
//======= LIST OF SERVICE ===============//
//sample basic service
include "f_testService.php";
//tracking service
include "f_getDetailPKK.php";
include "f_getNewPKK.php";
include "f_getKdAgen.php";
include "f_getPDFDTJK.php";
include "f_getPDFDPJK.php";
include "f_getPDFNota.php";
include "f_getPDFPKK.php";
include "f_getPDFPPKB.php";
include "f_getVesselAuto.php";
include "f_getPortAuto.php";
include "f_getKemasan.php";
include "f_getKunjungan.php";
include "f_getDermaga.php";
include "f_getStatusKapal.php";
include "f_createPGK.php";
include "f_getDataPGK.php";
include "f_updatePGK.php";
include "f_getNewP4.php";
include "f_getPGKAuto.php";
include "f_getServiceCode.php";
include "f_getKadeAuto.php";
include "f_getTugboatAuto.php";
include "f_getTongkangAuto.php";
include "f_createP4.php";
include "f_getDataP4.php";
include "f_updateP4.php";
include "f_createLanjutanP4.php";
include "f_ValidasiPenetapanP4.php";
include "f_setPenetapanP4.php";
include "f_getListCMS.php";
include "f_getSaldoCMS.php";
include "f_setPenetapanCMS.php";
include "f_getApprovalP4.php";

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
