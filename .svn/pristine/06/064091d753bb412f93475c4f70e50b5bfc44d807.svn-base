<?php

/*|	
 | Function Name	: testService
 | Description 		: Testing All Connection in oriDb(), make sure all connection is valid
 | */
function testService($in_param) {
	try {
		$conn = oriDb();
		
		if(!checkOriDb($conn,$err)) 
			goto Err;
	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}
	
	$message = $in_param;
	
	goto Success;
	
	Err:
		closeOriDb($conn);
		return "F^".$err;
	
	Success:
		closeOriDb($conn);
		return "S^".$message;
}

?>