<?php
class Proforma_model extends CI_Model {

	public function __construct(){
		$this->load->library('session');
		$this->load->library('OMDBConnect');

	}

	public function getProformaCore($headquery, $headparams){

		$rs = $this->omdbconnect->query($headquery, $headparams);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			$header = $this->omdbconnect->getOne($rs);
		}

		//get Detail
		$query = "select a.* ,
					case a.unit when 'QTY' then 'Unit' when 'CUBIC' then 'Meter Kubik' when 'TON' then 'Ton' else a.unit end UNITTYPE
				 from prf_booking_cg_d a
				 where a.jenis_biaya not in ('ADMIN')
					and a.id_proforma = :idprf";
		$params = array();
		$params[':idprf'] = $header['ID_PROFORMA'];

		$rs = $this->omdbconnect->query($query, $params);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			$detail = $this->omdbconnect->getAll($rs);
		}

		//finally
		return array (	'header' => $header, 'detail' => $detail	);

	}

	public function getProforma($prf_id){
		//get Header
		$query = "select to_char(prf_date,'DD MON YYYY') fmtdate,
				  a.*,
				   TERBILANG(a.KREDIT) TERBILANG,
		          b.VESSEL,
				  b.VOY_IN,
				  b.VOY_OUT,
				  b.DO_NUMBER,
				  b.DO_DATE,
				  c.SERVICETYPE_NAME,
				  to_char(b.req_date,'DD-MM-YYYY HH24:MI') trx_date,
				  (select BL_NUMBER from req_booking_cg_d f where b.id_req = f.id_req and rownum = 1) BL_NUMBER,
				  (select BL_DATE from req_booking_cg_d f where b.id_req = f.id_req and rownum = 1) BL_DATE,
				  (select sum(TOTAL_TARIFF) from prf_booking_cg_d g where a.id_proforma = g.id_proforma and g.jenis_biaya = 'ADMIN') ADMINISTRASI
		          from prf_booking_h a, req_booking_h b, m_servicetype c
				  where a.id_req = b.id_req
				    and b.id_servicetype = c.id_servicetype
					and a.id_proforma = :idprf";
		$params = array();
		$params[':idprf'] = $prf_id;

		return $this->getProformaCore($query, $params);
	}

	public function getProformaByReq($req_id){

		//get Header
		$query = "select to_char(prf_date,'DD MON YYYY') fmtdate, a.* from prf_booking_h a where id_reqcargo = :idreq";
		$params = array();
		$params[':idreq'] = $req_id;

		return $this->getProformaCore($query, $params);
	}

	public function getProformaList(){
		$filter = "";

		$query = "select to_char(prf_date,'DD MON YYYY') fmtdate, a.* from prf_booking_h a $filter";

		$rs = $this->omdbconnect->query($query);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			return $this->omdbconnect->getAll($rs);
		}
	}

	public function createProforma($header, $details){

		$idreq = $header['ID_REQ'];
		$idprf = $header['ID_PROFORMA'];

		$q_clean  = " delete from prf_booking_cg_d where id_proforma in (select id_proforma from prf_booking_h where id_req = '$idreq'); ";
		$q_clean .=	" delete from prf_booking_h where id_req = '$idreq'; ";

		$q_header = "INSERT INTO PRF_BOOKING_H (
					   ID_PROFORMA, ID_REQ, PRF_DATE,
					   PRF_EDIT_DATE, STATUS_PRF, ID_USER,
   					   ID_HOLDING, ID_PORT, ID_COMPANY,
					   ID_SERVICETYPE, CURRENCY, ID_UPER,
					   ID_CUST, CUST_NAME,
					   MATERAI, TOTAL, PPN,
					   KREDIT, TARIF_MINIMUM)
					VALUES ('".$header['ID_PROFORMA']."' 	/* ID_PROFORMA */,
							'".$header['ID_REQ']."' 		/* ID_REQ */,
							sysdate					 		/* PRF_DATE */,
							'".$header['PRF_EDIT_DATE']."' 	/* PRF_EDIT_DATE */,
							'".$header['STATUS_PRF']."' 	/* STATUS_PRF */,
							'".$header['ID_USER']."' 		/* ID_USER */,
							'".$header['ID_HOLDING']."' 	/* ID_HOLDING */,
							'".$header['ID_PORT']."' 		/* ID_PORT */,
							'".$header['ID_COMPANY']."' 	/* ID_COMPANY */,
							'".$header['ID_SERVICETYPE']."' /* ID_SERVICETYPE */,
							'".$header['CURRENCY']."' 		/* CURRENCY */,
							'".$header['ID_UPER']."' 		/* ID_UPER */,
							'".$header['ID_CUST']."' 		/* ID_CUST */,
							'".$header['CUST_NAME']."' 		/* CUST_NAME */,
							'".$header['MATERAI']."' 		/* MATERAI */,
							'".$header['TOTAL']."' 			/* TOTAL */,
							'".$header['PPN']."' 			/* PPN */, 
							'".$header['KREDIT']."' 		/* KREDIT */,
							'".$header['TARIF_MINIMUM']."' 	/* TARIF_MINIMUM */);";  /// for debug-> remove ;


		$q_detail = "";
		foreach($details as $dt){
			if($dt['TOTAL_TARIFF'] != 0 || $dt['TOTAL_TARIFF'] != '') {
			$q_detail .= " INSERT INTO PRF_BOOKING_CG_D (
									   ID_PROFORMA, JENIS_BIAYA, NAMA_BIAYA,
									   ID_CARGO, CARGO_NAME, ID_PKG, PKG_NAME,
									   QTY, UNIT, HZ,
							   DS, TARIFF, TOTAL_TARIFF,
							   REQ_DTL_NO, TOTHR,
							   STACKIN_DATE, STACKOUT_DATE) 
							VALUES ('".$dt['ID_PROFORMA']."' 	/* ID_PROFORMA */,
									'".$dt['JENIS_BIAYA']."' 	/* JENIS_BIAYA */,
									'".$dt['NAMA_BIAYA']."' 	/* NAMA_BIAYA */,
									'".$dt['ID_CARGO']."' 		/* ID_CARGO */,
									'".$dt['CARGO_NAME']."' 	/* CARGO_NAME */,
									'".$dt['ID_PKG']."' 		/* ID_PKG */,
									'".$dt['PKG_NAME']."' 		/* PKG_NAME */,
									'".$dt['QTY']."' 			/* QTY */,
									'".$dt['UNIT']."' 			/* UNIT */,
									'".$dt['HZ']."' 			/* HZ */,
									'".$dt['DS']."' 			/* DS */,
									'".$dt['TARIFF']."' 		/* TARIFF */,
									'".$dt['TOTAL_TARIFF']."' 	/* TOTAL_TARIFF */,
									'".$dt['REQ_DTL_NO']."' 	/* REQ_DTL_NO */,
									'".$dt['TOTHR']."' 			/* TOTHR */, 									to_date('".$dt['STACKIN_DATE']."','dd/mm/yyyy') 	/* STACKIN_DATE */, 
									to_date('".$dt['STACKOUT_DATE']."','dd/mm/yyyy') 	/* STACKOUT_DATE */ 
									);"; /// for debug-> remove ;
		}
		}

		$q_complete =  " update prf_booking_cg_d prf set
							prf.cargo_name = coalesce( prf.cargo_name, (select s1.cargo_name from m_cg_hscode s1 where s1.id_cargo = prf.id_cargo)),
							(prf.stackin_date, prf.stackout_date) = ( select s2.stackin_date, s2.stackout_date from req_booking_cg_d s2 where s2.id_req = '$idreq' and s2.dtl_no = prf.req_dtl_no and rownum = 1)
						where prf.id_proforma = '$idprf'; ";
		$q_complete .= " update prf_booking_h d set
							(ID_USER, ID_HOLDING,ID_PORT,ID_COMPANY,ID_SERVICETYPE,ID_CUST,CUST_NAME, CUST_ADDR, CUST_NPWP) =
							(select s.id_user, s.id_holding, s.id_port, s.id_company, s.id_servicetype, s.id_cust, s.cust_name, s.cust_addr, s.cust_npwp
							from req_booking_h s where s.id_req = '$idreq') where d.id_req = '$idreq'; ";

		//echo $q_complete; die;

		$query = "begin $q_clean $q_header $q_detail $q_complete end;";
		$rs = $this->omdbconnect->query($query);


		//return $query; die;
		//return $rs; die;


		if ($rs['success']){
			$x = json_decode($rs['result']);
			if ($x->rc == 'S'){
				return 'S';
			}
		}
		return $rs;
	}

	public function editProforma($header, $details){
		$id_proforma = $header['ID_PROFORMA'];
		$q_clean = " delete from prf_booking_cg_d where id_proforma = '$id_proforma'; ";

		$q_head = " UPDATE PRF_BOOKING_H
					SET    PRF_EDIT_DATE  = ".$header['PRF_EDIT_DATE'].",
						   STATUS_PRF     = ".$header['STATUS_PRF'].",
						   ID_USER        = ".$header['ID_USER'].",
						   ID_HOLDING     = ".$header['ID_HOLDING'].",
						   ID_PORT        = ".$header['ID_PORT'].",
						   ID_COMPANY     = ".$header['ID_COMPANY'].",
						   ID_SERVICETYPE = ".$header['ID_SERVICETYPE'].",
						   CURRENCY       = ".$header['CURRENCY'].",
						   ID_UPER        = ".$header['ID_UPER'].",
						   ID_CUST        = ".$header['ID_CUST'].",
						   CUST_NAME      = ".$header['CUST_NAME'].",
						   ADMINISTRASI   = ".$header['ADMINISTRASI'].",
						   MATERAI        = ".$header['MATERAI'].",
						   TOTAL          = ".$header['TOTAL'].",
						   PPN            = ".$header['PPN'].",
						   KREDIT         = ".$header['KREDIT']."
					where id_proforma = '$id_proforma'; ";

		//foreach detail...
		$q_detail = "";
		foreach($details as $dt){
			$q_detail .= " INSERT INTO PRF_BOOKING_CG_D (
							   ID_PROFORMA, JENIS_BIAYA, ID_CARGO,
							   CARGO_NAME, ID_PKG, PKG_NAME,
							   QTY, UNIT, HZ,
							   DS, TARIFF, TOTAL_TARIFF)
							VALUES ('".$dt['ID_PROFORMA']."' 	/* ID_PROFORMA */,
									'".$dt['JENIS_BIAYA']."' 	/* JENIS_BIAYA */,
									'".$dt['ID_CARGO']."' 		/* ID_CARGO */,
									'".$dt['CARGO_NAME']."' 	/* CARGO_NAME */,
									'".$dt['ID_PKG']."' 		/* ID_PKG */,
									'".$dt['PKG_NAME']."' 		/* PKG_NAME */,
									'".$dt['QTY']."' 			/* QTY */,
									'".$dt['UNIT']."' 			/* UNIT */,
									'".$dt['HZ']."' 			/* HZ */,
									'".$dt['DS']."' 			/* DS */,
									'".$dt['TARIFF']."' 		/* TARIFF */,
									'".$dt['TOTAL_TARIFF']."' 	/* TOTAL_TARIFF */ );"; /// for debug-> remove ;
		}

		$query = "begin $q_clean $q_header $q_detail end;";
		$rs = $this->omdbconnect->query($query);
		if (!$rs['success']){
			return $rs;
		}
		else{
			return 'S';
		}

	}


}?>
