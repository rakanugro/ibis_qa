<?php
/*+---------------------------------------------------------------------------------------------------+
  | $Web Service Template$                                                         					  |
  | Author                  : -                                                         			  |
  | Template Created Date	: 22-Des-2014                                                             |
  | Template Version        : 1.0                                                                     |
  |---------------------------------------------------------------------------------------------------|
  | $Template Modification History$                                                                   |
  |---------------------------------------------------------------------------------------------------|
  | Modification                                Date                                  Modification By | 
  |---------------------------------------------------------------------------------------------------|
  */

//======= DB Collection ========//
function oriDb($connection_group_name="") 
{
	//setup oracle db connection
	/*++++ DEVELOPMENT ++++++*/
	switch($connection_group_name) 
	{
		case "BILLING_IDJKT_T3I":
			//$conn['billing'] = oci_connect('BILLING', 'billing', '192.168.29.88:1521/TOSDBTEST');
			$conn['billing'] = oci_connect('BILLING', 'billingdesember2014', '10.10.12.214:1521/tosdbqa');
		break;
		case "CONTAINER_IDJKT_T3I":
			//$conn['container'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.88:1521/TOSDBTEST');
			$conn['container'] = oci_connect('OPUS_REPO', 'opus_repo', '10.10.12.214:1521/tosdbqa');
		break;
		case "BILLING_IDJKT_T3D":
			$conn['billing'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
		break;
		case "CONTAINER_IDJKT_T3D":
			$conn['container'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
		break;
		case "BILLING_IDJKT_T2D":
			$conn['billing'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
		break;
		case "CONTAINER_IDJKT_T2D":
			$conn['container'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
		break;
		case "BILLING_IDJKT_T1D":
			$conn['billing'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
		break;
		case "CONTAINER_IDJKT_T1D":
			$conn['container'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
		break;
		case "BILLING_IDPNK_T3I":
			$conn['billing'] = oci_connect('BILLING', 'billing', '192.168.29.88:1521/PNKDBT');
		break;
		case "CONTAINER_IDPNK_T3I":
			$conn['container'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.88:1521/PNKDBT');
		break;
		case "CONTAINER_IDJKT_T009D":
			$conn['container'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.88:1521/MTDBT');
		break;
		case "BILLING_IDJKT_T009D":
			$conn['billing'] = oci_connect('BILLING', 'billingptpdom', '192.168.29.88:1521/MTDBT');
		break;
		case "IBIS":
			$conn['ibis'] = oci_connect('IBIS', 'ibis123', '10.10.33.149:1521/ESERVICEDB');
		break;
		case "BILLING":
			$conn['billing_idjkt_t3i'] = oci_connect('BILLING', 'billingdesember2014', '10.10.12.214:1521/tosdbqa');
			$conn['billing_idjkt_t3d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
			$conn['billing_idjkt_t2d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
			$conn['billing_idjkt_t1d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
			$conn['billing_idjkt_t009d'] = oci_connect('BILLING', 'billingptpdom', '192.168.29.88:1521/MTDBT'); 	
		break;
		case "CONTAINER":
			$conn['container_idjkt_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '10.10.12.214:1521/tosdbqa');
			$conn['container_idjkt_t3d'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
			$conn['container_idjkt_t2d'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
			$conn['container_idjkt_t1d'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
			$conn['container_idpnk_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.88:1521/PNKDBT');
			$conn['container_idjkt_t009d'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.88:1521/MTDBT');
			$conn['container_idjkt_l2'] = oci_connect('LINEOS', 'ligneOS', '192.168.23.26:1521/DBDEV');
		break;		
		default :
			$conn['container_idjkt_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '10.10.12.214:1521/tosdbqa');
			$conn['container_idjkt_t3d'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
			$conn['container_idjkt_t2d'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
			$conn['container_idjkt_t1d'] = oci_connect('ITOS_REPO', 'itos_REPO', '192.168.23.26:1521/DBDEV');
			$conn['container_idpnk_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.88:1521/PNKDBT');
			$conn['container_idjkt_t009d'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.88:1521/MTDBT');
			$conn['container_idjkt_l2'] = oci_connect('LINEOS', 'ligneOS', '192.168.23.26:1521/DBDEV');
			$conn['billing_idjkt_t3i'] = oci_connect('BILLING', 'billingdesember2014', '10.10.12.214:1521/tosdbqa');
			$conn['billing_idjkt_t3d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
			$conn['billing_idjkt_t2d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
			$conn['billing_idjkt_t1d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
			$conn['billing_idjkt_t009d'] = oci_connect('BILLING', 'billingptpdom', '192.168.29.88:1521/MTDBT');
			$conn['ibis'] = oci_connect('IBIS', 'ibis123', '10.10.33.149:1521/ESERVICEDB');
		break;
	}

	return $conn;
}

function mysqlDb()
{
	//setup mysql db connection
	return $conn;
}

//======= Close Database Connection Collection ========// 
function closeOriDb($conn)
{
	foreach ($conn as $key => $value) 
		oci_close($conn[$key]);
	
	return true;
}

//======= Check Database Connection Collection ========// 
function checkOriDb($conn,&$err)
{

	foreach ($conn as $key => $value) 
	{
		if (!$conn[$key]) 
			$err .= "connection to $key failed;";
	}
	
	if($err!="")
		return false;
	
	return true;
}

//======= Check Database Connection Collection ========// 
function checkOriSQL($conn,$sql,&$query,&$err,&$bind_param=array())
{
		
	$query = oci_parse($conn, $sql);

	foreach ($bind_param as $key => $value) {
		oci_bind_by_name($query, $key, &$bind_param[$key],1000);
	}
	
	if (!oci_execute($query,OCI_NO_AUTO_COMMIT))
	{
		$e = oci_error($query);
		
		if(!getDebugMode2())
			$sql = "";
			
		$err = "Database problem;".$e['message'].";$sql";
		
		return false;
	}

	if(getDebugMode())
		$message .= $sql.";<br><br>\n\n";
		
	return true;
}

//======= Check Database Connection Collection , AUTOCOMMIT ON========// 
function checkOriSQLAutoCommit($conn,$sql,&$query,&$err,&$bind_param=array())
{
	$query = oci_parse($conn, $sql);

	foreach ($bind_param as $key => $value) {
		oci_bind_by_name($query, $key, &$bind_param[$key],1000);
	}
	
	if (!oci_execute($query))
	{
		$e = oci_error($query);
		
		if(!getDebugMode2())
			$sql = "";
			
		$err = "Database problem;".$e['message'].";$sql";
		
		return false;
	}

	if(getDebugMode())
		$message .= $sql.";<br><br>\n\n";
	
	return true;
}

function rollbackOriDb($conn)
{
	foreach ($conn as $key => $value) 
	{
		oci_rollback($conn[$key]);
	}
}

function commitOriDb($conn)
{
	foreach ($conn as $key => $value) 
	{
		oci_commit($conn[$key]);
	}
}
?>