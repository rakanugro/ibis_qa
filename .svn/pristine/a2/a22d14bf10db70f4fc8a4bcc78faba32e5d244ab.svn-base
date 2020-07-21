<?php
require_once "lib/nusoap.php";

function cekWebService($category) {

    //reset stagging lini 2
	if ($conn6 = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) {

		$resetITT = "BEGIN PROC_ITT_REFRESH(); END;";
		$delITT = oci_parse($conn6, $resetITT);
		oci_execute($delITT);
		oci_close($conn6);
			
	} else {
	    $errmsg = oci_error();
	    print 'Oracle connect error: ' . $errmsg['message'];
	}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Terminal 3 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//	
   if ($conn = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) { 		
		
		//get ITT Booking Info
        $query2 = "SELECT A.ID_ITT,
						  A.ID_VES_VOYAGE,
						  A.YARD_NAME_LINI2,
						  C.VESSEL_NAME,
						  C.VOY_IN,
						  C.VOY_OUT,
						  TO_CHAR(C.ATA,'DD-MM-RRRR') ATA,
						  TO_CHAR(C.ATD,'DD-MM-RRRR') ATD,
						  A.VIA_YARD
				   FROM CON_ITT_H A, VES_VOYAGE C
					WHERE C.ID_VES_VOYAGE = A.ID_VES_VOYAGE
					AND A.LINI2_FLAG = 'N'";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
            $iditt = $row['ID_ITT'];
			$no_ukk = $row['ID_VES_VOYAGE'];
			$idyard = $row['YARD_NAME_LINI2'];
			$vessel = $row['VESSEL_NAME'];
			$voyin = $row['VOY_IN'];
			$voyout = $row['VOY_OUT'];
			$ata = $row['ATA'];
			$atd = $row['ATD'];
			$via = $row['VIA_YARD'];
			
			//==== Insert Stagging Lini 2 (Header) ===//
			if ($conn2 = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) 
			{
			   $idplp = "";
			   $atd = "";
			   $callsign = "";
			   $no_book = "";	
    		   $jnstrade = "T"; 
			   $kd_tpl = "TER3";
			   $user = "itost3";
			   $kade = "";
			   $nmtpl1 = $kd_tpl;
			   $nmtpl2 = "Lapangan ".$idyard;
			   $params = $user."^".$nmtpl1."^".$nmtpl2."^".$vessel."^".$voyin."^".$voyout."^".$ata."^".$atd."^".$callsign."^".$idyard."^".$idplp."^".$jnstrade."^".$iditt."^".$kd_tpl."^".$kade."^".$no_ukk;			   
			   $insertH = "BEGIN PROC_REC_H('$params'); END;";
			   $header = oci_parse($conn2, $insertH);
			   oci_execute($header);
			   oci_close($conn2);
			}
			else
			{
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];				
			}			
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }	
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Terminal 3 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//		
	
	return "OK";	
}

//======= Declare Function Service ========// 
function getITT_Booking($service) {

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Terminal 3 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//
   //============= Header Booking ===================// 
    // db connection
	
        //reset stagging lini 2
	    if ($conn6 = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) {

			$resetITT = "BEGIN PROC_ITT_REFRESH(); END;";
			$delITT = oci_parse($conn6, $resetITT);
			oci_execute($delITT);
			oci_close($conn6);
			
	    } else {
		   $errmsg = oci_error();
		   print 'Oracle connect error: ' . $errmsg['message'];
	    }
		
   if ($conn = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) { 		
		
		//get ITT Booking Info
        $query2 = "SELECT A.ID_ITT,
						  A.ID_VES_VOYAGE,
						  A.YARD_NAME_LINI2,
						  C.VESSEL_NAME,
						  C.VOY_IN,
						  C.VOY_OUT,
						  TO_CHAR(C.ATA,'DD-MM-RRRR') ATA,
						  TO_CHAR(C.ATD,'DD-MM-RRRR') ATD,
						  A.VIA_YARD
				   FROM CON_ITT_H A, VES_VOYAGE C
					WHERE C.ID_VES_VOYAGE = A.ID_VES_VOYAGE
					AND A.LINI2_FLAG = 'N'";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
            $iditt = $row['ID_ITT'];
			$no_ukk = $row['ID_VES_VOYAGE'];
			$idyard = $row['YARD_NAME_LINI2'];
			$vessel = $row['VESSEL_NAME'];
			$voyin = $row['VOY_IN'];
			$voyout = $row['VOY_OUT'];
			$ata = $row['ATA'];
			$atd = $row['ATD'];
			$via = $row['VIA_YARD'];
			
			//==== Insert Stagging Lini 2 (Header) ===//
			if ($conn2 = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) 
			{
			   $idplp = "";
			   $atd = "";
			   $callsign = "";
			   $no_book = "";	
    		   $jnstrade = "T"; 
			   $kd_tpl = "TER3";
			   $user = "itost3";
			   $kade = "";
			   $nmtpl1 = $kd_tpl;
			   $nmtpl2 = "Lapangan ".$idyard;
			   $params = $user."^".$nmtpl1."^".$nmtpl2."^".$vessel."^".$voyin."^".$voyout."^".$ata."^".$atd."^".$callsign."^".$idyard."^".$idplp."^".$jnstrade."^".$iditt."^".$kd_tpl."^".$kade."^".$no_ukk;			   
			   $insertH = "BEGIN PROC_REC_H('$params'); END;";
			   $header = oci_parse($conn2, $insertH);
			   oci_execute($header);
			   oci_close($conn2);
			}
			else
			{
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];				
			}
			
			//==== Detail Booking ===//
			$queryDtl = "SELECT B.NO_CONTAINER,
								B.POINT,
								D.CONT_SIZE,
								D.CONT_TYPE,
								D.CONT_STATUS,
								D.HAZARD,
								D.ID_ISO_CODE  
					FROM CON_ITT_D B, CON_LISTCONT D
					   WHERE B.ID_ITT = '$iditt'
					   AND B.CANCEL_ITT = 'N'
					   AND B.NO_CONTAINER = D.NO_CONTAINER
					   AND B.POINT = D.POINT";
			$queryDtl = oci_parse($conn, $queryDtl);
			oci_execute($queryDtl);	
			while ($rowd = oci_fetch_array($queryDtl, OCI_ASSOC))
			{
				$nocont = $rowd['NO_CONTAINER'];
				$point = $rowd['POINT'];
				$sz_cont = $rowd['CONT_SIZE'];
				$ty_cont = $rowd['CONT_TYPE'];
				$st_cont = $rowd['CONT_STATUS'];
				$hz_cont = $rowd['HAZARD'];
				$isocode = $rowd['ID_ISO_CODE'];	

				if ($conn3 = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV'))
				{
					$queryIdrec = "SELECT ID_REC IDX FROM PLAN_REC_H WHERE ID_ITT = '$iditt'";
					$queryIdrec = oci_parse($conn3, $queryIdrec);
					oci_execute($queryIdrec);	
					while ($rowrec = oci_fetch_array($queryIdrec, OCI_ASSOC))
					{
						$idrec = $rowrec['IDX'];
					}					
					$idplp = "";
					$atd = "";
					$callsign = "";
					$no_book = "";	
					$jnstrade = "T"; 
					$kd_tpl = "TER3";
					$user = "itost3";
					$kade = "";
					$nmtpl1 = $kd_tpl;
					$nmtpl2 = "Lapangan ".$idyard;
					$noplp = "";
					$tglplp = "";
					$temp = "";
					$itt_status = "Y";
					$paramd = $idrec."^".$nocont."^".$sz_cont."^".$ty_cont."^".$st_cont."^".$hz_cont."^".$no_ukk."^".$vessel."^".$voyin."^".$voyout."^".$callsign."^".$kd_tpl."^".$nmtpl1."^".$idyard."^".$nmtpl2."^".$user."^".$idplp."^".$jnstrade."^".$noplp."^".$tglplp."^".$temp."^".$itt_status."^".$isocode."^".$point."^".$via;			   
					$insertD = "BEGIN PROC_REC_D('$paramd'); END;";
					$detail = oci_parse($conn3, $insertD);
					oci_execute($detail);										
					oci_close($conn3);
				}
				else
				{
					$errmsg = oci_error();
					print 'Oracle connect error: ' . $errmsg['message'];					
				}
			}		
        }
        
        oci_close($conn);
//++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ Terminal 3 +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++//		
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
  //============= Header Booking ===================//

   return "OK";
}

//======= Declare Function Service ========// 
function setVerify_ITT($idrec) {

   if ($conn = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) { 		
		
		//get container ESY
        $query2 = "SELECT A.ID_VES_VOYAGE,
						  B.NO_CONT,
						  B.ITT_POINT
				   FROM PLAN_REC_H A, PLAN_REC_D B
					WHERE A.ID_REC = B.ID_REC
					AND A.ID_REC = '$idrec'";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
			$idvvd = $row['ID_VES_VOYAGE'];
			$nocont = $row['NO_CONT'];
			$point = $row['ITT_POINT'];
			
			// db connection
		    if ($conn2 = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) {
				
				$sql = 'BEGIN PROC_SETVERIFY_ITT(:nocont, :point, :idvesvoy, :out, :msg_out); END;';
				$stmt = oci_parse($conn2,$sql);
				//=== INPUT VARIABLE ===//
				oci_bind_by_name($stmt,':nocont',$nocont,32);
				oci_bind_by_name($stmt,':point',$point,32);
				oci_bind_by_name($stmt,':idvesvoy',$idvvd,32);

				//=== OUTPUT VARIABLE ===//
				oci_bind_by_name($stmt,':out',$out,32);
				oci_bind_by_name($stmt,':msg_out',$msg_out,32);

				// $name = 'Harry';
				oci_execute($stmt); 
				oci_close($conn2);
				
		    } else {
			  $errmsg = oci_error();
			  print 'Oracle connect error: ' . $errmsg['message'];
		    }			
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }

	return "OK";
	
}

function updateStatusCancelITT($idvvd,$nocont,$point) {
	// db connection
	if ($conn2 = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) {
		
		$sql = 'BEGIN PROC_SAVECANCELITT_LN2(:v_idvvd, :v_nocont, :v_point, :v_out, :v_msg_out); END;';
		$stmt = oci_parse($conn2,$sql);
		//=== INPUT VARIABLE ===//
		oci_bind_by_name($stmt,':v_idvvd',$idvvd,32);
		oci_bind_by_name($stmt,':v_nocont',$nocont,32);
		oci_bind_by_name($stmt,':v_point',$point,32);

		//=== OUTPUT VARIABLE ===//
		oci_bind_by_name($stmt,':v_out',$out,32);
		oci_bind_by_name($stmt,':v_msg_out',$msg_out,32);

		// $name = 'Harry';
		oci_execute($stmt); 
		oci_close($conn2);
	} else {
		$out = 'NO';
		$msg_out = $nocont.' failed';
	    $errmsg = oci_error();
		print 'Oracle connect error: ' . $errmsg['message'];
	}
	
	return $out.'-'.$msg_out;	
}

function getJobYard_Lini2($idvvd,$nocont,$point,$wg,$rm,$slno) {

	// db connection
	if ($conn2 = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) {
				
		$sql = 'BEGIN PROC_GETJOBYARD_ITT(:v_idvvd, :v_nocont, :v_point, :v_wg, :v_rm, :v_sealno, :v_bl, :v_nm_bl, :v_slot_bl, :v_row_bl, :v_tier_bl, :v_err, :v_sz); END;';
		$stmt = oci_parse($conn2,$sql);
		//=== INPUT VARIABLE ===//
		oci_bind_by_name($stmt,':v_idvvd',$idvvd,32);
		oci_bind_by_name($stmt,':v_nocont',$nocont,32);
		oci_bind_by_name($stmt,':v_point',$point,32);
		oci_bind_by_name($stmt,':v_wg',$wg,32);
		oci_bind_by_name($stmt,':v_rm',$rm,32);
		oci_bind_by_name($stmt,':v_sealno',$slno,32);

		//=== OUTPUT VARIABLE ===//
		oci_bind_by_name($stmt,':v_bl',$idbl,32);
		oci_bind_by_name($stmt,':v_nm_bl',$nmbl,32);
		oci_bind_by_name($stmt,':v_slot_bl',$slotbl,32);
		oci_bind_by_name($stmt,':v_row_bl',$rowbl,32);
		oci_bind_by_name($stmt,':v_tier_bl',$tierbl,32);
		oci_bind_by_name($stmt,':v_err',$err,32);
		oci_bind_by_name($stmt,':v_sz',$sz,32);

		// $name = 'Harry';
		oci_execute($stmt); 
		oci_close($conn2);
				
	} else {
	    $errmsg = oci_error();
		print 'Oracle connect error: ' . $errmsg['message'];
	}
	
	return $err."-".$idbl."-".$nmbl."-".$slotbl."-".$rowbl."-".$tierbl."-".$sz;	
}

function sendLog_Plc_Itos($idrec,$nocont) {

   if ($conn = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) { 		
		
		//get container ESY
        $query2 = "SELECT NO_UKK ID_VES_VOYAGE,
						  NO_CONTAINER NO_CONT,
						  ITT_POINT,
						  OP_PLC_BY,
						  OP_PLC_EQ,
						  OP_PLC_NMBLOCK,
						  OP_PLC_SLOT,
						  OP_PLC_ROW,
						  OP_PLC_TIER,
						  KD_TPL2,
						  CASE WHEN OP_PLC_ST = '1' THEN 'N'
							   ELSE 'Y' END RELOC
				   FROM OP_LST_CONTAINER
				   WHERE PL_IDREC = '$idrec'
					AND TRIM(NO_CONTAINER) = '$nocont'";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
			$idvvd = $row['ID_VES_VOYAGE'];
			$nocont = $row['NO_CONT'];
			$point = $row['ITT_POINT'];
			$username = $row['OP_PLC_BY'];
			$machine_nm = $row['OP_PLC_EQ'];
			$loc = $row['KD_TPL2']."-".$row['OP_PLC_NMBLOCK']."-".$row['OP_PLC_SLOT']."-".$row['OP_PLC_ROW']."-".$row['OP_PLC_TIER'];
			$reloc = $row['RELOC'];
			
			// db connection
			if ($conn2 = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) {
						
				$sql = 'BEGIN PROC_SENDLOGPLC_ITT(:v_no_container, :v_point, :v_id_ves_voyage, :v_user_name, :v_machine_name, :v_location, :v_is_reloc, :v_out, :v_msg_out); END;';
				$stmt = oci_parse($conn2,$sql);
				//=== INPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_no_container',$nocont,32);
				oci_bind_by_name($stmt,':v_point',$point,32);
				oci_bind_by_name($stmt,':v_id_ves_voyage',$idvvd,32);
				oci_bind_by_name($stmt,':v_user_name',$username,32);
				oci_bind_by_name($stmt,':v_machine_name',$machine_nm,32);
				oci_bind_by_name($stmt,':v_location',$loc,32);
				oci_bind_by_name($stmt,':v_is_reloc',$reloc,32);

				//=== OUTPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_out',$out,32);
				oci_bind_by_name($stmt,':v_msg_out',$msg_out,32);

				// $name = 'Harry';
				oci_execute($stmt); 
				oci_close($conn2);
						
			} else {
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];
			}			
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
		
	return $out.", ".$msg_out;	
}

function sendLog_Req_Itos($no_req,$no_container) {	
	
   if ($conn = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) { 		
		
		//get container ESY
        $query2 = "SELECT NO_UKK ID_VES_VOYAGE,
						  NO_CONTAINER NO_CONT,
						  ITT_POINT
				   FROM OP_LST_CONTAINER
				   WHERE ACTIVE = '1'
					AND TRIM(NO_CONTAINER) = '$no_container'";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
			$idvvd = $row['ID_VES_VOYAGE'];
			$nocont = $row['NO_CONT'];
			$point = $row['ITT_POINT'];
			
			// db connection
			if ($conn2 = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) {
						
				$sql = 'BEGIN PROC_SENDLOGREQ_ITT(:v_no_container, :v_point, :v_id_ves_voyage, :v_no_request, :v_out , :v_msg_out); END;';
				$stmt = oci_parse($conn2,$sql);
				//=== INPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_no_container',$nocont,32);
				oci_bind_by_name($stmt,':v_point',$point,32);
				oci_bind_by_name($stmt,':v_id_ves_voyage',$idvvd,32);
				oci_bind_by_name($stmt,':v_no_request',$no_req,32);

				//=== OUTPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_out',$out,32);
				oci_bind_by_name($stmt,':v_msg_out',$msg_out,32);

				// $name = 'Harry';
				oci_execute($stmt); 
				oci_close($conn2);
						
			} else {
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];
			}			
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }	
		
	return "OK";	
}

function sendLog_Pay_Itos($no_nota,$channel,$status2) {

   if ($conn = oci_connect('BILLING_OBX', 'billing_OBX', '192.168.23.26/DBDEV')) { 		
		
		//get container ESY
		if($channel=='manual')
		{
			$query2 = "SELECT A.NO_NOTA,
							  C.NO_CONT,
							  D.ITT_POINT,
							  D.NO_UKK,
							  A.NO_REQUEST,
							  CASE WHEN B.JENIS_REQ = '0' THEN 'SP2 ESY'
							  ELSE 'SP2 EXT' END TYPE_REQ,
							  TO_CHAR(B.TGL_REQUEST,'YYYYMMDDHH24MISS') TGL_REQUEST,
							  TO_CHAR(A.TGL_ENTRY_LUNAS,'YYYYMMDDHH24MISS') TGL_LUNAS,
							  TO_CHAR(B.PAID_THRU,'YYYYMMDD')||'235959' PAID_THRU,
							  B.USERNAME,
							  B.CUST_NAME,
							  B.CUST_ADDR
					   FROM BIL_NOTA_PTP_H A, REQ_DLV_INTER_H B, REQ_DLV_INTER_D C, LINEOS.OP_LST_CONTAINER D
					   WHERE A.JENIS_NOTA = 'DLVI'
						AND A.NO_REQUEST = B.NO_REQUEST
						AND B.ID_DLV = C.ID_DLV
						AND C.ID_DLV = D.PL_IDDEL
                        AND C.NO_CONT = D.NO_CONTAINER
						AND D.ITT_FLAG = 'Y'
						AND A.NO_NOTA = '$no_nota'";			
		}
		else
		{
			$query2 = "SELECT A.NO_NOTA,
							  C.NO_CONT,
							  D.ITT_POINT,
							  D.NO_UKK,
							  A.NO_REQUEST,
							  CASE WHEN B.JENIS_REQ = '0' THEN 'SP2 ESY'
							  ELSE 'SP2 EXT' END TYPE_REQ,
							  TO_CHAR(B.TGL_REQUEST,'YYYYMMDDHH24MISS') TGL_REQUEST,
							  TO_CHAR(A.TGL_ENTRY_LUNAS,'YYYYMMDDHH24MISS') TGL_LUNAS,
							  TO_CHAR(B.PAID_THRU,'YYYYMMDD')||'235959' PAID_THRU,
							  B.USERNAME,
							  B.CUST_NAME,
							  B.CUST_ADDR
					   FROM BIL_NOTA_PTP_H A, REQ_DLV_INTER_H B, REQ_DLV_INTER_D C, LINEOS.OP_LST_CONTAINER D
					   WHERE A.JENIS_NOTA = 'DLVI'
						AND A.NO_REQUEST = B.NO_REQUEST
						AND B.ID_DLV = C.ID_DLV
						AND C.ID_DLV = D.PL_IDDEL
						AND C.NO_CONT = D.NO_CONTAINER
						AND D.ITT_FLAG = 'Y'
						AND A.NO_REQUEST = '$no_nota'";				
		}
			
		$query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
			$idvvd = $row['NO_UKK'];
			$nocont = $row['NO_CONT'];
			$point = $row['ITT_POINT'];
			$no_req = $row['NO_REQUEST'];
			$no_nota = $row['NO_NOTA'];
			$type_req = $row['TYPE_REQ'];
			$status = $status2;
			$date_req = $row['TGL_REQUEST'];
			$date_payment = $row['TGL_LUNAS'];
			$paidthru = $row['PAID_THRU'];
			$user = $row['USERNAME'];
			$custnm = $row['CUST_NAME'];
			$custaddr = $row['CUST_ADDR'];
			
			// db connection
			if ($conn2 = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) {
				
				$params = $nocont."^".$point."^".$idvvd."^".$no_req."^".$type_req."^".$no_nota."^".$status."^".$date_req."^".$date_payment."^".$paidthru."^".$user."^".$custnm."^".$custaddr;
				$sql = 'BEGIN PROC_SENDLOGPAY_ITT(:v_collect_param, :v_out, :v_msg_out); END;';
				$stmt = oci_parse($conn2,$sql);
				//=== INPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_collect_param',$params,500);
				
				//=== OUTPUT VARIABLE ===//				
				// $name = 'Harry';
				oci_bind_by_name($stmt,':v_out',$out,32);
				oci_bind_by_name($stmt,':v_msg_out',$msg_out,32);
				
				oci_execute($stmt); 				
				oci_close($conn2);
				
			} else {
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];
			}
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
   
   return "OK";	
}

function sendLog_Gidel_Itos($iddel,$nocont) {

   if ($conn = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) { 		
		
		//get container ESY
        $query2 = "SELECT NO_UKK ID_VES_VOYAGE,
						  NO_CONTAINER NO_CONT,
						  ITT_POINT,
						  OP_GIDEL_BY,
						  OP_GIDEL_YTNO
				   FROM OP_LST_CONTAINER
				   WHERE PL_IDDEL = '$iddel'
					AND TRIM(NO_CONTAINER) = '$nocont'";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
			$idvvd = $row['ID_VES_VOYAGE'];
			$nocont = $row['NO_CONT'];
			$point = $row['ITT_POINT'];
			$username = $row['OP_GIDEL_BY'];
			$no_truck = $row['OP_GIDEL_YTNO'];
			
			// db connection
			if ($conn2 = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) {
						
				$sql = 'BEGIN PROC_SENDLOGGIDEL_ITT(:v_no_container, :v_point, :v_id_ves_voyage, :v_user_name, :v_no_truck, :v_out, :v_msg_out); END;';
				$stmt = oci_parse($conn2,$sql);
				//=== INPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_no_container',$nocont,50);
				oci_bind_by_name($stmt,':v_point',$point,50);
				oci_bind_by_name($stmt,':v_id_ves_voyage',$idvvd,50);
				oci_bind_by_name($stmt,':v_user_name',$username,50);
				oci_bind_by_name($stmt,':v_no_truck',$no_truck,50);

				//=== OUTPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_out',$out,32);
				oci_bind_by_name($stmt,':v_msg_out',$msg_out,32);

				// $name = 'Harry';
				oci_execute($stmt); 
				oci_close($conn2);
				
				return $out;
				die;
						
			} else {
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];
			}			
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
   
	return "OK";	
}

function sendLog_Pck_Itos($iddel,$nocont,$usernm) {

   if ($conn = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) { 		
		
		//get container ESY
        $query2 = "SELECT NO_UKK ID_VES_VOYAGE,
						  NO_CONTAINER NO_CONT,
						  ITT_POINT
				   FROM OP_LST_CONTAINER
				   WHERE PL_IDDEL = '$iddel'
					AND TRIM(NO_CONTAINER) = '$nocont'";
		
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
			$idvvd = $row['ID_VES_VOYAGE'];
			$nocont = $row['NO_CONT'];
			$point = $row['ITT_POINT'];
			
			// db connection
			if ($conn2 = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) {
				
				$sql = 'BEGIN PROC_SENDLOGPCK_ITT(:v_no_container, :v_point, :v_id_ves_voyage, :v_user_name, :v_out, :v_msg_out); END;';
				$stmt = oci_parse($conn2,$sql);
				//=== INPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_no_container',$nocont,50);
				oci_bind_by_name($stmt,':v_point',$point,50);
				oci_bind_by_name($stmt,':v_id_ves_voyage',$idvvd,50);
				oci_bind_by_name($stmt,':v_user_name',$usernm,50);

				//=== OUTPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_out',$out,32);
				oci_bind_by_name($stmt,':v_msg_out',$msg_out,32);

				// $name = 'Harry';
				oci_execute($stmt); 
				oci_close($conn2);
						
			} else {
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];
			}			
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
   
	return $query2;	
}

function sendLog_Godel_Itos($iddel,$nocont) {

   if ($conn = oci_connect('LINEOS', 'ligneOS', '192.168.23.26/DBDEV')) { 		
		
		//get container ESY
        $query2 = "SELECT NO_UKK ID_VES_VOYAGE,
						  NO_CONTAINER NO_CONT,
						  ITT_POINT,
						  OP_GODEL_BY,
						  OP_GODEL_YTNO
				   FROM OP_LST_CONTAINER
				   WHERE PL_IDDEL = '$iddel'
					AND TRIM(NO_CONTAINER) = '$nocont'";
        $query2 = oci_parse($conn, $query2);
        oci_execute($query2); 

        while ($row = oci_fetch_array($query2, OCI_ASSOC))
        {
			$idvvd = $row['ID_VES_VOYAGE'];
			$nocont = $row['NO_CONT'];
			$point = $row['ITT_POINT'];
			$username = $row['OP_GODEL_BY'];
			$no_truck = $row['OP_GODEL_YTNO'];
			
			// db connection
			if ($conn2 = oci_connect('ITOS_OP', 'itos_OP', '192.168.23.26/DBDEV')) {
						
				$sql = 'BEGIN PROC_SENDLOGGODEL_ITT(:v_no_container, :v_point, :v_id_ves_voyage, :v_user_name, :v_no_truck, :v_out, :v_msg_out); END;';
				$stmt = oci_parse($conn2,$sql);
				//=== INPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_no_container',$nocont,50);
				oci_bind_by_name($stmt,':v_point',$point,50);
				oci_bind_by_name($stmt,':v_id_ves_voyage',$idvvd,50);
				oci_bind_by_name($stmt,':v_user_name',$username,50);
				oci_bind_by_name($stmt,':v_no_truck',$no_truck,50);

				//=== OUTPUT VARIABLE ===//
				oci_bind_by_name($stmt,':v_out',$out,32);
				oci_bind_by_name($stmt,':v_msg_out',$msg_out,32);

				// $name = 'Harry';
				oci_execute($stmt); 
				oci_close($conn2);
						
			} else {
				$errmsg = oci_error();
				print 'Oracle connect error: ' . $errmsg['message'];
			}			
		}
        
        oci_close($conn);
		
   } else {
      $errmsg = oci_error();
      print 'Oracle connect error: ' . $errmsg['message'];
   }
   
	return "OK";	
}

$server = new soap_server();
$server->configureWSDL('portalipc', 'urn:portalipc');
 
$server->wsdl->schemaTargetNamespace = 'portalipc';

$server->register('cekWebService',
            array('category' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('getITT_Booking',
            array('service' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('setVerify_ITT',
            array('idrec' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');
			
$server->register('updateStatusCancelITT',
            array('id_ves_voyage' => 'xsd:string', 'no_container' => 'xsd:string', 'point' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');
			
$server->register('getJobYard_Lini2',
            array('id_ves_voyage' => 'xsd:string', 'no_container' => 'xsd:string', 'point' => 'xsd:string', 'weight' => 'xsd:string', 'remark' => 'xsd:string', 'seal_numb' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');
			
$server->register('sendLog_Plc_Itos',
            array('idrec' => 'xsd:string', 'no_container' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');
			
$server->register('sendLog_Req_Itos',
            array('noreq' => 'xsd:string', 'no_container' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');			
			
$server->register('sendLog_Pay_Itos',
            array('nota' => 'xsd:string', 'channel' => 'xsd:string', 'status' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');
			
$server->register('sendLog_Gidel_Itos',
            array('iddel' => 'xsd:string', 'no_container' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');
			
$server->register('sendLog_Pck_Itos',
            array('iddel' => 'xsd:string', 'no_container' => 'xsd:string', 'username' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');

$server->register('sendLog_Godel_Itos',
            array('iddel' => 'xsd:string', 'no_container' => 'xsd:string'),
            array('return' => 'xsd:string'),
            'urn:portalipc',
            'urn:portalipc#pollServer');			

$server->service($HTTP_RAW_POST_DATA);

?>