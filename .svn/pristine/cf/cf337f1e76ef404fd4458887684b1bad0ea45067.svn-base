<?php
class Va_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->forum = $this->load->database("forum",TRUE);
		$this->load->library('session');
	}

	public function getVANumber($org_id, $unit_id)
	{
		$connection = oci_connect('IBIS', 'ibis123', '10.10.33.85:1521/ESERVICEDB');
		$query = "BEGIN ef_get_va_number
						(
							'$org_id',
							'$unit_id',
							:out_message
						); END;";

		$query = oci_parse($connection, $query) or die ('Can not parse query');
		oci_bind_by_name($query, 'out_message', $out_param, 1000) or die ('Can not bind variable');

		oci_execute($query);

		oci_close($connection);

		return $out_param;

	}

	public function checkout($params)
	{
		$query = "select * from VA_CHECKOUT where TRX_NUMBER = '{$params['TRX_NUMBER']}'";

		$validation = $this->forum->query($query, $params);

		$result = $validation->num_rows();

		if($result == 0) {
			$query	= "insert into VA_CHECKOUT(TRX_NUMBER, ORG_ID, LAYANAN, CUSTOMER_NAME, CUSTOMER_NUMBER, AMOUNT, TRX_DATE, USER_ID, CABANG, SERVICES) values (?,?,?,?,?,?,?,?,?,?)";
			// return $query;
			$this->forum->query($query, $params);

			if(count($this->forum->affected_rows()) > 0) {
				return array('TRX_NUMBER' => $params['TRX_NUMBER'], 'STATUS' => 'SUCCESS');
			} else {
				return array('TRX_NUMBER' => $params['TRX_NUMBER'], 'STATUS' => 'SUCCESS');
			}
		} else {
				return array('TRX_NUMBER' => $params['TRX_NUMBER'], 'STATUS' => 'FAILED');
		}

	}

	public function all_cart($user_id, $org_id)
	{
		$query = "select * from VA_CHECKOUT where ORG_ID = '{$org_id}' AND USER_ID = '{$user_id}'";

		$query = $this->forum->query($query);

	  return $result = $query->result_array();
	}

	public function remove_cart($user_id, $org_id, $proforma)
	{
		$query = "delete from VA_CHECKOUT where ORG_ID = '{$org_id}' AND USER_ID = '{$user_id}' AND TRX_NUMBER = '{$proforma}'";

		$query = $this->forum->query($query);
	}

	public function remove_cart_bulk($user_id, $org_id, $bulk)
	{
		$implode_bulk = sprintf("'%s'", implode("','", $bulk ));

		$query = "delete from VA_CHECKOUT where ORG_ID = '{$org_id}' AND USER_ID = '{$user_id}' AND TRX_NUMBER IN ({$implode_bulk})";

		$query = $this->forum->query($query);
	}

}?>
