<?php

/*|
 | Function Name 	: getUperBm
 | Description 		: Get Uper BM
 | Creator			: 
 | Creation Date	: 
 |					  EDITOR						UPDATE DATE 		NOTE
 | EDIT LOG			: 
 |*/
function getUperBm($in_param) {
	
	try {
		/*------------------------------------------SETUP CONNECTION---------------------------------------------------*/
		//get connection collection
		$conn['ori'] = oriDb();
		//check if all connections in connection collections is success, if found error/connection fail return false.
		if(!checkOriDb($conn['ori'],$err)) goto Err;
		
		/*------------------------------------------SETUP CLIENT INPUT PARAMETER---------------------------------------*/
		//parse input parameter
		$xml_data = new SimpleXMLElement($in_param);
		//set input parameter

		$vessel_code = $xml_data->data->vessel_code;
        $modules = array(
            'barang_idjkt', 'billing_idjkt_t1', 'billing_idjkt_t2', 'billing_idjkt_t3'
        );
		
		
		/*------------------------------------------START COLLECTION PROGRAM-------------------------------------------*/
		//define parameter
		$out_data 	= array();
		$def = "";
		
		//get BM data
		$bm_data = array();
		
		//select connection
		//PL/SQL
		$getUperBm_Barang = "SELECT A.APPR_STATUS,
               A.TERMINAL,
               TO_CHAR (A.ORDER_ID) ORDER_ID,
               A.VOYAGE_NO,
               A.BRANCH_ID,
               A.ORDER_NO,
               TO_CHAR (A.DORDER, 'YYYY-MM-DD HH24:MI:SS') AS DORDER,
               A.COMPANY_ID,
               A.PBM_ID,
               E.NAME,
               A.KADE,
               D.NAME KADE_NAME,
               A.STATUS,
               A.APPR_NOTE,
               B.NAME AS VSLNAME,
               C.NAME AS COMPANY_NAME,
               (SELECT SUM (b.qty_load)
                  FROM barang_prod.ttm_notajb nota
                       JOIN barang_prod.ttd_notajb b
                          ON (nota.notajb_id = b.notajb_id)
                       JOIN barang_prod.tr_cargosb c
                          ON (b.cargojb_id = c.cargotype_id)
                 WHERE     nota.status != 'X'
                       AND nota.order_id = A.order_id
                       AND c.golongan IN ('20', '40')
                       AND b.ACT_ID IN ('LDF', 'LDL'))
                  TOTAL_LOAD_CONT,
               (SELECT SUM (b.qty_disch)
                  FROM barang_prod.ttm_notajb nota
                       JOIN barang_prod.ttd_notajb b
                          ON (nota.notajb_id = b.notajb_id)
                       JOIN barang_prod.tr_cargosb c
                          ON (b.cargojb_id = c.cargotype_id)
                 WHERE     nota.status != 'X'
                       AND nota.order_id = A.order_id
                       AND c.golongan IN ('20', '40')
                       AND b.ACT_ID IN ('LDF', 'LDL'))
                  TOTAL_DISCH_CONT,
               (SELECT SUM (b.qty_load)
                  FROM barang_prod.ttm_notajb nota
                       JOIN barang_prod.ttd_notajb b
                          ON (nota.notajb_id = b.notajb_id)
                       JOIN barang_prod.tr_cargosb c
                          ON (b.cargojb_id = c.cargotype_id)
                 WHERE     nota.status != 'X'
                       AND nota.order_id = A.order_id
                       AND c.golongan NOT IN ('20', '40')
                       AND b.ACT_ID IN ('LDF', 'LDL'))
                  TOTAL_LOAD,
               (SELECT SUM (b.qty_disch)
                  FROM barang_prod.ttm_notajb nota
                       JOIN barang_prod.ttd_notajb b
                          ON (nota.notajb_id = b.notajb_id)
                       JOIN barang_prod.tr_cargosb c
                          ON (b.cargojb_id = c.cargotype_id)
                 WHERE     nota.status != 'X'
                       AND nota.order_id = A.order_id
                       AND c.golongan NOT IN ('20', '40')
                       AND b.ACT_ID IN ('LDF', 'LDL'))
                  TOTAL_DISCH,
               A.VESSEL_ID,
               TO_CHAR (A.DETA, 'YYYY-MM-DD HH24:MI:SS') AS DETA,
               TO_CHAR (A.DETD, 'YYYY-MM-DD HH24:MI:SS') AS DETD,
               D.NM_PEMILIK
          FROM barang_prod.TTM_ORDER A
               INNER JOIN barang_prod.TR_VESSEL B
                  ON (A.VESSEL_ID = B.VESSEL_ID)
               INNER JOIN barang_prod.TR_COMPANY C
                  ON (A.COMPANY_ID = C.COMPANY_ID)
               INNER JOIN barang_prod.TR_KADE D
                  ON (A.KADE = D.KADE)
               INNER JOIN barang_prod.tr_pbm E
                  ON (A.PBM_ID = E.PBM_ID)
         WHERE A.APPR_STATUS = 'A' AND A.branch_id = '01' AND A.VESSEL_ID = '$vessel_code'";
	
		//QUERY
		if(!checkOriSQL($conn['ori']['ibis'],$getVessel,$query_vessel,$err,$debug)) goto Err;
		//FETCH QUERY
		while ($row_vessel = oci_fetch_array($query_vessel, OCI_ASSOC))
		{
			//build "info" data
			$vessel_sub = array(
									'vessel_name' => $row_vessel[VESSEL],
									'voyage_in' => $row_vessel[VOYAGE_IN],
									'voyage_out' => $row_vessel[VOYAGE_OUT],
									'pol' => $row_vessel[POL],
									'id_joint_vessel' => $row_vessel[ID_JOINT_VESSEL]
								);

			array_push($bm_data, $vessel_sub);
		}		

		$out_data = array();
		$out_data['bm_data']=$bm_data;

		goto Success;

	}
	catch (Exception $e) {
		$err = $e->getMessage();
		goto Err;
	}

	/*------------------------------------------ERROR-------------------------------------------------------------*/
	Err:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($err=="") $err = "ERR";
		if($out_status=="") $out_status = "F";
		return generateResponse($out_data, $out_status, $err, "json");

	/*------------------------------------------SUCCESS-----------------------------------------------------------*/
	Success:
		//rollbackOriDb($conn['ori']);
		commitOriDb($conn['ori']);
		closeOriDb($conn['ori']);
		if($out_message=="") $out_message = "SUCCESS";
		$out_status = "S";
		return generateResponse($out_data, $out_status, $out_message, "json");
}

?>