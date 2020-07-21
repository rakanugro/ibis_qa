<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

//session_start();
class ecare extends CI_Controller
{

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
        $this->load->model('customer_registration_model');
        $this->load->model('ticket_model');
        $this->load->model('options_model');
        $this->load->library("Nusoap_lib");
        $this->load->library('breadcrumbs');
        $this->load->helper('MY_language_helper');
        $this->load->library('session');
        require_once(APPPATH . 'libraries/htmLawed.php');
        //if(!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2))) show_error(YOU_DONT_HAVE_ACCESS);

        $this->load->model('auth_model', 'auth_model');
        // if (!$this->user_model->check_user_access($this->session->userdata('group_phd'), $this->uri->segment(1), $this->uri->segment(2)))
        //     redirect(ROOT . 'mainpage', 'refresh');

    }

    public function common_loader($data, $views)
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

    // Added by EDII
    public function get_login_sf()
    {

        $url = "http://10.88.56.18/crm_api_dev/login.php";
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"http://10.88.56.18/crm_api_dev/login.php");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "postvar1=value1&postvar2=value2&postvar3=value3");

        // In real life you should use something like:
        // curl_setopt($ch, CURLOPT_POSTFIELDS, 
        //          http_build_query(array('postvar1' => 'value1')));

        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        curl_close ($ch);

        $decode_json = json_decode($output);
        $serverUrl = $decode_json->serverUrl;
        $sessionId = $decode_json->sessionId;

        $return_data['url'] = $serverUrl;
        $return_data['token'] = $sessionId;
        $new_sess = array(
            'ss_token' => $return_data['token'],
            'ss_url' => $return_data['url'],
            'uname_phd' => $this->session->userdata('uname_phd')
        );

        $this->session->set_userdata($new_sess);
        return $return_data;

    }

    public function post_to_sf($url, $data_array)
    {   
        $url = $url;
        $data = $data_array;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$data);


        // Receive server response ...
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($ch);

        curl_close ($ch);
        $return_data['output_status'] = json_decode($output); 
        
        return $return_data;
    }

    // End added by EDII

    public function index($ticket_number = "")
    {
//        print_r($this->session->all_userdata());
//        die;
        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        if ($ticket_number == "opennpending") {
            $search = "opennpending";
            $ticket_number = "";
        }

        {
            $edit_view_link = '<a  class=\'btn btn-primary\'  href=\'' . ROOT . 'npkbilling/ecare/index/{TICKET_NUMBER}\'><i class=\'fa fa-pencil\'></i></a>';
            if ($this->session->userdata('group_phd') != 'p' && $this->session->userdata('group_phd') != '8' && $this->session->userdata('group_phd') != 'm')//user
            {
                $this->table->set_heading('No', 'Nomor Tiket', 'Judul', 'Tipe', 'Waktu Pembuatan', 'Status', 'EDIT', 'Respon Terakhir');
                $max_row = "200";
                $result = $this->ticket_model->getTicketByUserName($this->session->userdata('uname_phd'), $max_row);
                $i = 1;
                foreach ($result as $row) {
                    $status = $this->security->xss_clean($this->options_model->getContent('TICKETSTATUS', 'ID', $row['TICKET_STATUS']));
                    $type = $this->security->xss_clean($this->options_model->getContent('TICKETTYPE', 'ID', $row['TICKET_TYPE']));
                    $this->table->add_row(
                        $i++,
                        $this->security->xss_clean($row['TICKET_NUMBER']),
                        $this->security->xss_clean($row['TICKET_TITLE']),
                        $type,
                        $this->security->xss_clean($row['TICKET_SUBMIT_DATE']),
                        $status,
                        str_replace("{TICKET_NUMBER}", $this->security->xss_clean($row['TICKET_NUMBER']), $edit_view_link),
                        urldecode($this->security->xss_clean($row['CS']))
                    );
                }
            } else //p = helpdesk admin
            {
                $this->table->set_heading('No', 'Nomor Tiket', 'Judul', 'Tipe', 'Waktu Pembuatan', 'Status', 'Cabang', 'Pengguna', 'Pelanggan', 'Lihat', 'Respon Terakhir');
                $max_row = "200";
                $branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
                $result = $this->ticket_model->getTicketHelpdesk($search, $branch_id);

                $i = 1;
                foreach ($result as $row) {
                    $status = $this->security->xss_clean($this->options_model->getContent('TICKETSTATUS', 'ID', $row['TICKET_STATUS']));
                    $type = $this->security->xss_clean($this->options_model->getContent('TICKETTYPE', 'ID', $row['TICKET_TYPE']));
                    $this->table->add_row(
                        $i++,
                        $this->security->xss_clean($row['TICKET_NUMBER']),
                        $this->security->xss_clean($row['TICKET_TITLE']),
                        $type,
                        $this->security->xss_clean($row['TICKET_SUBMIT_DATE']),
                        $status,
                        $this->security->xss_clean($row['BRANCH']),
                        $this->security->xss_clean($row['NAME']),
                        $this->security->xss_clean($row['CUSTOMER_NAME']),
                        str_replace("{TICKET_NUMBER}", $this->security->xss_clean($row['TICKET_NUMBER']), $edit_view_link),
                        urldecode($this->security->xss_clean($row['CS']))
                    );
                }
            }
        }

        //form section
        {
            if ($ticket_number == "")//new ticket form
            {
                $data['sub_title'] = 'Membuat Tiket Baru';
                $data['ticket_data'] = array(
                    'TICKET_TITLE' => '',
                    'REQUEST_NUMBER' => '',
                    'TICKET_STATUS' => '',
                    'TICKET_MESSAGE' => '',
                    'TICKET_ATTACHMENT_FILE_NAME' => '',
                    'INTERACTION_SERVICE' => '',
                    'TICKET_TYPE' => '',
                    'TICKET_SERVICE' => ''
                );
                $data['form_readonly'] = '';
                $data['form_mode'] = 'new_ticket';
                $data['action'] = ROOT . 'npkbilling/ecare/create_ticket';
                $data['submit_button'] = '<button type="submit" class="btn btn-success">Simpan</button>';
                $data['sub_sub_title']="";
            } else//view edit form
            {
                $data['opt_status'] = rsArrToOptArr($this->options_model->getOptions('TICKETSTATUS', 'ID')->result('array'));
                $data['ticket_data'] = $this->ticket_model->getTicketDetailbyTicketNumber($ticket_number);
                $data['channel'] = $this->security->xss_clean($this->options_model->getContent('TICKETCHANNEL', 'ID', $data['ticket_data']['TICKET_CHANNEL']));
                $data['type'] = $this->security->xss_clean($this->options_model->getContent('TICKETTYPE', 'ID', $data['ticket_data']['TICKET_TYPE']));
                //                Test Fikri
                $data['service'] = $this->security->xss_clean($this->options_model->getContent('SERVICETYPE', 'ID', $data['ticket_data']['SERVICETYPE']));
                $data['interaction'] = $this->security->xss_clean($this->options_model->getContent('INTERACTIONTYPE', 'ID', $data['ticket_data']['INTERACTIONTYPE']));
                //                 -- Fikri END --
                $folderfile = $data['folderfile'] = 'upload_customer_care';
                // $data['file_link'] = APP_ROOT.$folderfile."/".$data['ticket_data']['TICKET_ATTACHMENT_FILE_NAME'];
                $data['file_link'] = $data['ticket_data']['TICKET_ATTACHMENT_FILE_NAME'];
                if ($this->session->userdata('group_phd') == 'p' || $this->session->userdata('group_phd') == '8') {
                    if ($data['ticket_data']['TICKET_STATUS'] == "N") {
                        $data['ticket_data']['TICKET_STATUS'] = "O";
                    }
                }
                $data['ticket_message'] = $this->ticket_model->getTicketMessagebyTicketNumber($ticket_number);
                $data['form_readonly'] = 'readonly';
                $data['form_mode'] = 'update_ticket';
                $data['sub_title'] = 'Lihat Tiket - <font color="blue"><b>' . htmlentities($data['ticket_data']['TICKET_NUMBER']) . '</b></font>&nbsp&nbsp&nbsp<font size="3"> ( ' . htmlentities($data['ticket_data']['TICKET_SUBMIT_DATE']) . ' ) </font>';
                $data['sub_sub_title'] = "<h3><b>" . htmlentities($data['ticket_data']['CUSTOMER_NAME']) . " / " . htmlentities($data['ticket_data']['NAME']) . "</b></h3>";
                $data['action'] = ROOT . 'npkbilling/ecare/create_ticket_message/' . $ticket_number;
                $data['submit_button'] = '';
            }
            $data['opt_type'] = rsArrToOptArr($this->options_model->getOptions('TICKETTYPE', 'ID')->result('array'));
            $data['opt_channel'] = rsArrToOptArr($this->options_model->getOptions('TICKETCHANNEL', 'ID')->result('array'));
            //            Test Fikri
            $data['opt_service'] = rsArrToOptArr($this->options_model->getOptions('SERVICETYPE', 'ID')->result('array'));
            $data['opt_interaction'] = rsArrToOptArr($this->options_model->getOptions('INTERACTIONTYPE', 'ID')->result('array'));
            //            -- Fikri End --
        }

        $data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

        $this->breadcrumbs->push('Pelanggan', 'customer');
        $this->breadcrumbs->push('Tiket', '/');
        $this->breadcrumbs->unshift('Home', '/');
        $data['breadcrumbs'] = $this->breadcrumbs->show();

        $data['title'] = 'Tiket Masalah';

        $this->common_loader($data, 'npkbilling/ecare/ticket');
    }

    public function search_ticket()
    {

        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        $search = trim($_POST['search']);

        //table grid section
        {
            $edit_view_link = '<a  class=\'btn btn-primary\'  href=\'' . ROOT . 'ecare/index/{TICKET_NUMBER}\'><i class=\'fa fa-pencil\'></i></a>';
            if ($this->session->userdata('group_phd') != 'p' && $this->session->userdata('group_phd') != '8' && $this->session->userdata('group_phd') != 'm')//user
            {
                $this->table->set_heading('No', 'Nomor Tiket', 'Judul', 'Tipe', 'Waktu Pembuatan', 'Status', 'Lihat');
                $max_row = "200";
                $result = $this->ticket_model->getTicketByUserName($this->session->userdata('uname_phd'), $max_row, $search);

                $i = 1;
                foreach ($result as $row) {
                    $status = $this->security->xss_clean($this->options_model->getContent('TICKETSTATUS', 'ID', $row['TICKET_STATUS']));
                    $type = $this->security->xss_clean($this->options_model->getContent('TICKETTYPE', 'ID', $row['TICKET_TYPE']));
                    $this->table->add_row(
                        $i++,
                        $this->security->xss_clean($row['TICKET_NUMBER']),
                        $this->security->xss_clean($row['TICKET_TITLE']),
                        $type,
                        $this->security->xss_clean($row['TICKET_SUBMIT_DATE']),
                        $status,
                        str_replace("{TICKET_NUMBER}", $this->security->xss_clean($row['TICKET_NUMBER']), $edit_view_link)
                    );
                }
            } else //p = helpdesk admin
            {
                $this->table->set_heading('No', 'Nomor Tiket', 'Judul', 'Tipe', 'Waktu Pembuatan', 'Status', 'Cabang', 'Pengguna', 'Pelanggan', 'Lihat');
                $max_row = "200";
                $branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
                $result = $this->ticket_model->getTicketHelpdesk($search, $branch_id);

                $i = 1;
                foreach ($result as $row) {
                    $status = $this->security->xss_clean($this->options_model->getContent('TICKETSTATUS', 'ID', $row['TICKET_STATUS']));
                    $type = $this->security->xss_clean($this->options_model->getContent('TICKETTYPE', 'ID', $row['TICKET_TYPE']));
                    $this->table->add_row(
                        $i++,
                        $this->security->xss_clean($row['TICKET_NUMBER']),
                        $this->security->xss_clean($row['TICKET_TITLE']),
                        $type,
                        $this->security->xss_clean($row['TICKET_SUBMIT_DATE']),
                        $status,
                        $this->security->xss_clean($row['BRANCH']),
                        $this->security->xss_clean($row['NAME']),
                        $this->security->xss_clean($row['CUSTOMER_NAME']),
                        str_replace("{TICKET_NUMBER}", $this->security->xss_clean($row['TICKET_NUMBER']), $edit_view_link)
                    );
                }
            }
        }

        $this->load->view('npkbilling/ecare/search_ticket', $data);
    }

    public function create_ticket()
    {
                
        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        } else {
            if (($_POST['title'] === null) and ($_POST['message'] === null) and ($_POST['request_number'] === null)) {
                $this->session->sess_destroy();
                redirect(ROOT . 'main', 'logout');
            } else {

                if (!isset($_POST['channel'])) {
                    $channel = "WEB";//input default : diisi langsung oleh user via aplikasi (selain helpdesk)
                } else {
                    $channel = $_POST['channel'];//hanya jika diinput oleh helpdesk
                }

                if ($_FILES['attachment_file']['name'] != "") {
                    $file = time() . '-' . $_FILES['attachment_file']['name'];
                    $folderfile = 'upload_customer_care';

                    $path = UPLOADFOLDER_ . $folderfile;
                    $config = array(
                        'upload_path' => $path,
                        'allowed_types' => "gif|jpg|png|jpeg|pdf",
                        'overwrite' => TRUE,
                        'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                        'max_height' => "768",
                        'file_name' => $file,
                        'max_width' => "1024"
                    );

                    $this->load->library('upload');
                    $this->upload->initialize($config);

                    if ($this->upload->do_upload('attachment_file')) {
                        $data = $this->upload->data();
                        $fullpath = APP_ROOT . $folderfile . "/" . $data['file_name']; //file_name
                        echo $this->upload->display_errors('<p>', '</p>');

                        $fullfile = $path . "/" . $data['file_name']; //full file_name
                        log_message('debug', 'value fullfile: ' . $fullfile);
                        $this->scan_virus($fullfile); //scan file disini

                        // $file = $data['file_name'];
                        $file = APP_ROOT . $folderfile . "/" . $data['file_name']; //file_name
                    } else {
                        $file = "";
                        echo $this->upload->display_errors('<p>', '</p>');
                    }
                }
                // Added by EDII
                $u_phd = $this->session->userdata('uname_phd');

                $get_token_db = $this->ticket_model->get_token($u_phd)->row_array();

                $db_token = $get_token_db['TOKEN'];
                $db_url = $get_token_db['URL'];
                // if ($db_token == '') {
                    $g_data = $this->get_login_sf();
                    $s_token = $g_data['token'];
                    $s_url = $g_data['url'];
                    $datenow = date('Y-m-d');
                    $sqlins = "INSERT INTO HELPDESK_TOKEN_SF (USERID, TOKEN, URL, INSERT_DATE, FLAG_EXPIRED) 
                                    VALUES ( '$u_phd','$s_token', '$s_url', TO_DATE('$datenow','yyyy-mm-dd'), 'N')";
                    $this->db->query($sqlins);
                // } else {
                //     $s_token = $db_token;
                //     $s_url = $db_url;
                // }
                

                $ticket_number_case = $this->ticket_model->get_ticket_number();
                $billing_customer_id = $this->session->userdata('customerid_phd');

                // $billing_customer_id     = '12777843';
                $sessionId = $s_token;
                $url_create_ticket = 'http://10.88.56.18/crm_api_dev/insert_case.php';
                $ticket_number = $ticket_number_case;
                $ticket_user_id = $this->session->userdata('uname_phd');
                $ticket_title = $_POST['title'];
                $ticket_message = $_POST['message'];
                $ticket_request_number = $_POST['request_number'];
                $ticket_attachment = $_POST['attachment'];
                $ticket_submit_date = date('Y-m-d H:i:s');
                $ticket_channel = $channel;
                $ticket_type = $_POST['type'];
                $ticket_service = $_POST['service'];
                // -- Tambahan untuk dapat service -- //
                $ticket_interaction = $_POST['interaction'];
                $q_service = "SELECT CONTEXT_TEXT FROM MST_CONTEXT_OPTIONS WHERE CONTEXT_VALUE = '" . $ticket_service . "'";
                $t_service = $this->db->query($q_service);
                $row_service = $t_service->row();
                $row_1 = $row_service->CONTEXT_TEXT;
                $q_type= "SELECT CONTEXT_TEXT FROM MST_CONTEXT_OPTIONS WHERE CONTEXT_VALUE = '" . $ticket_type . "'";
                $t_type = $this->db->query($q_type);
                $row_type = $t_type->row();
                $row_2 = $row_type->CONTEXT_TEXT;
                $q_interaction= "SELECT CONTEXT_TEXT FROM MST_CONTEXT_OPTIONS WHERE CONTEXT_VALUE = '" . $ticket_interaction . "'";
                $t_interaction = $this->db->query($q_interaction);
                $row_interaction = $t_interaction->row();
                $row_3 = $row_interaction->CONTEXT_TEXT;
                // -- End Tambahan -- //
                $ticket_branch_id = $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd'));
                $ticket_data = array(
                    'sessionId' => $s_token,
                    'subject' => $ticket_title,
                    'description' => $ticket_message,
                    'origin' => 'Web',
                    'status' => 'New',
                    'serverUrl' => $s_url,
                    'ticket_billing_customer_id__c' => '17521006',
                    'ticket_attachment_file_name__c' => $file,
                    'ticket_submit_date__c' => $ticket_submit_date,
                    'ticket_user_id__c' => $ticket_user_id,
                    'request_number__c' => $ticket_request_number,
                    'ticket_branch_id__c' => $ticket_branch_id,
                    'ticket_number__c' => $ticket_number,
                    'interaction__c' => $row_2,
                    'type__c' => $row_3,
                    'service__c' => $row_1
                );
                

                $ins_api_ticket = $this->post_to_sf($url_create_ticket, $ticket_data);
                
                $output_sf = $ins_api_ticket['output_status'];
                $expired_token = $output_sf->session_expired;
                $ticket_sf_id = $output_sf->id;
                if ($expired_token == 'yes') {

                    $req = $this->get_login_sf();
                    $ss_token = $req['token'];
                    $ss_url = $req['url'];
                    $datenow = date('Y-m-d');
                    $sql1 = "INSERT INTO HELPDESK_TOKEN_SF (USERID, TOKEN, URL, INSERT_DATE, FLAG_EXPIRED) 
                                    VALUES ( '$u_phd','$ss_token', '$ss_url', TO_DATE('$datenow','yyyy-mm-dd'), 'N')";
                    $this->db->query($sql1);
                    $sql_update = "UPDATE HELPDESK_TOKEN_SF SET FLAG_EXPIRED = 'Y' 
                                           WHERE USERID ='$u_phd' AND TOKEN ='$s_token' ";
                    $this->db->query($sql_update);
                    $ticket_data = array(
                        'sessionId' => $ss_token,
                        'subject' => $ticket_title,
                        'description' => $ticket_message,
                        'origin' => 'Web',
                        'status' => 'New',
                        'serverUrl' => $ss_url,
                        'ticket_billing_customer_id__c' => $ticket_user_id,
                        'ticket_attachment_file_name__c' => $file,
                        'ticket_submit_date__c' => $ticket_submit_date,
                        'ticket_user_id__c' => $ticket_user_id,
                        'request_number__c' => $ticket_request_number,
                        'ticket_branch_id__c' => $ticket_branch_id,
                        'ticket_number__c' => $ticket_number,
                        'interaction__c' => $row_2,
                        'type__c' => $row_3,
                        'service__c' => $row_1
                    );
                    $test_s = $this->post_to_sf($url_create_ticket, $ticket_data);
                }
                $params = array(
                    'TICKET_NUMBER' => $ticket_number_case,
                    'USER_ID' => $this->session->userdata('uname_phd'),
                    'TITLE' => htmLawed($_POST['title']),
                    'MESSAGE' => htmLawed($_POST['message']),
                    'REQUEST_NUMBER' => htmLawed($_POST['request_number']),
                    'ATTACHMENT' => htmLawed(urlencode($file)),
                    'TICKET_CHANNEL' => htmLawed($channel),
                    'TICKET_TYPE' => htmLawed($_POST['type']),
                    'BRANCH_ID' => $this->customer_registration_model->get_branch_id_by_registration_company_id($this->session->userdata('registrationcompanyid_phd')),
                    'SERVICE_TYPE' => $_POST['service'],
                    'INTERACTION_TYPE' => $_POST['interaction'],
                    'SF_TICKET_ID' => $ticket_sf_id
                );
                $this->ticket_model->create_ticket($params);
                // End Added by EDII
                redirect(ROOT . 'npkbilling/ecare', 'refresh');
            }

        }
    }

    public function scan_virus($file)
    {
        /* contoh result scan clamav
        file valid              -> index.php: OK ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 0 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 13.927 sec (0 m 13 s)
        file terinfeksi virus   -> eicar.com.txt: Eicar-Test-Signature FOUND ----------- SCAN SUMMARY ----------- Known viruses: 4490129 Engine version: 0.99.2 Scanned directories: 0 Scanned files: 1 Infected files: 1 Data scanned: 0.00 MB Data read: 0.00 MB (ratio 0.00:1) Time: 14.098 sec (0 m 14 s) */
        $scan_process = shell_exec('clamscan ' . $file);
        log_message('debug', 'hasil scan: ' . $scan_process);
        if (strpos($scan_process, 'OK') != false) {
            log_message('debug', 'hasil scan file: ' . $file . ' tidak terinfeksi virus.');
            return 'lolos';
        } else {
            log_message('debug', 'hasil scan file: ' . $file . ' terinfeksi virus');
            return 'infected';
        }
    }

    public function create_ticket_message($ticket_number)
    {
        if (!$this->session->userdata('uname_phd')) {

            redirect(ROOT . 'main', 'refresh');
        } else {
            if (($ticket_number === null) and (htmLawed($_POST['message2']) === null)) {
                $this->session->sess_destroy();
                redirect(ROOT . 'main', 'logout');
            } else {

                if ($_FILES['attachment_file']['name'] != "") {
                    $file = time() . '-' . $_FILES['attachment_file']['name'];
                    $folderfile = 'upload_customer_care';

                    $path = UPLOADFOLDER_ . $folderfile;
                    $config = array(
                        'upload_path' => $path,
                        'allowed_types' => "gif|jpg|png|jpeg|pdf",
                        'overwrite' => TRUE,
                        'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
                        'max_height' => "768",
                        'file_name' => $file,
                        'max_width' => "1024"
                    );

                    $this->load->library('upload');
                    $this->upload->initialize($config);
                    if ($this->upload->do_upload('attachment_file')) {
                        $data = $this->upload->data();
                        $fullpath = APP_ROOT . $folderfile . "/" . $data['file_name']; //file_name
                        echo $this->upload->display_errors('<p>', '</p>');

                        $fullfile = $path . "/" . $data['file_name']; //full file_name
                        log_message('debug', 'value fullfile: ' . $fullfile);
                        $this->scan_virus($fullfile); //scan file disini

                        // $file = $data['file_name'];
                        $file = APP_ROOT . $folderfile . "/" . $data['file_name'];
                    } else {
                        $file = "";
                        echo $this->upload->display_errors('<p>', '</p>');
                    }
                }

                $params = array(
                    'TICKET_NUMBER' => $ticket_number,
                    'MESSAGE' => htmLawed($_POST['message2']),
                    'ATTACHMENT' => htmLawed(urlencode($file)),
                    'USER_ID' => $this->session->userdata('uname_phd'),
                    'STATUS' => $_POST['status'],
                    'ACTIVITY' => htmLawed($_POST['activity'])
                );

                $this->ticket_model->create_ticket_message($params);

                $params = array(
                    'STATUS' => $_POST['status'],
                    'ACTIVITY' => htmLawed($_POST['activity']),
                    'TICKET_NUMBER' => $ticket_number
                );

                $this->ticket_model->update_ticket($params);

                // Added by EDII
                $conv_user_id = $this->session->userdata('uname_phd');
                $get_token_db = $this->ticket_model->get_token($conv_user_id)->row_array();
                $db_token = $get_token_db['TOKEN'];
                $db_url = $get_token_db['URL'];
                $u_phd = $this->session->userdata('uname_phd');
                if ($db_token == '') {
                    $g_data = $this->get_login_sf();
                    $s_token = $g_data['token'];
                    $s_url = $g_data['url'];
                    $datenow = date('Y-m-d');
                    $sqlins = "INSERT INTO HELPDESK_TOKEN_SF (USERID, TOKEN, URL, INSERT_DATE, FLAG_EXPIRED) 
                            VALUES ( '$u_phd','$s_token', '$s_url', TO_DATE('$datenow','yyyy-mm-dd'), 'N')";
                    $this->db->query($sqlins);
                } else {
                    $s_token = $db_token;
                    $s_url = $db_url;
                }

                $url_create_conv = 'http://10.88.56.18/crm_api_dev/insert_conversation.php';
                $conv_ticket_number = $ticket_number;
                $conv_message = $_POST['message2'];
                $conv_status = $_POST['status'];
                $conv_created_date = date('Y-m-d H:i:s');
                $q_sf_id = $this->db->query("SELECT SF_TICKET_ID FROM HELPDESK_TICKET_HEADER WHERE TICKET_NUMBER = '$ticket_number'")->row_array();
                $get_sf_id = $q_sf_id['SF_TICKET_ID'];
                $conv_data = array(
                    'sessionId' => $s_token,
                    'serverUrl' => $s_url,
                    'origin__c' => 'Web',
                    "created_date__c" => $conv_created_date,
                    "messages__c" => $conv_message,
                    "ticket_change_status_history__c" => $conv_status,
                    "ticket_attachment_file_name__c" => $file,
                    "ticket_number__c" => $ticket_number,
                    "Case__c" => $get_sf_id


                );
                $ins_api_conv = $this->post_to_sf($url_create_conv, $conv_data);
                $expired_token = $ins_api_conv['output_status']->session_expired;
                if ($expired_token == 'yes') {
                    $req = $this->get_login_sf();
                    $ss_token = $req['token'];
                    $ss_url = $req['url'];
                    $datenow = date('Y-m-d');
                    $sql_insert = "INSERT INTO HELPDESK_TOKEN_SF (USERID, TOKEN, URL, INSERT_DATE, FLAG_EXPIRED) 
                            VALUES ( '$u_phd','$ss_token', '$ss_url', TO_DATE('$datenow','yyyy-mm-dd'), 'N')";
                    $this->db->query($sql_insert);
                    $sql_update = "UPDATE HELPDESK_TOKEN_SF SET FLAG_EXPIRED = 'Y' 
                                   WHERE USERID ='$u_phd' AND TOKEN ='$s_token' ";
                    $this->db->query($sql_update);
                    $conv_data = array(
                        'sessionId' => $ss_token,
                        'serverUrl' => $ss_url,
                        'origin__c' => 'Web',
                        "created_date__c" => $conv_created_date,
                        "messages__c" => $conv_message,
                        "ticket_change_status_history__c" => $conv_status,
                        "ticket_attachment_file_name__c" => $file,
                        "ticket_number__c" => $ticket_number,
                        "Case__c" => $get_sf_id

                    );
                    $ins_api_conv = $this->post_to_sf($url_create_conv, $conv_data);
                }
                // End Added by EDII
                 redirect(ROOT . 'npkbilling/ecare', 'refresh');
            }
        }
    }

    public function get_count_new_ticket()
    {
        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        echo $this->ticket_model->getTotalListTicket();
    }

    public function get_consignee_list()
    {
        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        $customer_id = $this->session->userdata('customeridppjk_phd');
        if (isset($_GET['term'])) {
            echo json_encode(
            //$this->user_model->getConsigneeOfPPJK($user_id, strtoupper($_GET['term']))
                $this->customer_registration_model->getConsigneeOfPPJK($customer_id, strtoupper($_GET['term']))//diganti ke ppjk-consignee per customer
            );
        } else {
            echo json_encode(array());
        }
    }

    public function contact_us()
    {

        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        $this->breadcrumbs->push('Kontak', '/ecare/contact_us');
        $this->breadcrumbs->unshift('Home', '/');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'Kontak Kami';

        $data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

        $this->common_loader($data, 'npkbilling/ecare/contact_us');
    }

    public function my_profile()
    {

        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        $customer_id = $this->session->userdata('customeridppjk_phd');
        $user_id = $this->session->userdata('uname_phd');
        $customer_name = $this->session->userdata('customername_phd');
        //$result1=$this->user_model->getConsigneeOfPPJKList($user_id);//per user
        $result1 = $this->customer_registration_model->getConsigneeOfPPJKList($customer_id);//diganti ke ppjk-consignee per customer

        //create table
        //$this->table->set_heading('NO', 'NAMA PERUSAHAAN', 'TANGGAL PENAMBAHAN');
        $this->table->set_heading("<th>NO</th>", "<th>CUSTOMER ID</th>", "<th>NAMA PERUSAHAAN</th>", "<th>TANGGAL PENAMBAHAN</th>");

        $in_data = "<root>
            <sc_type>1</sc_type>
            <sc_code>123456</sc_code>
            <data>
                <customer_id>$customer_id</customer_id>
                <user_id>$user_id</user_id>
                <customer_name>$customer_name</customer_name>
            </data>
        </root>";

        if (!$this->nusoap_lib->call_wsdl(CUSTOMER, "getCustomerDetail", array("in_data" => "$in_data"), $result)) {
            echo $result;
            die;
        } else {
            //echo $result;die;
            $obj = json_decode($result);

            if ($obj->data->customer) {
                for ($i = 0; $i < count($obj->data->customer); $i++) {
                    $data['customer_id'] = $obj->data->customer[$i]->customer_id;
                    $data['customer_name'] = $obj->data->customer[$i]->customer_name;
                    $data['address'] = $obj->data->customer[$i]->address;
                    $data['address'] = $obj->data->customer[$i]->address;
                    $data['npwp'] = $obj->data->customer[$i]->npwp;
                    $data['email'] = $obj->data->customer[$i]->email;
                    $data['phone'] = $obj->data->customer[$i]->phone;

                    $data['uphone'] = $obj->data->customer[$i]->userinfo->uphone;
                    $data['uemail'] = $obj->data->customer[$i]->userinfo->uemail;
                    $data['user_id'] = $user_id;

                    $data['pdf_password'] = $obj->data->customer[$i]->userinfo->pdf_password;

                    foreach ($obj->data->customer[$i]->service as $value) {
                        $data[$value->service] = "checked";
                    }

                    if ($data['customer_name'] == "") {
                        //$data['msg']="<center>Userid anda belum tersinkronisasi dengan pelanggan tertentu. <br>Silahkan <b>melakukan permintaan sinkronisasi pelanggan</b> ke pelayanan pelanggan menggunakan userid : <b>$user_id</b></center>";
                    }

                }
            }
        }

        $i = 1;
        foreach ($result1 as $row) {
            $this->table->add_row(
                $i++,
                $row['CONSIGNEE_ID'],
                $row['NAME'],
                $row['CREATED_DATE']
            );
        }

        //var_dump($data);
        $data['menu_list'] = $this->user_model->get_menuList($this->session->userdata('group_phd'));

        $this->breadcrumbs->push('My Profile', '/');
        $this->breadcrumbs->unshift('Home', '/');
        $data['breadcrumbs'] = $this->breadcrumbs->show();
        $data['title'] = 'My Profile';

        $this->common_loader($data, 'npkbilling/ecare/my_profile');
    }

    public function update_notif()
    {

        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        if (isset($_POST['submit_form'])) {

            $customer_id = isset($_POST['customer_id']) ? htmLawed($_POST['customer_id']) : '';
            $user_id = isset($_POST['user_id']) ? htmLawed($_POST['user_id']) : '';
            $uphone = isset($_POST['uphone']) ? htmLawed($_POST['uphone']) : '';
            $uemail = isset($_POST['uemail']) ? htmLawed($_POST['uemail']) : '';
            $sms01 = isset($_POST['sms01']) ? htmLawed($_POST['sms01']) : '';
            $eml01 = isset($_POST['eml01']) ? htmLawed($_POST['eml01']) : '';
            $sms02 = isset($_POST['sms02']) ? htmLawed($_POST['sms02']) : '';
            $eml02 = isset($_POST['eml02']) ? htmLawed($_POST['eml02']) : '';
            $sms03 = isset($_POST['sms03']) ? htmLawed($_POST['sms03']) : '';
            $eml03 = isset($_POST['eml03']) ? htmLawed($_POST['eml03']) : '';
            $sms04 = isset($_POST['sms04']) ? htmLawed($_POST['sms04']) : '';
            $eml04 = isset($_POST['eml04']) ? htmLawed($_POST['eml04']) : '';
            $sms05 = isset($_POST['sms05']) ? htmLawed($_POST['sms05']) : '';
            $eml05 = isset($_POST['eml05']) ? htmLawed($_POST['eml05']) : '';
            $sms06 = isset($_POST['sms06']) ? htmLawed($_POST['sms06']) : '';
            $eml06 = isset($_POST['eml06']) ? htmLawed($_POST['eml06']) : '';
            $sms07 = isset($_POST['sms07']) ? htmLawed($_POST['sms07']) : '';
            $eml07 = isset($_POST['eml07']) ? htmLawed($_POST['eml07']) : '';
            $sms08 = isset($_POST['sms08']) ? htmLawed($_POST['sms08']) : '';
            $eml08 = isset($_POST['eml08']) ? htmLawed($_POST['eml08']) : '';
            $sms09 = isset($_POST['sms09']) ? htmLawed($_POST['sms09']) : '';
            $eml09 = isset($_POST['eml09']) ? htmLawed($_POST['eml09']) : '';
            $sms10 = isset($_POST['sms09']) ? htmLawed($_POST['sms10']) : '';
            $eml10 = isset($_POST['eml09']) ? htmLawed($_POST['eml10']) : '';

            injek($customer_id);
            injek($user_id);
            injek($uphone);
            injek($uemail);
            injek($sms01);
            injek($eml01);
            injek($sms02);
            injek($eml02);
            injek($sms03);
            injek($eml03);
            injek($sms04);
            injek($eml04);
            injek($sms05);
            injek($eml05);
            injek($sms06);
            injek($eml06);
            injek($sms07);
            injek($eml07);
            injek($sms08);
            injek($eml08);
            injek($sms09);
            injek($eml09);
            injek($sms10);
            injek($eml10);

            $setup = "";

            if ($sms01 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS01";
            }

            if ($eml01 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML01";
            }

            if ($sms02 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS02";
            }

            if ($eml02 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML02";
            }

            if ($sms03 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS03";
            }

            if ($eml03 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML03";
            }

            if ($sms04 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS04";
            }

            if ($eml04 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML04";
            }

            if ($sms05 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS05";
            }

            if ($eml05 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML05";
            }

            if ($sms06 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS06";
            }

            if ($eml06 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML06";
            }

            if ($sms07 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS07";
            }

            if ($eml07 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML07";
            }

            if ($sms08 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS08";
            }

            if ($eml08 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML08";
            }

            if ($sms09 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS09";
            }

            if ($eml09 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML09";
            }

            if ($sms10 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "SMS10";
            }

            if ($eml10 == "true") {
                if ($setup != "") $setup .= ",";
                $setup .= "EML10";
            }

            $in_data = "<root>
                <sc_type>1</sc_type>
                <sc_code>123456</sc_code>
                <data>
                    <customer_id>$customer_id</customer_id>
                    <user_id>$user_id</user_id>
                    <uphone>$uphone</uphone>
                    <uemail>$uemail</uemail>
                    <setup>$setup</setup>
                </data>
            </root>";
            injek($in_data);

            if (!$this->nusoap_lib->call_wsdl(CUSTOMER, "updateCustomer", array("in_data" => "$in_data"), $result)) {
                echo $result;
                die;
            } else {
                //call success
                //echo "<br>----response---<br>";
                echo $result;

                //contoh decode data
                //echo "<br>----decode-----";
                $obj = json_decode($result);
                //echo "<br>";
                //echo $obj->sc_type;echo "<br>";
                //echo $obj->sc_code;echo "<br>";
                //echo $obj->rc;echo "<br>";
                //echo $obj->rcmsg;echo "<br>";
            }
        }
    }

    public function set_consignee()
    {

        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        if (isset($_POST['setConsignee'])) {
            $consignee = isset($_POST['consignee']) ? htmLawed($_POST['consignee']) : '';
            $consignee_npwp = isset($_POST['consignee_npwp']) ? htmLawed($_POST['consignee_npwp']) : '';
            $consignee_id = isset($_POST['consignee_id']) ? htmLawed($_POST['consignee_id']) : '';

            injek($consignee);
            injek($consignee_npwp);
            injek($consignee_id);

            $this->session->set_userdata(array(
                'customerid_phd' => $consignee_id,
                'custid_phd' => $consignee_id,
                'customername_phd' => $consignee,
                'npwp_phd' => $consignee_npwp));

            echo "success";
        }
    }

    public function check_customer_id()
    {
        if (!$this->session->userdata('uname_phd')) {
            redirect(ROOT . 'main', 'refresh');
        }

        if ($this->session->userdata('group_phd') == "5" || $this->session->userdata('group_phd') == "" || $this->session->userdata('group_phd') == "0") {
            if ($this->user_model->getCustomerIdByUsername($this->session->userdata('uname_phd')) == "") {
                echo "<center>Userid anda belum tersinkronisasi dengan pelanggan tertentu. <br>Silahkan <b>melakukan permintaan sinkronisasi pelanggan</b> ke pelayanan pelanggan menggunakan userid : <b>" . $this->session->userdata('uname_phd') . "</b></center>";
            }
        }
    }
}