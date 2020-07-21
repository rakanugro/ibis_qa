<?php

//phpinfo();
echo "test";

if($conn = oci_connect('billing', 'billing', '192.168.23.16/orcl')){
	echo "ok test";
}
else{
	echo "not oke";
}

?>
