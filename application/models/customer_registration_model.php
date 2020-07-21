<?php
class Customer_registration_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}
	
	public function getAccess()
	{
		$user_group = $this->session->userdata('group_phd');
		if($user_group=="8"||$user_group=="p"||$user_group=="1")
			return "_t";//access temporary field
		else if($user_group=="a")
			return "";//access main field
		else 
			return "_t";
	}
	
	// CUSTOMER MASTER DATA GENERATED CUSTOMER ID
	public function get_new_customer_id(){
		$query = "select customer_id_manager.get_new_id() customer_id from dual";
		return $this->db->query($query)->row_array();
	}
	
	public function update_activation($params, $id){
		$t = $this->getAccess();
		$id = $params['CUSTOMER_ID'];
		$query 	= "delete from mst_customer_activation where customer_id = $id";
		return $this->db->query($query);
	}
	
	public function create_customer($params,$id=""){
		
		
		if($id=="")
		{
			if ($params['REG_TYPE'] == 'NEW'){
				$id = " customer_id_manager.get_new_id_new_format('".$this->session->userdata('registrationcompanyid_phd')."') ";
			}
			else{
				$id = "'".$params['CUSTOMER_ID']."'";
			}
		}
		else
		{
			$id = "'$id'";
		}
		//var_dump($id); die;

		array_shift($params);// remove customer_id, param length -1
		
		//note : city_type not inserted
		$query	= "insert into mst_customer(
						customer_id_t,
						name_t, address_t, citizenship_t, npwp_t, passport_t, email_t, website_t, 
						phone_t, company_type_t, is_mitra_t, is_customer_t, alt_name_t, deed_establishment_t,
						customer_group_t, svc_vessel_t, svc_cargo_t,
						svc_container_t, svc_misc_t, is_subsidiary_t, holding_name_t,
						employee_count_t, is_main_branch_t, 
						partnership_date_t,
						province_t, city_t, kecamatan_t, kelurahan_t, postal_code_t,
						fax_t, parent_id_t, is_shipping_line_t, is_shipping_agent_t,
						is_pbm_t,is_ff_t,is_emkl_t,is_ppjk_t,is_consignee_t,is_rupa_t,
						create_by_t, create_date_t, create_via_t, create_ip_t,
						reg_type_t, headquarters_id_t, headquarters_name_t, ACCEPTANCE_DOC_T, ACCEPTANCE_DOC_DATE_T,registration_company_id_t 
					)
					values (
						$id,
						?, ?, ?, ?, ?, ?, ?, 
						?, ?, ?, ?, ?, to_date(?,'dd-mm-yyyy'), 
						?, ?, ?, 
						?, ?, ?, ?,
						?, ?, 
						to_date(?,'yyyy'),
						?, ?, ?, ?, ?,
						?, ?, ?, ?,  
						?, ?, ?, ?, ?,?,
						?, SYSDATE, ?, ?,
						?, ?, ?, ?, to_date(?,'dd-mm-yyyy'), ? 
					)";
		
		return $this->db->query($query, $params);			
	}

	public function create_activation($params,$id){
		//var_dump($id); die;
		
		if($id=="")
		{
			if ($params['REG_TYPE'] == 'NEW'){
				$id = " customer_id_manager.get_new_id_new_format('".$this->session->userdata('registrationcompanyid_phd')."') ";
			}
			else{
				$id = "'".$params['CUSTOMER_ID']."'";
			}
		}
		else
		{
			$id = "'$id'";
		}
				

		array_shift($params);// remove customer_id, param length -1
		$USER = $params['USER_ID'];
		//$EXPIRED = $params['EXPIRED_DATE'];
		//$date_activation = $params['ACTIVATION_DATE'];
		$date_expired = $params['EXPIRED_DATE'];
		//$masa_berlaku = $params['MASA_BERLAKU'];
		//print_r($masa_berlaku);die();
		//exit();
		//note : city_type not inserted
		$query	= "insert into mst_customer_activation(
						customer_id,
						customer_name, branch_id, customer_type, npwp,
						alasan, activation_date, expired_date, masa_berlaku, user_id
					)
					values (
						$id,
						?, ?, ?, ?, 
						?, SYSDATE, to_date('$date_expired','dd-mm-yyyy'), 'AKTIF','$USER'
					)";
		

		//var_dump($params); 
		//echo '<br>';
		// echo $query;
		// die;
		return	$this->db->query($query, $params);			
	}

	public function create_deactivation($params,$id){
		
		
		if($id=="")
		{
			if ($params['REG_TYPE'] == 'NEW'){
				$id = " customer_id_manager.get_new_id_new_format('".$this->session->userdata('registrationcompanyid_phd')."') ";
			}
			else{
				$id = "'".$params['CUSTOMER_ID']."'";
			}
		}
		else
		{
			$id = "'$id'";
		}
				

		array_shift($params);
		//var_dump($params); die;
		$query	= "insert into mst_customer_deactivation(
						customer_id,
						customer_name, branch_id, customer_type, npwp,
						deactivation_date, user_id, alasan 
					)
					values (
						$id,
						?, ?, ?, ?, 
						SYSDATE, ?, ?
					)";
		//print_r($query); die();
		return	$this->db->query($query, $params);			
	}
	
	
	public function find_customer_id($params){
		
		$t = $this->getAccess();
		
		$query = "select customer_id$t customer_id from mst_customer where 
						name$t = ? 
					and address$t = ?
					and (npwp$t = ? or npwp$t is null)
					and (passport$t = ? or passport$t is null)
					and email$t = ?
					and (postal_code$t = ? or postal_code$t is null)
					and reg_type$t = ? order by create_date_t desc";
		
		$result = $this->db->query($query, $params);
		
		if($result->num_rows() > 0){
			$row = $result->row_array();
			return $row['CUSTOMER_ID'];
		}
		else{
			return false;	
		}
		
	}
	
	public function find_customer($param,$org_id){
		$t = $this->getAccess();
		
		$branch_id = $this->get_branch_id_by_registration_company_id($org_id);
		
		// $query = "select a.name name,b.billing_customer_id customer_id from mst_customer a left join mst_customer_billing_account b on a.customer_id = b.customer_id 
							// where (name like '%$param%' or a.customer_id like '%$param%' or b.billing_customer_id like '%$param%') and b.branch_id = '$branch_id'";
		$query = "select a.name name,b.billing_customer_id customer_id from mst_customer a left join mst_customer_billing_account b on a.customer_id = b.customer_id 
							where (name like '%$param%' or a.customer_id like '%$param%' or b.billing_customer_id like '%$param%') and b.branch_id = '$branch_id'";

		$result = $this->db->query($query);
	
		return $result->result();
	}
    
    public function find_customer_withlabel($param){
		$t = $this->getAccess();
		
		$query = "select name$t label,customer_id$t value from mst_customer where name$t like '%$param%' or customer_id$t like '%$param%'";
		
		$result = $this->db->query($query);
	
		return $result->result();
	}

	public function get_customer_name_for_breadcrumbs($customer_id){
		$t = $this->getAccess();
		$query 	= "select 
						name$t name 
					from mst_customer
					where customer_id$t = ?";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$result = $result->row_array();
			return "&nbsp&nbsp&nbsp&nbsp<font color=\"green\">(".$result['NAME'].")</font>";
		}
		else{
			return "Baru";	
		}
	}	
	
	public function get_branch_id_by_registration_company_id($org_id=""){
		
		if($org_id=="")
			$org_id = $this->session->userdata('registrationcompanyid_phd');
		
		$query 	= "select branch_id from MST_HR_OPERATING_UNITS where organization_id = ?";
		$result	= $this->db->query($query,array($org_id));
		// print_r($this->db);die();
		$row	= $result->row_array();
		if($result->num_rows()){
			return $row['BRANCH_ID'];
		}
	}
	
	public function get_all_branch_id_by_registration_company_id($org_id="",$branch_id=""){
		
		if($org_id=="")
			$org_id = $this->session->userdata('registrationcompanyid_phd');
		
		$query 	= "select count(branch_id) jumlah from MST_HR_OPERATING_UNITS where organization_id = ? and branch_id = ?";
		$result	= $this->db->query($query,array($org_id,$branch_id));
		$row	= $result->row_array();
		return $row['JUMLAH'];
	}	
	
	public function get_org_id_by_branch_id($branch_id,$enable_only=false){
		if($enable_only)
		{
			$search = " and enabled_gui = 'Y'";
		}
		
		$query 	= "select organization_id from MST_HR_OPERATING_UNITS where branch_id = ? $search";
		$result	= $this->db->query($query,array($branch_id));
		$row	= $result->row_array();

		return $row['ORGANIZATION_ID'];
	}	
	
	public function read_customer($customer_id){
		$t = $this->getAccess();
		$query 	= "select 
						customer_id$t customer_id,
						a.name$t name, address$t address, citizenship$t citizenship,npwp$t npwp, passport$t passport, email$t email, website$t website, 
						phone$t phone, company_type$t company_type, is_mitra$t is_mitra, is_customer$t is_customer, alt_name$t alt_name, to_char(deed_establishment$t, 'dd-mm-yyyy') deed_establishment,
						customer_group$t customer_group, svc_vessel$t svc_vessel, svc_cargo$t svc_cargo,
						svc_container$t svc_container, svc_misc$t svc_misc, is_subsidiary$t is_subsidiary, holding_name$t holding_name,
						employee_count$t employee_count, is_main_branch$t is_main_branch,  
						to_char(partnership_date$t, 'yyyy') partnership_date,
						customer_type$t customer_type, 
						province$t province, city$t city, kecamatan$t kecamatan, kelurahan$t kelurahan, postal_code$t postal_code,
						fax$t fax, parent_id$t parent_id, is_shipping_agent$t is_shipping_agent, is_shipping_line$t is_shipping_line,
						is_pbm$t is_pbm,is_ff$t is_ff,is_emkl$t is_emkl,is_ppjk$t is_ppjk,is_consignee$t is_consignee,is_rupa$t is_rupa,
						reg_type$t reg_type, headquarters_id$t headquarters_id, headquarters_name$t headquarters_name,
						ACCEPTANCE_DOC$t ACCEPTANCE_DOC, to_char(ACCEPTANCE_DOC_DATE$t, 'dd-mm-yyyy') ACCEPTANCE_DOC_DATE,
						REGISTRATION_COMPANY_ID$t REGISTRATION_COMPANY_ID, b.name NAMA_CABANG 
					from mst_customer a left join MST_HR_OPERATING_UNITS b on b.ORGANIZATION_ID = a.REGISTRATION_COMPANY_ID$t 
					where customer_id$t = ?";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			return $result->row_array();
		}
		else{
			return "";	
		}
	}

	public function update_customer($params){
		$t = $this->getAccess();
		
		if($params["ACCEPTANCE_DOC"]=="")
		{
			unset($params["ACCEPTANCE_DOC"]);
			$update_doc = "";
		}
		else
		{
			$update_doc = "ACCEPTANCE_DOC$t = ?,";
		}
		
		//var_dump($params); die;
		
		$query	= "update mst_customer set 
						name$t		= ?, 
						address$t		= ?, 
						citizenship$t		= ?, 
						npwp$t		= ?, 
						passport$t		= ?, 
						email$t		= ?, 
						website$t		= ?, 
						phone$t		= ?,
						company_type$t	= ?,
						is_mitra$t = ?,
						is_customer$t = ? ,
						reg_type$t = ?,
						alt_name$t		= ?,
						deed_establishment$t	= to_date(?,'dd-mm-yyyy'),
						customer_group$t		= ?,
						svc_vessel$t		= ?,
						svc_cargo$t		= ?,
						svc_container$t	= ?, 
						svc_misc$t		= ?, 
						is_subsidiary$t	= ?, 
						holding_name$t	= ?,
						employee_count$t		= ?, 
						is_main_branch$t		= ?, 
						partnership_date$t	= to_date(?, 'yyyy'),
						province$t	= ?, 
						city$t		= ?, 
						kecamatan$t	= ?, 
						kelurahan$t	= ?, 
						postal_code$t	= ?,
						fax$t			= ?, 
						parent_id$t	= ?, 
						is_shipping_line$t 	= ?,
						is_shipping_agent$t 	= ?,
						is_PBM$t 	= ?,
						is_FF$t 	= ?,
						is_EMKL$t 	= ?,
						is_PPJK$t 	= ?,
						is_CONSIGNEE$t 	= ?,
						is_RUPA$t = ?,
						edit_by$t	= ?, 
						edit_date$t	= SYSDATE, 
						edit_via$t	= ?, 
						edit_ip$t	= ?,
						headquarters_id$t	= ?,
						headquarters_name$t	= ?,
						$update_doc
						ACCEPTANCE_DOC_DATE$t = to_date(?,'dd-mm-yyyy') 
					where customer_id$t = ?";

		return	$this->db->query($query, $params);			
	}

	public function delete_customer($customer_id){
		
		$query 	= "delete from mst_customer where customer_id = ?";
		
		return $this->db->query($query,array($customer_id));
	}
	
	public function get_branch_sign_by_branch_id($customer_id,$branch_id){
		
		$query	= "SELECT count(1) counter from mst_customer where customer_id = '$customer_id' and branch_sign like '%$branch_id%'";
		$result	= $this->db->query($query);
		$row	= $result->row_array();

		return $row['COUNTER'];
	}		
	
	public function get_count_billing_by_branch_id($billing_id,$branch_id){
		
		$query	= "SELECT count(1) counter from mst_customer_billing_account where billing_id = '$billing_id' and branch_id_t like '%$branch_id%'";
		$result	= $this->db->query($query);
		$row	= $result->row_array();

		return $row['COUNTER'];
	}		
	
	public function get_branch_sign($customer_id){
		
		$query	= "SELECT branch_sign from mst_customer where customer_id = ?";
		$result	= $this->db->query($query,array($customer_id));
		$row	= $result->row_array();

		return $row['BRANCH_SIGN'];
	}	
	
	// TODO : FIX SECURITY ISSUE
	public function view_list($type='',$search, $limit, $offset, $order, $sort, $registration_company_id="", $jenis_pelanggan="",$service_type="",$status_approval='', $status_customer='',$lokasi_pelanggan='',$cfs=''){
		$t = $this->getAccess();
		
		if( in_array(	strtoupper($order), 
						array('NAME','ADDRESS','NPWP','EMAIL','WEBSITE','PHONE','CUSTOMER_ID')
					) ){
			$order = " order by $order_t $sort_t ";
		}
		else{
			$order = " order by CASE
						WHEN status_approval = 'N' THEN 1
						WHEN status_approval = 'W' THEN 2
						WHEN status_approval = 'P' THEN 3
						WHEN status_approval = 'A' THEN 4
						WHEN status_approval = 'R' THEN 5 
					END";
		}

		if(strlen($search)>0){
			$search = " where (upper(a.name_t) like upper('%$search%') 
						or upper(a.address_t) like upper('%$search%')
						or upper(a.npwp_t) like upper('%$search%')
						or upper(a.customer_id_t) like upper('%$search%')
						or upper(a.npwp_t) like upper('%$search%'))
						";	
		}
		
		if($status_approval!="")
		{
			$q_sa =" status_approval = '$status_approval'";
			
			if(strlen($search)>0)
				$search .= " and $q_sa";
			else
				$search = "where $q_sa";			
		}		
		
		if($status_customer!="")
		{
			$q_sc =" status_customer = '$status_customer'";
			
			if(strlen($search)>0)
				$search .= " and $q_sc";
			else
				$search = "where $q_sc";			
		}
		
		if($lokasi_pelanggan!="")
		{
			$branch_id = $this->get_branch_id_by_registration_company_id($lokasi_pelanggan);
			$q_sc =" (registration_company_id_t = '$lokasi_pelanggan'  or branch_sign like '%$branch_id%')";
			
			if(strlen($search)>0)
				$search .= " and $q_sc";
			else
				$search = "where $q_sc";			
		}

		if($cfs=="CFS")
		{
			$q_cfs =" e.cfs$t = 'Y'";
			
			if(strlen($search)>0)
				$search .= " and $q_cfs";
			else
				$search = "where $q_cfs";			
		}
		
		if($jenis_pelanggan!="")
		{
			if(strtoupper($jenis_pelanggan)=="EMKL")
			{
				$q_jp =" is_emkl_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="SHIPA")
			{
				$q_jp =" is_shipping_agent_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="CONSG")
			{
				$q_jp =" is_consignee_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="STVCO")
			{
				$q_jp =" is_pbm_t = 'Y'";
			}			
			else if(strtoupper($jenis_pelanggan)=="PPJK")
			{
				$q_jp =" is_ppjk_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="RUPA")
			{
				$q_jp =" is_Rupa_t = 'Y'";
			}

			if(strlen($search)>0)
				$search .= " and $q_jp";
			else
				$search = "where $q_jp";
		}		
		
		if($service_type!="")
		{
			if(strtoupper($service_type)=="VESSE")
			{
				$q_st =" SVC_VESSEL_t = 'Y'";
			}
			else if(strtoupper($service_type)=="CONGC")
			{
				$q_st =" (svc_cargo_t = 'Y' or SVC_CONTAINER_t = 'Y')";
			}
			else if(strtoupper($service_type)=="MISC")
			{
				$q_st =" svc_misc_t = 'Y'";
			}
			
			if(strlen($search)>0)
				$search .= " and $q_st";
			else
				$search = "where $q_st";
		}
		
		if($registration_company_id!="")
		{
			$branch_id = $this->get_branch_id_by_registration_company_id($registration_company_id);
			$q_reg = " (registration_company_id_t in (select b.organization_id from MST_HR_OPERATING_UNITS a inner join  MST_HR_OPERATING_UNITS b on a.BRANCH_ID = b.branch_id 
    where a.organization_id = '$registration_company_id') 
						or branch_sign like '%$branch_id%')";
			
		}
		else
			$q_reg = "1=1";

		if(strlen($search)>0)
			$search .= " and $q_reg";
		else
			$search = "where $q_reg";
		
		if(strlen($search)>0)
			$search .= " and a.customer_id_t is not null";
		else
			$search = "where a.customer_id_t is not null";
		
		if($type=="info")
		{
			$query	= "select startnum, endnum, (select count(1) total from mst_customer a left join mst_customer_billing_account e on e.customer_id$t = a.customer_id$t $search ) total from
						(    
							select nvl(min(numrow),0) startnum, nvl(max(numrow),0) endnum
											from 
												(	select 	rownum numrow, 
														CASE 
														WHEN NVL(EDIT_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) > NVL(CREATE_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) THEN EDIT_DATE$t
														WHEN NVL(EDIT_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) < NVL(CREATE_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) THEN CREATE_DATE$t 
														END DATE_ORDER
														from mst_customer a 
														left join mst_customer_billing_account e on e.customer_id$t = a.customer_id$t 
													$search 
													$order 
												)
											where numrow > $offset and numrow <= " . ($limit+$offset) . "
						) ";
			
			//echo $query; die;
			return $this->db->query($query)->row_array();;			
		}
		else
		{
			$query	= "select * from
								(	select 	
									row_number() over ($order) numrow, 
									row_number() over (partition by a.customer_id_t order by a.customer_id_t) numrow2, 
									CASE 
									  WHEN NVL(EDIT_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) > NVL(CREATE_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) THEN EDIT_DATE$t
									  WHEN NVL(EDIT_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) < NVL(CREATE_DATE$t,TO_DATE('01-01-1990','dd-mm-yyyy')) THEN CREATE_DATE$t 
									END DATE_ORDER,
									a.customer_id_seq, 
									nvl(a.customer_id,a.customer_id_t) customer_id,
									nvl(a.name,a.name_t) name,
									a.is_shipping_agent_t is_shipping_agent,
									a.is_emkl_t is_emkl,
									a.is_consignee_t is_consignee,
									a.is_pbm_t is_pbm,
									a.is_rupa_t is_rupa,
									a.status_approval,
									a.type_approval,
									a.status_customer,
									a.reject_notes,
									a.registration_company_id_t registration_company_id,
									a.npwp_t npwp,
									a.address$t address,
									a.kelurahan$t kelurahan,
									a.kecamatan$t kecamatan,
									a.city$t city,
									a.province$t province,
									a.postal_code$t postal_code,
									a.email$t email,
									a.phone$t phone,
									c.name_ceo$t name_ceo,
									c.handphone_ceo$t handphone_ceo,
									c.email_ceo$t email_ceo,
									d.name_pic$t name_pic,
									d.email_pic$t email_pic,
									d.handphone_pic$t handphone_pic,
									b.name cabang_pendaftaran 
									from mst_customer a 
									left join mst_customer_ceo c on c.customer_id_t = a.customer_id_t 
									left join mst_customer_pic d on d.customer_id_t = a.customer_id_t 
									left join MST_HR_OPERATING_UNITS b on a.registration_company_id_t = b.organization_id 
									left join mst_customer_billing_account e on e.customer_id$t = a.customer_id$t 
									$search  
								) abc where to_number(numrow) > $offset and to_number(numrow) <= " . ($limit+$offset) . "and numrow2 = '1'";
			
			//echo $query; die;
			return $this->db->query($query);
		}
	}
		

	public function view_list_aktivasi($type='',$search, $limit, $offset, $order, $sort, $registration_company_id="", $jenis_pelanggan="",$service_type="",$status_approval='', $status_customer='',$lokasi_pelanggan='',$cfs=''){
		$t = $this->getAccess();
		
		if( in_array(	strtoupper($order), 
						array('NAME','ADDRESS','NPWP','EMAIL','WEBSITE','PHONE','CUSTOMER_ID')
					) ){
			$order = " order by $order_t $sort_t ";
		}
		else{
			$order = " order by CASE
						WHEN status_approval = 'N' THEN 1
						WHEN status_approval = 'W' THEN 2
						WHEN status_approval = 'P' THEN 3
						WHEN status_approval = 'A' THEN 4
						WHEN status_approval = 'R' THEN 5 
					END";
		}

		if(strlen($search)>0){
			$search = " where (upper(a.name_t) like upper('%$search%') 
						or upper(a.address_t) like upper('%$search%')
						or upper(a.npwp_t) like upper('%$search%')
						or upper(a.customer_id_t) like upper('%$search%')
						or upper(a.npwp_t) like upper('%$search%'))
						";	
		}
		
		if($status_approval!="")
		{
			$q_sa =" status_approval = '$status_approval'";
			
			if(strlen($search)>0)
				$search .= " and $q_sa";
			else
				$search = "where $q_sa";			
		}		
		
		if($status_customer!="")
		{
			$q_sc =" status_customer = '$status_customer'";
			
			if(strlen($search)>0)
				$search .= " and $q_sc";
			else
				$search = "where $q_sc";			
		}
		
		if($lokasi_pelanggan!="")
		{
			$branch_id = $this->get_branch_id_by_registration_company_id($lokasi_pelanggan);
			$q_sc =" (registration_company_id_t = '$lokasi_pelanggan'  or branch_sign like '%$branch_id%')";
			
			if(strlen($search)>0)
				$search .= " and $q_sc";
			else
				$search = "where $q_sc";			
		}

		if($cfs=="CFS")
		{
			$q_cfs =" e.cfs$t = 'Y'";
			
			if(strlen($search)>0)
				$search .= " and $q_cfs";
			else
				$search = "where $q_cfs";			
		}
		
		if($jenis_pelanggan!="")
		{
			if(strtoupper($jenis_pelanggan)=="EMKL")
			{
				$q_jp =" is_emkl_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="SHIPA")
			{
				$q_jp =" is_shipping_agent_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="CONSG")
			{
				$q_jp =" is_consignee_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="STVCO")
			{
				$q_jp =" is_pbm_t = 'Y'";
			}			
			else if(strtoupper($jenis_pelanggan)=="PPJK")
			{
				$q_jp =" is_ppjk_t = 'Y'";
			}
			
			if(strlen($search)>0)
				$search .= " and $q_jp";
			else
				$search = "where $q_jp";
		}		
		
		if($service_type!="")
		{
			if(strtoupper($service_type)=="VESSE")
			{
				$q_st =" SVC_VESSEL_t = 'Y'";
			}
			else if(strtoupper($service_type)=="CONGC")
			{
				$q_st =" (svc_cargo_t = 'Y' or SVC_CONTAINER_t = 'Y')";
			}
			else if(strtoupper($service_type)=="MISC")
			{
				$q_st =" svc_misc_t = 'Y'";
			}
			
			if(strlen($search)>0)
				$search .= " and $q_st";
			else
				$search = "where $q_st";
		}
		
		if($registration_company_id!="")
		{
			$branch_id = $this->get_branch_id_by_registration_company_id($registration_company_id);
			$q_reg = " (registration_company_id_t='$registration_company_id' or branch_sign like '%$branch_id%')";
			
		}
		else
			$q_reg = "1=1";

		if(strlen($search)>0)
			$search .= " and $q_reg";
		else
			$search = "where $q_reg";
		
		if(strlen($search)>0)
			$search .= " and a.customer_id_t is not null";
		else
			$search = "where a.customer_id_t is not null";
		
		if($type=="info")
		{	
			$query	= "select startnum, endnum, 
       						(select count(1) total from mst_customer_activation a 
            				left join mst_customer_billing_account e on e.customer_id_t = a.customer_id
            				where 1=1 and a.customer_id is not null ) total 
            				from ( select nvl(min(numrow),0) startnum, nvl(max(numrow),0) endnum 
            				from (   select rownum numrow from mst_customer_activation a 
            				left join mst_customer_billing_account e on e.customer_id_t = a.customer_id where 1=1 and a.pelanggan_aktif = '1' and a.customer_id is not null ) 
            		   where numrow > 0 and numrow <= 10) ";
            //echo $query; die;
			return $this->db->query($query)->row_array();			
		}
		else
		{
			$query	= "select * from mst_customer_activation where pelanggan_aktif = '1' and expired_date is not null";
			//echo $query; die;
			return $this->db->query($query);
		}
	}
	
	public function view_list_deaktivasi($type='',$search, $limit, $offset, $order, $sort, $registration_company_id="", $jenis_pelanggan="",$service_type="",$status_approval='', $status_customer='',$lokasi_pelanggan='',$cfs=''){
		$t = $this->getAccess();
		
		if( in_array(	strtoupper($order), 
						array('NAME','ADDRESS','NPWP','EMAIL','WEBSITE','PHONE','CUSTOMER_ID')
					) ){
			$order = " order by $order_t $sort_t ";
		}
		else{
			$order = " order by CASE
						WHEN status_approval = 'N' THEN 1
						WHEN status_approval = 'W' THEN 2
						WHEN status_approval = 'P' THEN 3
						WHEN status_approval = 'A' THEN 4
						WHEN status_approval = 'R' THEN 5 
					END";
		}

		if(strlen($search)>0){
			$search = " where (upper(a.name_t) like upper('%$search%') 
						or upper(a.address_t) like upper('%$search%')
						or upper(a.npwp_t) like upper('%$search%')
						or upper(a.customer_id_t) like upper('%$search%')
						or upper(a.npwp_t) like upper('%$search%'))
						";	
		}
		
		if($status_approval!="")
		{
			$q_sa =" status_approval = '$status_approval'";
			
			if(strlen($search)>0)
				$search .= " and $q_sa";
			else
				$search = "where $q_sa";			
		}		
		
		if($status_customer!="")
		{
			$q_sc =" status_customer = '$status_customer'";
			
			if(strlen($search)>0)
				$search .= " and $q_sc";
			else
				$search = "where $q_sc";			
		}
		
		if($lokasi_pelanggan!="")
		{
			$branch_id = $this->get_branch_id_by_registration_company_id($lokasi_pelanggan);
			$q_sc =" (registration_company_id_t = '$lokasi_pelanggan'  or branch_sign like '%$branch_id%')";
			
			if(strlen($search)>0)
				$search .= " and $q_sc";
			else
				$search = "where $q_sc";			
		}

		if($cfs=="CFS")
		{
			$q_cfs =" e.cfs$t = 'Y'";
			
			if(strlen($search)>0)
				$search .= " and $q_cfs";
			else
				$search = "where $q_cfs";			
		}
		
		if($jenis_pelanggan!="")
		{
			if(strtoupper($jenis_pelanggan)=="EMKL")
			{
				$q_jp =" is_emkl_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="SHIPA")
			{
				$q_jp =" is_shipping_agent_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="CONSG")
			{
				$q_jp =" is_consignee_t = 'Y'";
			}
			else if(strtoupper($jenis_pelanggan)=="STVCO")
			{
				$q_jp =" is_pbm_t = 'Y'";
			}			
			else if(strtoupper($jenis_pelanggan)=="PPJK")
			{
				$q_jp =" is_ppjk_t = 'Y'";
			}
			
			if(strlen($search)>0)
				$search .= " and $q_jp";
			else
				$search = "where $q_jp";
		}		
		
		if($service_type!="")
		{
			if(strtoupper($service_type)=="VESSE")
			{
				$q_st =" SVC_VESSEL_t = 'Y'";
			}
			else if(strtoupper($service_type)=="CONGC")
			{
				$q_st =" (svc_cargo_t = 'Y' or SVC_CONTAINER_t = 'Y')";
			}
			else if(strtoupper($service_type)=="MISC")
			{
				$q_st =" svc_misc_t = 'Y'";
			}
			
			if(strlen($search)>0)
				$search .= " and $q_st";
			else
				$search = "where $q_st";
		}
		
		if($registration_company_id!="")
		{
			$branch_id = $this->get_branch_id_by_registration_company_id($registration_company_id);
			$q_reg = " (registration_company_id_t='$registration_company_id' or branch_sign like '%$branch_id%')";
			
		}
		else
			$q_reg = "1=1";

		if(strlen($search)>0)
			$search .= " and $q_reg";
		else
			$search = "where $q_reg";
		
		if(strlen($search)>0)
			$search .= " and a.customer_id_t is not null";
		else
			$search = "where a.customer_id_t is not null";
		
		if($type=="info")
		{
			$query	= "select startnum, endnum, 
       						(select count(1) total from mst_customer_deactivation a 
            				left join mst_customer_billing_account e on e.customer_id_t = a.customer_id
            				where 1=1 and a.customer_id is not null ) total 
            				from ( select nvl(min(numrow),0) startnum, nvl(max(numrow),0) endnum 
            				from (   select rownum numrow from mst_customer_deactivation a 
            				left join mst_customer_billing_account e on e.customer_id_t = a.customer_id where 1=1 and a.customer_id is not null ) 
            		   where numrow > 0 and numrow <= 10) ";

			return $this->db->query($query)->row_array();;			
		}
		else
		{
			$query	= "select * from mst_customer_deactivation";
			//echo $query; die;
			return $this->db->query($query);
		}
	}
	
	public function count_NPWP($npwp){
		
		$query	= "SELECT count(1) counter from mst_customer where npwp = ?";
		$result	= $this->db->query($query,array($npwp));
		$row	= $result->row_array();

		return $row['COUNTER'];
	}
	
	//==============================================================================
	// BILLING
	
	public function view_list_billing($customer_id){
		$t = $this->getAccess();
		
		$query	= "select 
						a.billing_id,
						a.address_billing$t address_billing,
						b.name branch,
						a.branch_id$t branch_id,
						a.phone_billing$t phone_billing,
						a.email_billing$t email_billing, 
						a.billing_customer_id$t billing_customer_id, 
						case   
							when (select count(1) from mst_customer_bank_account where billing_id$t = a.billing_id) > 0 then '1' 
							else '0'
						end BANK,
						case
							when (select count(1) from mst_customer_account_manager where billing_id$t = a.billing_id) > 0 then '1' 
							else '0'
						end AM
					from mst_customer_billing_account a left join mst_hr_operating_units b 
					on a.branch_id$t = b.branch_id 
					where customer_id$t = ? and b.displayed_gui is not null";

		return $this->db->query($query, array($customer_id));
	}	
	
	public function get_count_billing_account_by_org_id($customer_id,$org_id){
		$t = $this->getAccess();
		
		$query	= "SELECT count(1) counter from mst_customer_billing_account where customer_id$t = ? and branch_id$t in (select branch_id from mst_hr_operating_units where organization_id = ? and branch_id is not null)";
		$result	= $this->db->query($query,array($customer_id,$org_id));
		$row	= $result->row_array();

		return $row['COUNTER'];
	}
	
	public function get_count_branch_id_by_org_id($org_id){
		$t = $this->getAccess();
		
		$query	= "SELECT count(1) counter from mst_hr_operating_units where organization_id = ? and branch_id is not null";
		$result	= $this->db->query($query,array($org_id));
		$row	= $result->row_array();

		return $row['COUNTER'];
	}		
		
	public function get_hq_customer_id($customer_id){
		$query = "select customer_id 
						from mst_customer_billing_account
						where customer_id = ? and is_main_branch = 'Y'
					union
					select customer_id
						from mst_customer
						where customer_id = ?";
		
		return $this->db->query($query, array($customer_id, $customer_id));
	}
	
	public function get_new_billing_id(){
		
		$query = "select mst_customer_billing_seq.nextval billing_id from dual";
		
		return $this->db->query($query)->row_array();
	}
	
	public function create_billing_account($params){
		$t = $this->getAccess();
		/*if ($params['REG_TYPE_BILLING'] == 'NEW' && $params['IS_MAIN_BRANCH'] == 'N'){
			$bc_id = " customer_id_manager.get_new_id() ";
		}
		else{
			$bc_id = ' ? ';
		}*/
		$bc_id = ' ? ';
		
		$query = "insert into mst_customer_billing_account(
						billing_id,
						customer_id$t,
						address_billing$t, province_billing$t, city_billing$t, kecamatan_billing$t, 
						kelurahan_billing$t, postal_code_billing$t, phone_billing$t, email_billing$t,
						hq_id$t, branch_id$t, billing_customer_id$t, is_main_branch$t, reg_type_billing$t, cfs$t 
					)
					values(
						?,
						?,
						?, ?, ?, ?,
						?, ?, ?, ?,
						?, ?, $bc_id, ?, ?, ? 
					)";
					
		return $this->db->query($query, $params);
	}
	
	// for updating just inserted main branch
	public function update_hq($billing_customer_id){
		
		$query = "update mst_customer_billing_account
					set 
						hq_id = (select billing_id from mst_customer_billing_account where billing_customer_id = ? )
					where billing_customer_id = ?
				";
		return $this->db->query($query, array($billing_customer_id, $billing_customer_id));		
	}
	
	//
	public function get_hq_id($customer_id){
		$t = $this->getAccess();
		$query = "select nvl(billing_id,'') hq_id 
					from mst_customer_billing_account 
					where customer_id$t = ? 
					and billing_id is not null
					and is_main_branch$t = 'Y'";

		return $this->db->query($query, array($customer_id));		
	}
	
	public function sync_hq($customer_id){
		//updates all billing ids with the same customer_id as arg 
		//with new hq_id, new customer_id
		//this is called for example if the current main branch is deleted  
		//and then a new main branch is inserted
		//TODO CODE...
	}
	
	public function read_billing_account($billing_id){
		$t = $this->getAccess();
		$query = "select 
						billing_id, customer_id$t customer_id,
						address_billing$t address_billing, province_billing$t province_billing, city_billing$t city_billing, kecamatan_billing$t kecamatan_billing, 
						kelurahan_billing$t kelurahan_billing, postal_code_billing$t postal_code_billing, phone_billing$t phone_billing, email_billing$t email_billing,
						hq_id$t hq_id, branch_id$t branch_id, billing_customer_id$t billing_customer_id, is_main_branch$t is_main_branch, reg_type_billing$t reg_type_billing,
						cfs$t cfs 
					from mst_customer_billing_account
					where billing_id = ?";
		
		return $this->db->query($query, array($billing_id))->row_array();
	}
	
	public function delete_billing_account($billing_id){
		$this->db->trans_start();			
		$t = $this->getAccess();
		$query	= "update mst_customer_billing_account set 
						customer_id$t 		='',
						address_billing$t		='', 
						province_billing$t	='', 
						city_billing$t		='', 
						kecamatan_billing$t	='', 
						kelurahan_billing$t	='', 
						postal_code_billing$t	='', 
						phone_billing$t		='',
						email_billing$t		='',
						hq_id$t				='', 
						branch_id$t			='', 
						billing_customer_id$t	='', 
						is_main_branch$t		='',
						reg_type_billing$t = '' 
					where billing_id = ?";
			$this->db->query($query, array($billing_id));
			
			$query = "update mst_customer_billing_site set 
								billing_id$t = '',
								site_id$t = '' 
						where billing_id_t = ?";
			$this->db->query($query, array($billing_id));
			
		$query	= "update mst_customer_account_manager set 
						billing_id$t		= '', 
						title_am$t		= '', 
						name_am$t			= '', 
						address_am$t		= '', 
						province_am$t		= '', 
						city_am$t			= '', 
						city_type_am$t	='',
						kecamatan_am$t	= '',
						kelurahan_am$t	= '',
						postal_code_am$t	= '',
						phone_am$t		= '',
						handphone_am$t	= '',
						email_am$t		= ''
					where billing_id_t = ? ";
			$this->db->query($query, array($billing_id));

		$query 	= "update mst_customer_bank_account set 
						billing_id$t = '', 
						account_no$t = '',
						bank_id$t = '',
						currency$t = '',
						autocollection$t = '',
						cms$t = '',
						saldo_min_cms$t = '',
						branch_id$t = '',
						token_id$t = ''
					where billing_id_t =  ? ";
			$this->db->query($query, array($billing_id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function update_billing_account($params){
		$t = $this->getAccess();
		$query	= "update mst_customer_billing_account set 
						customer_id$t 		=?,
						address_billing$t		=?, 
						province_billing$t	=?, 
						city_billing$t		=?, 
						kecamatan_billing$t	=?, 
						kelurahan_billing$t	=?, 
						postal_code_billing$t	=?, 
						phone_billing$t		=?,
						email_billing$t		=?,
						hq_id$t				=?, 
						branch_id$t			=?, 
						billing_customer_id$t	=?, 
						is_main_branch$t		=?,
						reg_type_billing$t = ?,
						cfs$t = ? 
					where billing_id = ?";
		
		return	$this->db->query($query, $params);
	}

	public function get_sites($billing_id){
		$t = $this->getAccess();
		$query = "select distinct site_id$t site_id from mst_customer_billing_site where billing_id$t = ?";
		return	$this->db->query($query, array($billing_id));
	}
	
	public function get_sites_by_branch_id($branch){
		$query = "select organization_id as site_id from MST_HR_OPERATING_UNITS where simop_branch_id = ?";
		return	$this->db->query($query, array($branch));
	}	
	
	public function update_sites($billing_id, $sites){
		$t = $this->getAccess();
		
		$this->db->trans_start();		
			$query = "delete from mst_customer_billing_site where billing_id$t = ?";
			//echo $query;
			$this->db->query($query, array($billing_id));
			
			$query	= "insert all ";
			$params	= array();
			$ct		= 0;
			foreach ($sites as $site){
				$query .= " into mst_customer_billing_site (billing_id$t, site_id$t) values (?,?) ";
				$params[] = $site['BILLING_ID']; 
				$params[] = $site['SITE_ID'];
				$ct++;
			}
			$query .= " select * from dual";
			
			if ($ct>0){
				$this->db->query($query, $params);
			}
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	//==============================================================================
	// BANK

	public function view_list_bank($billing_id){
		$t = $this->getAccess();
		$query	= "select 
						bank_account_id,
						account_no$t account_no,
						bank_id$t bank_id,
						currency$t currency,
						autocollection$t autocollection,
						autocollection_barang$t autocollection_barang,
						autocollection_bm_barang$t autocollection_bm_barang,
						cms$t cms,
						token_id$t token_id,
						context_text BANK_NAME
					from mst_customer_bank_account bk
					inner join mst_context_options ctx on ctx.context_value = bk.bank_id$t
					where bk.billing_id$t = ?
					and ctx.context_type='BANK'";
		return $this->db->query($query, array($billing_id));
	}
	
	public function view_detail_bank($bank_id){
		$t = $this->getAccess();
		$query	= "select 
						bank_account_id,
						billing_id$t billing_id,
						account_no$t account_no,
						bank_id$t bank_id,
						currency$t currency,
						autocollection$t autocollection,
						autocollection_barang$t autocollection_barang,
						autocollection_bm_barang$t autocollection_bm_barang,
						cms$t cms,
						saldo_min_cms$t saldo_min_cms,
						branch_id$t branch_id, 
						token_id$t token_id
					from mst_customer_bank_account
					where bank_account_id = ?";
		return $this->db->query($query,array($bank_id));
	}
	
	public function create_bank($params){
		$t = $this->getAccess();
		$this->db->trans_start();
		
		if ($params['AUTOCOLLECTION'] == 'Y'){
			$q1 = "update mst_customer_bank_account set
					autocollection$t = 'N'
					where billing_id$t = ?
					and currency$t = ?";
			
			$this->db->query($q1, array($params['BILLING_ID'], $params['CURRENCY']));
		}
		
		if ($params['AUTOCOLLECTION_BARANG'] == 'Y'){
			$q1 = "update mst_customer_bank_account set
					autocollection_barang$t = 'N'
					where billing_id$t = ? 
					and currency$t = ?";
			
			$this->db->query($q1, array($params['BILLING_ID'], $params['CURRENCY']));
		}	

		if ($params['AUTOCOLLECTION_BM_BARANG'] == 'Y'){
			$q1 = "update mst_customer_bank_account set
					autocollection_bm_barang$t = 'N'
					where billing_id$t = ? 
					and currency$t = ?";
			
			$this->db->query($q1, array($params['BILLING_ID'], $params['CURRENCY']));
		}	
		
		$query	= "insert into mst_customer_bank_account(
						billing_id$t, account_no$t, bank_id$t, currency$t, autocollection$t, autocollection_barang$t, autocollection_bm_barang$t, cms$t, saldo_min_cms$t, token_id$t
					)
					values(
						?, ?, ?, ?, ?, ?, ?, ?, ?, ?
					)";
		$this->db->query($query, $params);
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	public function update_bank($params, $billing_id){
		$t = $this->getAccess();
		$this->db->trans_start();
		
		if ($params['AUTOCOLLECTION'] == 'Y'){
			$q1 = "update mst_customer_bank_account set
					autocollection$t = 'N'
					where billing_id$t = ? 
					and currency$t = ?";
			
			$this->db->query($q1, array($billing_id, $params['CURRENCY']));
		}
		
		if ($params['AUTOCOLLECTION_BARANG'] == 'Y'){
			$q1 = "update mst_customer_bank_account set
					autocollection_barang$t = 'N'
					where billing_id$t = ? 
					and currency$t = ?";
			
			$this->db->query($q1, array($billing_id, $params['CURRENCY']));
		}		

		if ($params['AUTOCOLLECTION_BM_BARANG'] == 'Y'){
			$q1 = "update mst_customer_bank_account set
					autocollection_bm_barang$t = 'N'
					where billing_id$t = ? 
					and currency$t = ?";
			
			$this->db->query($q1, array($params['BILLING_ID'], $params['CURRENCY']));
		}	
		
		$query 	= "update mst_customer_bank_account set 
						account_no$t = ?,
						bank_id$t = ?,
						currency$t = ?,
						autocollection$t = ?,
						autocollection_barang$t = ?,
						autocollection_bm_barang$t = ?,
						cms$t = ?,
						saldo_min_cms$t = ?,
						branch_id$t = ?,
						token_id$t = ?
					where bank_account_id = ? ";

		$this->db->query($query, $params);
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	public function delete_bank($bank_account_id){
		$t = $this->getAccess();
		$query 	= "update mst_customer_bank_account set 
						account_no$t = '',
						bank_id$t = '',
						currency$t = '',
						autocollection$t = '',
						autocollection_barang$t = '',
						autocollection_bm_barang$t = '',
						cms$t = '',
						saldo_min_cms$t = '',
						branch_id$t = '',
						token_id$t = ''
					where bank_account_id = ? ";
		
		return $this->db->query($query, array($bank_account_id));
	}
	
	//==============================================================================
	// ACCOUNT MANAGER
	
	public function view_list_am($params){
		$t = $this->getAccess();
		$query	= "select 
						am_id,
						name_am$t name_am,
						title_am$t title_am
					from mst_customer_account_manager
					where billing_id$t =?";

		return $this->db->query($query,$params);
	}	
	
	public function view_list_am_by_customer_id($customer_id){
		$t = $this->getAccess();
		$query	= "select 
						name_am$t name_am,
						title_am$t title_am,
						address_am$t address_am,
						handphone_am$t handphone_am,
						email_am$t email_am
					from mst_customer_account_manager a, mst_customer_billing_account b 
					where a.billing_id=b.billing_id and b.customer_id$t =?";

		return $this->db->query($query,$customer_id);
	}

	public function read_account_manager($am_id){	
		$t = $this->getAccess();
		$query = "select 
						am_id, billing_id$t billing_id, title_am$t title_am, name_am$t name_am, address_am$t address_am, province_am$t province_am, city_am$t city_am, city_type_am$t city_type_am, kecamatan_am$t kecamatan_am, kelurahan_am$t kelurahan_am, postal_code_am$t postal_code_am, phone_am$t phone_am, handphone_am$t handphone_am, email_am$t email_am
					from mst_customer_account_manager
					where am_id = ?";
		return $this->db->query($query, array($am_id))->row_array();
	}
	
	public function create_account_manager($params){
		$t = $this->getAccess();
		$query="insert into MST_CUSTOMER_ACCOUNT_MANAGER (BILLING_ID$t, TITLE_AM$t, NAME_AM$t, ADDRESS_AM$t, PROVINCE_AM$t, CITY_AM$t, CITY_TYPE_AM$t, KECAMATAN_AM$t, KELURAHAN_AM$t, POSTAL_CODE_AM$t, PHONE_AM$t, HANDPHONE_AM$t, EMAIL_AM$t) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		return	$this->db->query($query, $params);	
	}
	
	public function update_account_manager($params){
		$t = $this->getAccess();
		$query	= "update mst_customer_account_manager set 
						billing_id$t		= ?, 
						title_am$t		= ?, 
						name_am$t			= ?, 
						address_am$t		= ?, 
						province_am$t		= ?, 
						city_am$t			= ?, 
						city_type_am$t	= ?,
						kecamatan_am$t	= ?,
						kelurahan_am$t	= ?,
						postal_code_am$t	= ?,
						phone_am$t		= ?,
						handphone_am$t	= ?,
						email_am$t		= ?
					where am_id = ?";
		
		return	$this->db->query($query, $params);			
	}
	
	public function delete_am($am_id){
		$t = $this->getAccess();
		$query	= "update mst_customer_account_manager set 
						billing_id$t		= '', 
						title_am$t		= '', 
						name_am$t			= '', 
						address_am$t		= '', 
						province_am$t		= '', 
						city_am$t			= '', 
						city_type_am$t	= '',
						kecamatan_am$t	= '',
						kelurahan_am$t	= '',
						postal_code_am$t	= '',
						phone_am$t		= '',
						handphone_am$t	= '',
						email_am$t		= ''
					where am_id = ?";
		
		return $this->db->query($query, array($am_id));
	}	
	
	//==============================================================================
	//NON PBM
	public function create_non_pbm($params){
		$t = $this->getAccess();
		$query = "insert into mst_customer_non_pbm(
						three_partied_code$t, siujpt$t, siujpt_expired_date$t, tdg$t, alfi$t, 
						customer_id$t  
					)
					values(
						?, ?, to_date(?,'dd-mm-yyyy'), ?, ?,  
						? 
					)";
		
		return $this->db->query($query, $params);
	}
	
	public function read_non_pbm($non_pbm_id){
		$t = $this->getAccess();
		$query = "select 
						non_pbm_id, three_partied_code$t three_partied_code, siujpt$t siujpt, 
						to_char(siujpt_expired_date$t, 'dd-mm-yyyy') siujpt_expired_date, tdg$t tdg, alfi$t alfi,
						customer_id$t customer_id 
					from mst_customer_non_pbm where non_pbm_id = ?";
				
		return $this->db->query($query, array($non_pbm_id))->row_array();
	}
	
	public function update_non_pbm($params){
		$t = $this->getAccess();
		$query = "update mst_customer_non_pbm set
						three_partied_code$t = ?, 
						siujpt$t = ?, 
						siujpt_expired_date$t = to_date(?,'dd-mm-yyyy'), 
						tdg$t = ?,
						alfi$t = ?,
						customer_id$t = ? 
					where
						non_pbm_id = ? ";
		
		return $this->db->query($query, $params);
	}	
	//==============================================================================
	//PBM
	
	public function view_list_pbm($customer_id){
		$t = $this->getAccess();
		$query	= "select 
						a.external_id,
						b.name BRANCH_NAME,
						a.siupbm$t siupbm,
						a.branch_id$t branch_id, 
						a.pbm_id 
					from mst_customer_pbm a 
							left join MST_HR_OPERATING_UNITS b on b.branch_id = a.branch_id$t and b.displayed_gui = 'Y'
							left join mst_customer c on c.customer_id$t = a.customer_id$t 
					where a.customer_id$t = ?";

		return $this->db->query($query, array($customer_id));
	}
	
	public function get_count_pbm_by_branch_id($customer_id,$branch_id){
		$t = $this->getAccess();
		
		$query	= "SELECT count(1) counter from mst_customer_pbm where customer_id$t = ? and branch_id$t = ?";
		$result	= $this->db->query($query,array($customer_id,$branch_id));
		$row	= $result->row_array();

		return $row['COUNTER'];
	}	
	
	public function create_pbm($params){
		$t = $this->getAccess();
		$query = "insert into mst_customer_pbm(
						three_partied_code$t, siupbm$t, siupbm_publish_date$t, apbmi$t, 
						customer_id$t, branch_id$t   
					)
					values(
						?, ?, to_date(?,'dd-mm-yyyy'), ?, 
						?, ? 
					)";
		
		return $this->db->query($query, $params);
	}
	
	public function read_pbm($pbm_id){
		$t = $this->getAccess();
		$query = "select 
						pbm_id, three_partied_code$t three_partied_code, siupbm$t siupbm, 
						to_char(siupbm_publish_date$t, 'dd-mm-yyyy') siupbm_publish_date, apbmi$t apbmi,
						customer_id$t customer_id,branch_id$t branch_id, external_id$t external_id 
					from mst_customer_pbm where pbm_id = ?";
				
		return $this->db->query($query, array($pbm_id))->row_array();
	}	
	
	public function update_pbm($params){
		$t = $this->getAccess();
		$query = "update mst_customer_pbm set
						three_partied_code$t = ?, 
						siupbm$t = ?, 
						siupbm_publish_date$t = to_date(?,'dd-mm-yyyy'), 
						apbmi$t = ?,
						customer_id$t = ?,
						branch_id$t = ? 
					where
						pbm_id = ? ";
		
		return $this->db->query($query, $params);
	}
	
	public function view_list_sa_kd_pbm($customer_id){
		$t = $this->getAccess();
		$query	= "select b.name cabang, a.kode_pbm from mst_customer_billing_account a left join mst_hr_operating_units b on a.branch_id$t=b.branch_id
where customer_id$t = ? and b.enabled_gui = 'Y'";

		return $this->db->query($query, array($customer_id));
	}	
	//==============================================================================
	// SHIPPING AGENT

	public function view_list_sa($customer_id){
		$t = $this->getAccess();
		$query	= "select 
						a.external_id,
						b.name BRANCH_NAME,
						a.siapdel$t siapdel,
						a.branch_id$t branch_id,
						a.shipping_agent_id 
					from mst_customer_shp_agt a 
							left join MST_HR_OPERATING_UNITS b on b.branch_id = a.branch_id$t and b.displayed_gui = 'Y'
							left join mst_customer c on c.customer_id$t = a.customer_id$t 
					where a.customer_id$t = ?";

		return $this->db->query($query, array($customer_id));
	}
	
	public function get_count_shipping_agent_by_branch_id($customer_id,$branch_id){
		$t = $this->getAccess();
		
		$query	= "SELECT count(1) counter from mst_customer_shp_agt where customer_id$t = ? and branch_id$t = ?";
		$result	= $this->db->query($query,array($customer_id,$branch_id));
		$row	= $result->row_array();

		return $row['COUNTER'];
	}	
	
	public function create_shipping_agent($params){
		$t = $this->getAccess();
		//print_r($params); die();
		$query = "insert into mst_customer_shp_agt(
						three_partied_code$t, siapdel$t, siapdel_expire_date$t, insa_member_no$t, skpt$t,
						siupal$t, siupal_publish_date$t, siupal_expire_date$t,
						siopsus$t, siopsus_publish_date$t, siopsus_expire_date$t,
						siupkk$t, siupkk_publish_date$t, siupkk_expire_date$t,
						sktd$t, sktd_publish_date$t, sktd_created_date$t, sktd_start$t, sktd_end$t,
						route_tramper$t, route_liner$t, customer_id$t, npwp$t, address$t, branch_id$t, external_id$t 
					)
					values(
						?, ?, to_date(?,'dd-mm-yyyy'), ?, ?, 
						?, to_date(?,'dd-mm-yyyy'), to_date(?,'dd-mm-yyyy'), 
						?, to_date(?,'dd-mm-yyyy'), to_date(?,'dd-mm-yyyy'), 
						?, to_date(?,'dd-mm-yyyy'), to_date(?,'dd-mm-yyyy'), 
						?, to_date(?,'dd-mm-yyyy'), to_date(?,'dd-mm-yyyy'), to_date(?,'dd-mm-yyyy'), to_date(?,'dd-mm-yyyy'), 
						?, ?, ?, ?, ?, ?, ?
					)";
		
		return $this->db->query($query, $params);
	}

	public function read_shipping_agent($shipping_agent_id){
		$t = $this->getAccess();
		$query = "select 
						three_partied_code$t three_partied_code, siapdel$t siapdel, to_char(siapdel_expire_date$t, 'dd-mm-yyyy') siapdel_expire_date, 
						insa_member_no$t insa_member_no, skpt$t skpt,
						siupal$t siupal, to_char(siupal_publish_date$t, 'dd-mm-yyyy') siupal_publish_date, to_char(siupal_expire_date$t, 'dd-mm-yyyy') siupal_expire_date,
						siopsus$t siopsus, to_char(siopsus_publish_date$t, 'dd-mm-yyyy') siopsus_publish_date, to_char(siopsus_expire_date$t, 'dd-mm-yyyy') siopsus_expire_date,
						siupkk$t siupkk, to_char(siupkk_publish_date$t, 'dd-mm-yyyy') siupkk_publish_date, to_char(siupkk_expire_date$t, 'dd-mm-yyyy') siupkk_expire_date,
						route_tramper$t route_tramper, route_liner$t route_liner, customer_id$t customer_id, 
						npwp$t npwp, address$t address, shipping_agent_id, branch_id$t branch_id, external_id$t external_id,
						sktd$t sktd, to_char(sktd_publish_date$t, 'dd-mm-yyyy') sktd_publish_date, 
						to_char(sktd_created_date$t, 'dd-mm-yyyy') sktd_created_date, 
						to_char(sktd_start$t, 'dd-mm-yyyy') sktd_start, to_char(sktd_end$t, 'dd-mm-yyyy') sktd_end , to_char(skpt_publish_date$t, 'dd-mm-yyyy') skpt_publish_date , to_char(skpt_expire_date$t, 'dd-mm-yyyy') skpt_expire_date 
					from mst_customer_shp_agt where shipping_agent_id = ?";
				
		return $this->db->query($query, array($shipping_agent_id))->row_array();
	}
	
	public function mandatory_shipping_agent($shipping_agent_id){
		$t = $this->getAccess();
		$query = "select a.billing_customer_id_t as billing_customer_id from mst_customer_billing_account a 
					inner join mst_customer_shp_agt b on a.customer_id_t = b.customer_id_t where b.shipping_agent_id = ? and reg_type_billing_t = 'OLD'";
				
		return $this->db->query($query, array($shipping_agent_id))->row_array();
	}

	public function delete_shipping_agent($shipping_agent_id)
	{
		$t = $this->getAccess();
		echo $query	= "update mst_customer_shp_agt set 
						three_partied_code$t='', 
						siapdel$t='', 
						siapdel_expire_date$t='', 
						insa_member_no$t='', 
						skpt$t='',
						siupal$t='', 
						siupal_publish_date$t='', 
						siupal_expire_date$t='',
						siopsus$t='', 
						siopsus_publish_date$t='', 
						siopsus_expire_date$t='',
						sktd$t='', 
						sktd_publish_date$t='', 
						sktd_created_date$t='', 
						sktd_start$t='', 
						sktd_end$t='',
						route_tramper$t='', 
						route_liner$t='', 
						customer_id$t='', 
						npwp$t='', 
						address$t='', 
						branch_id$t='', 
						external_id$t =''
					where shipping_agent_id = ?";
			$this->db->query($query, array($shipping_agent_id));
	}
	
	public function update_shipping_agent($params){
		$t = $this->getAccess();
		//print_r($params); die();
		$query = "update mst_customer_shp_agt set
						three_partied_code$t = ?, 
						siapdel$t = ?, 
						siapdel_expire_date$t = to_date(?,'dd-mm-yyyy'), 
						insa_member_no$t = ?, 
						skpt$t = ?,
						siupal$t = ?, 
						siupal_publish_date$t = to_date(?,'dd-mm-yyyy'),
						siupal_expire_date$t = to_date(?,'dd-mm-yyyy'),
						siopsus$t = ?,
						siopsus_publish_date$t = to_date(?,'dd-mm-yyyy'), 
						siopsus_expire_date$t = to_date(?,'dd-mm-yyyy'),
						siupkk$t = ?,
						siupkk_publish_date$t = to_date(?,'dd-mm-yyyy'), 
						siupkk_expire_date$t = to_date(?,'dd-mm-yyyy'),						
						sktd$t = ?,
						sktd_publish_date$t = to_date(?,'dd-mm-yyyy'),
						sktd_created_date$t = to_date(?,'dd-mm-yyyy'),
						sktd_start$t = to_date(?,'dd-mm-yyyy'),
						sktd_end$t = to_date(?,'dd-mm-yyyy'),
						route_tramper$t = ?,
						route_liner$t = ?,
						customer_id$t = ?,
						npwp$t = ?,
						address$t = ?,
						branch_id$t = ?, 
						external_id$t = ? 
					where
						shipping_agent_id = ? ";
		//print_r($query); die();
		return $this->db->query($query, $params);
	}
	
	public function create_user_eservice($params){

		$password = md5("123456".$params['USER_ID']);
		
		$query = "insert into mst_user(
						username, password, name, email, enabled,
						created_by, customer_id, handphone,
						id_group, external_id, branch_id,
						registration_company_id 
					)
					values(
						?, '$password', ?, ?, '1', 
						?, ?, ?, 
						?, ?, ?, 
						?  
					)";
		
		return $this->db->query($query, $params);
	}
	
	public function update_user_eservice($params){

		$password = md5("123456".$params['USER_ID']);
		
		$query = "update mst_user
						set name = ?,
						email = ?, 
						handphone = ?, 
						branch_id = ? 
					where username = ?";
		
		return $this->db->query($query, $params);
	}	
	
	public function get_new_external_id($registration_company_id,$service_type,$condition=""){
		$query = "BEGIN ef_get_request_number 
						(
							'$registration_company_id',
							'$service_type',
							'$condition',
							:out_message
						); END;";

		$query = oci_parse($this->db->conn_id, $query) or die ('Can not parse query');
		oci_bind_by_name($query, 'out_message', $out_param,1000) or die ('Can not bind variable');

		oci_execute($query);

        return $out_param;
	}	

	public function view_list_sa_kd_agen($customer_id){
		$t = $this->getAccess();
		$query	= "select b.name cabang, a.kode_agen from mst_customer_billing_account a left join mst_hr_operating_units b on a.branch_id$t=b.branch_id
where customer_id$t = ? and b.enabled_gui = 'Y'";

		return $this->db->query($query, array($customer_id));
	}
	
	//==============================================================================
	// SHIPPING AGENT PIC
	
	public function view_list_sa_pic($customer_id){
		$t = $this->getAccess();
		$query	= "select 
						a.pic_id,
						a.branch_id$t branch_id,
						b.name branch,
						a.name_pic$t name_pic,
						a.address_pic$t address_pic,
						a.phone_pic$t phone_pic,
						a.handphone_pic$t handphone_pic,
						a.email_pic$t email_pic
					from mst_customer_pic a left join mst_hr_operating_units b 
					on a.branch_id$t = b.branch_id 
					where a.customer_id$t = ? and b.displayed_gui = 'Y'";

		return $this->db->query($query, array($customer_id));
	}
	
	public function delete_pic($pic_id){
		$this->db->trans_start();
		$t = $this->getAccess();		
		$query = "update mst_customer_pic set 
						customer_id$t		= '', 
						name_pic$t	 		= '',
						ktp_pic$t	 		= '', 
						religion_pic$t		= '', 
						address_pic$t	 	= '', 
						province_pic$t		= '', 
						city_pic$t	 		= '',
						city_type_pic$t 	= '',
						kecamatan_pic$t 	= '',
						kelurahan_pic$t 	= '',
						postal_code_pic$t	= '',
						phone_pic$t 	 	= '',
						handphone_pic$t 	= '',
						email_pic$t 		= ''
					 where pic_id = ?";
			$this->db->query($query, array($pic_id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}	
	
	public function create_sa_pic($params){
		$t = $this->getAccess();
		$query = "insert into mst_customer_pic (
						customer_id$t, name_pic$t, ktp_pic$t, religion_pic$t, 
						address_pic$t, province_pic$t, city_pic$t,
						city_type_pic$t, kecamatan_pic$t, kelurahan_pic$t, postal_code_pic$t, 
						phone_pic$t, handphone_pic$t, email_pic$t, branch_id$t 
					)
					values (
						?, ?, ?, ?, 
						?, ?, ?, 
						?, ?, ?, ?, 
						?, ?, ?, ? 
					)";
		
		return $this->db->query($query, $params);
	}
	
	public function read_sa_pic($pic_id){
		$t = $this->getAccess();
		$query = "select pic_id, 
						customer_id$t customer_id, name_pic$t name_pic, ktp_pic$t ktp_pic, religion_pic$t religion_pic,
						address_pic$t address_pic, province_pic$t province_pic, city_pic$t city_pic,
						city_type_pic$t city_type_pic, kecamatan_pic$t kecamatan_pic, kelurahan_pic$t kelurahan_pic, postal_code_pic$t postal_code_pic, 
						phone_pic$t phone_pic, handphone_pic$t handphone_pic, email_pic$t email_pic, branch_id$t branch_id 
					from mst_customer_pic where pic_id = ?";
		
		return $this->db->query($query, array($pic_id))->row_array();
	}
	
	public function update_sa_pic($params){
		$t = $this->getAccess();
		$query = "update mst_customer_pic set 
						customer_id$t		= ?, 
						name_pic$t	 		= ?,
						ktp_pic$t	 		= ?, 
						religion_pic$t		= ?, 
						address_pic$t	 	= ?, 
						province_pic$t		= ?, 
						city_pic$t	 		= ?,
						city_type_pic$t 	= ?,
						kecamatan_pic$t 	= ?,
						kelurahan_pic$t 	= ?,
						postal_code_pic$t	= ?,
						phone_pic$t 	 	= ?,
						handphone_pic$t 	= ?,
						email_pic$t 		= ?
					 where pic_id = ?";
					 
		return $this->db->query($query, $params);
	}
	
	//==============================================================================
	// BOD	
	
	public function create_bod($params){
		$t = $this->getAccess();
		$query="insert into MST_CUSTOMER_BOD (CUSTOMER_ID$t, TITLE_BOD$t, NAME_BOD$t, ADDRESS_BOD$t, PROVINCE_BOD$t, CITY_BOD$t, 
			CITY_TYPE_BOD$t, KECAMATAN_BOD$t, KELURAHAN_BOD$t, POSTAL_CODE_BOD$t, PHONE_BOD$t, HANDPHONE_BOD$t, EMAIL_BOD$t) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
		return	$this->db->query($query, $params);	
	}
	
	public function read_bod($bod_id){	
		$t = $this->getAccess();
		$query = "select 
                        bod_id, customer_id$t customer_id, title_bod$t title_bod, name_bod$t name_bod, address_bod$t address_bod,
						province_bod$t province_bod, city_bod$t city_bod, city_type_bod$t city_type_bod, kecamatan_bod$t kecamatan_bod, 
						kelurahan_bod$t kelurahan_bod,
						postal_code_bod$t postal_code_bod, phone_bod$t phone_bod, handphone_bod$t handphone_bod, email_bod$t email_bod 
                    from mst_customer_bod
					where bod_id = ?";
		return $this->db->query($query, array($bod_id))->row_array();
	}
	
	public function update_bod($params){
		$t = $this->getAccess();
		$query	= "update mst_customer_bod set 
						customer_id$t		= ?, 
						title_bod$t		= ?, 
						name_bod$t		= ?, 
						address_bod$t		= ?, 
						province_bod$t		= ?, 
						city_bod$t	= ?, 
						city_type_bod$t		= ?,
						kecamatan_bod$t	= ?,
						kelurahan_bod$t		= ?,
						postal_code_bod$t	= ?,
						phone_bod$t		= ?,
						handphone_bod$t		= ?,
						email_bod$t	= ?
					where bod_id = ?";
		
		return	$this->db->query($query, $params);			
	}
	
	public function view_list_bod($params){
		$t = $this->getAccess();
		$query	= "select 
						bod_id,
						name_bod$t name_bod,
						title_bod$t title_bod,
						address_bod$t address_bod,
						email_bod$t email_bod,
						HANDPHONE_BOD$t HANDPHONE_BOD
					from mst_customer_bod
					where customer_id$t =?";

		return $this->db->query($query,$params);
	}

	public function delete_bod($bod_id){
		$this->db->trans_start();	
		$t = $this->getAccess();		
		echo $query	= "update mst_customer_bod set 
						customer_id$t		= '', 
						title_bod$t		= '', 
						name_bod$t		= '', 
						address_bod$t		= '', 
						province_bod$t		= '', 
						city_bod$t	= '', 
						city_type_bod$t		= '',
						kecamatan_bod$t	= '',
						kelurahan_bod$t		= '',
						postal_code_bod$t	= '',
						phone_bod$t		= '',
						handphone_bod$t		= '',
						email_bod$t	= ''
					where bod_id = ?";
			$this->db->query($query, array($bod_id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	//==============================================================================
	// CEO	
	public function create_ceo($params){
		$t = $this->getAccess();
		$query="INSERT INTO MST_CUSTOMER_CEO (
					CUSTOMER_ID$t, NAME_CEO$t, ADDRESS_CEO$t, PROVINCE_CEO$t, CITY_CEO$t, CITY_TYPE_CEO$t, KECAMATAN_CEO$t, KELURAHAN_CEO$t, POSTAL_CODE_CEO$t, 
					PHONE_CEO$t, HANDPHONE_CEO$t, EMAIL_CEO$t, 
					LOCATION_BIRTH_CEO$t, DATE_BIRTH_CEO$t, 
					NATIONALITY_CEO$t, KTP_CEO$t, PASSPORT_CEO$t, SEX_CEO$t, RELIGION_CEO$t, 
					KTP_EXPIRE_DATE_CEO$t, PASSPORT_EXPIRE_DATE_CEO$t) 
					VALUES (
						?,?,?,?,?,?,?,?,?,
						?,?,?,
						?, to_date(?, 'dd-mm-yyyy'),
						?,?,?,?,?,
						to_date(?, 'dd-mm-yyyy'), to_date(?, 'dd-mm-yyyy')
					)";					
		return	$this->db->query($query, $params);
	}
	
	public function read_ceo($ceo_id){
		$t = $this->getAccess();
		$query = "select 
                       CEO_ID,CUSTOMER_ID$t CUSTOMER_ID, NAME_CEO$t NAME_CEO, ADDRESS_CEO$t ADDRESS_CEO, PROVINCE_CEO$t PROVINCE_CEO, 
					   CITY_CEO$t CITY_CEO, CITY_TYPE_CEO$t CITY_TYPE_CEO, 
					   KECAMATAN_CEO$t KECAMATAN_CEO, KELURAHAN_CEO$t KELURAHAN_CEO, POSTAL_CODE_CEO$t POSTAL_CODE_CEO, 
					   PHONE_CEO$t PHONE_CEO, HANDPHONE_CEO$t HANDPHONE_CEO, EMAIL_CEO$t EMAIL_CEO, LOCATION_BIRTH_CEO$t LOCATION_BIRTH_CEO, 
					   to_char(date_birth_ceo$t, 'dd-mm-yyyy') DATE_BIRTH_CEO, 
					   NATIONALITY_CEO$t NATIONALITY_CEO, KTP_CEO$t KTP_CEO, PASSPORT_CEO$t PASSPORT_CEO, SEX_CEO$t SEX_CEO, RELIGION_CEO$t RELIGION_CEO,
					   to_char(KTP_EXPIRE_DATE_CEO$t, 'dd-mm-yyyy') KTP_EXPIRE_DATE_CEO, 
					   to_char(PASSPORT_EXPIRE_DATE_CEO$t, 'dd-mm-yyyy') PASSPORT_EXPIRE_DATE_CEO
                    from MST_CUSTOMER_CEO
					where ceo_id = ?";
					
		//		echo $query; die;
		
		return $this->db->query($query, array($ceo_id))->row_array();
	}
	
	public function read_ceo_by_customer_id($customer_id){
		$t = $this->getAccess();
		$query = "select 
                       CEO_ID,CUSTOMER_ID$t CUSTOMER_ID, NAME_CEO$t NAME_CEO, ADDRESS_CEO$t ADDRESS_CEO, PROVINCE_CEO$t PROVINCE_CEO, 
					   CITY_CEO$t CITY_CEO, CITY_TYPE_CEO$t CITY_TYPE_CEO, 
					   KECAMATAN_CEO$t KECAMATAN_CEO, KELURAHAN_CEO$t KELURAHAN_CEO, POSTAL_CODE_CEO$t POSTAL_CODE_CEO, 
					   PHONE_CEO$t PHONE_CEO, HANDPHONE_CEO$t HANDPHONE_CEO, EMAIL_CEO$t EMAIL_CEO, LOCATION_BIRTH_CEO$t LOCATION_BIRTH_CEO, 
					   to_char(date_birth_ceo$t, 'dd-mm-yyyy') DATE_BIRTH_CEO, 
					   NATIONALITY_CEO$t NATIONALITY_CEO, KTP_CEO$t KTP_CEO, PASSPORT_CEO$t PASSPORT_CEO, SEX_CEO$t SEX_CEO, RELIGION_CEO$t RELIGION_CEO,
					   to_char(KTP_EXPIRE_DATE_CEO$t, 'dd-mm-yyyy') KTP_EXPIRE_DATE_CEO, 
					   to_char(PASSPORT_EXPIRE_DATE_CEO$t, 'dd-mm-yyyy') PASSPORT_EXPIRE_DATE_CEO
                    from MST_CUSTOMER_CEO
					where CUSTOMER_ID$t = ?";
					
		//		echo $query; die;
		
		return $this->db->query($query, array($customer_id));
	}	
	
	public function update_ceo($params){
		$t = $this->getAccess();
		$query	= "update MST_CUSTOMER_CEO set 
						CUSTOMER_ID$t		= ?, 
						NAME_CEO$t		= ?, 
						ADDRESS_CEO$t		= ?, 
						PROVINCE_CEO$t	= ?, 
						CITY_CEO$t		= ?, 
						CITY_TYPE_CEO$t	= ?, 
						KECAMATAN_CEO$t	= ?,
						KELURAHAN_CEO$t	= ?,
						POSTAL_CODE_CEO$t	= ?,
						PHONE_CEO$t		= ?,
						HANDPHONE_CEO$t	= ?,
						EMAIL_CEO$t		= ?,
						LOCATION_BIRTH_CEO$t	= ?,
						DATE_BIRTH_CEO$t	= to_date(?,'dd-mm-yyyy'),
						NATIONALITY_CEO$t	= ?,
						KTP_CEO$t			= ?,
						PASSPORT_CEO$t	= ?,
						SEX_CEO$t			= ?,
						RELIGION_CEO$t 	= ?,
						KTP_EXPIRE_DATE_CEO$t 		= to_date(?, 'dd-mm-yyyy'),
						PASSPORT_EXPIRE_DATE_CEO$t 	= to_date(?, 'dd-mm-yyyy')
					where CEO_ID = ?";
		
		return	$this->db->query($query, $params);			
	}
	
	//////////// user sim kapal
	
	public function check_user_simkapal_sync($shipping_agent_id,$customer_id=""){

		$query4 = "select customer_id from mst_customer_skapal_user   
					where internal_id = ? ";
		$query = $this->db->query($query4, array($shipping_agent_id));
		if($query->num_rows()==0)
		{
			$query4 = "select customer_id from mst_customer_skapal_user   
						where customer_id = ? ";
			$query = $this->db->query($query4, array($customer_id));
		}
		
		if($query->num_rows()!=0)
		{
			$row = $query->row_array();
		
			$customer_id=$row['CUSTOMER_ID'];
			
			$query1 = "select reg_type from mst_customer where customer_id = ?";
			
			$row = $this->db->query($query1, array($customer_id))->row_array();
			
			if($row['REG_TYPE'] == 'NEW'){//new customer, created from CDM, not simkapal
				
				$query4 = "select count(1) ctr from mst_pelanggan_skapal 
							where kd_pelanggan = ? and status_simkapal = 'S' and status_simkeu = 'S'";
				$row = $this->db->query($query4, array($customer_id))->row_array();
				
				if ($row['CTR'] > 0){ // customer synced with simkapal
					$query2 = "select count(1) ctr from mst_customer_skapal_user 
								where internal_id = ?";
					$row = $this->db->query($query2, array($shipping_agent_id))->row_array();
					
					if ($row['CTR'] > 0){ // user already inserted
						$query3 = "select count(1) ctr from mst_customer_skapal_user 
									where internal_id = ? and first_sync == 'S'";
						$row = $this->db->query($query2, array($shipping_agent_id))->row_array();
						
						if ($row['CTR'] > 0){
							$r = 'S'; //has synced once, don't care if now is sync or not
						}
						else{
							$r = 'F'; //failed to sync so there should be no row inserted yet on simkapal
						}
					}
					else{
						$r = 'N'; //not found, need to make one
					}
				}
				else{
					$r = 'X'; // customer not synced with simkapal
				}
			}
			else{
				$r = 'O'; // old customer, do not make new user
			}			
		}
		else{
			$r = 'N'; //not found, need to make one
		}
					
		return $r;

	}
	
	public function create_user_simkapal($params){
		$query = "insert into mst_customer_skapal_user (user_id, real_name, customer_id, info_sms_number, info_email_address, created_by, internal_id)
					values (?,?,?,?,?,?,?)";
					
		return	$this->db->query($query, $params);			
	}
	
	public function check_sync($customer_id){
		
		$query 	= "select status_simkeu, error_message_simkeu, 
							status_simkapal, error_message_simkapal, status_iu  
						from mst_pelanggan_skapal where kd_pelanggan = ? order by date_staging_inserted desc";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			return $result->row_array();
		}
		else{
			return "failed";	
		}
	}	
	
	public function user_check_old_password($params)
	{
		$query = "select password from  mst_user 
				where username = ?";

		$result = $this->db->query($query,$params);
		
		$row = $result->row_array();
		return  $row['PASSWORD'];
	}

	public function update_user($params){
		// $query = "update mst_user set 
            // name = ?, 
            // email = ?,
            // id_group = ?,
            // is_ppjk = ?,
            // customer_id =?,
            // enabled =?,
            // id_sub_group = ?,
            // registration_company_id =? 
        // where username = ?";
		
		// return	$this->db->query($query, $params);
        $query = "begin 
            IBIS.PROC_UPDATE_CONSIGNEE_PPJK ( 
                '".$params['NAME']."', 
                '".$params['EMAIL']."', 
                '".$params['CATEGORY']."', 
                '".$params['IS_PPJK']."', 
                '".$params['CUSTOMER_ID']."', 
                ".$params['ACTIVE'].", 
                '".$params['TERMINAL_TYPE']."', 
                '".$params['REGISTRATION_COMPANY_ID']."',
                '".$params['USERNAME']."', 
                '".$params['USERNAME_CREATE']."'); 
        end;";
		
		// echo $query; die;
		return $this->db->simple_query($query);
	}
	
	public function update_user_password($params){
		$query = "update mst_user set 
						password = ? 
					where username = ?";
		
		return	$this->db->query($query, $params);		
	}
	
	public function view_detail_user_simkapal($shipping_agent_id, $customer_id){
		$query = "select user_id, real_name, info_sms_number, info_email_address from mst_customer_skapal_user where internal_id = ?";
		
		return	$this->db->query($query, array($shipping_agent_id));
	}
	
	public function update_user_simkapal($params){
		$query = "update mst_customer_skapal_user set 
						real_name = ?,
						info_sms_number = ?,
						info_email_address = ?
					where customer_id = ? and internal_id = ?";
		
		return	$this->db->query($query, $params);
	}
	
	public function set_user_reg_success($user_id){
		$this->db->trans_start();

			$query = "select template from mst_template_sms where tmp_name = 'AGENT_USER_REG_SUCCESS' and language = 'ID'";
			$row_msg = $this->db->query($query)->row_array();

			$query = "select subject, to_char(content) content from mst_template_email where key = 'skapal_user_reg_success'";
			$row_email = $this->db->query($query)->row_array();
			
			$query = "select real_name, info_sms_number, info_email_address from mst_customer_skapal_user where user_id = ?";
			$row_contact = $this->db->query($query, array($user_id))->row_array();
			
			$txt = $row_msg['TEMPLATE'];
			$txt = str_replace('$user', $user_id, $txt);
			$txt = str_replace('$company', $row_contact['REAL_NAME'], $txt);
			
			$params = array (
							'MSISDN'	=> $row_contact['INFO_SMS_NUMBER'],
							'TEXT'		=> $txt
						);
			
			$query = "insert into sms_lg (msisdn, text) values (?, ?)";
			$this->db->query($query, $params);
			
			$mail = $row_email['CONTENT'];
			$mail = str_replace('$company', $row_contact['REAL_NAME'], $mail);
			$mail = str_replace('$user', $user_id, $mail);
						
			$params2 = array(
							'FROM_EMAIL' 	=> 'robot@indonesiaport.co.id',
							'TO_EMAIL' 		=> $row_contact['INFO_EMAIL_ADDRESS'],
							'HTML_DATA' 	=> $mail,
							'TEXT_DATA' 	=> $mail,
							'SUBJECT_EMAIL' => $row_email['SUBJECT']
						);
			$query = "insert into email_lg (from_email, to_email, html_data, text_data, subject_email) values (?,?,?,?,?)";
			$this->db->query($query, $params2);
			
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	////////////////////////////////////////////////////////////////////////////////////////////////
	// for registration wizard/walkthrough/breadcrumb
	
	public function check_reg_status($customer_id,$branch_id){
		$t = $this->getAccess();
		
		if($branch_id!="")
		{
			$search_by_branch = " and branch_id$t = '$branch_id'";
		}
		
		$query = "select
					(select count(1) from mst_customer where customer_id$t = ?) GI,
					(select count(1) from mst_customer_billing_account where customer_id$t = ? $search_by_branch) BILL,
					(select count(1) from mst_customer_bank_account where billing_id$t in (select billing_id from mst_customer_billing_account where customer_id$t = ?)) BANK,
					(select count(1) from mst_customer_account_manager where billing_id$t in (select billing_id from mst_customer_billing_account where customer_id$t = ?)) AM,
					(select count(1) from mst_customer_ceo where customer_id$t = ?) CEO,
					(select count(1) from mst_customer_bod where customer_id$t = ?) BOD,
					(select count(1) from mst_customer_pbm where customer_id$t = ? $search_by_branch) PBM,  
					(select count(1) from mst_customer_non_pbm where customer_id$t = ?) NON_PBM,  
					(select count(1) from mst_customer_shp_agt where customer_id$t = ? $search_by_branch) SA,
					(select count(1) from mst_customer_pic where customer_id$t = ? $search_by_branch) SAPIC,
					(select count(1) from MST_CUSTOMER_PPJK_CONSG where ppjk_id$t = ?) PPJK
				from dual";
		
		return $this->db->query($query, array(	$customer_id, $customer_id, $customer_id, $customer_id, 
												$customer_id, $customer_id, $customer_id, $customer_id,
												$customer_id, $customer_id, $customer_id)
								)->row_array();
	}
	
	public function get_billing_ids($customer_id){
		$t = $this->getAccess();
		$query = "select billing_id  from mst_customer_billing_account where customer_id$t  = ?";
		
		return $this->db->query($query,array($customer_id));
	}
	
	public function get_ceo_id($customer_id){
		$t = $this->getAccess();
		$query = "select ceo_id from mst_customer_ceo where customer_id$t = ?";
		
		return $this->db->query($query,array($customer_id))->row_array();
	}
	
	public function get_shipping_agent_id($customer_id){
		$t = $this->getAccess();
		$query = "select shipping_agent_id from mst_customer_shp_agt where customer_id$t = ?";
		
		return $this->db->query($query,array($customer_id))->row_array();
	}
	
	public function get_pbm_id($customer_id){
		$t = $this->getAccess();
		$query = "select pbm_id from mst_customer_pbm where customer_id$t = ?";
		
		return $this->db->query($query,array($customer_id))->row_array();
	}

	public function get_non_pbm_id($customer_id){
		$t = $this->getAccess();
		$query = "select non_pbm_id from mst_customer_non_pbm where customer_id$t = ?";
		
		return $this->db->query($query,array($customer_id))->row_array();
	}
	
	public function get_customer_id_by_billing_id($sa_id){
		$t = $this->getAccess();
		$query = "select customer_id$t customer_id from mst_customer_billing_account where billing_id = ?";
		
		return $this->db->query($query,array($sa_id))->row_array();
	}
	
	public function check_customer_type($customer_id){
		$t = $this->getAccess();
		$query = "select is_shipping_agent$t is_shipping_agent, is_shipping_line$t is_shipping_line, is_pbm$t is_pbm, is_ff$t is_ff, is_emkl$t is_emkl, is_ppjk$t is_ppjk, is_consignee$t is_consignee, is_customer$t is_customer, is_mitra$t is_mitra, is_rupa$t is_rupa, company_type$t company_type
					from mst_customer where customer_id$t = ?";
		
		return $this->db->query($query, array($customer_id))->row_array();
	}
	
	public function last_sync_status($customer_id){
		
		$query = "SELECT status_iu,status_simkapal,status_simkeu,to_char(date_staging_inserted,'DD-MM-YYYY HH24:Mi:SS') date_staging_inserted  FROM MST_PELANGGAN_SKAPAL WHERE KD_PELANGGAN = ? order by date_staging_inserted desc";
		
		return $this->db->query($query, array($customer_id))->row_array();
	}	
	
	public function sync_db($customer_id, $inup = "U"){
		
		$query = "begin proc_transfer_simkapal('$customer_id', '$inup'); end;";
		
		//echo $query; die;
		return $this->db->simple_query($query);
	}	
	
	public function update_customer_status($customer_id, $status){
		
		$query = "update mst_customer set status_approval = ? where customer_id = ?";
		
		$this->db->query($query, array($status,$customer_id));
	}
	
	public function check_sync_insert_history($customer_id){
		
		$query = "select count(1) ctr from  mst_pelanggan_skapal
					where kd_pelanggan = ?
					and insert_update_flag = 'I' 
					and status_simkapal = 'S'
					and status_simkeu   = 'S'";
		$result = $this->db->query($query, array($customer_id));
		
		$row = $result->row_array();
		return  $row['CTR'];
	}

	public function validate_insa_member_no($insa_member_no,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  MST_CUSTOMER_SHP_AGT a, mst_customer b 
					where a.customer_id=b.customer_id 
							and INSA_MEMBER_NO = '$insa_member_no' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}	
	
	public function validate_siopsus($siopsus,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  MST_CUSTOMER_SHP_AGT a, mst_customer b 
					where a.customer_id=b.customer_id 
							and siopsus = '$siopsus' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}	
	
	public function validate_siupal($siupal,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  MST_CUSTOMER_SHP_AGT a, mst_customer b 
					where a.customer_id=b.customer_id 
							and siupal = '$siupal' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}	
	
	public function validate_siapdel($siapdel,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  MST_CUSTOMER_SHP_AGT a, mst_customer b 
					where a.customer_id=b.customer_id 
							and siapdel = '$siapdel' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function validate_apbmi($apbmi,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  mst_customer_pbm a, mst_customer b 
					where a.customer_id=b.customer_id 
							and apbmi = '$apbmi' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function validate_siupbm($siupbm,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  mst_customer_pbm a, mst_customer b 
					where a.customer_id=b.customer_id 
							and siupbm = '$siupbm' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function validate_alfi($alfi,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  mst_customer_non_pbm a, mst_customer b 
					where a.customer_id=b.customer_id 
							and alfi = '$alfi' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function validate_siujpt($siujpt,$customer_id,$registrationcompanyid){
		
		$where="";
		
		if($registrationcompanyid!="")
		{
			$where .= " and b.registration_company_id = '$registrationcompanyid' ";
		}
		
		$query = "select count(1) ctr from  mst_customer_non_pbm a, mst_customer b 
					where a.customer_id=b.customer_id 
							and siujpt = '$siujpt' 
							and a.customer_id <> '$customer_id' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function validate_npwp($npwp,$customer_id,$registrationcompanyid){
		
		$where = "";
		if($customer_id!="")
		{
			$where .= " and customer_id_t <> '$customer_id' ";
		}
			
		$query = "select count(1) ctr from  mst_customer 
					where npwp_t = '$npwp' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}

	public function validate_passport($passport,$customer_id,$registrationcompanyid){
		
		$where = "";
		if($customer_id!="")
		{
			$where .= " and customer_id_t <> '$customer_id' ";
		}
			
		$query = "select count(1) ctr from  mst_customer 
					where passport_t = '$passport' $where";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function validate_blacklist($value,$atribute){
			
		$query = "select count(1) ctr from  MST_CUSTOMER_BLACKLIST 
					where BLACKLIST_ATTRIBUTE = ? and BLACKLIST_VALUE = ? and active = 'Y'";
		$result = $this->db->query($query,array($atribute,$value));
		
		$row = $result->row_array();
		return  $row['CTR'];
	}	

	public function validate_blacklist_double($blacklist_id,$atribute,$value){
		
		if($blacklist_id!="")
		{
			$blacklist_id_search = " AND BLACKLIST_ID <> ? ";
		}
		
		$query = "select count(1) ctr from  MST_CUSTOMER_BLACKLIST 
					where BLACKLIST_ATTRIBUTE = ? and BLACKLIST_VALUE = ? $blacklist_id_search";
		$result = $this->db->query($query,array($atribute,$value,$blacklist_id));
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function validate_agent_branch($branch,$customer_id,$shipping_agent_id){
			
		if($shipping_agent_id!="")
		{
			$add_query = " and shipping_agent_id <> '$shipping_agent_id' ";
		}
		else
		{
			$add_query = "";
		}
		
		$query = "select count(1) ctr from  mst_customer_shp_agt 
					where branch_id = '$branch' and customer_id = '$customer_id' $add_query ";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}

	public function validate_bank_branch($branch,$billing_id,$bank_account_id){
			
		if($bank_account_id!="")
		{
			$add_query = " and bank_account_id <> '$bank_account_id' ";
		}
		else
		{
			$add_query = "";
		}
		
		$query = "select count(1) ctr from  mst_customer_bank_account  
					where branch_id = '$branch' and billing_id = '$billing_id' $add_query";
		$result = $this->db->query($query);
		
		$row = $result->row_array();
		return  $row['CTR'];
	}
	
	public function get_reg_type_general($customer_id){
		
		$query = "select reg_type from mst_customer where customer_id_t = ?";
		$result = $this->db->query($query, array($customer_id));
		
		$row = $result->row_array();
		return  $row['REG_TYPE'];
	}
	
	public function getHistory($customer_id){
        $qselect = "select concat(concat(concat(to_char(last_user_activity_date, 'dd/mm/yyyy hh24:mi:ss'), ': '), 
        			concat(b.name, ' ')), last_user_activity_code) as history from MST_CUSTOMER_ACTIVITY  
					a left join mst_user b on a.last_user_activity_userid = b.username 
					where a.customer_id = ? order by last_user_activity_date desc";
        $rselect = $this->db->query($qselect, array($customer_id));
        $data = $rselect->result_array();
        return $data;
	}	
	
	/////////// blacklist
	public function blacklist_list($search, $limit, $offset, $order, $sort, $atribut){
		
		if( in_array(	strtoupper($order), 
						array('NAME','ADDRESS','NPWP','EMAIL','WEBSITE','PHONE','CUSTOMER_ID')
					) ){
			$order = " order by $order $sort ";
		}
		else{
			$order = " order by case when EDIT_DATE is null then 1 else 0 end, EDIT_DATE DESC, BLACKLIST_ID DESC ";
		}
		
		if(strlen($search)>0){
			$search = " where (upper(BLACKLIST_ATTRIBUTE) like upper('%$search%') 
						or upper(BLACKLIST_VALUE) like upper('%$search%'))";	
		}
		
		if(strlen($atribut)>0){
			if($search!="")
				$search .=" AND ";
			else 
				$search .=" WHERE ";
			
			$search .= " BLACKLIST_ATTRIBUTE = '$atribut'";
		}
		
		$query	= "select * from
					(	select 	rownum numrow, 
								a.* from mst_customer_blacklist a
						$search 
						$order 
					)
					where numrow > $offset and numrow <= " . ($limit+$offset)." $order ";
		
		//echo $query; die;
		return $this->db->query($query);
	}
	
	public function blacklist_list_info($search, $limit, $offset, $order, $sort, $atribut){
		
		if( in_array(	strtoupper($order), 
						array('NAME','ADDRESS','NPWP','EMAIL','WEBSITE','PHONE','CUSTOMER_ID')
					) ){
			$order = " order by $order $sort ";
		}
		else{
			$order = " order by BLACKLIST_ID DESC ";
		}

		if(strlen($search)>0){
			$search = " where (upper(BLACKLIST_ATTRIBUTE) like upper('%$search%') 
						or upper(BLACKLIST_VALUE) like upper('%$search%'))";
		}

		if(strlen($atribut)>0){
			if($search!="")
				$search .=" AND ";
			else 
				$search .=" WHERE ";
			
			$search .= " BLACKLIST_ATTRIBUTE = '$atribut'";
		}
		
		$query	= "select startnum, endnum, (select count(1) total from mst_customer_blacklist $search ) total from
					(    
						select nvl(min(numrow),0) startnum, nvl(max(numrow),0) endnum
										from 
											(	select 	rownum numrow
													from mst_customer_blacklist a
												$search 
												$order 
											)
										where numrow > $offset and numrow <= " . ($limit+$offset) . "
					) ";
		
		//echo $query; die;
		return $this->db->query($query)->row_array();;
	}
	
	public function create_blacklist($params){

		$this->db->trans_start();
		
		$query	= "insert into mst_customer_blacklist(
						BLACKLIST_ATTRIBUTE, BLACKLIST_VALUE, NOTES, CREATE_BY, CREATE_DATE 
					)
					values(
						?, ?, ?, ?, SYSDATE
					)";
		$this->db->query($query, $params);
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}
	
	public function view_detail_blacklist($id){
		
		$query	= "select 
						blacklist_id,
						blacklist_attribute,
						blacklist_value,
						notes 
					from mst_customer_blacklist 
					where blacklist_id = ?";
		return $this->db->query($query,array($id));
	}	
	
	public function update_blacklist($params){

		$this->db->trans_start();
		
		$query	= "update mst_customer_blacklist 
						set BLACKLIST_ATTRIBUTE = ?, BLACKLIST_VALUE = ?,  NOTES = ?, EDIT_BY = ?, EDIT_DATE = SYSDATE
						WHERE BLACKLIST_ID = ? ";
		$this->db->query($query, $params);
		
		$this->db->trans_complete();
		
		return $this->db->trans_status();
	}

	public function delete_blacklist(){
		$blacklist_id = htmLawed($_POST['blacklist_id']);
		$notes = htmLawed($_POST['notes']);
		
		$query = "update mst_customer_blacklist set delete_notes = ?, create_date = sysdate, edit_date = sysdate where blacklist_id = ?";
		$this->db->query($query, array($notes,$blacklist_id));
		
		$query = "update mst_customer_blacklist set active = 'N', EDIT_DATE = SYSDATE where blacklist_id = ?";
		
		return $this->db->query($query, array($blacklist_id));
	}

	public function activate_blacklist($blacklist_id){
		
		$query = "update mst_customer_blacklist set active = 'Y', EDIT_DATE = SYSDATE where blacklist_id = ?";
		
		return $this->db->query($query, array($blacklist_id));
	}
	
	//customer submit/confirm
	public function submit_customer($customer_id){
		$t = $this->getAccess();
		$query 	= "update mst_customer set status_approval = 'W', type_approval=CASE
                        WHEN approve_date is not null  THEN 
                          'U'
                        ELSE
                          'C' 
                     END, confirm_date = sysdate where customer_id$t= ? ";
		return $this->db->query($query,array( $customer_id ));
	}
	
	public function add_audit_trail($customer_id,$notes,$user_id){
		$query 	= "insert into mst_customer_audit_trail (customer_id,notes,user_id) values (?,?,?)";
		return $this->db->query($query,array( $customer_id,$notes,$user_id));
	}
	
    public function getListAuditTrail($customer_id)
    {
        $query = "select a.*,to_char(date_insert,'dd-mm-yyyy') date_insert2, b.name  
						from MST_CUSTOMER_AUDIT_TRAIL a 
						left join mst_user b on b.USERNAME = a.USER_ID  
						where a.customer_id = ? order by a.DATE_INSERT desc";

		$query 	= $this->db->query($query,array($customer_id));
		$hasil=$query->result_array();
		return $hasil;
    }	
	
	public function check_submit($customer_id){
		$t = $this->getAccess();
		$query 	= "select status_approval from mst_customer where customer_id$t= ? ";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$row = $result->row_array();
			return $row['STATUS_APPROVAL'];
		}
		else{
			return "failed";	
		}
	}	
	
	public function get_submit_notes($customer_id){
		$t = $this->getAccess();
		$query 	= "select notes from (
		select notes,date_insert,row_number() over (order by date_insert desc) numrow  from mst_customer_audit_trail where customer_id = ?) abc
		where abc.numrow = 1";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$row = $result->row_array();
			return $row['NOTES'];
		}
		else{
			return "failed";	
		}
	}
	
	public function reject_notes($customer_id){
		$t = $this->getAccess();
		$query 	= "select reject_notes from mst_customer where customer_id$t= ? ";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$row = $result->row_array();
			return $row['REJECT_NOTES'];
		}
		else{
			return "failed";	
		}
	}	
	
	////// customer approval
    public function getTotalListApproval($search="")
    {

        $query = "SELECT count(1) total
            FROM mst_customer 
            WHERE (status_approval IN ('W','P','FP') or sync_cfs_only = 'Y')";
		//print_r($query); die();
		$query 	= $this->db->query($query);
		
		$hasil=$query->row_array();
		return $hasil['TOTAL'];
    }
	
	public function getTotalListActivation($search="")
    {

        $query = "SELECT count(1) total FROM mst_customer_activation WHERE pelanggan_aktif ='1' AND expired_date is not null";
		//print_r($query); die();
		$query 	= $this->db->query($query);
		
		$hasil=$query->row_array();
		return $hasil['TOTAL'];
    }
	
	public function getTotalListDeactivation($search="")
    {

        $query = "SELECT count(1) total FROM mst_customer_deactivation";
		//print_r($query); die();
		$query 	= $this->db->query($query);
		
		$hasil=$query->row_array();
		return $hasil['TOTAL'];
    }
	
    public function getListApproval($page, $limit, $search="")
    {
        $lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;

		if($search!="")
		{
			$search = strtoupper($search);
			$search = " and (UPPER(customer_id_t) like '%$search%' or UPPER(NAME_T) like '%$search%' or UPPER(b.NAME) like '%$search%')";
		}

        $query = "SELECT *
				  FROM (SELECT a.*, ROWNUM rnum
						  FROM (  SELECT a.*,b.NAME nama_cabang,   
								 TO_CHAR (CONFIRM_DATE, 'dd-mm-yyyy hh24:mi:ss') REQUEST_DATE,
								 TO_CHAR (CONFIRM_DATE, 'yyyy mm dd hh24 mi ss')
									REQUEST_DATE_STRING,
								 TO_CHAR (SYSDATE, 'yyyy mm dd hh24 mi ss')
									SYSDATE_STRING						  
							FROM  mst_customer a left join MST_HR_OPERATING_UNITS b on b.ORGANIZATION_ID = a.REGISTRATION_COMPANY_ID_T 
						   WHERE (status_approval IN ('W','P','FP') or sync_cfs_only = 'Y') $search
						ORDER BY confirm_date asc) a
					  where ROWNUM <= $upper_bound )
					where rnum  > $lower_bound";
		//print_r($query); die();
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
    }
	
	
	public function getListActivation($page, $limit, $search="")
    {
        $lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;

		if($search!="")
		{
			$search = strtoupper($search);
			$search = " AND (upper(a.customer_name) like upper('%$search%') or upper(a.customer_id) like upper('%$search%') or upper(a.npwp) like upper('%$search%'))";
			//print_r($search); die();
		
		}

		$query = "SELECT * FROM 
						(SELECT a.*, ROWNUM rnum FROM 
						( SELECT a.*,b.name, TO_CHAR 
							(ACTIVATION_DATE, 'dd-mm-yyyy hh24:mi:ss') REQUEST_DATE, 
								TO_CHAR (ACTIVATION_DATE, 'yyyy mm dd hh24 mi ss') REQUEST_DATE_STRING, 
								TO_CHAR (SYSDATE, 'yyyy mm dd hh24 mi ss') SYSDATE_STRING 
							FROM mst_customer_activation a left join mst_hr_operating_units b on a.branch_id = b.branch_id and enabled_gui = 'Y' And b.simop_branch_id is not null
						WHERE 1=1 and a.pelanggan_aktif = '1' and a.EXPIRED_DATE is not null $search
						ORDER BY ACTIVATION_DATE asc) a 
					where ROWNUM <= $upper_bound ) 
				where rnum > $lower_bound";
		
		//print_r($query);die();
		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
    }
	
	public function getListDeactivation($page, $limit, $search="")
    {
        $lower_bound = ($page-1) * $limit;
        $upper_bound = $page * $limit;

		if($search!="")
		{
			$search = strtoupper($search);
			$search = "and(UPPER(customer_name) like '%$search%' or UPPER(BRANCH_ID) like '%$search%' or UPPER(CUSTOMER_TYPE) like '%$search%')";
		}

		$query = "SELECT * FROM 
						(SELECT a.*, ROWNUM rnum FROM 
						( SELECT a.*,b.name, TO_CHAR 
							(DEACTIVATION_DATE, 'dd-mm-yyyy hh24:mi:ss') REQUEST_DATE, 
								TO_CHAR (DEACTIVATION_DATE, 'yyyy mm dd hh24 mi ss') REQUEST_DATE_STRING, 
								TO_CHAR (SYSDATE, 'yyyy mm dd hh24 mi ss') SYSDATE_STRING 
							FROM mst_customer_deactivation a left join mst_hr_operating_units b on a.branch_id = b.branch_id and enabled_gui = 'Y' And b.simop_branch_id is not null
						WHERE 1=1 $search
						ORDER BY DEACTIVATION_DATE asc) a 
					where ROWNUM <= $upper_bound ) 
				where rnum > $lower_bound";
		

		$query 	= $this->db->query($query);
		$hasil=$query->result_array();
		return $hasil;
    }

	//customer approve
	public function approve_customer($customer_id){
		
		$query = "UPDATE MST_CUSTOMER 
				SET 
				   CUSTOMER_ID               = CUSTOMER_ID_T,
				   CUSTOMER_LABEL            = CUSTOMER_LABEL_T,
				   NAME                      = NAME_T,
				   ADDRESS                   = ADDRESS_T,
				   NPWP                      = NPWP_T,
				   EMAIL                     = EMAIL_T,
				   WEBSITE                   = WEBSITE_T,
				   PHONE                     = PHONE_T,
				   COMPANY_TYPE              = COMPANY_TYPE_T,
				   ALT_NAME                  = ALT_NAME_T,
				   DEED_ESTABLISHMENT        = DEED_ESTABLISHMENT_T,
				   CUSTOMER_GROUP            = CUSTOMER_GROUP_T,
				   CUSTOMER_TYPE             = CUSTOMER_TYPE_T,
				   SVC_VESSEL                = SVC_VESSEL_T,
				   SVC_CARGO                 = SVC_CARGO_T,
				   SVC_CONTAINER             = SVC_CONTAINER_T,
				   SVC_MISC                  = SVC_MISC_T,
				   IS_SUBSIDIARY             = IS_SUBSIDIARY_T,
				   HOLDING_NAME              = HOLDING_NAME_T,
				   EMPLOYEE_COUNT            = EMPLOYEE_COUNT_T,
				   IS_MAIN_BRANCH            = IS_MAIN_BRANCH_T,
				   PARTNERSHIP_DATE          = PARTNERSHIP_DATE_T,
				   PROVINCE                  = PROVINCE_T,
				   CITY                      = CITY_T,
				   CITY_TYPE                 = CITY_TYPE_T,
				   KECAMATAN                 = KECAMATAN_T,
				   KELURAHAN                 = KELURAHAN_T,
				   POSTAL_CODE               = POSTAL_CODE_T,
				   FAX                       = FAX_T,
				   PARENT_ID                 = PARENT_ID_T,
				   CREATE_BY                 = CREATE_BY_T,
				   CREATE_DATE               = CREATE_DATE_T,
				   CREATE_VIA                = CREATE_VIA_T,
				   CREATE_IP                 = CREATE_IP_T,
				   EDIT_BY                   = EDIT_BY_T,
				   EDIT_DATE                 = EDIT_DATE_T,
				   EDIT_VIA                  = EDIT_VIA_T,
				   EDIT_IP                   = EDIT_IP_T,
				   IS_SHIPPING_AGENT         = IS_SHIPPING_AGENT_T,
				   IS_SHIPPING_LINE          = IS_SHIPPING_LINE_T,
				   REG_TYPE                  = REG_TYPE_T,
				   IS_PBM                    = IS_PBM_T,
				   IS_FF                     = IS_FF_T,
				   IS_EMKL                   = IS_EMKL_T,
				   IS_PPJK                   = IS_PPJK_T,
				   IS_CONSIGNEE              = IS_CONSIGNEE_T,
				   REGISTRATION_COMPANY_ID   = REGISTRATION_COMPANY_ID_T,
				   HEADQUARTERS_ID           = HEADQUARTERS_ID_T,
				   HEADQUARTERS_NAME         = HEADQUARTERS_NAME_T, 
				   ACCEPTANCE_DOC         	 = ACCEPTANCE_DOC_T,
				   ACCEPTANCE_DOC_DATE       = ACCEPTANCE_DOC_DATE_T,
				   PASSPORT					 = PASSPORT_T, 
				   CITIZENSHIP				 = CITIZENSHIP_T,
				   IS_CUSTOMER				 = IS_CUSTOMER_T,
				   IS_MITRA				 	 = IS_MITRA_T,
				   IS_RUPA 			 	 	 = IS_RUPA_T
			where customer_id_t = ? ";
		$this->db->query($query,array( $customer_id ));

		$query = "UPDATE MST_CUSTOMER_BILLING_ACCOUNT
					SET    CUSTOMER_ID           = CUSTOMER_ID_T,
						   ADDRESS_BILLING       = ADDRESS_BILLING_T,
						   PROVINCE_BILLING      = PROVINCE_BILLING_T,
						   CITY_BILLING          = CITY_BILLING_T,
						   CITY_TYPE_BILLING     = CITY_TYPE_BILLING_T,
						   KECAMATAN_BILLING     = KECAMATAN_BILLING_T,
						   KELURAHAN_BILLING     = KELURAHAN_BILLING_T,
						   POSTAL_CODE_BILLING   = POSTAL_CODE_BILLING_T,
						   EMAIL_BILLING         = EMAIL_BILLING_T,
						   HQ_ID                 = HQ_ID_T,
						   BRANCH_ID             = BRANCH_ID_T,
						   BILLING_CUSTOMER_ID   = BILLING_CUSTOMER_ID_T,
						   IS_MAIN_BRANCH        = IS_MAIN_BRANCH_T,
						   CUSTOMER_ID_SEQ       = CUSTOMER_ID_SEQ_T,
						   REG_TYPE_BILLING      = REG_TYPE_BILLING_T,
						   PHONE_BILLING         = PHONE_BILLING_T,
						   CFS					 = CFS_T 
			where customer_id_t = ? or customer_id = ? ";
		$this->db->query($query,array( $customer_id,$customer_id ));
		
		$query = "UPDATE MST_CUSTOMER_BANK_ACCOUNT
					SET    BILLING_ID     = BILLING_ID_T,
						   ACCOUNT_NO     = ACCOUNT_NO_T,
						   BANK_ID       = BANK_ID_T,
						   CURRENCY      = CURRENCY_T,
						   AUTOCOLLECTION = AUTOCOLLECTION_T,
						   AUTOCOLLECTION_BARANG = AUTOCOLLECTION_BARANG_T,
						   AUTOCOLLECTION_BM_BARANG = AUTOCOLLECTION_BM_BARANG_T,
						   TOKEN_ID       = TOKEN_ID_T,
						   CMS           = CMS_T,
						   SALDO_MIN_CMS = SALDO_MIN_CMS_T,
						   BRANCH_ID    = BRANCH_ID_T
			where billing_id_t in (select billing_id_t from MST_CUSTOMER_BILLING_ACCOUNT where customer_id_t = ? ) 
				or billing_id in (select billing_id from MST_CUSTOMER_BILLING_ACCOUNT where customer_id = ? ) ";
		$this->db->query($query,array( $customer_id,$customer_id ));		

		$query = "UPDATE MST_CUSTOMER_ACCOUNT_MANAGER
				SET    TITLE_AM       = TITLE_AM_T,
					   NAME_AM        = NAME_AM_T,
					   ADDRESS_AM     = ADDRESS_AM_T,
					   PROVINCE_AM    = PROVINCE_AM_T,
					   CITY_AM        = CITY_AM_T,
					   CITY_TYPE_AM   = CITY_TYPE_AM_T,
					   KECAMATAN_AM   = KECAMATAN_AM_T,
					   KELURAHAN_AM   = KELURAHAN_AM_T,
					   POSTAL_CODE_AM = POSTAL_CODE_AM_T,
					   PHONE_AM       = PHONE_AM_T,
					   HANDPHONE_AM   = HANDPHONE_AM_T,
					   EMAIL_AM       = EMAIL_AM_T,
					   BILLING_ID     = BILLING_ID_T 
				where billing_id_t in (select billing_id_t from MST_CUSTOMER_BILLING_ACCOUNT where customer_id_t = ? ) 	 
						or billing_id in (select billing_id from MST_CUSTOMER_BILLING_ACCOUNT where customer_id = ? ) ";
		$this->db->query($query,array( $customer_id,$customer_id ));		
		
		$query = "UPDATE MST_CUSTOMER_BILLING_SITE
					SET    BILLING_ID   = BILLING_ID_T,
						   SITE_ID      = SITE_ID_T
			where billing_id_t in (select billing_id_t from MST_CUSTOMER_BILLING_ACCOUNT where customer_id_t = ? ) 
					or billing_id in (select billing_id from MST_CUSTOMER_BILLING_ACCOUNT where customer_id = ? )";
		$this->db->query($query,array( $customer_id,$customer_id ));		
		
		$query = "UPDATE MST_CUSTOMER_CEO
					SET    CUSTOMER_ID                =  CUSTOMER_ID_T,
						   NAME_CEO                   =  NAME_CEO_T,
						   ADDRESS_CEO                =  ADDRESS_CEO_T,
						   PROVINCE_CEO               =  PROVINCE_CEO_T,
						   CITY_CEO                   =  CITY_CEO_T,
						   CITY_TYPE_CEO              =  CITY_TYPE_CEO_T,
						   KECAMATAN_CEO              =  KECAMATAN_CEO_T,
						   KELURAHAN_CEO              =  KELURAHAN_CEO_T,
						   POSTAL_CODE_CEO            =  POSTAL_CODE_CEO_T,
						   PHONE_CEO                  =  PHONE_CEO_T,
						   HANDPHONE_CEO              =  HANDPHONE_CEO_T,
						   EMAIL_CEO                  =  EMAIL_CEO_T,
						   LOCATION_BIRTH_CEO         =  LOCATION_BIRTH_CEO_T,
						   DATE_BIRTH_CEO             =  DATE_BIRTH_CEO_T,
						   NATIONALITY_CEO            =  NATIONALITY_CEO_T,
						   KTP_CEO                    =  KTP_CEO_T,
						   PASSPORT_CEO               =  PASSPORT_CEO_T,
						   SEX_CEO                    =  SEX_CEO_T,
						   RELIGION_CEO               =  RELIGION_CEO_T,
						   CUSTOMER_ID_SEQ            =  CUSTOMER_ID_SEQ_T,
						   KTP_EXPIRE_DATE_CEO        =  KTP_EXPIRE_DATE_CEO_T,
						   PASSPORT_EXPIRE_DATE_CEO   =  PASSPORT_EXPIRE_DATE_CEO_T
			where customer_id_t = ? ";
		$this->db->query($query,array( $customer_id ));		
		
		$query = "UPDATE MST_CUSTOMER_BOD
					SET    CUSTOMER_ID       = CUSTOMER_ID_T,
						   NAME_BOD          = NAME_BOD_T,
						   TITLE_BOD         = TITLE_BOD_T,
						   ADDRESS_BOD       = ADDRESS_BOD_T,
						   PROVINCE_BOD      = PROVINCE_BOD_T,
						   CITY_BOD          = CITY_BOD_T,
						   CITY_TYPE_BOD     = CITY_TYPE_BOD_T,
						   KECAMATAN_BOD     = KECAMATAN_BOD_T,
						   KELURAHAN_BOD     = KELURAHAN_BOD_T,
						   POSTAL_CODE_BOD   = POSTAL_CODE_BOD_T,
						   PHONE_BOD         = PHONE_BOD_T,
						   HANDPHONE_BOD     = HANDPHONE_BOD_T,
						   EMAIL_BOD         = EMAIL_BOD_T
			where customer_id_t = ? or customer_id = ?";
		$this->db->query($query,array( $customer_id,$customer_id ));		
		
		$query = "UPDATE MST_CUSTOMER_NON_PBM
					SET    THREE_PARTIED_CODE    = THREE_PARTIED_CODE_T,
						   SIUJPT                = SIUJPT_T,
						   SIUJPT_EXPIRED_DATE   = SIUJPT_EXPIRED_DATE_T,
						   TDG                   = TDG_T,
						   ALFI                  = ALFI_T,
						   CUSTOMER_ID           = CUSTOMER_ID_T
			where customer_id_t = ? ";
		$this->db->query($query,array( $customer_id ));		
		
		$query = "UPDATE MST_CUSTOMER_PBM
					SET    THREE_PARTIED_CODE    = THREE_PARTIED_CODE_T,
						   BRANCH_ID             = BRANCH_ID_T,
						   SIUPBM                = SIUPBM_T,
						   SIUPBM_PUBLISH_DATE   = SIUPBM_PUBLISH_DATE_T,
						   APBMI                 = APBMI_T,
						   CUSTOMER_ID         = CUSTOMER_ID_T
			where customer_id_t = ? ";
		$this->db->query($query,array( $customer_id ));		
		
		$query = "UPDATE MST_CUSTOMER_PIC
					SET    CUSTOMER_ID       = CUSTOMER_ID_T,
						   BRANCH_ID         = BRANCH_ID_T,
						   NAME_PIC          = NAME_PIC_T,
						   KTP_PIC           = KTP_PIC_T,
						   RELIGION_PIC      = RELIGION_PIC_T,
						   ADDRESS_PIC       = ADDRESS_PIC_T,
						   PROVINCE_PIC      = PROVINCE_PIC_T,
						   CITY_PIC          = CITY_PIC_T,
						   CITY_TYPE_PIC     = CITY_TYPE_PIC_T,
						   KECAMATAN_PIC     = KECAMATAN_PIC_T,
						   KELURAHAN_PIC     = KELURAHAN_PIC_T,
						   POSTAL_CODE_PIC   = POSTAL_CODE_PIC_T,
						   PHONE_PIC         = PHONE_PIC_T,
						   HANDPHONE_PIC     = HANDPHONE_PIC_T,
						   EMAIL_PIC         = EMAIL_PIC_T
			where customer_id_t = ? or customer_id = ? ";
		$this->db->query($query,array( $customer_id,$customer_id ));		
		
		$query = "UPDATE MST_CUSTOMER_SHP_AGT
					SET    THREE_PARTIED_CODE     = THREE_PARTIED_CODE_T,
						   SIAPDEL                = SIAPDEL_T,
						   SIAPDEL_EXPIRE_DATE    = SIAPDEL_EXPIRE_DATE_T,
						   INSA_MEMBER_NO         = INSA_MEMBER_NO_T,
						   SKPT                   = SKPT_T,
						   SIUPAL                 = SIUPAL_T,
						   SIUPAL_PUBLISH_DATE    = SIUPAL_PUBLISH_DATE_T,
						   SIUPAL_EXPIRE_DATE     = SIUPAL_EXPIRE_DATE_T,
						   SIOPSUS                = SIOPSUS_T,
						   SIOPSUS_PUBLISH_DATE   = SIOPSUS_PUBLISH_DATE_T,
						   SIOPSUS_EXPIRE_DATE    = SIOPSUS_EXPIRE_DATE_T,
						   SIUPKK                 = SIUPKK_T,
						   SIUPKK_PUBLISH_DATE    = SIUPKK_PUBLISH_DATE_T,
						   SIUPKK_EXPIRE_DATE     = SIUPKK_EXPIRE_DATE_T,						   
						   ROUTE_TRAMPER          = ROUTE_TRAMPER_T,
						   ROUTE_LINER            = ROUTE_LINER_T,
						   CUSTOMER_ID            = CUSTOMER_ID_T,
						   CUSTOMER_ID_SEQ        = CUSTOMER_ID_SEQ_T,
						   ADDRESS                = ADDRESS_T,
						   NPWP                   = NPWP_T,
						   BRANCH_ID              = BRANCH_ID_T,
						   EXTERNAL_ID            = EXTERNAL_ID_T,
						   SKTD_PUBLISH_DATE      = SKTD_PUBLISH_DATE_T,
						   SKTD_CREATED_DATE      = SKTD_CREATED_DATE_T,
						   SKTD                   = SKTD_T,
						   SKTD_START             = SKTD_START_T,
						   SKTD_END               = SKTD_END_T
			where customer_id_t = ? ";
		$this->db->query($query,array( $customer_id ));

		$query = "UPDATE MST_CUSTOMER_PPJK_CONSG
					SET    
					   PPJK_ID      = PPJK_ID_T,
					   CONSIGNEE_ID = CONSIGNEE_ID_T,
					   CREATED_DATE = CREATED_DATE_T,
					   EXPIRED_DATE = EXPIRED_DATE_T,
					   CREATE_USER  = CREATE_USER_T,
					   EDIT_USER    = EDIT_USER_T,
					   EDIT_DATE    = EDIT_DATE_T,
					   BRANCH_ID      =  BRANCH_ID_T 
			where PPJK_ID_T = ? ";
		$this->db->query($query,array( $customer_id ));
		

		
		$query 	= "update mst_customer set status_approval = 'P', status_customer = 'A', approve_date = sysdate where customer_id_t = ? ";
		$this->db->query($query,array( $customer_id ));
	}
	
	public function check_approve($customer_id){
		$t = $this->getAccess();
		$query 	= "select status_approval from mst_customer where customer_id$t= ? ";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$row = $result->row_array();
			return $row['STATUS_APPROVAL'];
		}
		else{
			return "failed";	
		}
	}	
	
	public function get_registration_company_id($customer_id){
		$query 	= "select registration_company_id_t registration_company_id from mst_customer where customer_id_t= ? ";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$row = $result->row_array();
			return $row['REGISTRATION_COMPANY_ID'];
		}
		else{
			return "failed";	
		}
	}
	
	//reject request
	public function rejectRequest($cust_num,$reject_notes,$userid="")
	{
		$query = "update mst_customer set status_approval='R',
							REJECT_NOTES = ? ,  REJECT_USER = ?, REJECT_DATE = sysdate  
							where CUSTOMER_ID_T = ?";
		$this->db->query($query, array($reject_notes, $userid, $cust_num));

		return "Success";
	}
	
	//for comparison old vs new 
	public function read_customer_all($customer_id){
		$query 	= "select 
						customer_id_t,
						a.name_t, address_t, npwp_t, email_t, website_t, 
						phone_t, company_type_t, alt_name_t, to_char(deed_establishment_t, 'dd-mm-yyyy') deed_establishment_t,
						customer_group_t, svc_vessel_t, svc_cargo_t,
						svc_container_t, svc_misc_t, is_subsidiary_t, holding_name_t,
						employee_count_t, is_main_branch_t,  
						to_char(partnership_date_t, 'yyyy') partnership_date_t,
						province_t, city_t, kecamatan_t, kelurahan_t, postal_code_t,
						fax_t, parent_id_t, is_shipping_agent_t, is_shipping_line_t,
						is_pbm_t,is_ff_t,is_emkl_t,is_ppjk_t,is_consignee_t,
						reg_type_t, headquarters_id_t, headquarters_name_t,
						ACCEPTANCE_DOC_t, to_char(ACCEPTANCE_DOC_DATE_t, 'dd-mm-yyyy') ACCEPTANCE_DOC_DATE_t,
						REGISTRATION_COMPANY_ID_t, 
						b.name NAMA_CABANG,
						customer_id,
						a.name, address, npwp, email, website, 
						phone, company_type, alt_name, to_char(deed_establishment, 'dd-mm-yyyy') deed_establishment,
						customer_group, svc_vessel, svc_cargo,
						svc_container, svc_misc, is_subsidiary, holding_name,
						employee_count, is_main_branch,  
						to_char(partnership_date, 'yyyy') partnership_date,
						province, city, kecamatan, kelurahan, postal_code,
						fax, parent_id, is_shipping_agent, is_shipping_line,
						is_pbm,is_ff,is_emkl,is_ppjk,is_consignee,
						reg_type, headquarters_id, headquarters_name,
						ACCEPTANCE_DOC, to_char(ACCEPTANCE_DOC_DATE, 'dd-mm-yyyy') ACCEPTANCE_DOC_DATE,
						REGISTRATION_COMPANY_ID 
					from mst_customer a left join MST_HR_OPERATING_UNITS b on b.ORGANIZATION_ID = a.REGISTRATION_COMPANY_ID_t 
					where customer_id_t = ?";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			return $result->row_array();
		}
		else{
			return "";	
		}
	}
	
	public function read_customer_cfs_all($customer_id){
		$query 	= "select b.billing_customer_id, a.* 
					from mst_customer_billing_account b, mst_customer a 
						left join MST_HR_OPERATING_UNITS c on c.ORGANIZATION_ID = a.REGISTRATION_COMPANY_ID 
					where a.customer_id = ? and a.customer_id = b.customer_id and b.cfs = 'Y' and b.branch_id = '01' 
							and b.billing_customer_id is not null";
		$result	= $this->db->query($query,array( $customer_id ));
		
		if($result->num_rows() > 0){
			return $result->row_array();
		}
		else{
			return "";	
		}
	}	
	
	public function is_customer_cfs($customer_id){
		$query 	= "select b.billing_customer_id, a.* 
					from mst_customer_billing_account b, mst_customer a 
						left join MST_HR_OPERATING_UNITS c on c.ORGANIZATION_ID = a.REGISTRATION_COMPANY_ID 
					where a.customer_id = ? and a.customer_id = b.customer_id and b.cfs = 'Y' and b.branch_id = '01'";
		$result	= $this->db->query($query,array( $customer_id ));
		
		if($result->num_rows() > 0){
			return true;
		}
		else{
			return false;
		}
	}		
	
	public function set_sync_cfs_only($customer_id)
	{
		$query 	= "update mst_customer set sync_cfs_only = 'Y' where customer_id = ?";
		$result	= $this->db->query($query,array( $customer_id ));
	}
	
	public function set_success_sync_cfs($customer_id)
	{
		$query 	= "update mst_customer set sync_cfs_only = '', STATUS_APPROVAL = 'A' where customer_id = ?";
		$result	= $this->db->query($query,array( $customer_id ));		
	}

	public function get_sync_cfs_status($customer_id){
		$query 	= "select 
						sync_cfs_only  
					from mst_customer
					where customer_id = ? AND status_approval IN ('A')";
		$result	= $this->db->query($query,array( $customer_id ));

		if($result->num_rows() > 0){
			$result = $result->row_array();
			return $result['SYNC_CFS_ONLY'];
		}
	}
	
	public function set_cfs_sync_y($customer_id)
	{
		$query 	= "update mst_customer set sync_cfs_only = 'Y' where customer_id = ?";
		$result	= $this->db->query($query,array( $customer_id ));		
	}	
	
	
	public function read_billing_account_all($customer_id){
		$query = "select 
						customer_id_t, customer_id,
						address_billing_t, address_billing, 
						province_billing_t, province_billing, 
						city_billing_t, city_billing, 
						kecamatan_billing_t, kecamatan_billing, 
						kelurahan_billing_t, kelurahan_billing, 
						postal_code_billing_t, postal_code_billing, 
						phone_billing_t, phone_billing, 
						email_billing_t, email_billing,
						hq_id_t, hq_id, 
						branch_id_t, branch_id, 
						billing_customer_id_t, billing_customer_id, 
						is_main_branch_t, is_main_branch, 
						reg_type_billing_t, reg_type_billing
					from mst_customer_billing_account
					where customer_id_t = ? or customer_id = ?";
		
		return $this->db->query($query,array( $customer_id, $customer_id ))->result("array");
	}

	public function read_bank_all($customer_id){
		$query	= "select 
						account_no_t, account_no,
						currency_t, currency,
						autocollection_t, autocollection,
						autocollection_barang_t, autocollection_barang,
						autocollection_bm_barang_t, autocollection_bm_barang,
						cms_t, cms,
						token_id_t, token_id,
						ctx_t.context_text BANK_NAME_T, ctx.context_text BANK_NAME 
					from mst_customer_bank_account bk
					left join mst_context_options ctx_t on ctx_t.context_value = bk.bank_id_t
					left join mst_context_options ctx on ctx.context_value = bk.bank_id 
					where bk.billing_id_t in (select billing_id from mst_customer_billing_account where customer_id_t = ? ) 
					and ctx_t.context_type='BANK'";
					
		return $this->db->query($query,array( $customer_id,$customer_id ))->result("array");
	}

	public function read_am_all($customer_id){
		$query	= "select 
						title_am_t, title_am, 
						name_am_t, name_am, 
						address_am_t, address_am, 
						province_am_t, province_am, city_am_t, city_am, city_type_am_t, city_type_am, 
						kecamatan_am_t, kecamatan_am, kelurahan_am_t, kelurahan_am, postal_code_am_t, postal_code_am, 
						phone_am_t, phone_am, handphone_am_t, handphone_am, email_am_t, email_am 
					from mst_customer_account_manager 
					where billing_id_t in (select billing_id from mst_customer_billing_account where customer_id_t = ? )
						or billing_id in (select billing_id from mst_customer_billing_account where customer_id = ? )";

		return $this->db->query($query,array( $customer_id,$customer_id ))->result("array");
	}

	public function read_ceo_all($customer_id){
		$query = "select 
                       NAME_CEO_T, NAME_CEO, 
					   ADDRESS_CEO_T, ADDRESS_CEO, 
					   PROVINCE_CEO_T, PROVINCE_CEO, 
					   CITY_CEO_T, CITY_CEO, 
					   CITY_TYPE_CEO_T, CITY_TYPE_CEO, 
					   KECAMATAN_CEO_T, KECAMATAN_CEO, KELURAHAN_CEO_T, KELURAHAN_CEO, POSTAL_CODE_CEO_T, POSTAL_CODE_CEO, 
					   PHONE_CEO_T, PHONE_CEO, HANDPHONE_CEO_T, HANDPHONE_CEO, EMAIL_CEO_T, EMAIL_CEO, LOCATION_BIRTH_CEO_T, LOCATION_BIRTH_CEO, 
					   to_char(date_birth_ceo_t, 'dd-mm-yyyy') DATE_BIRTH_CEO_T, to_char(date_birth_ceo, 'dd-mm-yyyy') DATE_BIRTH_CEO, 
					   NATIONALITY_CEO_T, NATIONALITY_CEO, KTP_CEO_T, KTP_CEO, PASSPORT_CEO_T, PASSPORT_CEO, SEX_CEO_T, SEX_CEO, RELIGION_CEO_T, RELIGION_CEO,
					   to_char(KTP_EXPIRE_DATE_CEO_T, 'dd-mm-yyyy') KTP_EXPIRE_DATE_CEO_T, to_char(KTP_EXPIRE_DATE_CEO, 'dd-mm-yyyy') KTP_EXPIRE_DATE_CEO, 
					   to_char(PASSPORT_EXPIRE_DATE_CEO_T, 'dd-mm-yyyy') PASSPORT_EXPIRE_DATE_CEO_T, to_char(PASSPORT_EXPIRE_DATE_CEO, 'dd-mm-yyyy') PASSPORT_EXPIRE_DATE_CEO
                    from MST_CUSTOMER_CEO 
					where CUSTOMER_ID_T = ?";
		
		return $this->db->query($query, array($customer_id))->row_array();
	}
	
	public function read_bod_all($customer_id){	
		$query = "select 
                        title_bod_t, title_bod, name_bod_t, name_bod, address_bod_t, address_bod,
						province_bod_t, province_bod, city_bod_t, city_bod, city_type_bod_t, city_type_bod, kecamatan_bod_t, kecamatan_bod, 
						kelurahan_bod_t, kelurahan_bod,
						postal_code_bod_t, postal_code_bod, phone_bod_t, phone_bod, handphone_bod_t, handphone_bod, email_bod_t, email_bod 
                    from mst_customer_bod
					where customer_id_t = ? or customer_id = ?";
		return $this->db->query($query,array( $customer_id,$customer_id ))->result("array");
	}
	
	public function shiping_agent_all($customer_id){ 
		$query = "select 
						three_partied_code_t, three_partied_code, siapdel_t, siapdel, 
						to_char(siapdel_expire_date_t, 'dd-mm-yyyy') siapdel_expire_date_t, to_char(siapdel_expire_date, 'dd-mm-yyyy') siapdel_expire_date, 
						insa_member_no_t, insa_member_no, skpt_t, skpt,
						siupal_t, siupal,
						to_char(siupal_publish_date_t, 'dd-mm-yyyy') siupal_publish_date_t, to_char(siupal_publish_date, 'dd-mm-yyyy') siupal_publish_date, 
						to_char(siupal_expire_date_t, 'dd-mm-yyyy') siupal_expire_date_t, to_char(siupal_expire_date, 'dd-mm-yyyy') siupal_expire_date,
						siopsus_t, siopsus, 
						to_char(siopsus_publish_date_t, 'dd-mm-yyyy') siopsus_publish_date_t, to_char(siopsus_publish_date, 'dd-mm-yyyy') siopsus_publish_date, 
						to_char(siopsus_expire_date_t, 'dd-mm-yyyy') siopsus_expire_date_t, to_char(siopsus_expire_date, 'dd-mm-yyyy') siopsus_expire_date,
						route_tramper_t, route_tramper, route_liner_t, route_liner, customer_id_t, customer_id, 
						npwp_t, npwp, address_t, address, branch_id_t, branch_id, external_id_t, external_id,
						sktd_t, sktd, 
						to_char(sktd_publish_date_t, 'dd-mm-yyyy') sktd_publish_date_t, to_char(sktd_publish_date, 'dd-mm-yyyy') sktd_publish_date, 
						to_char(sktd_created_date_t, 'dd-mm-yyyy') sktd_created_date_t, to_char(sktd_created_date, 'dd-mm-yyyy') sktd_created_date, 
						to_char(sktd_start_t, 'dd-mm-yyyy') sktd_start_t, to_char(sktd_start, 'dd-mm-yyyy') sktd_start, 
						to_char(sktd_end_t, 'dd-mm-yyyy') sktd_end_t, to_char(sktd_end, 'dd-mm-yyyy') sktd_end  
					from mst_customer_shp_agt where customer_id_t = ?";
		
		return $this->db->query($query, array($customer_id))->row_array();
	}
	
	public function pbm_all($customer_id){
		$query = "select 
						three_partied_code_t, three_partied_code, siupbm_t, siupbm, 
						to_char(siupbm_publish_date_t, 'dd-mm-yyyy') siupbm_publish_date_t, to_char(siupbm_publish_date, 'dd-mm-yyyy') siupbm_publish_date, 
						apbmi_t, apbmi 
					from mst_customer_pbm where customer_id_t = ?";
				
		return $this->db->query($query, array($customer_id))->row_array();
	}
	
	public function non_pbm_all($customer_id){
		$query = "select 
						three_partied_code_t, three_partied_code, siujpt_t, siujpt, 
						to_char(siujpt_expired_date_t, 'dd-mm-yyyy') siujpt_expired_date_t, 
						to_char(siujpt_expired_date, 'dd-mm-yyyy') siujpt_expired_date, 
						tdg_t, tdg, alfi_t, alfi 
					from mst_customer_non_pbm where customer_id_t = ?";
				
		return $this->db->query($query, array($customer_id))->row_array();
	}	
	
	public function ppjk_consignee_all($customer_id){
		$query = "SELECT 
						PPJK_ID, CONSIGNEE_ID, 
					   CREATED_DATE, EXPIRED_DATE, CREATE_USER, 
					   EDIT_USER, EDIT_DATE, 
					   PPJK_ID_T, CONSIGNEE_ID_T, 
					   CREATED_DATE_T, EXPIRED_DATE_T, CREATE_USER_T, 
					   EDIT_USER_T, EDIT_DATE_T, 
					   BRANCH_ID, BRANCH_ID_T 
					FROM MST_CUSTOMER_PPJK_CONSG where PPJK_ID_T = ? or PPJK_ID = ?";
				
		return $this->db->query($query, array($customer_id,$customer_id ))->result("array");
	}
	
	public function read_pic_all($customer_id){
		$t = $this->getAccess();
		$query = "select name_pic_t, name_pic, ktp_pic_t, ktp_pic, religion_pic_t, religion_pic,
						address_pic_t, address_pic, province_pic_t, province_pic, city_pic_t, city_pic,
						city_type_pic_t, city_type_pic, kecamatan_pic_t, kecamatan_pic, kelurahan_pic_t, kelurahan_pic, postal_code_pic_t, postal_code_pic, 
						phone_pic_t, phone_pic, handphone_pic_t, handphone_pic, email_pic_t, email_pic
					from mst_customer_pic where customer_id_t = ? or customer_id = ?";
		
		return $this->db->query($query,array( $customer_id,$customer_id ))->result("array");
	}
	
	//get customer hierarchy
	public function read_customer_hq($customer_id){
		$t = $this->getAccess();
		$query 	= "select b.name$t name, b.customer_id$t customer_id  
					from mst_customer a, mst_customer b 
					where a.customer_id$t = ? and a.headquarters_id$t=b.customer_id";
					
		return $this->db->query($query,array( $customer_id ))->row_array();
	}
	
	public function read_customer_branch($customer_id){
		$t = $this->getAccess();
		$query 	= "select name$t name, customer_id$t customer_id    
					from mst_customer 
					where headquarters_id$t = ?";
		return $this->db->query($query,array( $customer_id ))->result("array");
	}
	
	public function read_customer_child($customer_id){
		$t = $this->getAccess();
		$query 	= "select name$t name, customer_id$t customer_id    
					from mst_customer 
					where parent_id$t = ?";
		return $this->db->query($query,array( $customer_id ))->result("array");
	}
	
	//moved to analytics model
	//public function get_revenue($customer_id,$year,$month)	
	//public function get_throughput($customer_id,$year,$month)
	
	public function get_customer_name($customer_id){
		$t = $this->getAccess();
		$query 	= "select 
						name$t name 
					from mst_customer
					where customer_id$t = ?";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$result = $result->row_array();
			return $result['NAME'];
		}
	}
	
	public function get_customer_registration_company_id($customer_id){
		$query 	= "select 
						registration_company_id 
					from mst_customer
					where customer_id = ?";
		$result	= $this->db->query($query,array( $customer_id ));	
		
		if($result->num_rows() > 0){
			$result = $result->row_array();
			return $result['REGISTRATION_COMPANY_ID'];
		}
	}
	
	public function sign_customer($customer_id,$data){
		$query 	= "update mst_customer set branch_sign = ? where customer_id = ?";
		$result	= $this->db->query($query,array( $data,$customer_id ));
	}	
	
	
	public function getCustomer_location($context, $language)	{

		$query = "	select organization_id VALUE, name TEXT, enabled_gui 
					from mst_hr_operating_units 
					where 
						enabled_gui = 'Y' 
					order by simop_branch_id";
		
		return $this->db->query($query,array($context, $language));

	}	
	
	public function getCustomerBankAutocollectionByCustomerID($customer_id, $branch_id)	{

		$query = "SELECT ACCOUNT_NO,BANK_ID FROM mst_customer_bank_account where billing_id in (select billing_id from mst_customer_billing_account where billing_customer_id = ? and branch_id = ?)
    and autocollection_barang = 'Y'";
		
		return $this->db->query($query,array($customer_id, $branch_id))->row_array();

	}	
	//public function get_customer_rank($start_month,$end_month,$sort_by,$branch,$custtype) moved to analytics_model
	
	
	//-------------------------------------------------------------------
	
	public function get_ppjk_consignee_list($customer_id, $branch_id){
		$t = $this->getAccess();
		
		$query = "select id, 
						pp.ppjk_id$t PPJK_ID, a.name$t PPJK_NAME, 
						pp.consignee_id$t CONSIGNEE_ID, b.name$t CONSIGNEE_NAME, 
						expired_date$t EXPIRED_DATE,
						c.name branch 
					from MST_CUSTOMER_PPJK_CONSG pp
						inner join mst_customer a on a.customer_id$t = pp.ppjk_id$t
						inner join mst_customer b on b.customer_id = pp.consignee_id$t 
						left join mst_hr_operating_units c on c.branch_id=pp.branch_id
					where pp.ppjk_id$t = ?";					
					// * b.customer_id without $t to ensure only approved customer can be assigned as consignee
					
		return $this->db->query($query,array( $customer_id));			
		//return $query; die;
	}

	public function count_consignee_ppjk($ppjk_id,$consignee_id){
		$query	= "SELECT count(1) counter from MST_CUSTOMER_PPJK_CONSG where PPJK_ID_T = '$ppjk_id' and CONSIGNEE_ID_T = '$consignee_id'";
		$result	= $this->db->query($query);
		$row	= $result->row_array();

		return $row['COUNTER'];
	}
	
	public function create_ppjk_consignee($params){
		$query = "INSERT INTO MST_CUSTOMER_PPJK_CONSG (
						PPJK_ID_T, CONSIGNEE_ID_T, CREATED_DATE_T, EXPIRED_DATE_T,
						CREATE_USER_T, BRANCH_ID_T)
					VALUES (?, ?, sysdate, to_date(?,'dd-mm-yyyy'), ?, ?)";
					
		return $this->db->query($query, $params);
		//return $query;
	}
	
	public function delete_ppjk_consg($id){
		$this->db->trans_start();
		$t = $this->getAccess();		
		$query = "update MST_CUSTOMER_PPJK_CONSG set 
						PPJK_ID$t		= '', 
						CONSIGNEE_ID$t = ''
					 where id = ?";
			$this->db->query($query, array($id));
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function update_ppjk_consignee($params){
		$this->db->trans_start();
		$t = $this->getAccess();		
		echo $query = "update MST_CUSTOMER_PPJK_CONSG set 
						EXPIRED_DATE$t		= to_date(?,'dd-mm-yyyy')  
					 where id = ?";
			$this->db->query($query, $params);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}
	
	public function view_detail_ppjk_consignee($id){	
		$t = $this->getAccess();
		$query	= "SELECT ID,
						PPJK_ID$t PPJK_ID,
						CONSIGNEE_ID$t CONSIGNEE_ID,
						b.name CONSIGNEE_NAME,
						to_char(EXPIRED_DATE$t,'dd-mm-yyyy') EXPIRED_DATE,
						BRANCH_ID$t BRANCH_ID
					FROM MST_CUSTOMER_PPJK_CONSG	a
					inner join mst_customer b on a.consignee_id$t = b.customer_id
					where id = ?";
		return $this->db->query($query,array($id));
	}	
	
	public function getConsigneeOfPPJKList($customer_id){
		$t = $this->getAccess();
		$query	= "SELECT
						CONSIGNEE_ID,
						b.name,
						to_char(a.EXPIRED_DATE,'dd-mm-yyyy') EXPIRED_DATE,
						to_char(a.CREATED_DATE,'dd-mm-yyyy') CREATED_DATE,
						a.BRANCH_ID
					FROM MST_CUSTOMER_PPJK_CONSG	a 
					left join mst_customer_billing_account c on c.customer_id=a.ppjk_id 
					left join mst_customer b on a.consignee_id = b.customer_id
					where c.billing_customer_id = ? 
					";
		if($customer_id!="")
			return $this->db->query($query,array($customer_id,$customer_id))->result_array();
		else 
			return null;
	}

	public function getConsigneeOfPPJK($customer_id, $consignee)
	{
		$query = "select d.billing_customer_id CONSIGNEE_ID, pc.created_date, pc.expired_date, pc.notes, mc.name, mc.npwp, e.name branch_name
				from MST_CUSTOMER_PPJK_CONSG pc
				left join mst_customer mc on pc.consignee_id = mc.customer_id 
				left join mst_customer_billing_account c on c.customer_id=pc.ppjk_id 
				left join mst_customer_billing_account d on d.customer_id = pc.consignee_id 
				left join mst_hr_operating_units e on e.branch_id = d.branch_id and e.enabled_gui = 'Y'
				where c.billing_customer_id = ? and mc.name like ? and pc.PPJK_ID_T is not null
					UNION 
				SELECT d.billing_customer_id CONSIGNEE_ID, 
				sysdate created_date, sysdate expired_date, '' notes,
				b.name, b.npwp, e.name branch_name
				FROM MST_CUSTOMER b 
				left join mst_customer_billing_account d on d.customer_id=b.customer_id 
				left join mst_hr_operating_units e on e.branch_id = d.branch_id and e.enabled_gui = 'Y'
				where d.billing_customer_id = ? and b.name like ? ";

		$query 	= $this->db->query($query, array($customer_id, "%".$consignee."%",$customer_id, "%".$consignee."%"));
		$hasil=$query->result_array();
		return $hasil;
	}	
}?>