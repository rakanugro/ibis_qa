<?php
class Biller_model extends CI_Model
{

	public function __construct()
	{
		$this->billing = $this->load->database("default", TRUE);
		$this->billing->reconnect();
		$this->forum = $this->load->database("forum", TRUE);
		$this->forum->reconnect();
	}
	public function getDataBiller()
	{
		$query = "select t.ID, NAMA_BILLER,KODE_BILLER,KODE_CABANG,b.INV_UNIT_NAME,t.STATUS,
		to_char(CREATED_AT,'DD MON YYYY HH24:MI:SS') AS created_date,
							to_char(UPDATED_AT,'DD MON YYYY HH24:MI:SS') AS updated_date,
							CASE
						    WHEN t.STATUS = '0'
						    	THEN 'Aktif'
						    WHEN t.STATUS = '1'
						    	THEN 'Tidak Aktif'
						  END AS STATUSTEXT,
							t.*
							from INVOICE.VA_MST_BILLER t
							inner join INVOICE.INV_MST_UNIT b on b.INV_UNIT_ID = t.INV_ID_UNIT ";
		$query 	= $this->forum->query($query);
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}
	public function getDataBillers($where = "", $unit_id)
	{
		$query = "select t.*,
		to_char(CREATED_AT,'DD MON YYYY HH24:MI:SS') AS created_date,
							to_char(UPDATED_AT,'DD MON YYYY HH24:MI:SS') AS updated_date,
							CASE
						    WHEN t.STATUS = '0'
						    	THEN 'Aktif'
						    WHEN t.STATUS = '1'
						    	THEN 'Tidak Aktif'
						  END AS STATUSTEXT
							from INVOICE.VA_MST_BILLER t
							inner join INVOICE.INV_MST_UNIT b on b.INV_UNIT_ID = t.INV_ID_UNIT " . $where . " AND INV_ID_UNIT = {$unit_id}";
		$query 	= $this->forum->query($query, array($where));
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}
	public function getDataUnit()
	{
		$this->forum = $this->load->database("forum", TRUE);
		$this->forum->reconnect();
		$query = "select * from inv_mst_unit";
		$query 	= $this->forum->query($query, array($noReq));
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}
	public function update_biller($params)
	{
		$query = "UPDATE VA_MST_BILLER
						set NAMA_BILLER = ?,
						 TELEPON = ?,
						 KODE_BILLER = ?,
						 EMAIL = ?,
						 KOTA = ?,
						 ALAMAT = ?,
						 NPWP = ?,
						 STATUS = ?,
						 INV_ID_UNIT = ?,
						 KODE_CABANG = ?,
						 UPDATED_AT = SYSDATE
					where ID = ?";
		//print_r($query);
		//exit;

		return $this->forum->query($query, $params);
	}


	public function insert_biller($params)
	{
		$query	= "INSERT INTO VA_MST_BILLER(ID,NAMA_BILLER, TELEPON, KODE_BILLER, EMAIL, KOTA, ALAMAT, NPWP, STATUS,INV_ID_UNIT, CREATED_AT, CREATED_BY, KODE_CABANG) values ('',?,?,?,?,?,?,?,?,?,SYSDATE,?,?)";
		// return $query;
		return $this->forum->query($query, $params);
		// $this->billing->last_query();
	}

	public function getDataBranch($id = null)
	{
		$this->forum = $this->load->database("forum", TRUE);
		$this->forum->reconnect();
		$query = "select * from inv_mst_unit where inv_unit_orgid = {$id}";
		$query 	= $this->forum->query($query);
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}

	public function getBranchId($id = null)
	{
		$this->forum = $this->load->database("forum", TRUE);
		$this->forum->reconnect();
		$query = "select inv_unit_id, inv_unit_orgid, inv_unit_name from inv_mst_unit where inv_unit_code = '{$id}' and inv_entity_code = 'IPC'";
		$query 	= $this->forum->query($query);
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}

	public function getBillerCode($id = null)
	{
		$query = "select * from VA_MST_BILLER where INV_ID_UNIT = '{$id}' and STATUS = 1";
		$query 	= $this->forum->query($query);
		return $hasil = $query->result();
		// return $this->db->last_query
	}

	public function checkBiller($code, $user_id)
	{
		$query = "select * from VA_MST_BILLER where KODE_BILLER = '{$code}' and CREATED_BY != '{$user_id}'";
		$query 	= $this->forum->query($query);
		return $hasil = $query->result();
	}

	public function checkKodeCabang($code, $user_id)
	{
		$query = "select * from VA_MST_BILLER where KODE_CABANG = '{$code}' and CREATED_BY != '{$user_id}'";
		$query 	= $this->forum->query($query);
		return $hasil = $query->result();
	}

	public function getSelectedUnit($id)
	{
		$this->forum = $this->load->database("forum", TRUE);
		$this->forum->reconnect();
		$query = "select * from inv_mst_unit where INV_UNIT_ORGID = '{$id}'";
		$query 	= $this->forum->query($query, array($noReq));
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}

	public function getDataBillerWhereInv($id)
	{
		$query = "select to_char(CREATED_AT,'DD MON YYYY HH24:MI:SS') AS created_date,
							to_char(UPDATED_AT,'DD MON YYYY HH24:MI:SS') AS updated_date,
							CASE
						    WHEN t.STATUS = '0'
						    	THEN 'Aktif'
						    WHEN t.STATUS = '1'
						    	THEN 'Tidak Aktif'
						  END AS STATUSTEXT,
							t.* from VA_MST_BILLER t WHERE t.INV_ID_UNIT = '{$id}'";
		$query 	= $this->forum->query($query, array($noReq));
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}

	public function getDataBillerWhereId($id)
	{
		$query = "select to_char(CREATED_AT,'DD MON YYYY HH24:MI:SS') AS created_date,
							to_char(UPDATED_AT,'DD MON YYYY HH24:MI:SS') AS updated_date,
							CASE
						    WHEN t.STATUS = '0'
						    	THEN 'Aktif'
						    WHEN t.STATUS = '1'
						    	THEN 'Tidak Aktif'
						  END AS STATUSTEXT,
							t.* from VA_MST_BILLER t WHERE t.ID = '{$id}'";
		$query 	= $this->forum->query($query, array($noReq));
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}
}
