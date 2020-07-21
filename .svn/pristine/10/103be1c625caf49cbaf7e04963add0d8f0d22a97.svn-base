<?php
	tcpdf();

	$obj_pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
	// create new PDF document
	// set header and footer fonts
	$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$obj_pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	//set margins
	$obj_pdf->SetMargins(10, 10, 15);
	//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	$obj_pdf->setPrintHeader(false);

	//set auto page breaks
	$obj_pdf->SetAutoPageBreak(TRUE, 10);

	//set image scale factor
	$obj_pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	
	$data = array();
	$data['vars'] = $vars;
	
	
	$style = array(
				'position' => '',
				'align' => 'C',
				'stretch' => false,
				'fitwidth' => true,
				'cellfitalign' => '',
				//'border' => true,
				'hpadding' => 'auto',
				'vpadding' => 'auto',
				'fgcolor' => array(0,0,0),
				'bgcolor' => false, //array(255,255,255),
				'text' => true,
				'font' => 'helvetica',
				'fontsize' => 4,
				'stretchtext' => 4
			);	
	$obj_pdf->SetFont('courier', '', 9);
	$obj_pdf->AddPage();
	$obj_pdf->writeHTML($this->load->view("print/om/$view", $data, true), 
								true, false, true, false, '');
	$obj_pdf->ln();$obj_pdf->ln();$obj_pdf->ln();$obj_pdf->ln();$obj_pdf->ln();$obj_pdf->ln();$obj_pdf->ln();$obj_pdf->ln();$obj_pdf->ln();

				$obj_pdf->setPage(1);
				$obj_pdf->Image(APP_ROOT.'config/cube/img/ipc_logo.png', 5, 4, 30, 15, '', '', '', true, 72);
				//$pdf->Image(APP_ROOT.'config/images/cr/ttd2.jpg', 175, 260, 30, 15, '', '', '', true, 72);

				$obj_pdf->SetFont('helvetica', 'B', 9);
	//$obj_pdf->write1DBarcode($vars['NO_NOTA'], 'C128', 80, 15, '', 25, 0.4, $style, 'N');						
	$obj_pdf->Output('output.pdf', 'I');
?>