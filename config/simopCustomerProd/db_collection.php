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
function oriDb() 
{
	//setup oracle db connection
	$conn['container_idjkt_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.85:1521/TOSDB');
	$conn['container_idjkt_t3d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.33.25:1521/TO3');
	$conn['container_idjkt_t2d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.33.25:1521/TO2');
	$conn['container_idjkt_t1d'] = oci_connect('ITOS_REPO', 'itos_REPO', '10.10.33.25:1521/TO1');	
	$conn['container_idpnk_t3i'] = oci_connect('OPUS_REPO', 'opus_repo', '192.168.29.85:1521/PNKDB');
	//$conn['container_idjkt_itost'] = oci_connect('ITOS_REPO', 'ITOS_REPO', '192.168.23.44:1521/orcl');
	$conn['billing_idpnk_t3i'] = oci_connect('BILLING', 'billingpnkkitasemua', '192.168.29.85:1521/PNKDB');
	$conn['ibis'] = oci_connect('IBIS', 'ibis123', '10.10.33.149:1521/ESERVICEDB');
	$conn['billing_idjkt_t3i'] = oci_connect('BILLING', 'billing', '192.168.29.88:1521/TOSDBTEST');
	$conn['billing_idjkt_t3d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '10.10.33.25:1521/TO3');
	$conn['billing_idjkt_t2d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '10.10.33.25:1521/TO2');
	$conn['billing_idjkt_t1d'] = oci_connect('ITOS_BILLING', 'itos_BILLING', '10.10.33.25:1521/TO1');
	//$conn['billing_idjkt_itost'] = oci_connect('ITOS_BILLING', 'itos_billing', '192.168.23.44:1521/orcl');
	
	return $conn;
}

function oriDb2() 
{
	//setup oracle db connection
	//$conn['kapal'] = oci_connect('KAPAL_PROD', 'KAPAL_PROD', '10.10.12.218:1521/PELDB');
	//$conn['kapal'] = oci_connect('KAPAL_PROD', '$Prod_k4p4lpass', '10.10.30.22:1521/PELDBJAL');
	$conn['kapal'] = oci_connect('kapal_prod', '$Prod_k4p4lpass', 'dr-scan.indonesiaport.co.id:1521/PELDBJAL');//prod
	
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
function checkOriSQL($conn,$sql,&$query,&$err,&$message="",&$bind_param=array())
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
function checkOriSQLAutoCommit($conn,$sql,&$query,&$err,&$message="",&$bind_param=array())
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