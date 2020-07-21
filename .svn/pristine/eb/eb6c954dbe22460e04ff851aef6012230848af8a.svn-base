<?php 
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$                                                         					  |
  | Author                  : -                                                         			  |
  | Template Created Date	: 8-Aug-2015                                                              |
  | Template Version        : 1.0                                                                     |
  | Function 				: Database Connection String											  |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By |
  | 																								  |
  |---------------------------------------------------------------------------------------------------|
  */
  
  $db['container_idjkt_t3i']['username'] = "OPUS_REPO";
  $db['container_idjkt_t3i']['password'] = "opus_repo";
  $db['container_idjkt_t3i']['string'] = "192.168.29.88:1521/TOSDBTEST";
  $db['container_idjkt_t3i']['driver'] = "oci";

  $db['container_idjkt_t3d']['username'] = "ITOS_REPO";
  $db['container_idjkt_t3d']['password'] = "itos_REPO";
  $db['container_idjkt_t3d']['string'] = "192.168.23.26:1521/DBDEV";
  $db['container_idjkt_t3i']['driver'] = "oci";
  
  function getConnection($connection)
  {

	if($db[$connection]['username']=="oci")
		return oci_connect($db[$connection]['username'], $db[$connection]['password'], $db[$connection]['string']);
	else 
		return oci_connect($db[$connection]['username'], $db[$connection]['password'], $db[$connection]['string']);
	
  }
?>  