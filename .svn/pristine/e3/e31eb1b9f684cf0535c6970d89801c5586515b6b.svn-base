<?php
class Nota_model extends CI_Model {

	public function __construct(){
		$this->load->library('session');
		$this->load->library('OMDBConnect');

	}

	public function getNotaCore($headquery, $headparams){

		$rs = $this->omdbconnect->query($headquery, $headparams);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			$header = $this->omdbconnect->getOne($rs);
		}

		//get Detail
		$query = "select
					a.tarif tariff,
					a.tottarif total_tariff,
						a.*
				  from inv_booking_d a
				 where a.uraian not in ('ADMIN')
					and a.id_inv = :idinv";
		$params = array();
		$params[':idinv'] = $header['ID_INV'];

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

	public function getNota($nota_id){
		//get Header
		$query = "select to_char(a.date_created,'DD MON YYYY') fmtdate,
				  a.*,
				  c.servicetype_name,
				  to_char(a.date_created,'DD-MM-YYYY HH24:MI') trx_date,
				  (select BL_NUMBER from req_booking_cg_d f where f.id_req = a.id_req and rownum = 1) BL_NUMBER,
				  (select BL_DATE from req_booking_cg_d d where d.id_req = a.id_req and rownum = 1) BL_DATE,
				  (select sum(TOTTARIF) from inv_booking_d g where a.id_inv = g.id_inv and g.uraian = 'ADMIN') ADMINISTRASI,
				  TERBILANG(a.kredit) TERBILANG
		          from inv_booking_h a, m_servicetype c
				  where a.id_inv = :idinv
					and a.id_servicetype = c.id_servicetype";
		$params = array();
		$params[':idinv'] = $nota_id;

		return $this->getNotaCore($query, $params);
	}

	public function getNotaByReq($req_id){

		//get Header
		$query = "select to_char(date_created,'DD MON YYYY') fmtdate, a.* from inv_booking_h a where id_reqcargo = :idreq";
		$params = array();
		$params[':idreq'] = $req_id;

		return $this->getNotaCore($query, $params);
	}

	public function getNotaList(){
		$filter = "";

		$query = "select to_char(date_created,'DD MON YYYY') fmtdate, a.* from inv_booking_h a $filter";

		$rs = $this->omdbconnect->query($query);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			return $this->omdbconnect->getAll($rs);
		}
	}

	public function getMstBank(){
		$qbank = "select BANK_ACCOUNT_NAME, BANK_ACCOUNT_ID from m_bank where active = 'Y' ORDER BY CURRENCY_CODE, BANK_ACCOUNT_NAME";
		$rs = $this->omdbconnect->query($qbank);
		if (!$rs['success']){
			return $rs['result'];
		}
		else{
			return $this->omdbconnect->getAll($rs);
		}
	}
	

}?>
