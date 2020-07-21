<?php
class Master_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}

	public function get_master_vessel()
	{
		$query		= "SELECT * FROM MST_SBY_VESSEL";
		$result 	= $this->db->query($query);

		return $result->result_array();
	}

	public function get_master_tarif()
	{
		$query		= "SELECT * FROM MST_TARIF";
		$result 	= $this->db->query($query);

		return $result->result_array();
	}

	public function get_master_tarifbyid($id)
	{
		$query		= "SELECT * FROM MST_TARIF WHERE KD_TARIF = ?";
		$result 	= $this->db->query($query, array($id));

		return $result->row_array();
	}

	public function update_tarif($kd_tarif, $tarif)
	{
		$query		= "UPDATE MST_TARIF SET TARIF = ? WHERE KD_TARIF = ?";
		if ($this->db->query($query, array($tarif, $kd_tarif))) {
			return 'S';
		} else {
			return 'F';
		}

	}

	public function get_terminal()
	{
		$query		= "SELECT PORT, TERMINAL, TERMINAL_NAME FROM MST_TERMINAL WHERE ACTIVE = 'Y' ORDER BY ID ASC";
		$result 	= $this->db->query($query);

		return $result->result_array();
	}

	public function get_isocode()
	{
			$size			= $_POST["SC"];
			$tipe			= $_POST["TC"];
			$hgc			= $_POST['HGC'];
			$port			= $_POST['PORT'];

			if($port != 'IDJKT-T3I'){
				$tipe = ($hgc == 'OOG') ? 'OVD' : $tipe;
			}

			if($hgc=='OOG')
			{
				$hgc='9.6';
				if($tipe=='FLT'){
					$hgc='8.6';
				}
			}
			$size = ($size == '21') ? '20' : $size;

			$query = "select m.ISO_CODE from (select ISO_CODE from master_iso_code WHERE SIZE_='$size' AND TYPE_='$tipe' AND H_ISO=$hgc order by iso_code) m where rownum=1";

			$h=$this->db->query($query);
			$r=$h->row_array();
			$msg = $r['ISO_CODE'];
			return $msg;
	}

	public function cek_shippingline()
	{
			$cust_id=$this->session->userdata('customerid_phd');

			$query = "select IS_SHIPPING_AGENT from mst_customer where customer_id='$cust_id'";

			$h=$this->db->query($query);
			$r=$h->row_array();
			$msg=$r['IS_SHIPPING_AGENT'];
			return $msg;
	}

	public function get_customerList($a,$b)
	{

		$query = "select a.NAME,a.ADDRESS,a.NPWP,B.BILLING_CUSTOMER_ID from mst_customer a left join MST_CUSTOMER_BILLING_ACCOUNT b on a.CUSTOMER_ID=b.CUSTOMER_ID left join MST_CUSTOMER_BILLING_SITE c on b.billing_id=c.billing_id where
		           a.name like ? and C.SITE_ID=?";
		//ECHO $query;DIE;
		$c="%".$a."%";
		$param=array($c,$b);

		$h=$this->db->query($query
		,$param
		);
		$r=$h->result_array();

		return $r;
	}

			public function get_customerListTruck($a,$b)
	{

		$query = "select CUSTOMER_ID,NAME,ADDRESS FROM MST_CUSTOMER_TRUCK_TEMP where
                   name like ?";
		//ECHO $query;DIE;
		$c="%".$a."%";
		$param=array($c);

		//ECHO $c;
		//DIE;

		$h=$this->db->query($query
		,$param
		);
		$r=$h->result_array();

		//print_r($r);
		//die();

		return $r;
	}

	public function getHoldingCompany($id_port)
	{
		//echo 'ID_SG: '.$id_sub_group;die;

		$query = "select ID_COMPANY, ID_HOLDING
			from mst_terminal
			where id_port=?";

		$query 	= $this->db->query($query,array($id_port));
		return $query->row_array();
	}

	public function getSimkeuKodeCabang($id_port)
	{
		//echo 'ID_SG: '.$id_sub_group;die;

		$query = "select KODE_CABANG_SIMKEU
			from mst_terminal
			where id_port=?";

		$query 	= $this->db->query($query,array($id_port));
		return $query->row_array();
	}

	public function get_customerListNPK($a,$b,$d)
	{

		$query = "select a.NAME,a.CUSTOMER_ID from mst_customer a left join MST_CUSTOMER_BILLING_ACCOUNT b on a.CUSTOMER_ID=b.CUSTOMER_ID left join MST_CUSTOMER_BILLING_SITE c on b.billing_id=c.billing_id where 
		           a.NAME like ? and (c.SITE_ID=? OR a.REGISTRATION_COMPANY_ID=?)";
		//ECHO $query;DIE;
		$c="%".$a."%";
		$param=array($c,$b,$b);
		
		$h=$this->db->query($query
		,$param
		);
		$r=$h->result_array();
		
		return $r;
	}

    public function cek_kodenota() {
			$this->db->select("INV_NOTA_CODE");
			$this->db->where("INV_NOTA_CODE");
			$query = $this->db->get('INV_MST_NOTA');
			$row = $query->row();
			if ($query->num_rows < 0){
				return true;
			} else {
				return false;
			}
		}
}
?>
