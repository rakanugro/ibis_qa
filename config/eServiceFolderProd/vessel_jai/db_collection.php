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
	/*++++ PRODUCTION ++++++*/
	switch($connection_group_name)
	{
		case "KAPAL":
			$conn['kapal'] = oci_connect('jai_opis', 'jai_opis', '10.10.12.214:1521/PELDB');
		break;
		case "SIMKEU":
			$conn['simkeu'] = oci_connect('xpi2', 'welcome1$', '10.10.12.253:1527/TEST');
		break;		
		default :
			$conn['simkeu'] = oci_connect('xpi2', 'welcome1$', '10.10.12.253:1527/TEST');
			$conn['kapal'] = oci_connect('jai_opis', 'jai_opis', '10.10.12.214:1521/PELDB');
		break;
	}

	return $conn;
}

function oriDb2() 
{
	//setup oracle db connection
	$conn['kapal'] = oci_connect('jai_opis', 'jai_opis', '10.10.12.214:1521/PELDB');
	
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