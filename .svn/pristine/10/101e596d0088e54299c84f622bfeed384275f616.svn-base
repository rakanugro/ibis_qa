<?php
if (!function_exists('format_nota')) {
    function format_nota($data, $special_cust = array())
    {
        // require_once('tcpdf/tcpdf.php');
        $pdf = null;
        // echo print_r($data['STATUS_KOREKSI']);die();
        if ($data['status_lunas'] == 'Y') {
            if ($data['STATUS_KOREKSI'] == 1) {
                define('img_file', APP_ROOT . "assets/images/koreksi.png");
                $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $pdf->SetMargins(12, 0);
                // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->SetAuthor('E invoice 2018');
                // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
                // set default monospaced font
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                // set default header data
                $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);
                // set margins
                // $pdf->SetMargins(12, 0);
                // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				if($data['headerSubContext'] == "PTKM02")
				{
					$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 5);
				}
				else
				{
					$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 15);
				}
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                // $pdf->SetFont('courier', '', 8);
                $pdf->SetFont('gotham', '', 8);
                $pdf->SetTopMargin(5);

                $pdf->AddPage();

            } else {
                $pdf = new MyCustomPDFWithWatermark('P', 'mm', 'A4', true, 'UTF-8', false);
                // $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
                $pdf->SetTitle($title);
                $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
                $pdf->SetMargins(12, 0);
                // $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
                $pdf->SetPrintHeader(false);
                // $pdf->SetAutoPageBreak(TRUE);
                $pdf->setLanguageArray(null);
                $pdf->SetHeaderMargin(false);
                $pdf->SetTopMargin(5);
                $pdf->SetFooterMargin(1);
                // $pdf->SetAutoPageBreak(true);
                $pdf->SetAuthor('Author');
                $pdf->SetDisplayMode('real', 'default');

                $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 011', PDF_HEADER_STRING);
                $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
                // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
                $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
				if($data['headerSubContext'] == "PTKM02")
				{
					$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 5);
				}
				else
				{
					$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 15);
				}
                $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                // $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
                // $pdf->SetFont('courier', '', 8);
                $pdf->SetFont('gotham', '', 8);
                $pdf->AddPage();
            }


        } else {
            count($special_cust) > 0 ? '' : define('img_file', APP_ROOT . 'assets/images/copy.png'); /** aktifkan special customer tanpa watermark copy */
            //define('img_file', APP_ROOT . 'assets/images/copy.png');
            $pdf = new MyCustomPDFWithWatermark(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            $pdf->SetMargins(12, 0);
            // $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
            // $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            $pdf->SetAuthor('E invoice 2018');
            // $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
            // set default monospaced font
            $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
            // set default header data
            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 006', PDF_HEADER_STRING);
            // set margins
            // $pdf->SetMargins(12, 0);
            // $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
				if($data['headerSubContext'] == "PTKM02")
				{
					$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 5);
				}
				else
				{
					$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM - 15);
				}
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            // $pdf->SetFont('courier', '', 8);
            $pdf->SetFont('gotham', '', 8);
            $pdf->SetTopMargin(5);

            $pdf->AddPage();

        }
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
                    //'border' => true,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false, //array(255,255,255),
            'text' => true,
            'font' => 'courier',
            'fontsize' => 4,
            'stretchtext' => 4
        );
        return array($pdf, $style);
    }


}
if (!function_exists('header_nota')) {
    function header_nota($data)
    {
        // echo APP_ROOT.'uploads/entity/'.$data['e_logo'];die();
        $gambar = "";
        if (file_exists(FCPATH . 'uploads/entity/' . $data['e_logo'])) {
            $gambar = '<img width="350" height="200" src="' . APP_ROOT . 'uploads/entity/' . $data['e_logo'] . '">';
        } else {
            $gambar = '<div width="350" height="40">&nbsp;</div>';
        }


        if ($data['ex_num'] == "" || $data['ex_num'] == "null") {
		  
            $header = '<table>
                <tr>
                    <td ROWSPAN="4" width="80" style="line-height: 70px;">' . $gambar . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left" width="380px">&nbsp;</td>
                    <td COLSPAN="2" align="left" width="50px">&nbsp;</td>
                    <td COLSPAN="1" align="left" width="10px">&nbsp;</td>
                    <td COLSPAN="2" align="left" width="130px">&nbsp;</td>

                </tr>
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left" width="380px" style="font-size: 12px;">' . $data['e_name'] . '</td>';

					
            if (isset($data['uper'])) {
                $header .= '<td COLSPAN="2" align="left" width="50px">&nbsp;</td>
                    <td COLSPAN="1" align="left" width="10px">&nbsp;</td>
                    <td COLSPAN="2" align="left" width="130px">&nbsp;</td>';
            } else {
					
                $header .= '<td COLSPAN="2" align="left" width="50px">No. Nota</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['num'] . '</td>';
            }

            $header .= '</tr>
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">' . $data['e_address'] . '</td>';
            if (empty($data['uper'])) {
                $header .= '<td COLSPAN="2" align="left" width="50px">Tanggal</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['tgl_nota'] . '</td>';
            }

            $header .= '</tr>

                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="380px">NPWP: ' . $data['e_npwp'] . '</td>';
			 
            if ($data['status_lunas'] == 'Y') {
                $header .= '<td COLSPAN="2" align="left" width="180px">' . $data['e_faktur'] . '</td>';
            } else {
                $header .= '<td COLSPAN="2" align="left" width="180px">&nbsp;</td>';
            }
            $header .= '</tr>';
            if ($data['status_bayar'] == 'P') {
                $header .= '
                        <tr>
                            <td COLSPAN="1" width="10">&nbsp;</td>
                            <td COLSPAN="9" align="left">&nbsp;</td>
                            <td COLSPAN="12" align="left" width="190px">' . $data['faktor_note'] . '    </td>
                        </tr>';
            }

            if ($data['status_bayar'] == 'S') {
                $header .= '
                        <tr>
                            <td COLSPAN="1" width="10">&nbsp;</td>
                            <td COLSPAN="9" align="left">&nbsp;</td>
                            <td COLSPAN="12" align="left" width="190px"> -  </td>
                        </tr>';
            }
            $header .= ' </table>';

            return $header;
        } else {
            $header = '<table>
                <tr>
                    <td ROWSPAN="5" width="80" style="line-height: 70px;">' . $gambar . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left" width="380px">&nbsp;</td>
                    <td COLSPAN="2" align="left" width="50px">&nbsp;</td>
                    <td COLSPAN="1" align="left" width="10px">&nbsp;</td>
                    <td COLSPAN="2" align="left" width="130px">&nbsp;</td>

                </tr>
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left" width="380px" style="font-size: 12px;">' . $data['e_name'] . '</td>
                    <td COLSPAN="2" align="left" width="50px">No. Nota</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['num'] . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    
                </tr>

                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left" width="380px" style="font-size: 12px;">' . $data['e_address'] . '</td>
                    <td COLSPAN="2" align="left" width="50px">Ex. Nota</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['ex_num'] . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                </tr>

                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">NPWP: ' . $data['e_npwp'] . '</td>
                    <td COLSPAN="2" align="left" width="50px">Tanggal</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['tgl_nota'] . '</td>


                </tr>

                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="380px"></td>';
            if ($data['status_lunas'] == 'Y') {
                $header .= '<td COLSPAN="2" align="left" width="180px">' . $data['e_faktur'] . '</td>';
            } else {
                $header .= '<td COLSPAN="2" align="left" width="180px">&nbsp;</td>';
            }
            $header .= '</tr>';
            if ($data['status_bayar'] == 'P') {
                $header .= '
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px">' . $data['faktor_note'] . '    </td>
                </tr>';
            }

            if ($data['status_bayar'] == 'S') {
                $header .= '
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px"> -  </td>
                </tr>';
            }
            $header .= ' </table>';

            return $header;
        }


    }
}

// START SIGMA 07/10/19
if (!function_exists('header_notaCab')) {
    function header_notaCab($data)
    {
        $gambar = "";
        if (file_exists(FCPATH . 'uploads/entity/' . $data['e_logo'])) {
            $gambar = '<img width="350" height="200" src="' . APP_ROOT . 'uploads/entity/' . $data['e_logo'] . '">';
        } else {
            $gambar = '<div width="350" height="40">&nbsp;</div>';
        }

            $header = '<table>
                <tr>
                    <td ROWSPAN="5" width="80" style="line-height: 70px;">' . $gambar . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left" width="380px">&nbsp;</td>
                    <td COLSPAN="2" align="left" width="50px">&nbsp;</td>
                    <td COLSPAN="1" align="left" width="10px">&nbsp;</td>
                    <td COLSPAN="2" align="left" width="130px">&nbsp;</td>
                </tr>
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left" width="380px" style="font-size: 12px;">' . $data['e_name'] . '</td>
                    <td COLSPAN="2" align="left" width="50px">No. Nota</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['num'] . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                </tr>

                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">' . $data['e_address'] . '</td>
                    <td COLSPAN="2" align="left" width="50px">Tanggal</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['tgl_nota'] . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                </tr>

                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">NPWP: ' . $data['e_npwp'] . '</td>';

            if ($data['status_lunas'] == 'Y') {
                $header .= '<td COLSPAN="2" align="left" width="200px">' . $data['e_faktur'] . '</td>';
            } else {
                $header .= '<td COLSPAN="2" align="left" width="200px">&nbsp;</td>';
            }

            $header .= '<td COLSPAN="2" width="10px"></td>
                </tr>
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="380px"></td>
            </table>';

            return $header;
    }
}
// STOP SIGMA 07/10/19

if (!function_exists('header_pranota')) {
    function header_pranota($data)
    {

        $gambar = "";
        if (file_exists(FCPATH . 'uploads/entity/' . $data['e_logo'])) {
            $gambar = '<img width="350" height="200" src="' . APP_ROOT . 'uploads/entity/' . $data['e_logo'] . '">';
        } else {
            $gambar = '<div width="350" height="40" src="' . APP_ROOT . 'uploads/entity/"></div>';
        }
        $header = '<table>
                <tr>
                    <td ROWSPAN="4" width="80">' . $gambar . '</td>
                    <td COLSPAN="1" width="10">&nbsp;</td>';
        if ($data['bag'] == "KPL") {
            $header .= '<td COLSPAN="9" align="left" width="380px"><b>' . $data['e_name'] . '</b></td>
                        <td COLSPAN="2" align="left" width="60px">Bentuk 3A</td>
                        <td COLSPAN="1" align="left" width="10px">:</td>
                        <td COLSPAN="2" align="left" width="130px">' . $data['num'] . '</td>
                    </tr>
                    <tr>
                        <td COLSPAN="1" width="10">&nbsp;</td>
                        <td COLSPAN="9" align="left">' . $data['e_address'] . '</td>
                        <td COLSPAN="2" align="left" width="60px">Tanggal</td>';
        } else {
            $header .= '<td COLSPAN="9" align="left" width="350px"><b>' . $data['e_name'] . '</b></td>
                        <td COLSPAN="2" align="right" width="100px">No. Pra Nota</td>
                        <td COLSPAN="1" align="left" width="10px">:</td>
                        <td COLSPAN="2" align="left" width="130px">' . $data['num'] . '</td>
                    </tr>
                    <tr>
                        <td COLSPAN="1" width="10">&nbsp;</td>
                        <td COLSPAN="9" align="left">' . $data['e_address'] . '</td>
                        <td COLSPAN="2" align="right" width="100px">Tanggal</td>';
        }
        $header .= '
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="2" align="left" width="130px">' . $data['tgl_nota'] . '</td>

                </tr>

                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="380px">NPWP: ' . $data['e_npwp'] . '</td>';
        if ($data['status_lunas'] == 'Y') {
            $header .= '<td COLSPAN="2" align="left" width="180px">' . $data['e_faktur'] . '</td>';
        } else {
            $header .= '<td COLSPAN="2" align="left" width="180px">&nbsp;</td>';
        }
        $header .= '</tr>';
        if ($data['status_bayar'] == 'P') {
            $header .= '
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px">' . $data['faktor_note'] . '    </td>
                </tr>';
        }

        if ($data['status_bayar'] == 'S') {
            $header .= '
                <tr>
                    <td COLSPAN="1" width="10">&nbsp;</td>
                    <td COLSPAN="9" align="left">&nbsp;</td>
                    <td COLSPAN="12" align="left" width="190px"> -  </td>
                </tr>';
        }
        $header .= ' <tr>
                        <td COLSPAN="1" width="10">&nbsp;</td>
                        <td COLSPAN="9" align="left">&nbsp;</td>
                        <td COLSPAN="12" align="left" width="190px">&nbsp;</td>
                    </tr></table>';

        return $header;
    }
}
if (!function_exists('judul_nota')) {
    function judul_nota($data)
    {
        $judul = '<table>
                    <tr>
                        <td COLSPAN="2" style="font-family: gothamb;font-size: 14px;font-weight: 900;text-align:center;background-color:#ff4000;color:white;height:22px;line-height: 24px;">NOTA PENJUALAN JASA KEPELABUHANAN</td>
                    </tr>
                    <tr>
                        <td COLSPAN="2" align="center" style="line-height: 24px;">' . $data['jenisNota'] . '</td>
                    </tr>
                    </table>';
        return $judul;
    }
}
if (!function_exists('judul_uper_nota')) {
    function judul_uper_nota($data)
    {
       // $xjudul = "Uang yang Dipertanggungkan (UPER)";
          $xjudul = "UANG UNTUK DIPERHITUNGKAN (UPER)";
        /*$xjudul = "NOTA PENJUALAN JASA KEPELABUHANAN";
        if(){
            // 
        }*/
        $judul = '<table>
                    <tr>
                        <td COLSPAN="2" style="font-family: gothamb;font-size: 14px;font-weight: 900;text-align:center;background-color:#ff4000;color:white;height:22px;line-height: 24px;">' . $xjudul . '</td>
                    </tr>
                    <tr>
                        <td COLSPAN="2" align="center" style="line-height: 24px;">' . $data['jenisNota'] . '</td>
                    </tr>
                    </table>';
        return $judul;
    }
}
if (!function_exists('ematerai_nota')) {
    function ematerai_nota($data)
    {
        $ematerai = '
            <table><tr>';
        if ($data['status_lunas'] == 'Y') {
            if ((int)$data['amountMaterai'] > 0) {
                $ematerai .= '<td align="left" width="480px">' . $data['redaksi'] . '</td>
                            <td align="left" width="10px">&nbsp;</td>
                            <td align="center" style="border:1px solid #000;" width="150px"><b>Termasuk Bea Materai</b> <p>Rp. ' . $data['amountMaterai'] . ',-</p></td>';
            }
        }

        if (isset($data['fm'])) {
            $ematerai .= '</tr>
                <tr>
                    <td width="480px" align="left">' . $data['fm'] . '</td>
                </tr>
                <tr>
                    <td width="480px" align="left">' . $data['unit_wilayah'] . '</td>
                </tr>
                <tr>
                    <td width="480px" align="left">' . $data['alamat_wilayah'] . '</td>
                </tr>
              </table>';
        } else {
            $ematerai .= '</tr>
                <tr>
                    <td width="480px" align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td width="480px" align="left">' . $data['unit_wilayah'] . '</td>
                </tr>
                <tr>
                    <td width="480px" align="left">' . $data['alamat_wilayah'] . '</td>
                </tr>
              </table>';
        }
        return $ematerai;
    }
}
if (!function_exists('footer_nota')) {
    function footer_nota($data, $no_invoice = null)
    {
        $awalan_invoice = substr($no_invoice, 0, 3);
        $awalan_invoice_rupa09 = substr($no_invoice, 0, 2);
        // echo print_r($awalan_invoice); die();
        $calc = '';
        // echo $data['headerContext'];
        if ($data['headerContext'] == 'PTKM' || $data['headerContext'] == 'BRG') {
            $calc = '<table>';
        } else if ($data['headerContext'] == 'RUPA') {
            // if ($data['headerSubContext'] != 'RUPA12'){
            //     $calc = '<table>';
            // }
        }
        // echo $calc;die();
        /* Penggunaan Layanan Administarsi*/
        switch ($data['headerContext']) {
            case "PTKM":
                /*if ($data['headerSubContext'] != "PTKM02") {*/
                    $calc .= '<tr>
                                    <td COLSPAN="2" align="left" width="100px">Administrasi</td>
                                    <td COLSPAN="2" align="right" width="457px">' . $data['current'] . '</td>
                                    <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook; border-bottom:1px solid #000;" width="100px">' . number_format($data['data']['administrasi'], 0, ' ', '.') . '</td>
                                </tr>';
                /*}*/
                break;
        }
        switch ($data['headerContext']) {
            case "PTKM":
                // print_r($data);die();
                $ppn_dibebaskan_ptkm = (int)$data['data']['jum_amount'] * 10 / 100;
                $ppn_dibebaskan_ptkm = number_format($ppn_dibebaskan_ptkm, 0, ',', '.');
                if ($awalan_invoice != '080') {
                    $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="357px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN 10%</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                        </tr>';
                } else {
                    $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="357px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN dibebaskan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_ptkm . '</td>
                        </tr>';
                }
                if ((int)$data['data']['materai'] > 0) {
                    $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                }
                $calc .= '<!--<tr>
                            <td COLSPAN="2" align="left">Materai</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                        </tr>-->


                        <tr>
                            <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                        </tr>';
                if ($data['headerSubContext'] == "PTKM02" && !empty($data['data']['no_uper'])) {
                    if ($data['data']['uang_jaminan'] == 0) {
                        $calc .= '';
                    } else if ($data['data']['piutang'] > 0 && $data['data']['uang_jaminan'] > 0) {
                        $calc .= '<tr>
                            <td COLSPAN="2" align="left">Jumlah Uper</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['uang_jaminan'], 0, ' ', '.') . '</td>
                            </tr>';
                        $calc .= '<tr>
                            <td COLSPAN="2" align="left">Jumlah Piutang</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['piutang'], 0, ' ', '.') . '</td>
                            </tr>';
                    } else {
                        $calc .= '<tr>
                        <td COLSPAN="2" align="left">Jumlah Uper</td>
                        <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                        <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['uang_jaminan'], 0, ' ', '.') . '</td>
                        </tr>';
                        $calc .= '<tr>
                        <td COLSPAN="2" align="left"><b>Sisa Uper</b></td>
                        <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                        <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['piutang'] * -1, 0, ' ', '.') . '</td>
                        </tr>';
                    }

                }

                $calc .= '</table>';
                break;
            case "RUPA":
                // print_r($data);die();
                $ppn_dibebaskan_rupa = (int)$data['data']['jum_amount'] * 10 / 100;
                $ppn_dibebaskan_rupa = number_format($ppn_dibebaskan_rupa, 0, ',', '.');
                if ($data['headerSubContext'] == 'RUPA05') {
                    $calc .= '<table border="0px">
                            <tr>
                                <td width="410px">
                                    ' . $data['data']['dataRUPA05'] . '
                                </td>
                                <td width="200px" rowspan="7">';
                    if (!empty($data['data']['redaksibody'])) {
                        $calc .= '
                                       <table>
                                       <tr><td align="center"><b>Ketentuan</b></td></tr>
                                       <tr><td>' . $data['data']['redaksibody'] . '</td></tr>
                                       </table>';
                    }
                    $calc .= '
                                </td>
                            </tr>
                          ';
                        //   echo print_r($data['data']); die();
                    if ($awalan_invoice != '080') {
                        $calc .= '<tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="96px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN 10%</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                        </tr>';
                    } else {
                        $calc .= '<tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="96px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN dibebaskan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                        </tr>';
                    }
                    //    if((int)$data['data']['piutang']<0){
                    //         $calc.='<tr>
                    //             <td COLSPAN="2" align="left"><b>Sisa Uper</b></td>
                    //             <td COLSPAN="2" align="right">'.$data["current"].'</td>
                    //             <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">'.number_format(abs((int)$data['data']['piutang']), 0, ' ', '.').'</td>
                    //         </tr>';
                    //     }else{
                    //         $calc.='<tr>
                    //             <td COLSPAN="2" align="left"><b>Piutang</b></td>
                    //             <td COLSPAN="2" align="right">'.$data["current"].'</td>
                    //             <td COLSPAN="1" align="right" style="border-top:1px solid #000;font-size: 11px;font-family: franklingothicbook;">'.number_format($data['data']['piutang'], 0, ' ', '.').'</td>
                    //         </tr>';
                    //     }
                    // $calc .=    '<tr>
                    //         <td COLSPAN="2" width="200px" align="left">Sharing Pendapatan</td>
                    //         <td COLSPAN="2" width="96px" align="right">'.$data['current'].'</td>
                    //         <td COLSPAN="1" width="100px" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.$data['data']['sharing']/*number_format($data['data']['sharing'], 0, ' ', '.')*/.'</td>
                    //     </tr>
                    //     <tr>
                    //         <td COLSPAN="2" align="left">PBB</td>
                    //         <td COLSPAN="2" align="right">'.$data['current'].'</td>
                    //         <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.$data['data']['pbb']/*number_format($data['data']['pbb'], 0, ' ', '.')*/.'</td>
                    //     </tr>';
				if ((int)$data['data']['pbb'] > 0) {
                     $calc .=    '<tr>
									 <td COLSPAN="2" align="left">PBB</td>
									 <td COLSPAN="2" align="right">'.$data['current'].'</td>
									 <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($data['data']['pbb'], 0, ' ', '.').'</td>
								 </tr>';
				}
					
               if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                    }
     
                    $calc .= ' <tr>

                            <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                        </tr>
                    </table>';
                } else if ($data['headerSubContext'] == 'RUPA04') {                   
                    if ($awalan_invoice != '080') {
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="60px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN 10%</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                        </tr>';
                    } else {
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="60px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN dibebaskan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                        </tr>';
                    }
                    
                    if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                    }
                    $calc .= '
                        <!--<tr>
                            <td COLSPAN="2" align="left">Materai</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                        </tr>-->


                        <tr>

                            <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                        </tr>
                    </table>';
                } else if ($data['headerSubContext'] == 'RUPA12') {
                    $calc .= '
                        <table border="0px">
                        <tr>
                        <td width="420px">
                        ' . $data['data']['dataRUPA12'] . '
                        </td>
                        <td width="200px" rowspan="5">';
                    if (!empty($data['data']['redaksibody'])) {
                        $calc .= '
                                       <table>
                                       <tr><td align="center"><b>Ketentuan</b></td></tr>
                                       <tr><td>' . $data['data']['redaksibody'] . '</td></tr>
                                       </table>';
                    }
                    $calc .= '
                        </td>
                        </tr>
                        <tr><td></td></tr>
                          ';

                    // echo $calc;die();
                    if ($awalan_invoice != '080') {
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="156px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="170px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN 10%</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                        </tr>';
                    } else {
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="156px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="170px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN dibebaskan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                        </tr>';
                    }
                    if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                    }
                    $calc .= '
                        <!--<tr>
                            <td COLSPAN="2" align="left">Materai</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                        </tr>-->


                        <tr>

                            <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                        </tr>
                    </table>';
                } elseif ($data['headerSubContext'] == 'RUPA09') {
                    $calc .= '
                           <tr>
                               <td colspan="5" width="410px">
                                   ' . $data['data']['dataRUPA09'] . '
                                   </table>
                               </td>
                               <td width="200px" ROWSPAN="8">';
                    if (!empty($data['data']['redaksibody'])) {
                        $calc .= '
                                       <table>
                                       <tr><td align="center"><b>Ketentuan</b></td></tr>
                                       <tr><td>' . $data['data']['redaksibody'] . '</td></tr>
                                       </table>';
                    }
                    $calc .= '
                               </td>
                           </tr>
                         <tr><td COLSPAN="5">&nbsp;</td></tr>
                         ';
                    if (/*$awalan_invoice != '080'*/$awalan_invoice_rupa09!= '08') {
                        $calc .= '    <tr>
                           <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                           <td COLSPAN="2" align="right" width="90px">' . $data['current'] . '</td>
                           <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                       </tr>

                       <tr>
                           <td COLSPAN="2" align="left">PPN 10%</td>
                           <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                           <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                       </tr>';
                    } else {
                        $calc .= '    <tr>
                           <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                           <td COLSPAN="2" align="right" width="90px">' . $data['current'] . '</td>
                           <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                       </tr>

                       <tr>
                           <td COLSPAN="2" align="left">PPN dibebaskan</td>
                           <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                           <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                       </tr>';
                    }
                   //     if((int)$data['data']['piutang']<0){
                   //         $calc.='<tr>
                   //             <td COLSPAN="2" align="left"><b>Sisa Uper</b></td>
                   //             <td COLSPAN="2" align="right">'.$data["current"].'</td>
                   //             <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">'.number_format(abs((int)$data['data']['piutang']), 0, ' ', '.').'</td>
                   //         </tr>';
                   //     }else{
                   //         $calc.='<tr>
                   //             <td COLSPAN="2" align="left"><b>Piutang</b></td>
                   //             <td COLSPAN="2" align="right">'.$data["current"].'</td>
                   //             <td COLSPAN="1" align="right" style="border-top:1px solid #000;font-size: 11px;font-family: franklingothicbook;">'.number_format($data['data']['piutang'], 0, ' ', '.').'</td>
                   //         </tr>';
                   //     }
                   // $calc .=    '<tr>
                   //         <td COLSPAN="2" width="150px" align="left">Sharing Pendapatan</td>
                   //         <td COLSPAN="2" width="140px" align="right">'.$data['current'].'</td>
                   //         <td COLSPAN="1" width="100px" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.$data['data']['sharing']/*number_format($data['data']['sharing'], 0, ' ', '.')*/.'</td>
                   //     </tr>
                   //     <tr>
                   //         <td COLSPAN="2" align="left">PBB</td>
                   //         <td COLSPAN="2" align="right">'.$data['current'].'</td>
                   //         <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.$data['data']['pbb']/*number_format($data['data']['pbb'], 0, ' ', '.')*/.'</td>
                   //     </tr>';

               if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                    }
     
                    $calc .= '<tr>

                           <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                           <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                           <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                       </tr>
                   </table>';
                } elseif ($data['headerSubContext'] == 'RUPA15') {
                    $calc .= '
                            <table>
                            <tr>
                                <td colspan="5" width="410px">
                                ' . $data['data']['dataRUPA15'] . '
                                </td>
                                <td width="200px" ROWSPAN="8">';
                    if (!empty($data['data']['redaksibody'])) {
                        $calc .= '
                                       <table>
                                       <tr><td align="center"><b>Ketentuan</b></td></tr>
                                       <tr><td>' . $data['data']['redaksibody'] . '</td></tr>
                                       </table>';
                    }
                    $calc .= '
                            </td>
                          </tr>
                          ';

                    // echo $calc;die();
                    if ($awalan_invoice != '080') {
                        $ppn_dibebaskan = $data['jum_amount'] * 10/100;
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="150px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="150px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left">PPN 10%</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left">a. PPN dikenakan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['ppn_dikenakan'], 0, ' ', '.') . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left">b. PPN dibebaskan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['ppn_dibebaskan'], 0, ' ', '.') . '</td>
                        </tr>';
                    } else {
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="150px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="150px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left">PPN 10%</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left">a. PPN dikenakan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['ppn_dikenakan'], 0, ' ', '.') . '</td>
                        </tr>
                        <tr>
                            <td COLSPAN="2" align="left">b. PPN dibebaskan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                        </tr>';
                    }
                    if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                    }
                    $calc .= '
                        <tr>
                            <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                        </tr>
                    </table>';
                } else if ($data['headerSubContext'] == 'RUPA09') {
                    $calc .= '
                           <tr>
                               <td colspan="5" width="410px">
                                   ' . $data['data']['dataRUPA09'] . '
                                   </table>
                               </td>
                               <td width="200px" ROWSPAN="8">';
                    if (!empty($data['data']['redaksibody'])) {
                        $calc .= '
                                       <table>
                                       <tr><td align="center"><b>Ketentuan</b></td></tr>
                                       <tr><td>' . $data['data']['redaksibody'] . '</td></tr>
                                       </table>';
                    }
                    $calc .= '
                               </td>
                           </tr>
                         <tr><td COLSPAN="5">&nbsp;</td></tr>
                         ';
                    if ($awalan_invoice != '080') {
                        $calc .= '    <tr>
                           <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                           <td COLSPAN="2" align="right" width="90px">' . $data['current'] . '</td>
                           <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                       </tr>

                       <tr>
                           <td COLSPAN="2" align="left">PPN 10%</td>
                           <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                           <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                       </tr>';
                    } else {
                        $calc .= '    <tr>
                           <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                           <td COLSPAN="2" align="right" width="90px">' . $data['current'] . '</td>
                           <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                       </tr>

                       <tr>
                           <td COLSPAN="2" align="left">PPN dibebaskan</td>
                           <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                           <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                       </tr>';
                    }
                   //     if((int)$data['data']['piutang']<0){
                   //         $calc.='<tr>
                   //             <td COLSPAN="2" align="left"><b>Sisa Uper</b></td>
                   //             <td COLSPAN="2" align="right">'.$data["current"].'</td>
                   //             <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">'.number_format(abs((int)$data['data']['piutang']), 0, ' ', '.').'</td>
                   //         </tr>';
                   //     }else{
                   //         $calc.='<tr>
                   //             <td COLSPAN="2" align="left"><b>Piutang</b></td>
                   //             <td COLSPAN="2" align="right">'.$data["current"].'</td>
                   //             <td COLSPAN="1" align="right" style="border-top:1px solid #000;font-size: 11px;font-family: franklingothicbook;">'.number_format($data['data']['piutang'], 0, ' ', '.').'</td>
                   //         </tr>';
                   //     }
                   // $calc .=    '<tr>
                   //         <td COLSPAN="2" width="150px" align="left">Sharing Pendapatan</td>
                   //         <td COLSPAN="2" width="140px" align="right">'.$data['current'].'</td>
                   //         <td COLSPAN="1" width="100px" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.$data['data']['sharing']/*number_format($data['data']['sharing'], 0, ' ', '.')*/.'</td>
                   //     </tr>
                   //     <tr>
                   //         <td COLSPAN="2" align="left">PBB</td>
                   //         <td COLSPAN="2" align="right">'.$data['current'].'</td>
                   //         <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">'.$data['data']['pbb']/*number_format($data['data']['pbb'], 0, ' ', '.')*/.'</td>
                   //     </tr>';

               if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                    }
     
                    $calc .= ' <tr>

                           <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                           <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                           <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                       </tr>
                   </table>';
                } else if ($data['headerSubContext'] == 'RUPA14') {
                    $calc .= '
                    <table border="0px">
                        <tr>
                            <td colspan="5" width="422px">
                            ' . $data['data']['dataRUPA14'] . '
                            </td>
                            <td width="200px" ROWSPAN="8">';
                    if (!empty($data['data']['redaksibody'])) {
                        $calc .= '
                                       <table>
                                       <tr><td align="center"><b>Ketentuan</b></td></tr>
                                       <tr><td>' . $data['data']['redaksibody'] . '</td></tr>
                                       </table>';
                    }
                    $calc .= '
                            </td>
                        </tr>
                      <tr><td COLSPAN="5">&nbsp;</td></tr>';

                    // echo $calc;die();
                    if ($awalan_invoice != '080') {
                        $calc .= '    <tr>
                        <td COLSPAN="2" align="left" width="150px">DASAR PENGENAAN PAJAK</td>
                        <td COLSPAN="2" align="right" width="152px">' . $data['current'] . '</td>
                        <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                    </tr>

                    <tr>
                        <td COLSPAN="2" align="left">PPN 10%</td>
                        <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                        <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                    </tr>';
                    } else {
                        $calc .= '    <tr>
                        <td COLSPAN="2" align="left" width="150px">DASAR PENGENAAN PAJAK</td>
                        <td COLSPAN="2" align="right" width="152px">' . $data['current'] . '</td>
                        <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                    </tr>

                    <tr>
                        <td COLSPAN="2" align="left">PPN dibebaskan</td>
                        <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                        <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                    </tr>';
                    }
                    if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                            <td COLSPAN="2" align="left">Materai</td>
                            <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                        </tr>';
                    }
                    $calc .= '
                    <!--<tr>
                        <td COLSPAN="2" align="left">Materai</td>
                        <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                        <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                    </tr>-->


                    <tr>

                        <td COLSPAN="2" align="left"><b>Jumlah Tagihan</b></td>
                        <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                        <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                    </tr>
                    </table>';
                } else {
                    if ($awalan_invoice != '080') {
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="357px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN 10%</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                        </tr>';
                    } else {
                        $calc .= '    <tr>
                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                            <td COLSPAN="2" align="right" width="357px">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="100px">' . number_format($data['data']['jum_amount'], 0, ' ', '.') . '</td>
                        </tr>

                        <tr>
                            <td COLSPAN="2" align="left">PPN dibebaskan</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . $ppn_dibebaskan_rupa . '</td>
                        </tr>';
                    }

                    if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left">Materai</td>
                                <td COLSPAN="2" align="right">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                    }
                    $tampil_status = $data['data']['status_lunas'] == "Y" ? "Pelunasan" : "Jumlah Tagihan";
                    $calc .= '
                        <!--<tr>
                            <td COLSPAN="2" align="left">Materai</td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                        </tr>-->


                        <tr>
                            <td COLSPAN="2" align="left"><b>'. $tampil_status .'</b></td>
                            <td COLSPAN="2" align="right">' . $data['current'] . '</td>
                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;">' . number_format($data['data']['total_amount'], 0, ' ', '.') . '</td>
                        </tr>
                    </table>';
                }
                break;
            case 'BRG':
                 //print_r($data);die();
                $ppn_dibebaskan_brg = (int)$data['JumlahPenganaanPajak'] * 10 / 100;
                $ppn_dibebaskan_brg = number_format($ppn_dibebaskan_brg, 0, ',', '.');
                if ($data["headerSubContext"] == "BRG10") {
                    if ($awalan_invoice != '080') {
                        $calc .= '<tr>
                                <td>
                                    <table>
                                        ' . $data['data']['datatd10'] . '
                                        <tr><td></td></tr>
                                        <tr>
                                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                                            <td COLSPAN="2" align="right" width="40px">' . $data["current"] . '</td>
                                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data["jumlahPenganaanPajak"], 0, ' ', '.') . '</td>
                                        </tr>

                                        <tr>
                                            <td COLSPAN="2" align="left" width="200px">PPN 10%</td>
                                            <td COLSPAN="2" align="right" width="40px">' . $data["current"] . '</td>
                                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                                        </tr>';
                    } else {
                        $calc .= '<tr>
                                <td>
                                    <table>
                                        ' . $data['data']['datatd10'] . '
                                        <tr><td></td></tr>
                                        <tr>
                                            <td COLSPAN="2" align="left" width="200px">DASAR PENGENAAN PAJAK</td>
                                            <td COLSPAN="2" align="right" width="40px">' . $data["current"] . '</td>
                                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data["jumlahPenganaanPajak"], 0, ' ', '.') . '</td>
                                        </tr>

                                        <tr>
                                            <td COLSPAN="2" align="left" width="200px">PPN dibebaskan</td>
                                            <td COLSPAN="2" align="right" width="40px">' . $data['current'] . '</td>
                                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . $ppn_dibebaskan_brg . '</td>
                                        </tr>';
                    }

                    if ((int)$data['data']['materai'] > 0) {
                        $calc .= '<tr>
                                            <td COLSPAN="2" align="left" width="200px">Materai</td>
                                            <td COLSPAN="2" align="right" width="40px">' . $data["current"] . '</td>
                                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . $data['data']['materai'] . '</td>
                                        </tr>';
                    }
                    $calc .= '<tr>
                                            <td COLSPAN="2" align="left" width="200px">Jumlah Tagihan</td>
                                            <td COLSPAN="2" align="right" width="40px">' . $data["current"] . '</td>
                                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;" width="110px">' . number_format($data["jum_amount"], 0, ' ', '.') . '</td>
                                        </tr>
							  <tr>
                                            <td COLSPAN="2" align="left" width="200px">Uang Jaminan</td>
                                            <td COLSPAN="2" align="right" width="40px">' . $data["current"] . '</td>
                                            <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data['data']['uang_jaminan']) . '</td>
                                        </tr>';			
                    $status_pelunasan = $data['data']['status_lunas'] == 'Y' ? '<b>Pelunasan</b>' : '<b>Piutang</b>';
                    $calc .= '<tr>
                                    <td COLSPAN="2" align="left" width="200px">' . $status_pelunasan . '</td> 
                                    <td COLSPAN="2" align="right" width="40px">' . $data["current"] . '</td>
                                    <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data['data']['u_piutang']) . '</td>
                                </tr>';
                    $calc .= '                </table>

                                </td>
                                <td>
                                    <table>
                                    <tr>
                                        <td align="center" width="120px">&nbsp;</td>
                                        <td align="left" width="180px" COLSPAN="2">' . $data['data']['redaksibody'] . '</td>
                                    </tr>
                                    </table>

                                </td></tr>';
                } else {
                    if ($awalan_invoice == '080') {
						if (($data["headerSubContext"] == "BRG04" || $data["headerSubContext"] == "BRG03") && $data["jmlminimal"] > 0)
						{
							$calc .= '<tr>
                                <td COLSPAN="2" align="left" width="240px">Jasa Pembulatan Minimal</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data["jmlminimal"], 0, ' ', '.') . '</td>
                            </tr>';
						}					
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left" width="240px">DASAR PENGENAAN PAJAK</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data["jumlahPenganaanPajak"], 0, ' ', '.') . '</td>
                            </tr>

                            <tr>
                                <td COLSPAN="2" align="left" width="240px">PPN dibebaskan</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data['current'] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . $ppn_dibebaskan_brg . '</td>
                            </tr>';
                    } else {
						if (($data["headerSubContext"] == "BRG04" || $data["headerSubContext"] == "BRG03") && $data["jmlminimal"] > 0)
						{
							$calc .= '<tr>
                                <td COLSPAN="2" align="left" width="240px">Jasa Pembulatan Minimal</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data["jmlminimal"], 0, ' ', '.') . '</td>
                            </tr>';
                        }
                        if ($data['source_system'] == 'LINEOS') {
                            $calc .= '<tr>
                                <td COLSPAN="2" align="left" width="240px">Administrasi</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook; border-bottom:1px solid #000;" width="110px">' . number_format($data['data']['administrasi'], 0, ' ', '.') . '</td>
                            </tr>';
                        }
                        $calc .= '<tr>
                                <td COLSPAN="2" align="left" width="240px">DASAR PENGENAAN PAJAK</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data["jumlahPenganaanPajak"], 0, ' ', '.') . '</td>
                            </tr>

                            <tr>
                                <td COLSPAN="2" align="left" width="240px">PPN 10%</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data['data']['tax_amount'], 0, ' ', '.') . '</td>
                            </tr>';
                            if ($data['source_system'] == 'LINEOS') {
                                $calc .= '<tr>
                                <td COLSPAN="2" align="left" width="240px">Materai</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . number_format($data['data']['materai'], 0, ' ', '.') . '</td>
                            </tr>';
                            }
                    }
                    if ((int)$data['data']['materai'] > 0 && $data['source_system'] != 'LINEOS') {
                        $calc .= '<tr>
                                    <td COLSPAN="2" align="left" width="240px">Materai</td>
                                    <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                    <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">' . $data['data']['materai'] . '</td>
                                </tr>';
                    }
                    $calc .= '<tr>
                                <td COLSPAN="2" align="left" width="240px">Jumlah Tagihan</td>
                                <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;" width="110px">' . number_format($data["jum_amount"], 0, ' ', '.') . '</td>
                            </tr>';
                            if ($data['source_system'] != 'LINEOS') {
                                $calc .= '<tr>
                                    <td colspan="2" align="left" width="240px">Uang Jaminan</td>
                                    <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                    <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right"width="110px">' . number_format($data['data']['uang_jaminan'], 0, ',', '.') . '</td>
                                    <td></td>
        
                                  </tr>';
                            }
                    if ((int)$data['data']['u_piutang'] < 0) {
                        $calc .= '<tr>
                                    <td colspan="2" align="left" width="240px"><b>Sisa Uper</b></td>
                                    <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                                    <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right"width="110px">' . number_format(str_replace(".", "", str_replace("-", "", str_replace(",00", "", $data['data']['u_piutang']))), 0, ',', '.') . '</td>
                                </tr>';
                    } else {
                        if ($data['source_system'] != 'LINEOS') {
                            $status_pelunasan = $data['data']['status_lunas'] == 'Y' ? '<b>Pelunasan</b>' : '<b>Piutang</b>';
                            $calc .= '<tr>
                            <td colspan="2" align="left" width="240px">' . $status_pelunasan . '</td>
                            <td COLSPAN="2" align="right" width="300px">' . $data["current"] . '</td>
                            <td COLSPAN="1" style="font-size: 11px;font-family: franklingothicbook;" align="right"width="110px">' . number_format(str_replace(".", "", str_replace("-", "", str_replace(",00", "", $data['data']['u_piutang']))), 0, ',', '.') . '</td>
                        </tr>';
                        }
                    }

                }
                        /*if ($data['headerSubContext'] != 'BRG03'){
                            $calc.='<tr>
                                <td COLSPAN="2" align="left" width="240px">Jumlah Uper</td>
                                <td COLSPAN="2" align="right" width="300px">'.$data["current"].'</td>
                                <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;" width="110px">0</td>
                            </tr>';
                            if((int)$data["u_piutang"]<0){
                                $calc.='<tr>
                                    <td COLSPAN="2" align="left" width="240px"><b>Sisa Uper</b></td>
                                    <td COLSPAN="2" align="right" width="300px">'.$data["current"].'</td>
                                    <td COLSPAN="1" align="right" style="border-top:1px solid #000;font-size: 11px;font-family: franklingothicbook;" width="110px">'.number_format(abs((int)$data["u_piutang"]), 0, ' ', '.').'</td>
                                </tr>';
                            }else{
                                $calc.='<tr>
                                    <td COLSPAN="2" align="left" width="240px"><b>Piutang</b></td>
                                    <td COLSPAN="2" align="right" width="300px">'.$data["current"].'</td>
                                    <td COLSPAN="1" align="right" style="border-top:1px solid #000;font-size: 11px;font-family: franklingothicbook;" width="110px">'.number_format($data["u_piutang"], 0, ' ', '.').'</td>
                                </tr>';
                            }
                        }*/
                $calc .= '</table>';
                break;
            case 'KPL':
                $PPN_DIPUNGUT_SENDIRI = ($data['current'] == 'IDR') ? str_replace(",00", "", $data['data']['PPN_DIPUNGUT_SENDIRI']) : $data['data']['PPN_DIPUNGUT_SENDIRI'];
                $PPN_DIPUNGUT_PEMUNGUT = ($data['current'] == 'IDR') ? str_replace(",00", "", $data['data']['dipungut_pajak']) : $data['data']['dipungut_pajak'];
                $PPN_TIDAK_DIPUNGUT = ($data['current'] == 'IDR') ? str_replace(",00", "", $data['data']['PPN_TIDAK_DIPUNGUT']) : $data['data']['PPN_TIDAK_DIPUNGUT'];
                $PPN_TIDAK_DIBEBASKAN = ($data['current'] == 'IDR') ? str_replace(",00", "", $data['data']['PPN_DIBEBASKAN']) : $data['data']['PPN_DIBEBASKAN'];
                $parse = substr(substr($PPN_DIPUNGUT_SENDIRI, -3),0,1);
                $parse2 = substr(substr($PPN_DIPUNGUT_SENDIRI, -2),0,1);
                if ($parse == "." || $parse2 == ".") {
                    $PPN_DIPUNGUT_SENDIRI = number_format($PPN_DIPUNGUT_SENDIRI, 0, ' ', '.');
                }

                $PPN_DIPUNGUT_SENDIRI = ($PPN_DIPUNGUT_SENDIRI !== null || empty($PPN_DIPUNGUT_SENDIRI)) ? str_replace(",00", "", $PPN_DIPUNGUT_SENDIRI) : $PPN_DIPUNGUT_SENDIRI;
                $PPN_DIPUNGUT_PEMUNGUT = ($PPN_DIPUNGUT_PEMUNGUT !== null || empty($PPN_DIPUNGUT_PEMUNGUT)) ? str_replace(",00", "", $PPN_DIPUNGUT_PEMUNGUT) : $PPN_DIPUNGUT_PEMUNGUT;
                $PPN_TIDAK_DIPUNGUT = ($PPN_TIDAK_DIPUNGUT !== null || empty($PPN_TIDAK_DIPUNGUT)) ? str_replace(",00", "", $PPN_TIDAK_DIPUNGUT) : $PPN_TIDAK_DIPUNGUT;
                $PPN_TIDAK_DIBEBASKAN = ($PPN_TIDAK_DIBEBASKAN !== null || !empty($PPN_TIDAK_DIBEBASKAN)) ? str_replace(",00", "", $PPN_TIDAK_DIBEBASKAN) : $PPN_TIDAK_DIBEBASKAN;
                
                $calc .= '<tr>
                            <td width="20"></td>
                            <td width="200"></td>
                            <td></td>
                            <td align="right"> </td>
                            <td></td>
                            <td width="20"></td>
                            <td colspan="3"></td>
                          </tr>
                          <tr>
                            <td colspan="5">
                                <table>
                                ' . $data['data']['tbl_tail'] . '
                                </table>
                            </td>
                            <td ROWSPAN="14" colspan="3" width="180">
                                <table>
                                <tr><td>' . $data['data']['INV_REDAKSI_NOTE'] . '</td></tr>
                                </table>
                            </td>
                             
                          </tr>
                          <tr>
                            <td width="20"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td ></td>

                          </tr>
                          <tr>
                            <td width="25"></td>
                            <td></td>
                            <td width="70"></td>
                            <td></td>
                            <td></td>
                            <td width="30"></td>
                          </tr>
                          <tr>
                            <td colspan="2"><b>DASAR PENGENAAN PAJAK</b></td>
                            <td>' . $data["current"] . '</td>
                            <td style="font-size: 11px;font-family: franklingothicbook;" align="right"><b>' . number_format($data['data']['dasarpengenaanpajak'], 0, ',', '.') . '</b></td>
                            <td></td>


                          </tr>';
                          if ($awalan_invoice == '080') {
                            $calc .= '
                            <tr>
                              <td colspan="2">PPN 10%</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
  
                            </tr>';
                          } else {
                            $calc .= '
                            <tr>
                              <td colspan="2">PPN 10%</td>
                              <td></td>
                              <td></td>
                              <td></td>
                              <td></td>
  
                            </tr>';
                          }
                          $calc .= '
                          <tr>
                            <td width="25">a.</td>
                            <td>Dipungut Sendiri</td>
                            <td>' . $data["current"] . '</td>
                            <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($PPN_DIPUNGUT_SENDIRI, 0, ',', '.') . '</td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td>b.</td>
                            <td>PPN Dipungut Pemungut</td>
                            <td>' . $data["current"] . '</td>
                            <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($PPN_DIPUNGUT_PEMUNGUT, 0, ',', '.') . '</td>
                            <td></td>
                            <td width="30"></td>
                          </tr>
                          <tr>
                            <td>c.</td>
                            <td>PPN tidak dipungut</td>
                            <td>' . $data["current"] . '</td>
                            <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($PPN_TIDAK_DIPUNGUT, 0, ',', '.') . '</td>
                            <td></td>
                            <td></td>
                          </tr>';
                          //var_dump($data["data"]);die();
                          // if ($awalan_invoice == '080') {
                          //     $ppn_dibebaskan_again = $data['data']["dasarpengenaanpajak"] * 10/100;
                          //   //   var_dump($data["data"]);die();
                          //   $calc .= '
                          //   <tr>
                          //     <td>d.</td>
                          //     <td>PPN dibebaskan</td>
                          //     <td>' . $data["current"] . '</td>
                          //     <td style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($ppn_dibebaskan_again, 0, ',', '.').'</td>
                          //     <td></td>
                          //     <td></td>
                          //   </tr>';
                          // } else {
                            $calc .= '
                            <tr>
                              <td>d.</td>
                              <td>PPN dibebaskan</td>
                              <td>' . $data["current"] . '</td>
                              <td style="font-size: 11px;font-family: franklingothicbook;" align="right">'.number_format($PPN_TIDAK_DIBEBASKAN, 0, ',', '.').'</td>
                              <td></td>
                              <td></td>
                            </tr>';
                          // }
                if ((int)$data['data']['amount_materai'] > 0) {
                    $calc .= '<tr>
                                <td colspan="2">Materai</td>
                                <td>' . $data["current"] . '</td>
                                <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['amount_materai'], 0, ',', '.') . '</td>
                                <td></td>
                                <td></td>
                            </tr>';
                }
                $calc .= '
                          <!--<tr>
                            <td colspan="2">Materai</td>
                            <td>' . $data["current"] . '</td>
                            <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['amount_materai'], 0, ',', '.') . '</td>
                            <td></td>
                            <td></td>

                          </tr>-->
                          <tr>
                            <td width="159px" colspan="2">Jumlah Tagihan</td>
                            <td align="right" width="85px">' . $data["current"] . '</td>
                            <td width="135px" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;" align="right">' . number_format($data['data']['amount_tagihan'], 0, ',', '.') . '</td>
                            <td></td>
                            <td></td>
                          </tr>
                          <tr>
                            <td colspan="2">Uang Jaminan</td>
                            <td align="right">' . $data["current"] . '</td>
                            <td style="font-size: 11px;font-family: franklingothicbook;" align="right">' . number_format($data['data']['uang_jaminan'], 0, ',', '.') . '</td>
                            <td></td>
                             <td width="30"></td>

                          </tr>
                          <!--<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>-->';
                            // echo $data['data']['piutang'];die();
                if ((int)$data['data']['piutang'] < 0) {
                    $calc .= '<tr>
                                    <td COLSPAN="2" align="left" width="85px"><b>Sisa Uper</b></td>
                                    <td COLSPAN="2" align="right" width="159px">' . $data["current"] . '</td>
                                    <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;" width="135px">' . number_format(str_replace(".", "", str_replace("-", "", str_replace(",00", "", $data['data']['piutang']))), 0, ',', '.') . '</td>
                                </tr>';
                } else {
                    $status_pelunasan = $data['data']['status_lunas'] == 'Y' ? '<b>Pelunasan</b>' : '<b>Piutang</b>';
                    $calc .= '<tr>
                                    <td COLSPAN="2" align="left" width="85px">' . $status_pelunasan . '</td> 
                                    <td COLSPAN="2" align="right" width="159px">' . $data["current"] . '</td>
                                    <td COLSPAN="1" align="right" style="font-size: 11px;font-family: franklingothicbook;border-top:1px solid #000;" width="135px">' . number_format(str_replace(".", "", str_replace("-", "", str_replace(",00", "", $data['data']['piutang']))), 0, ',', '.') . '</td>
                                </tr>';
                }
                          /*'<tr>
                              <td colspan="2"><b>Piutang</b></td>
                              <td>'.$data["current"].'</td>
                              <td style="font-size: 11px;font-family: franklingothicbook;" align="right"><b>'.number_format($data['data']['amount_tagihan'],0,',','.').'</b></td>
                              <td></td>
                              <td></td>

                            </tr>'*/
                $calc .= '<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr><tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                          </tr>
                        </table>';
                break;
        }
        $tinggiTerbilang = "60";
        $lebarTerbilang = "450";    
        if ($data["headerSubContext"] == "BRG10") {
            $tinggiTerbilang = "10";
        }
        elseif ($data["headerSubContext"] == "RUPA09") {
            $tinggiTerbilang = "20";
            $lebarTerbilang = "330";
        }
        $terbilang = '<table><tr><td height="' . $tinggiTerbilang . '">&nbsp;</td></tr></table>
                <table>
                <tr>
                    <td COLSPAN="2" align="left" width="80px">Terbilang</td>
                    <td COLSPAN="1" align="left" width="10px">:</td>
                    <td COLSPAN="7" width="'.$lebarTerbilang.'" align="left">' . ucwords($data['terbilang']) . '</td></br>
                </tr>
                </table>';
                // echo $data['headerSubContext'];die();
                // echo count($data['get_redaksi_x']);print_r($data['get_redaksi_x']);die();
        /*switch($data['headerContext'])
        {*/
            // case 'BRG':
                // if($data["headerSubContext"]=="BRG10"){
        $redaksifooter = "";
		$redaksipajak = "";
        if (count($data['get_redaksi_x']) > 0) {
            $redaksifooter = $data['get_redaksi_x']->INV_REDAKSI_BAWAH;
			$redaksipajak = $data['get_redaksi_x']->INV_REDAKSI_PAJAK;
                        // $data_table .='<td ROWSPAN="'.$countLine.'" style="font-size: 11px;font-family: franklingothicbook;" align="center" width="160px">'.$redaksibody.'</td>';
            $terbilang .= '<table><tr><td height="20">&nbsp;</td></tr></table>
                        <table>
                        <tr>
                            <td width="620" align="left">' . $redaksifooter . '</td></br>
                        </tr>
                        </table>';
        }
                // }
            /*break;
        }*/


        if ($data['headerSubContext'] == 'RUPA09') {
        $ttd_footer = '<table><tr><td height="120">&nbsp;</td></tr></table>';
        }else{
        $ttd_footer = '<table><tr><td height="20">&nbsp;</td></tr></table>';
        }

         $ttd_footer .= '   <table>
            <table>
                <tr>
                    <td COLSPAN="5" ROWSPAN="5" align="left" width="150px"><img height="100" width="100" src="' . $data['barcode_location'] . '" /></td>
                    <td COLSPAN="5" ROWSPAN="5"  align="bottom" width="200px">';
		if ($redaksipajak !="") {				
		 $ttd_footer .= '<div align="center" border="1" > <b>'. $redaksipajak .'</b> </div>';		 
		}
		 $ttd_footer .= '</td>	
                    <td align="center" width="400px">' . $data['unit_loc'] . ', ' . $data['tgl_nota'] . '</td>
                </tr>';

        if ($data['jabatan_pejabat'] !== null) {
            $ttd_footer .= '<tr>
                      <td align="center" width="400px">' . $data['jabatan_pejabat'] . '</td>
                  </tr>
                  <tr>
                      <td width="130px">&nbsp;</td>
                      <td width="220px"><img style="padding-left:200" width="140" height="105" src="' . APP_ROOT . 'uploads/ttd/' . $data['ttd_pejabat'] . '"></td>
                  </tr>
                  <tr>
                      <td align="center" width="400px">' . $data['pejabat'] . '</td>
                  </tr>
                  <tr>
                      <td align="center" width="400px">NIPP. ' . $data['nip_pejabat'] . '</td>
                  </tr>';
        }

        $ttd_footer .= '</table>';

        // $footer = $calc.$terbilang.$ttd_footer.$ematerai;
        $footer = $calc . $terbilang . $ttd_footer;
        // echo $calc;die();
        return $footer;
    }
}
?>
