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
	$conn['eproc'] = oci_connect('EPROC', 'ORAFIN', '103.19.80.232:9521/ORA11G');//development
	//$conn['eproc'] = oci_connect('EPROC', 'ORAFIN', '103.19.80.234:9521/ORA11G');//production
	$conn['orafin'] = oci_connect('APPS', 'APPS', '10.10.12.217:1521/DEV');
	
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
function checkOriSQL($conn,$sql,&$query,&$err,&$message="")
{
		
	$query = oci_parse($conn, $sql);

	if (!oci_execute($query,OCI_NO_AUTO_COMMIT))
	{
		$e = oci_error($query);
		
		if(!getDebugMode2())
			$sql = "";
			
		$err = "FAILED;Database problem;".$e['message'].";$sql";
		
		return false;
	}

	if(getDebugMode())
		$message .= $sql.";<br><br>";
		
	return true;
}

//======= Check Database Connection Collection , AUTOCOMMIT ON========// 
function checkOriSQLAutoCommit($conn,$sql,&$query,&$err,&$message="")
{
	$query = oci_parse($conn, $sql);

	if (!oci_execute($query))
	{
		$e = oci_error($query);
		
		if(!getDebugMode2())
			$sql = "";
			
		$err = "FAILED;Database problem;".$e['message'].";$sql";
		
		return false;
	}

	if(getDebugMode())
		$message .= $sql.";<br><br>";
	
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