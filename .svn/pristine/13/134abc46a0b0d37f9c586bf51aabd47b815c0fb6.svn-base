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
			$conn['billing'] = oci_connect('BILLING', 'billing', '192.168.29.88:1521/TOSDBTEST');
		break;
		case "CONTAINER_IDJKT_T3I":
			$conn['container_idjkt_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.85:1521/TOSDB');
		break;
		case "BILLING_IDJKT_T3D":
			$conn['billing'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
		break;
		case "CONTAINER_IDJKT_T3D":
			$conn['container_idjkt_t3d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO3');
		break;
		case "BILLING_IDJKT_T2D":
			$conn['billing'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
		break;
		case "CONTAINER_IDJKT_T2D":
			$conn['container_idjkt_t2d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO2');
		break;
		case "BILLING_IDJKT_T1D":
			$conn['billing'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '192.168.23.26:1521/DBDEV');
		break;
		case "CONTAINER_IDJKT_T1D":
			$conn['container_idjkt_t1d'] = oci_connect('ITOS_REPO', 'itos_repo', '10.10.32.25:1521/TO1');
		break;
		case "BILLING_IDPNK_T3I":
			$conn['billing'] = oci_connect('BILLING', 'billing', '192.168.29.88:1521/PNKDBT');
		break;
		case "CONTAINER_IDPNK_T3I":
			$conn['container_idpnk_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', 'ipc-domdb-scan.indonesiaport.co.id/PNKDB');
		break;
		case "CONTAINER_IDJKT_009":
			$conn['container_idjkt_009'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.85:1521/MTDB');
		break;		
		case "IBIS":
			$conn['ibis'] = oci_connect('IBIS', 'ibis123', '10.10.33.149:1521/ESERVICEDB');
		break;		
		case "KAPAL_PTP":
			$conn['ptp_kapal'] = oci_connect('KAPAL_PROD', '$Prod_k4p4lpass', '10.10.30.22:1521/PELDB');
		break;
		default :
			//setup oracle db connection	
			$conn['container_idjkt_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.85:1521/TOSDB');
			$conn['container_idjkt_t3d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO3');
			$conn['container_idjkt_t2d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO2');
			$conn['container_idjkt_t1d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO1');
			$conn['container_idpnk_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', 'ipc-domdb-scan.indonesiaport.co.id:1521/PNKDB');
			$conn['billing_idpnk_t3i'] = oci_connect('BILLING', 'billingpnkkitasemua', 'ipc-domdb-scan.indonesiaport.co.id:1521/PNKDB');
			$conn['ibis'] = oci_connect('IBIS', 'ibis123', '10.10.33.149:1521/ESERVICEDB');
			$conn['ptp_kapal'] = oci_connect('KAPAL_PROD', '$Prod_k4p4lpass', '10.10.30.22:1521/PELDB');
			//$conn['billing_idjkt_itost'] = oci_connect('ITOS_BILLING', 'itos_billing', '192.168.23.44:1521/orcl');
		break;
	}

	return $conn;
}

function oriDB_container()
{
	$conn['container_idjkt_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.85:1521/TOSDB');
	$conn['container_idjkt_t3d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO3');
	$conn['container_idjkt_t2d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO2');
	$conn['container_idjkt_t1d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.32.25:1521/TO1');
	$conn['container_idpnk_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', 'ipc-domdb-scan.indonesiaport.co.id:1521/PNKDB');
	$conn['container_idjkt_009'] = oci_connect('PTPDOM', 'PTPDOM01', '10.16.42.28:1521/ORCL');
}

function oriDb2() 
{
	//setup oracle db connection
	$conn['kapal'] = oci_connect('KAPAL_PROD', 'KAPAL_PROD', '10.10.12.218:1521/PELDB');
	
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