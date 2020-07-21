<?php
class GetRedaksi_model extends CI_Model {

public function __construct(){
		$this->forum = $this->load->database("forum",TRUE);
		$this->forum->reconnect();
		// $this->load->database();
	}

	public function get_nota_redaksi2($id, $layanan){
		$query 	= "
			SELECT INV_MST_REDAKSI.INV_REDAKSI_NOTE,INV_MST_REDAKSI.INV_REDAKSI_ATAS,INV_MST_REDAKSI.INV_REDAKSI_BAWAH FROM XEINVC_AR_INVOICE_HEADER
			LEFT JOIN INV_MST_UNIT ON XEINVC_AR_INVOICE_HEADER.ORG_ID = INV_MST_UNIT.INV_UNIT_ORGID
			LEFT JOIN INV_MST_REDAKSI ON INV_MST_UNIT.INV_UNIT_ID = INV_MST_REDAKSI.INV_UNIT_ID
			WHERE XEINVC_AR_INVOICE_HEADER.BILLER_REQUEST_ID='".$id."' AND INV_MST_REDAKSI.INV_NOTA_JENIS LIKE '".$layanan."'";
		$result =  $this->forum->query($query);
		// print_r($result);die();
		return $result->row();

	}

}

?>
