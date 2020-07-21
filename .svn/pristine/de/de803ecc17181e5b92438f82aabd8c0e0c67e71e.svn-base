<?php
class Analytics_model extends CI_Model {

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
	}


	public function get_revenue_month_per_service($customer_id,$year,$month){
		
		$query = "select   
					CASE 
						 WHEN service_type like '%KPL%' then 'Kapal'
						WHEN service_type like '%PTKM%' then 'Petikemas'
						ELSE  'Non Petikemas' 
					 END service_type,CASE 
						 WHEN service_type like '%KPL%' then 1
						WHEN service_type like '%PTKM%' then 2
						ELSE 3
					 END orderservice,sum(revenue) revenue from customer_data_staging_revenue where customer_id = ? and year = ? and month = ? group by (CASE          
						WHEN service_type like '%KPL%' then 'Kapal'
						WHEN service_type like '%PTKM%' then 'Petikemas'
						ELSE  'Non Petikemas' 
					 END), (CASE 
						 WHEN service_type like '%KPL%' then 1
						WHEN service_type like '%PTKM%' then 2
						ELSE 3
					 END) order by orderservice";
					 
		$result = $this->db->query($query,array($customer_id,$year,$month));
		
		return $result->result("array");
	}
	
	public function get_revenue_month_per_location($customer_id,$year,$month){
		
		$query = "select   
					b.name location,sum(revenue) revenue from customer_data_staging_revenue a 
					left join mst_hr_operating_units b on b.organization_id = a.branch_id where customer_id = ? and year = ? and month = ? group by 
					b.name";
					 
		$result = $this->db->query($query,array($customer_id,$year,$month));
		
		return $result->result("array");
	}
		
	
	public function get_revenue($customer_id,$year,$month){
		
		$query = "SELECT COALESCE ( (select sum(revenue) 
						from customer_data_staging_revenue 
						where customer_id = ? and year = ? and month = ?
						group by customer_id, year, month), 0) total from dual";
		$result = $this->db->query($query,array($customer_id,$year,$month));
		
		$row = $result->row_array();
		return  $row['TOTAL'];
	}

	public function get_revenue2($customer_id,$start_date,$end_date){
		
		$query = "select sum(revenue) total from CUSTOMER_DATA_STAGING_REVENUE where customer_id = ? and to_date('01-'||month||'-'||year,'dd-mm-yyyy') 
                        between to_date(?,'dd-mm-yyyy')  and to_date(?,'dd-mm-yyyy') 
                       group by customer_id";
		//echo $customer_id.$start_date.$end_date;
		$result = $this->db->query($query,array($customer_id,$start_date,$end_date));
		
		$row = $result->row_array();
		return  $row['TOTAL'];
	}
	
	public function get_throughput($customer_id,$year,$month){
		
		$query = "SELECT COALESCE ( (select sum(throughput) 
						from customer_data_staging_thrghpt 
						where customer_id = ? and year = ? and month = ?
						group by customer_id, year, month), 0) total from dual";
		$result = $this->db->query($query,array($customer_id,$year,$month));
		
		$row = $result->row_array();
		return  $row['TOTAL'];
	}

	public function get_throughput2($customer_id,$start_date,$end_date){
		
		$query = "select sum(throughput) total from customer_data_staging_thrghpt where customer_id = ? and to_date('01-'||month||'-'||year,'dd-mm-yyyy') 
                        between to_date(?,'dd-mm-yyyy')  and to_date(?,'dd-mm-yyyy') 
                       group by customer_id";
		$result = $this->db->query($query,array($customer_id,$start_date,$end_date));
		
		$row = $result->row_array();
		return  $row['TOTAL'];
	}
	
	public function get_customer_rank($start_month,$end_month,$sort_by,$branch,$custtype,$service_type,$showtop){
		$branch_search = "";
		/*if($branch == "83")//priok
		{
			$branch_search = " and a.branch_id in ('83','1822','1823','1824','1825','1826')";
		}
		else */
		
		if($branch!="ALL"&&$branch!="PTP"&&$branch!="TP"
			&&$branch!="IPCTPK"&&$branch!="TBR"&&$branch!="PNK"&&$branch!="JMB")
		{
			$branch_search = " and a.branch_id = '$branch'";
		}
		else if($branch=="PTP")
		{
			$branch_search = " and a.branch_id IN ('1822','1823','1824','1825','1826')";
		}
		else if($branch=="TP")
		{
			$branch_search = " and a.branch_id IN ('83','1822','1823','1824','1825','1826')";
		}
		else if($branch=="IPCTPK")
		{
			$branch_search = " and a.branch_id IN ('1827','1828','1829','2102')";
		}
		else if($branch=="TBR")
		{
			$branch_search = " and a.branch_id IN ('86','1829')";
		}
		else if($branch=="PNK")
		{
			$branch_search = " and a.branch_id IN ('88','1828')";
		}
		else if($branch=="JMB")
		{
			$branch_search = " and a.branch_id IN ('89','2102')";
		}
		
		$cust_join = ""; $cust_search = "";
		if ($custtype!="ALL"){
			$cust_join = " inner join mst_customer xx on xx.customer_id = a.customer_id ";

			if($custtype=="SHIPA"){
				$cust_search = " and xx.is_shipping_agent = 'Y' ";				
			}
			else if($custtype=="STVCO"){
				$cust_search = " and xx.is_pbm = 'Y' ";				
			}
			else if($custtype=="CONSG"){
				$cust_search = " and xx.is_consignee = 'Y' ";	
			}
			else if($custtype=="EMKL"){
				$cust_search = " and xx.is_emkl = 'Y' ";				
			}
		}
		
		if($service_type!="")
		{
			if(strtoupper($service_type)=="VESSE")
			{
				$service_search =" and b.SVC_VESSEL$t = 'Y'";
			}
			else if(strtoupper($service_type)=="CONGC")
			{
				$service_search =" and (b.svc_cargo$t = 'Y' or b.SVC_CONTAINER$t = 'Y')";
			}
			else if(strtoupper($service_type)=="MISC")
			{
				$service_search =" and b.svc_misc$t = 'Y'";
			} 
		}		
		
		if($sort_by=="REV")
		{
			$query = "select * from (select a.customer_id, b.name, sum(revenue) REVENUE, sum(THROUGHPUT) THROUGHPUT, d.name  registration_branch 
							from customer_data_staging_revenue a 
								$cust_join
								left join mst_customer b on a.customer_id = b.customer_id 
								left join MST_HR_OPERATING_UNITS d on a.branch_id = d.ORGANIZATION_ID  
								left join CUSTOMER_DATA_STAGING_THRGHPT c on c.customer_id = a.customer_id and c.year = a.year and c.month=a.month 
							where to_date(CONCAT(CONCAT('01', LPAD(a.month, 2, '0')),a.year),'ddmmyyyy') between TO_DATE ('01-$start_month', 'dd-mm-yyyy') 
							and TO_DATE ('01-$end_month', 'dd-mm-yyyy') $branch_search $cust_search $service_search
							group by a.customer_id,b.name, d.name 
							order by revenue desc) where ROWNUM <= $showtop";	
		}
		else if($sort_by=="THR")
		{
			$query = "select * from (select a.customer_id, b.name, sum(revenue) REVENUE, sum(THROUGHPUT) THROUGHPUT, d.name registration_branch 
							from CUSTOMER_DATA_STAGING_THRGHPT a 
								$cust_join
								left join mst_customer b on a.customer_id = b.customer_id 
								left join MST_HR_OPERATING_UNITS d on nvl(b.registration_company_id,'83') = d.ORGANIZATION_ID 
								left join customer_data_staging_revenue c on c.customer_id = a.customer_id and c.year = a.year and c.month=a.month 
							where to_date(CONCAT(CONCAT('01', LPAD(a.month, 2, '0')),a.year),'ddmmyyyy') between TO_DATE ('01-$start_month', 'dd-mm-yyyy') 
							and TO_DATE ('01-$end_month', 'dd-mm-yyyy') $branch_search $cust_search $service_search
							group by a.customer_id,b.name, d.name 
							order by THROUGHPUT desc) where ROWNUM <= $showtop";		
		}
		
		//echo $query; die;
		
		$result = $this->db->query($query);
		
		return $result->result("array");
	}
	
	
}
?>