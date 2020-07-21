<?php
class Bank_model extends CI_Model
{

	public function __construct()
	{
		$this->billing = $this->load->database("default", TRUE);
		$this->billing->reconnect();
		$this->forum = $this->load->database("forum", TRUE);
		$this->forum->reconnect();
	}
	public function getDataBiller($id = null)
	{
		$query = "select * from VA_MST_BILLER b inner join INVOICE.INV_MST_UNIT mu on b.INV_ID_UNIT = mu.INV_UNIT_ID where b.STATUS='1' AND b.INV_ID_UNIT= '{$id}'";
		$query 	= $this->forum->query($query);
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}
	public function getDataBank($where = "")
	{

		$query = "select t.*,
							to_char(CREATED_DATE,'DD MON YYYY HH24:MI:SS') as created_date,
							to_char(UPDATED_DATE,'DD 	MON YYYY HH24:MI:SS') as updated_date,
							CASE
						    WHEN t.STATUS = '0'
						    	THEN 'Aktif'
						    WHEN t.STATUS = '1'
						    	THEN 'Tidak Aktif'
						  END AS STATUSTEXT
							from va_mst_bank t " . $where;
		$query 	= $this->forum->query($query, array($noReq));
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}
	public function getDataBanks($where = "")
	{

		$query = "select t.*,
							to_char(CREATED_DATE,'DD MON YYYY HH24:MI:SS') as created_date,
							to_char(UPDATED_DATE,'DD MON YYYY HH24:MI:SS') as updated_date,
							CASE
						    WHEN t.STATUS = '0'
						    	THEN 'Aktif'
						    WHEN t.STATUS = '1'
						    	THEN 'Tidak Aktif'
						  END AS STATUSTEXT
							from va_mst_bank t where t.STATUS='0' " . $where;
		$query 	= $this->forum->query($query, array($noReq));
		$hasil = $query->result();
		// return $this->db->last_query();
		return $hasil;
	}


	public function update_bank($params)
	{
		$query = "UPDATE va_mst_bank
						set KODE_BANK = ?,
						NAMA_BANK = ?,
						STATUS = ?,
						UPDATED_DATE = SYSDATE
					where ID = ?";

		return $this->forum->query($query, $params);
	}

	public function getDataConfigBillerBank($all = 'false', $id = null, $current_id = null)
	{
		if($all == 'false') {
			$query = "select cb.ID, NAMA_CONFIG,ba.NAMA_BANK,b.NAMA_BILLER,NO_ACCOUNT,MERCHANT_CODE,PAYMENT_CODE,CASE
			WHEN cb.STATUS = '0'
				THEN 'Aktif'
			WHEN cb.STATUS = '1'
				THEN 'Tidak Aktif'
			END AS STATUS,cb.CREATE_DATE as CREATED_DATE,ID_BANK,ID_BILLER
				from VA_CONFIG_BILLER cb
				inner join VA_MST_BANK ba on ba.ID = cb.ID_BANK
				inner join VA_MST_BILLER b on b.ID = cb.ID_BILLER WHERE b.INV_ID_UNIT = '{$id}'";
		} else {
			$query = "select cb.ID, NAMA_CONFIG,ba.NAMA_BANK,b.NAMA_BILLER,NO_ACCOUNT,MERCHANT_CODE,PAYMENT_CODE,CASE
				WHEN cb.STATUS = '0'
					THEN 'Aktif'
				WHEN cb.STATUS = '1'
					THEN 'Tidak Aktif'
				END AS STATUS,cb.CREATE_DATE as CREATED_DATE,ID_BANK,ID_BILLER
					from VA_CONFIG_BILLER cb
					inner join VA_MST_BANK ba on ba.ID = cb.ID_BANK
					inner join VA_MST_BILLER b on b.ID = cb.ID_BILLER";
		}

		$query 	= $this->forum->query($query);
		$hasil = $query->result();
		//return $this->db->last_query();
		return $hasil;
	}


	public function insert_biller($params)
	{
		$query	= "insert into MST_BILLER(ID,NAMA_BILLER, TELEPON, KODE_BILLER, EMAIL, KOTA, ALAMAT, NPWP, STATUS,INV_ID_UNIT) values ('',?,?,?,?,?,?,?,?,?)";
		// return $query;
		return $this->forum->query($query, $params);
		// $this->billing->last_query();
	}
	public function insert_bank($params)
	{

		$query	= "insert into VA_MST_BANK(ID,KODE_BANK,NAMA_BANK,STATUS, CREATED_DATE) values (VA_MST_BANK_SEQ.NEXTVAL,?,?,?,SYSDATE)";
		// return $query;
		return $this->forum->query($query, $params);
		// $this->billing->last_query();
	}
	public function insert_config_biller_bank($params)
	{

		$query	= "insert into VA_CONFIG_BILLER(ID_BILLER,ID_BANK,NAMA_CONFIG,NO_ACCOUNT,MERCHANT_CODE,PAYMENT_CODE,STATUS,CREATE_DATE) values (?,?,?,?,?,?,?,SYSDATE)";
		// return $query;
		return $this->forum->query($query, $params);
		//return $this->billing->last_query();
	}

	public function update_biller_bank($param)
	{

		$query = "UPDATE VA_CONFIG_BILLER
						set ID_BILLER = ?,
						ID_BANK = ?,
						NAMA_CONFIG = ?,
						NO_ACCOUNT = ?,
						MERCHANT_CODE = ?,
						PAYMENT_CODE = ?,
						STATUS = ?,
						CREATE_DATE = SYSDATE
					where ID = ?";

		return $this->forum->query($query, $param);
	}

	public function get_config_biller($id)
	{
		$query = "select cb.id, nama_config,nama_bank,nama_biller,no_account,merchant_code,cb.PAYMENT_CODE,cb.STATUS,cb.create_date as CREATED_DATE,ID_BANK,ID_BILLER
			from va_config_biller cb
			inner join va_mst_bank ba on ba.ID = cb.ID_BANK
			inner join va_mst_biller b on b.ID = cb.ID_BILLER
			where cb.ID_BILLER = '{$id}'";

		$query 	= $this->forum->query($query, $id);
		$hasil =  $query->result();
		// return $this->db->last_query();
		return $hasil;
	}

	public function getBillerBank($id)
	{
		$query = "select cb.id, nama_config,nama_bank,nama_biller,no_account,merchant_code,cb.PAYMENT_CODE,cb.STATUS,cb.create_date as CREATED_DATE,ID_BANK,ID_BILLER
			from va_config_biller cb
			inner join va_mst_bank ba on ba.ID = cb.ID_BANK
			inner join va_mst_biller b on b.ID = cb.ID_BILLER
			where b.INV_ID_UNIT = '{$id}'";

		$query 	= $this->forum->query($query, $id);
		$hasil =  $query->result();
		// return $this->db->last_query();
		return $hasil;
	}

	public function getBillerCurrent($id)
	{
		$query = "select cb.id, nama_config,nama_bank,nama_biller,no_account,merchant_code,cb.PAYMENT_CODE,cb.STATUS,cb.create_date as CREATED_DATE,ID_BANK,ID_BILLER
			from va_config_biller cb
			inner join va_mst_bank ba on ba.ID = cb.ID_BANK
			inner join va_mst_biller b on b.ID = cb.ID_BILLER
			where cb.id = '{$id}'";

		$query 	= $this->forum->query($query, $id);
		$hasil =  $query->result();
		// return $this->db->last_query();
		return $hasil;
	}

	public function config_biller($id, $status)
	{
		$query = "UPDATE VA_CONFIG_BILLER SET
								STATUS = {$status}
							where ID_BANK = {$id}";

		return $this->forum->query($query);
	}
}
