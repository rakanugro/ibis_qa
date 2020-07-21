<?php
class Branch_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
		
	public function getBranchOptions($org_id="",$branch_id="", $customer_id=""){
		$q_where="";
		
		if($org_id!="")
		{
			if($branch_id!="")
			{
				$q_where = " where (branch_id = '$branch_id' and organization_id = '$org_id')";
			}
			else 
			{
				if($customer_id!="")
				{
					$q_where = " where organization_id = '$org_id' and branch_id is not null and branch_id not in (select branch_id_t from mst_customer_billing_account where customer_id_t = '$customer_id')";
				}
				else
				{
					$q_where = " where organization_id = '$org_id' and branch_id is not null";
				}
			}
		}
		else
		{
			$q_where = " where branch_id = '$branch_id'";
		}
		
		$query = "	select branch_id VALUE, name TEXT
					from mst_hr_operating_units $q_where 
					order by branch_id desc ";
		
		return $this->db->query($query);
	}
	
	public function getSiteOptions($branch) {
		
		$query = "select organization_id VALUE, name TEXT, enabled_gui ENABLED 
					from mst_hr_operating_units where branch_id = ? 
					and displayed_gui = 'Y'
					order by organization_id asc";
					
		return $this->db->query($query, array($branch));
	}
	

		
}?>