<?php
class Options_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
		
	public function getOptions($context, $language)	{
		
		$qcheck = "	select count(1) amt 
					from mst_context_options
					where 
						context_type = ?
						and language = ? ";
		
		$rcheck	= $this->db->query($qcheck,array($context, $language));
		$row	= $rcheck->row_array();
		
		if ($row['AMT'] <= 0){
			$language = $this->default_language;
		}
		
		$query = "	select context_value VALUE, context_text TEXT, enabled
					from mst_context_options
					where 
						context_type = ?
						and language = ? 
					order by context_order,context_text ";
		
		return $this->db->query($query,array($context, $language));

	}
	
	public function getRegistrationBranch()	{
		
		$query = "select VALUE, TEXT, enabled from 
                    (select to_char(organization_id) VALUE, name TEXT, enabled_gui enabled
					from MST_HR_OPERATING_UNITS
					where 
						displayed_gui = 'Y' 
					order by branch_id asc)
					union all 
					(select '' VALUE, '' TEXT, 'Y' enabled
					from dual)
					";
		
		return $this->db->query($query);

	}

	public function getOptionsBranch()	{
		
		$query = "	select branch_id VALUE, name TEXT, enabled_gui enabled 
					from MST_HR_OPERATING_UNITS
					where 
						displayed_gui = 'Y' 
					order by branch_id asc ";
		
		return $this->db->query($query);

	}
	
	public function getContent($context, $language, $id)	{
		
		$qcheck = "	select CONTEXT_TEXT from mst_context_options
					where 
						context_type = ?
						and language = ? and context_value = ?";
		
		$rcheck	= $this->db->query($qcheck,array($context, $language, $id));
		$row	= $rcheck->row_array();
		
		return $row['CONTEXT_TEXT'];
	}
	
	//TODO FIX Security Problem
	public function getProvinceList($search = ''){

		if(strlen($search) > 0){
			$search = "and upper(provinsi) like upper('%$search%') ";
		}
			
		$query = "	select distinct provinsi VALUE, provinsi TEXT from mst_postalcode
					where 1=1 
					$search	
					order by provinsi asc ";
		
		return $this->db->query($query);
	}	
	
	//TODO FIX Security Problem
	public function getCityList($search = '', $filterprov = ''){

		if(strlen($search) > 0){
			$search = urldecode($search);
			$search = html_entity_decode($search);
			$search = "and upper(kabupatenkota) like upper('%$search%') ";
		}
	
		if(strlen($filterprov) > 0){
			$filterprov = urldecode($filterprov);
			$filterprov = html_entity_decode($filterprov);
			$filterprov = " and provinsi = '$filterprov' ";
		}
		
		$query = "	select distinct kabupatenkota VALUE, kabupatenkota TEXT from mst_postalcode
					where 1=1 
					$search	
					$filterprov 
					order by kabupatenkota asc ";
		
		return $this->db->query($query);
	}

	//TODO FIX Security Problem
	public function getPostalcodeList($search = '', $filtercity = ''){
		
		if(strlen($search) > 0){
			$search = urldecode($search);
			$search = html_entity_decode($search);
			$search = "and upper(postal_code) like upper('%$search%') ";
		}
	
		if(strlen($filtercity) > 0){
			$filtercity = urldecode($filtercity);
			$filtercity = html_entity_decode($filtercity);
			$filtercity = " and kabupatenkota = '$filtercity' ";
		}
		
		$query = "	select distinct postal_code VALUE, postal_code TEXT from mst_postalcode
					where 1=1 
					$search	
					$filtercity 
					order by postal_code asc ";
		
		return $this->db->query($query);
	}	
	
	//TODO FIX Security Problem
	public function getKecamatanList($search = '', $filtercity = ''){

		if(strlen($search) > 0){
			$search = urldecode($search);
			$search = html_entity_decode($search);			
			$search = "and upper(kecamatan) like upper('%$search%') ";
		}
	
		if(strlen($filtercity) > 0){
			$filtercity = urldecode($filtercity);
			$filtercity = html_entity_decode($filtercity);
			$filtercity = " and kabupatenkota = '$filtercity' ";
		}
		
		$query = "	select distinct kecamatan VALUE, kecamatan TEXT from mst_postalcode
					where 1=1 
					$search	
					$filtercity 
					order by kecamatan asc ";
		
		return $this->db->query($query);
	}
	
	//TODO FIX Security Problem
	public function getKelurahanList($search = '', $filtercamat = ''){

		if(strlen($search) > 0){
			$search = urldecode($search);
			$search = html_entity_decode($search);
			$search = "and upper(kelurahan) like upper('%$search%') ";
		}
	
		if(strlen($filtercamat) > 0){
			$filtercamat = urldecode($filtercamat);
			$filtercamat = html_entity_decode($filtercamat);
			$filtercamat = " and kecamatan = '$filtercamat' ";
		}
		
		$query = "	select distinct kelurahan VALUE, kelurahan TEXT from mst_postalcode
					where 1=1 
					$search	
					$filtercamat 
					order by kelurahan asc ";
		
		return $this->db->query($query);
	}
	
	//autocomplete style
	//TODO FIX Security Problem
	public function getCompanyList($search = '',$branch_id = ''){
		
		if(strlen($search) > 0){
			$search = "and upper(a.name) like upper('%$search%') and b.branch_id = '$branch_id'";
		}
		// VALUE required for typeahead
		$query = " select a.name, a.address, a.npwp, a.customer_id, a.name VALUE
					from mst_customer a 
					left join mst_customer_billing_account b on b.customer_id=a.customer_id 
					where 1=1 
					$search	";
		
		return $this->db->query($query);
	}


	public function getUserGroupList($search = ''){
		// VALUE required for typeahead
		$query = " select id_group VALUE, name_group TEXT, enabled 
					from mst_group
					order by group_order";
		
		return $this->db->query($query);	
	}

	public function getTerminalList($search = ''){
		// VALUE required for typeahead
		$query = " select id_sub_group VALUE, terminal_name TEXT, active ENABLED 
					from mst_terminal
					order by terminal_order";
		
		return $this->db->query($query);	
	}
	
	public function getBranchList($search = ''){
		// VALUE required for typeahead
		$query = " select id_sub_group VALUE, terminal_name TEXT, active ENABLED 
					from mst_terminal
					order by terminal_order";
		
		return $this->db->query($query);	
	}	
	
	private $default_language = 'ID';
	

		
}?>