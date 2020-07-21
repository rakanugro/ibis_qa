<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start();
class Misc_tools extends CI_Controller {	

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url'); 
		$this->load->helper('form');
		$this->load->helper('my_options_helper');

		$this->load->helper('cookie');
		$this->load->library('form_validation'); 
		$this->load->library("table");
		$this->load->model('user_model');
		$this->load->model('ticket_model');
		$this->load->model('options_model');
		// $this->load->model('container_model');
		$this->load->library("Nusoap_lib");
		$this->load->library("commonlib");
		$this->load->library('table');
		$this->load->library('ciqrcode');
		$this->load->library('breadcrumbs');
		$this->load->helper('MY_language_helper');
		$this->load->library('session');
		$this->load->model('auth_model','auth_model');
		
		require_once(APPPATH.'libraries/htmLawed.php');
		
	}	

	public function common_loader($data,$views)
	{
		//$this->output->set_header('X-FRAME-OPTIONS: DENY'); 
		$this->load->view('templates/header', $data);
		$this->load->view('templates/top_bar', $data);
		$this->load->view('templates/menu_side', $data);
		$this->load->view('templates/top-1-breadcrumb', $data);
		$this->load->view('templates/top-2-title-nosearch', $data);
		$this->load->view($views, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		if(!isset($data)) $data = array();

		if (!empty($_POST))
		{
			$port 			= $_POST['port'];
			$portname 		= $_POST['portname'];
			$ReqNum			= substr($this->session->userdata('uname_phd'),0,11);//$_POST['txReqNum'];
			$Service		= $_POST['cboService'];
			$TL				= $_POST['cboTL'];
			$eta			= substr($_POST['eta'],-2).'-'.substr($_POST['eta'],5,2).'-'.substr($_POST['eta'],0,4);
			$etb			= substr($_POST['etb'],-2).'-'.substr($_POST['etb'],5,2).'-'.substr($_POST['etb'],0,4);
			// $start_shift	= $_POST['start_shift'];
			// $end_shift		= $_POST['end_shift'];
			$grid			= $_POST['txGrd'];
			$html			= "";
			$total			= 0;
			$adm			= 0;
			$materai		= 0;

			switch($Service)
			{
				case 'receiving':
					$reqNoBiller = $ReqNum;//$this->container_model->getNumberRequestBiller($ReqNum);

					$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<detail>
								<port>$port</port>
								<reqnum>$reqNoBiller</reqnum>
								<tl>$TL</tl>
								<eta>$eta</eta>
								<etb>$etb</etb>
								<start_shift>$start_shift</start_shift>
								<end_shift>$end_shift</end_shift>
								<grid>$grid</grid>
								<uid>".$this->session->userdata('uname_phd')."</uid>
							</detail>
						</data>
					</root>";

					if(!$this->nusoap_lib->call_wsdl(REQUEST_RECEIVING_CONTAINER, "tariffSimulation", array("in_data" => "$in_data"), $result))
					{
						print_r($result);die;
					}
					else
					{
						// print_r($result);die;
						$obj = json_decode($result);

						if($obj->data->status=='OK')
						{
							if (count($obj->data->rets) > 0)
							{
								$x=0;
								for($i=0;$i < count($obj->data->rets);$i++)
								{
									if ($obj->data->rets[$i]->keterangan != 'ADM')
									{
										$html .= "
										<tr>
											<td>".($x==0 ? ($i + 1) : ($x + 1))."</td><td>" . $obj->data->rets[$i]->keterangan . "</td><td>" . $obj->data->rets[$i]->size . "</td><td>" . $obj->data->rets[$i]->oog . "</td><td>" . $obj->data->rets[$i]->type . "</td><td>" . $obj->data->rets[$i]->status . "</td><td>" . $obj->data->rets[$i]->hz . "</td><td>" . $obj->data->rets[$i]->jumlah_cont . "</td><td>" . $obj->data->rets[$i]->jumlah_hari . "</td><td align='right'>" . number_format($obj->data->rets[$i]->tarif,2,",",".") . "</td><td align='right'>" . number_format($obj->data->rets[$i]->sub_total,2,",",".") . "</td>
										</tr>";
									} else {
										$x = $i;
									}
									$total += $obj->data->rets[$i]->sub_total;
									if ($obj->data->rets[$i]->keterangan == 'ADM') $adm += $obj->data->rets[$i]->sub_total;
									if ($obj->data->rets[$i]->keterangan == 'MATERAI') $materai += $obj->data->rets[$i]->sub_total;
								}
							} else {
								$html .= "
								<tr colspan=10>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
								</tr>";
							}
							$data['html'] = $html;
							$data['total'] = $total;
							$data['adm'] = $adm;
							$data['materai'] = $materai;
						} else {
							$data['out'] = 'Not OK';
						}
					}
					break;
				case 'delivery': case 'delivery_ext':
					$reqNoBiller 	= $ReqNum;//$this->container_model->getNumberRequestBiller($ReqNum);
					$jnsreq			= ($Service == 'delivery' ? 'NEW' : 'EXT');

					$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<detail>
								<port>$port</port>
								<reqnum>$reqNoBiller</reqnum>
								<tl>$TL</tl>
								<eta>$eta</eta>
								<etb>$etb</etb>";
					if($jnsreq=='EXT') 
						$in_data .= "<etb2>" . substr($_POST['etb2'],-2).'-'.substr($_POST['etb2'],5,2).'-'.substr($_POST['etb2'],0,4) . "</etb2>"; 
					else 
						$in_data .= "<etb2>" . $etb . "</etb2>";

					$in_data .=	"<start_shift>$start_shift</start_shift>
								<end_shift>$end_shift</end_shift>
								<jnsreq>$jnsreq</jnsreq>
								<grid>$grid</grid>
								<uid>".$this->session->userdata('uname_phd')."</uid>
							</detail>
						</data>
					</root>";
// die($in_data);
					if(!$this->nusoap_lib->call_wsdl(REQUEST_DELIVERY_CONTAINER, "tariffSimulation", array("in_data" => "$in_data"), $result))
					{
						echo $result;
						die;
					}
					else
					{
						// print_r($result);die;
						$obj = json_decode($result);

						if($obj->data->status=='OK')
						{
							if (count($obj->data->rets) > 0)
							{
								$x=0;
								for($i=0;$i < count($obj->data->rets);$i++)
								{
									if($obj->data->rets[$i]->keterangan != 'ADM')
									{
										$html .= "
										<tr>
											<td>".($x==0 ? ($i + 1) : ($x + 1))."</td><td>" . $obj->data->rets[$i]->keterangan . "</td><td>" . $obj->data->rets[$i]->size . "</td><td>" . $obj->data->rets[$i]->oog . "</td><td>" . $obj->data->rets[$i]->type . "</td><td>" . $obj->data->rets[$i]->status . "</td><td>" . $obj->data->rets[$i]->hz . "</td><td>" . $obj->data->rets[$i]->jumlah_cont . "</td><td>" . $obj->data->rets[$i]->jumlah_hari . "</td><td align='right'>" . number_format($obj->data->rets[$i]->tarif,2,",",".") . "</td><td align='right'>" . number_format($obj->data->rets[$i]->sub_total,2,",",".") . "</td>
										</tr>";
									} else {
										$x = $i;
									}
									$total += $obj->data->rets[$i]->sub_total;
									if ($obj->data->rets[$i]->keterangan == 'ADM') $adm += $obj->data->rets[$i]->sub_total;
									if ($obj->data->rets[$i]->keterangan == 'MATERAI') $materai += $obj->data->rets[$i]->sub_total;
								}
							} else {
								$html .= "
								<tr>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
								</tr>";
							}

							$data['html'] = $html;
							$data['total'] = $total;
							$data['adm'] = $adm;
							$data['materai'] = $materai;
						} else {
							$data['out'] = 'Not OK';
						}
					}
					break;
				case 'loading_cancel_before':
					$reqNoBiller 	= $ReqNum;

					$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<detail>
								<port>$port</port>
								<reqnum>$reqNoBiller</reqnum>
								<tl>$TL</tl>
								<eta>".date('d-m-Y')."</eta>
								<etb>".date('d-m-Y', mktime(0, 0, 0, date('m'), date('d') + 5, date('Y')))."</etb>
								<etb2>".date('d-m-Y', mktime(0, 0, 0, date('m'), date('d') + 5, date('Y')))."</etb2>
								<start_shift>$start_shift</start_shift>
								<end_shift>$end_shift</end_shift>
								<jnsreq>B</jnsreq>
								<grid>$grid</grid>
								<uid>".$this->session->userdata('uname_phd')."</uid>
							</detail>
						</data>
					</root>";
// die($in_data);
					if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT, "tariffSimulation", array("in_data" => "$in_data"), $result))
					{
						echo $result;
						die;
					}
					else
					{
						// print_r($result);die;
						$obj = json_decode($result);

						if($obj->data->status=='OK')
						{
							if (count($obj->data->rets) > 0)
							{
								$x=0;
								for($i=0;$i < count($obj->data->rets);$i++)
								{
									if($obj->data->rets[$i]->keterangan != 'ADM')
									{
										$html .= "
										<tr>
											<td>".($x==0 ? ($i + 1) : ($x + 1))."</td><td>" . $obj->data->rets[$i]->keterangan . "</td><td>" . $obj->data->rets[$i]->size . "</td><td>" . $obj->data->rets[$i]->oog . "</td><td>" . $obj->data->rets[$i]->type . "</td><td>" . $obj->data->rets[$i]->status . "</td><td>" . $obj->data->rets[$i]->hz . "</td><td>" . $obj->data->rets[$i]->jumlah_cont . "</td><td>" . $obj->data->rets[$i]->jumlah_hari . "</td><td align='right'>" . number_format($obj->data->rets[$i]->tarif,2,",",".") . "</td><td align='right'>" . number_format($obj->data->rets[$i]->total,2,",",".") . "</td>
										</tr>";
									} else {
										$x = $i;
									}
									$total += $obj->data->rets[$i]->total;
									if ($obj->data->rets[$i]->keterangan == 'ADM') $adm += $obj->data->rets[$i]->total;
									if ($obj->data->rets[$i]->keterangan == 'MATERAI') $materai += $obj->data->rets[$i]->total;
								}
							} else {
								$html .= "
								<tr>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
								</tr>";
							}

							$data['html'] = $html;
							$data['total'] = $total;
							$data['adm'] = $adm;
							$data['materai'] = $materai;
						}
					}
					break;
				case 'loading_cancel_after':
					$reqNoBiller 	= $ReqNum;

					$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<detail>
								<port>$port</port>
								<reqnum>$reqNoBiller</reqnum>
								<tl>$TL</tl>
								<eta>$eta</eta>
								<etb>$etb</etb>
								<etb2>" . substr($_POST['etb2'],-2).'-'.substr($_POST['etb2'],5,2).'-'.substr($_POST['etb2'],0,4) . "</etb2>
								<start_shift>$start_shift</start_shift>
								<end_shift>$end_shift</end_shift>
								<jnsreq>A</jnsreq>
								<grid>$grid</grid>
								<uid>".$this->session->userdata('uname_phd')."</uid>
							</detail>
						</data>
					</root>";
// die($in_data);
					if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT, "tariffSimulation", array("in_data" => "$in_data"), $result))
					{
						echo $result;
						die;
					}
					else
					{
						// var_dump(json_encode($result));die;
						$obj = json_decode($result);

						if($obj->data->status=='OK')
						{
							if (count($obj->data->rets) > 0)
							{
								$x=0;
								for($i=0;$i < count($obj->data->rets);$i++)
								{
									if($obj->data->rets[$i]->keterangan != 'ADM')
									{
										$html .= "
										<tr>
											<td>".($x==0 ? ($i + 1) : ($x + 1))."</td><td>" . $obj->data->rets[$i]->keterangan . "</td><td>" . $obj->data->rets[$i]->size . "</td><td>" . $obj->data->rets[$i]->oog . "</td><td>" . $obj->data->rets[$i]->type . "</td><td>" . $obj->data->rets[$i]->status . "</td><td>" . $obj->data->rets[$i]->hz . "</td><td>" . $obj->data->rets[$i]->jumlah_cont . "</td><td>" . $obj->data->rets[$i]->jumlah_hari . "</td><td align='right'>" . number_format($obj->data->rets[$i]->tarif,2,",",".") . "</td><td align='right'>" . number_format($obj->data->rets[$i]->total,2,",",".") . "</td>
										</tr>";
									} else {
										$x = $i;
									}
									$total += $obj->data->rets[$i]->total;
									if ($obj->data->rets[$i]->keterangan == 'ADM') $adm += $obj->data->rets[$i]->total;
									if ($obj->data->rets[$i]->keterangan == 'MATERAI') $materai += $obj->data->rets[$i]->total;
								}
							} else {
								$html .= "
								<tr>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
								</tr>";
							}

							$data['html'] = $html;
							$data['total'] = $total;
							$data['adm'] = $adm;
							$data['materai'] = $materai;
						}
					}
					break;
				case 'loading_cancel_delivery':
					$reqNoBiller 	= $ReqNum;

					$in_data="<root>
						<sc_type>1</sc_type>
						<sc_code>123456</sc_code>
						<data>
							<detail>
								<port>$port</port>
								<reqnum>$reqNoBiller</reqnum>
								<tl>$TL</tl>
								<eta>$eta</eta>
								<etb>$etb</etb>
								<etb2>" . substr($_POST['etb2'],-2).'-'.substr($_POST['etb2'],5,2).'-'.substr($_POST['etb2'],0,4) . "</etb2>
								<start_shift>$start_shift</start_shift>
								<end_shift>$end_shift</end_shift>
								<jnsreq>D</jnsreq>
								<grid>$grid</grid>
								<uid>".$this->session->userdata('uname_phd')."</uid>
							</detail>
						</data>
					</root>";
// die($in_data);
					if(!$this->nusoap_lib->call_wsdl(REQUEST_BATALMUAT, "tariffSimulation", array("in_data" => "$in_data"), $result))
					{
						echo $result;
						die;
					}
					else
					{
						// print_r($result);die;
						$obj = json_decode($result);

						if($obj->data->status=='OK')
						{
							if (count($obj->data->rets) > 0)
							{
								$x=0;
								for($i=0;$i < count($obj->data->rets);$i++)
								{
									if($obj->data->rets[$i]->keterangan != 'ADM')
									{
										$html .= "
										<tr>
											<td>".($x==0 ? ($i + 1) : ($x + 1))."</td><td>" . $obj->data->rets[$i]->keterangan . "</td><td>" . $obj->data->rets[$i]->size . "</td><td>" . $obj->data->rets[$i]->oog . "</td><td>" . $obj->data->rets[$i]->type . "</td><td>" . $obj->data->rets[$i]->status . "</td><td>" . $obj->data->rets[$i]->hz . "</td><td>" . $obj->data->rets[$i]->jumlah_cont . "</td><td>" . $obj->data->rets[$i]->jumlah_hari . "</td><td align='right'>" . number_format($obj->data->rets[$i]->tarif,2,",",".") . "</td><td align='right'>" . number_format($obj->data->rets[$i]->total,2,",",".") . "</td>
										</tr>";
									} else {
										$x = $i;
									}
									$total += $obj->data->rets[$i]->total;
									if ($obj->data->rets[$i]->keterangan == 'ADM') $adm += $obj->data->rets[$i]->total;
									if ($obj->data->rets[$i]->keterangan == 'MATERAI') $materai += $obj->data->rets[$i]->total;
								}
							} else {
								$html .= "
								<tr>
									<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
								</tr>";
							}

							$data['html'] = $html;
							$data['total'] = $total;
							$data['adm'] = $adm;
							$data['materai'] = $materai;
						}
					}
					break;
				default:
					break;
			}

			$data['port'] 		= $portname;
			$data['Service'] 	= str_replace('_',' ',$Service);
			$data['TL']			= $TL;
			$data['eta']		= $eta;
			$data['etb']		= $etb;
			if($_POST['etb2']!= null)
				$data['etb2']	= $_POST['etb2'];
			$data['start_shift']= $start_shift;
			$data['end_shift']	= $end_shift;

			$form = 'pages/misc_tools/tariff_sim_result';
			$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		} else {
			$form = 'pages/misc_tools/tariff_sim';
			$data['terminal'] = $this->user_model->get_terminalList($this->session->userdata('sub_group_phd'));
		}

		$this->common_loader($data,$form);
	}

	public function setformval($base, $alt='')
	{
		return isset($base)? htmLawed($base) : $alt;
	}

	public function add_receiving_header()
	{

		if(isset($_POST['submit_header'])){
			$inv_char 	= array("&", "\"", "'", "<", ">");
			$fix_char		= array(" ", " ", " ", " ", " ");
			$customer_id=$this->session->userdata('customerid_phd');
			$customer_name=$this->session->userdata('customername_phd');
			$customer_address=$this->session->userdata('address_phd');
			$customer_address = base64_encode($customer_address);
			$customer_npwp=$this->session->userdata('npwp_phd');

			$vessel=$this->setformval($_POST['vessel']);
			$peb_no=$this->setformval($_POST['peb_no']);
			$npe_no=$this->setformval($_POST['npe_no']);
			$booking_ship_no=$this->setformval($_POST['booking_ship_no']);
			$gate_in_date=$this->setformval($_POST['gate_in_date']);
			$port=$this->setformval($_POST['port']);
			$ukk=$this->setformval($_POST['ukk']);
			$pod=$this->setformval($_POST['pod']);
			$fpod=$this->setformval($_POST['fpod']);
			$pod_name=$this->setformval($_POST['pod_name']);
			$fpod_name=$this->setformval($_POST['fpod_name']);
			$trading_type=$this->setformval($_POST['trading_type']);
			$request_no=$this->setformval($_POST['request_no']);
			$receiving_type=$this->setformval($_POST['receiving_type']);
			$start_shift=$this->setformval($_POST['start_shift']);
			$end_shift=$this->setformval($_POST['end_shift']);
			$peb_dt=$this->setformval($_POST['peb_dt']);
			$voyin=$this->setformval($_POST['voyin']);
			$voyout=$this->setformval($_POST['voyout']);
			$nospp=$this->setformval($_POST['nospp']);
			$nosppdom=$this->setformval($_POST['nosppdom']);
			$nosuratjalan=$this->setformval($_POST['nosuratjalan']);
			$bookingship009=$this->setformval($_POST['bookingship009']);
			$bookingshipdom=$this->setformval($_POST['bookingshipdom']);
			
			$eta=$this->setformval($_POST['eta']);
			$etb=$this->setformval($_POST['etb']);
			$etd=$this->setformval($_POST['etd']);
			$start_stack=$this->setformval($_POST['start_stack']);
			$open_stack=$this->setformval($_POST['openstack']);
			$closing_time=$this->setformval($_POST['closing']);
			
			//declare form validation pemesanan penerimaan default
			$config = array(
				array(
					'field' => 'port',
					'label' => 'Terminal',
					'rules' => 'required'
				),
				array(
					'field' => 'end_shift',
					'label' => 'End Shift Reefer',
					'rules' => 'required'
				),
				array(
					'field' => 'trading_type',
					'label' => 'Type of Trade',
					'rules' => 'required'
				),
				array(
					'field' => 'receiving_type',
					'label' => 'Receiving Type',
					'rules' => 'required'
				)
			);
			
			//default response
			$response = array();
			$response['data'] = array();
			
			if($this->input->post()) {
				$this->form_validation->set_rules($config); //setting rules inputan pemesanan penerimaan

				if($this->form_validation->run() == false) {
					$response['rcmsg'] = 'Isian form tidak lengkap';
					echo json_encode($response);
					die;
				}
			}

			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<header>
						<peb_no>$peb_no</peb_no>
						<npe_no>$npe_no</npe_no>
						<booking_ship_no>$booking_ship_no</booking_ship_no>
						<gate_in_date>$gate_in_date</gate_in_date>
						<customer_id>$customer_id</customer_id>
						<customer_name>$customer_name</customer_name>
						<customer_npwp>$customer_npwp</customer_npwp>
						<customer_address>$customer_address</customer_address>
						<port>$port</port>
						<ukk>$ukk</ukk>
						<pod>$pod</pod>
						<fpod>$fpod</fpod>
						<pod_name>$pod_name</pod_name>
						<fpod_name>$fpod_name</fpod_name>
						<trading_type>$trading_type</trading_type>
						<request_no>$request_no</request_no>
						<receiving_type>$receiving_type</receiving_type>
						<start_shift>$start_shift</start_shift>
						<end_shift>$end_shift</end_shift>
						<id_user>".$this->session->userdata('userid_simop')."</id_user>
						<id_user_eservice>".$this->session->userdata('uname_phd')."</id_user_eservice>
						<vessel>$vessel</vessel>
						<voyage_in>$voyin</voyage_in>
						<voyage_out>$voyout</voyage_out>
						<nospp>$nospp</nospp>
						<nosppdom>$nosppdom</nosppdom>
						<nosuratjalan>$nosuratjalan</nosuratjalan>
						<bookingship009>$bookingship009</bookingship009>
						<bookingshipdom>$bookingshipdom</bookingshipdom>
						<peb_dt>$peb_dt</peb_dt>
						<eta>$eta</eta>
						<etb>$etb</etb>
						<etd>$etd</etd>
						<start_stack>$start_stack</start_stack>
						<open_stack>$open_stack</open_stack>
						<closing_time>$closing_time</closing_time>
					</header>
				</data>
			</root>";
			injek($in_data);

			if(!$this->nusoap_lib->call_wsdl(TARIFF_SIMULATION,"requestReceivingHeader",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				echo $result;
				exit;

				$obj = json_decode($result);


				if($obj->data->info)
				{
					/*$data['no_container'] = $obj->data->request_no;*/
				}
			}
		}

	}

	public function add_receiving_detail()
	{
		if(isset($_POST['submit_container'])){
			$inv_char 	= array("&", "\"", "'", "<", ">");
			$fix_char		= array(" ", " ", " ", " ", " ");

			$request_no=$this->setformval($_POST['request_no']);
			$container_qty=$this->setformval($_POST['container_qty']);
			$container_no=$this->setformval($_POST['container_no']);
			$container_size=$this->setformval($_POST['container_size']);
			$container_type=$this->setformval($_POST['container_type']);
			$container_status=$this->setformval($_POST['container_status']);
			$container_height=$this->setformval($_POST['container_height']);
			$container_weight=$this->setformval($_POST['container_weight']);
			$container_operator=$this->setformval($_POST['container_operator']);
			$container_dangerous=$this->setformval($_POST['container_dangerous']);
			$container_transit=$this->setformval($_POST['container_transit']);
			$number_booking_ship=$this->setformval($_POST['number_booking_ship']);
			$container_imo=$this->setformval($_POST['container_imo']);
			$container_un=$this->setformval($_POST['container_un']);
			$container_temperature=$this->setformval($_POST['container_temperature']);
			$container_excess_width=$this->setformval($_POST['container_excess_width']);
			$container_excess_height=$this->setformval($_POST['container_excess_height']);
			$container_excess_length=$this->setformval($_POST['container_excess_length']);
			$trading_type=$this->setformval($_POST['trading_type']);
			$carrier   =$this->setformval($_POST['carrier']);
			$port   =$this->setformval($_POST['port']);
			$commodity   =$this->setformval($_POST['commodity']);
			$tl_type=$this->setformval($_POST['tl_type']);
			$vgm=$this->setformval($_POST['vgm']);
			$is_vgm=$this->setformval($_POST['is_vgm']);
			$nor=$this->setformval($_POST['nor'], 'N');

			$in_data="<root>
				<sc_type>1</sc_type>
				<sc_code>123456</sc_code>
				<data>
					<detail>
						<request_no>$request_no</request_no>
						<container_qty>$container_qty</container_qty>
						<container_no>$container_no</container_no>
						<size>$container_size</size>
						<type>$container_type</type>
						<status>$container_status</status>
						<height>$container_height</height>
						<weight>$container_weight</weight>
						<operator>$container_operator</operator>
						<dangerous>$container_dangerous</dangerous>
						<transit>$container_transit</transit>
						<booking_ship>$number_booking_ship</booking_ship>
						<imo>$container_imo</imo>
						<un>$container_un</un>
						<temperature>$container_temperature</temperature>
						<excess_width>$container_excess_width</excess_width>
						<excess_height>$container_excess_height</excess_height>
						<excess_length>$container_excess_length</excess_length>
						<trading_type>$trading_type</trading_type>
						<carrier>$carrier</carrier>
						<port>$port</port>
						<commodity>$commodity</commodity>
						<tl_type>$tl_type</tl_type>
						<nor>$nor</nor>
						<vgm>$vgm</vgm>
					</detail>
				</data>
			</root>";
			injek($in_data);

			if(!$this->nusoap_lib->call_wsdl(TARIFF_SIMULATION,"requestReceivingDetail",array("in_data" => "$in_data"),$result))
			{
				echo $result;
				die;
			}
			else
			{
				echo $result;die;
				exit;

				$obj = json_decode($result);
			}
		}
	
	}

    public function getListContainer()
	{
        $norequest = ($_POST["request_no"]);
        $port = explode("-",($_POST["port"]));
        $reply = array();

        $stack = array();
        $in_data = "<root>
			<sc_type>1</sc_type>
			<sc_code>123456</sc_code>
			<data>
				<norequest>$norequest</norequest>
				<port_code>".$port[0]."</port_code>
				<terminal_code>".$port[1]."</terminal_code>
			</data>
		</root>";
		injek($in_data);

		if(!$this->nusoap_lib->call_wsdl(TARIFF_SIMULATION,"getListContainer",array("in_data" => "$in_data"),$result))
		{
			echo $result;
			die;
		}
		else
		{
			$obj = json_decode($result);
			//echo $result;die;
			if($obj->data->listcont)
			{
				for($i=0;$i<count($obj->data->listcont);$i++)
				{
					$temp;
					$temp['NO_CONTAINER']=$obj->data->listcont[$i]->no_container;
					$temp['SIZE_CONT']=$obj->data->listcont[$i]->size_cont;
					$temp['TYPE_CONT']=$obj->data->listcont[$i]->type_cont;
					$temp['STATUS_CONT']=$obj->data->listcont[$i]->status_cont;
					$temp['HZ']=$obj->data->listcont[$i]->hz;
					$temp['KD_COMODITY']=$obj->data->listcont[$i]->kd_comodity;
					$temp['NM_COMMODITY']=$obj->data->listcont[$i]->nm_commodity;
					$temp['ID_CONT']=$obj->data->listcont[$i]->id_cont;
					$temp['ISO_CODE']=$obj->data->listcont[$i]->iso_code;
					$temp['HEIGHT']=$obj->data->listcont[$i]->height;
					$temp['CARRIER']=$obj->data->listcont[$i]->carrier;
					$temp['OG']=$obj->data->listcont[$i]->og;
					$temp['NO_BOOKING_SHIP']=$obj->data->listcont[$i]->no_booking_ship;
					$temp['TL_FLAG']=$obj->data->listcont[$i]->tl_flag;

					array_push($stack, $temp);
				}
			}
		}

        //print_r($stack); die();
        $data['detail'] = $stack;
		$data['no_request'] = $norequest;
        $this->load->view('pages/container/get_detail_receiving', $data);
    }

}
