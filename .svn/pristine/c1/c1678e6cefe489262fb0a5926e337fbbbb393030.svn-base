<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/buttons.dataTables.min.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/responsive.dataTables.min.css" type="text/css" />
<style>.dt-buttons{display:none}</style>
<style>.custom {
    /*font-size: 8px;*/
    /*font-family: Arial;*/
</style>
<style type="text/css">
    .centered
    {
        text-align:center;
    }
    .margin{
        margin-top: 5%;
    }
    .margin2{
        margin-left: 5%;
    }
    .margin3{
        margin-left: 29%;
    }
    }
    .margin4{
        margin-left: 40%;
    }
</style>
<style>
    table.dataTable thead .sorting { background: url(/ui/adminLTE/plugins/datatables/images/sort_both.png) no-repeat center right; }
    table.dataTable thead .sorting_asc { background: url(/ui/adminLTE/plugins/datatables/images/sort_asc.png) no-repeat center right; }
    table.dataTable thead .sorting_desc { background: url(/ui/adminLTE/plugins/datatables/images/sort_desc.png) no-repeat center right; }

    table.dataTable thead .sorting_asc_disabled { background: url(/ui/adminLTE/plugins/datatables/images/sort_asc_disabled.png) no-repeat center right; }
    table.dataTable thead .sorting_desc_disabled { background: url(/ui/adminLTE/plugins/datatables/images/sort_desc_disabled.png) no-repeat center right; }



    .dataTables_wrapper .dataTables_paginate .paginate_button {
        background: none;
        color: #e84e40 !important;
        border-radius: 4px;
        border: 1px solid #ffffff;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
        background: none;
        color:#e84e40 !important;
        border-radius: 4px;
        border: 1px solid #ffffff;
        background-color: #eeeeee;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button:active {
        background: none;
        color: #ffffff !important;
        background-color: #e84e40;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current {
        background: none;
        color: #fff !important;
        border: 1px solid #ffffff;
        background-color: #e84e40;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
        background: none;
        color:#fff !important;
        background-color: #e84e40;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
        background: none;
        color:#e84e40 !important;
        background-color: #ffffff;
    }

    .dataTables_wrapper .dataTables_paginate .paginate_button.disabled:hover {
        background: none;
        color:#e84e40 !important;
        background-color: #ffffff;
    }
    th{
        text-align: center;
    }
    .table tbody > tr > td:first-child {font-size: 13px;font-weight: 100; }

    tbody>tr>td:nth-child(9){text-align:right;}
    tbody>tr>td:nth-child(10){text-align:right;}
    tbody>tr>td:nth-child(11){text-align:right;}
    tbody>tr>td:nth-child(12){text-align:center;}
    tbody>tr>td:nth-child(13){text-align:center;}
</style>
<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>Reporting</li>
            <li class="active"><span>Laporan Harian Periodik</span></li>
        </ol>

        <h1>LAPORAN HARIAN PERIODIK</h1>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="main-box clearfix">
            <header class="main-box-header clearfix"></header>
            <div class="box box-primary" style="padding: 10px;">
                <div class="box-body">
                    <div class="row">
                        <form class="form-horizontal" id="formsearch">
                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="box-body">
                                            <label for="" class="col-sm-3 control-label">Layanan</label>
                                            <div class="row">
                                                <div class="col-xs-5">
                                                    <select onchange="refreshRedaksi()" name="INV_NOTA_LAYANAN" id="INV_NOTA_LAYANAN" class="form-control select2" style="width: 100%;">
                                                        <option value="">All</option>
                                                        <option value="KPL">KAPAL</option>
                                                        <option value="BRG">BARANG</option>
                                                        <option value="PTKM">PETIKEMAS</option>
                                                        <option value="RUPA">RUPA-RUPA</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="box-body">
                                            <label for="" class="col-sm-3 control-label">Jenis Nota</label>
                                            <div class="row">
                                                <div class="col-xs-5">
                                                    <select for="" name="INV_NOTA_JENIS" id="INV_NOTA_JENIS" class="form-control select" style="width: 100%;">
                                                        <option value="">All</option>
                                                        <?php for ($i=0; $i < count($jenisnota); $i++) { ?>
                                                            <option value="<?php echo $jenisnota[$i]->INV_NOTA_CODE; ?>"><?php echo $jenisnota[$i]->INV_NOTA_JENIS; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="box-body">
                                            <label for="" class="col-sm-3 control-label">Status Bayar</label>
                                            <div class="row">
                                                <div class="col-xs-5">
                                                    <select name="STATUS_LUNAS" id="STATUS_LUNAS" class="form-control select2" style="width: 100%;">
                                                        <option value="">All</option>
                                                        <option value="Y">LUNAS</option>
                                                        <option value="X">KOREKSI</option>
                                                        <option value="XY">BELUM LUNAS</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="box-body">
                                    <div class="form-group">
                                        <div class="box-body">
                                            <label for="" class="col-sm-3 control-label">Customer</label>
                                            <div class="row">
                                                <div class="col-xs-5">
                                                    <input type="text" name="CUSTOMER" id="CUSTOMER" class="form-control" placeholder="CUSTOMER">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="box-body">
                                            <label for="" class="col-sm-3 control-label">Tanggal Nota</label>
                                            <div class="row">
                                                <div class="col-xs-4">
                                                    <div class="input-group">
                                                        <input type="date" name="TGL_PELUNASAN_START" id="TGL_PELUNASAN_START" class="form-control form_datetime" value="<?php echo $tgl=date('Y-m-d'); ?>" placeholder="yyyy-dd-mm">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12"><br>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="all" onclick="javascript:checkAll(this)"/>
                                        <label for="all">
                                            ALL
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="NO_NOTA" value="NO_NOTA" name="NO_NOTA" checked onclick="return false;"/>
                                        <label for="NO_RECEIPT">
                                            No Nota
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="CURRENCY" value="CURRENCY" name="CURRENCY" onclick="javascript:checkSingle(this)"/>
                                        <label for="CURRENCY">
                                            Currency
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="LAYANAN" value="LAYANAN" name="LAYANAN" onclick="javascript:checkSingle(this)"/>
                                        <label for="LAYANAN">
                                            Layanan
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="JENIS_NOTA" value="JENIS_NOTA" name="JENIS_NOTA" onclick="javascript:checkSingle(this)"/>
                                        <label for="JENIS_NOTA">
                                            Jenis Nota
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="PENDAPATAN" value="PENDAPATAN" name="PENDAPATAN" checked onclick="return false;"/>
                                        <label for="PENDAPATAN">
                                            Pendapatan
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="PPN" value="PPN" name="PPN" onclick="javascript:checkSingle(this)"/>
                                        <label for="PPN">
                                            PPN
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="TOTAL" value="TOTAL" name="TOTAL" checked onclick="return false;"/>
                                        <label for="TOTAL">
                                            Total
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="STATUS_TRANSFER" value="STATUS_TRANSFER" name="STATUS_TRANSFER" onclick="javascript:checkSingle(this)"/>
                                        <label for="STATUS_TRANSFER">
                                            Status Transfer
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="TGL_TRANSFER" value="TGL_TRANSFER" name="TGL_TRANSFER" checked onclick="return false;"/>
                                        <label for="TGL_TRANSFER">
                                            Tanggal Nota
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="CUSTOMER_NM" value="CUSTOMER_NM" name="CUSTOMER_NM" checked onclick="return false;"/>
                                        <label for="CUSTOMER_NM">
                                            Customer
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="TANGGAL_LUNAS" value="TANGGAL_LUNAS" name="TANGGAL_LUNAS" onclick="javascript:checkSingle(this)"/>
                                        <label for="TANGGAL_LUNAS">
                                            Tanggal Lunas
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="BANK" value="BANK" name="BANK" onclick="javascript:checkSingle(this)"/>
                                        <label for="BANK">
                                            Bank
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-nice">
                                        <input type="checkbox" id="STS_LUNAS" value="STS_LUNAS" name="STS_LUNAS" onclick="javascript:checkSingle(this)"/>
                                        <label for="STS_LUNAS">
                                            Status Lunas
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="box-body">
                                <div class="col-sm-12 text-right">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="clearreset()"> Clear</button>
                                    <button onclick="exportexcel2()" class="btn btn-primary btn-sm" >Export To Excel</button>
                                    <button onclick="exportpdf2()"   class="btn btn-primary btn-sm" >Print Report</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/buttons.flash.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/vfs_fonts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/libs/buttons.html5.min.js"></script>

<script type="text/javascript">
    $(".form_datetime").date({
        format: "dd/mm/yyyy",
    });
</script>

<script>
    $("#formsearch").on('submit',(function(e) {
        e.preventDefault();
        loaddata();
    }));

    $(document).ready(function() {
        $('#dynamic-table').DataTable();
    });

    $("#excelexport").click(function(){
        $(".dt-button.buttons-excel.buttons-html5").click();
        return false;
    });

    $("#pdfexport").click(function(){
        $(".dt-button.buttons-pdf.buttons-html5").click();
        return false;
    });


    function loaddata(){
        var path = '';
        path = "<?php echo ROOT.'einvoice/nota/periodiksearch';?>";

        var CUSTOMER_NAME		= $('#CUSTOMER').val();
        var INV_NOTA_JENIS		= $('#INV_NOTA_JENIS').val();
        var HEADER_CONTEXT	 	= $("#INV_NOTA_LAYANAN").val();
        var STATUS_LUNAS		= $("#STATUS_LUNAS").val();
        var TGL_PELUNASAN_START = $("#TGL_PELUNASAN_START").val();
        var TGL_PELUNASAN_END 	= $("#TGL_PELUNASAN_END").val();

        $('#dynamic-table').DataTable( {
            "bFilter": false,
            "bInfo": false,
            "order": [[ 12, "desc" ]],
            "lengthMenu": [ 10, 25, 50, 100, 250 ],
            "fixedHeader": false,
            "autoWidth": true,
            "destroy": true, responsive: true,
            dom: 'Bfrtp<"bottom"li><"clear">',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                        columns: [  0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
                    },
                    title: 'LAPORAN PERIODIK',
                    filename: 'Laporan Periodik',
                    messageTop: 'Jenis Nota 	 : '+$('#INV_NOTA_LAYANAN option:selected').text()+'                                                                                                                                                                                                                                                                                              Periode : All ' + '\n' + '\n' + 'Layanan          : '+$('#INV_NOTA_JENIS option:selected').text()+'' + '\n' +  '\n' + 'Status Bayar  : '+$('#STATUS_LUNAS option:selected').text()+'',
                    orientation: 'landscape',
                    pageSize: 'A4',
                    widths: [ 'auto', '*', '*' ] ,
                    customize: function(doc) {
                        doc['footer']=(function(page, pages) {
                            return {
                                columns: [
                                    '',
                                    {
                                        alignment: 'right',
                                        text: [
                                            { text: page.toString(), italics: true },
                                            ' of ',
                                            { text: pages.toString(), italics: true }
                                        ]
                                    }
                                ],
                                margin: [10, 0]
                            }
                        });

                        doc.content.splice( 0, 0, {
                            margin: [ 0, 0, 0, 0 ],
                            alignment: 'left',
                            image: 'data:image/jpeg;base64,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',
                            width: 75
                        } );
                        doc.defaultStyle.fontSize = 7; //<-- set fontsize to 16 instead of 10
                        doc.defaultStyle.alignment = 'left';
                        doc.styles.title.fontSize = 20;
                        doc.styles.tableHeader.fontSize = 8;
                        doc.pageMargins = [20,20,20,20];
                        doc.styles['td:nth-child(2)'] = {
                            width: '500px',
                            'max-width': '500px'
                        }
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [  0,1,2,3,4,5,6,7,8,9,10,11,12,13,14]
                    },
                    title: '',
                    filename: 'Laporan Periodik',
                    exportOptions: {
                        fontSize: 11,
                        stripHtml: false
                    },

                    customize: function (xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        var numrows = 8;
                        var clR = $('row', sheet);

                        clR.each(function () {
                            var attr = $(this).attr('r');
                            var ind = parseInt(attr);
                            ind = ind + numrows;
                            $(this).attr("r",ind);
                        });

                        // Create row before data
                        $('row c ', sheet).each(function () {
                            var attr  = $(this).attr('r');
                            var pre   = attr.substring(0, 1);
                            var ind   = parseInt(attr.substring(1, attr.length));
                            ind = ind + numrows;
                            $(this).attr("r", pre + ind);
                        });

                        function Addrow(index,data) {
                            msg = '<row r="'+index+'">'
                            for(i=0;i<data.length;i++){
                                var key=data[i].key;
                                var value=data[i].value;
                                msg += '<c t="inlineStr" r="' + key + index + '">';
                                msg += '<is>';
                                msg += '<t>'+value+'</t>';
                                msg += '</is>';
                                msg += '</c>';
                            }
                            msg += '</row>';
                            return msg;
                        }

                        //insert
                        var r2 = Addrow(2, [{ key: 'C', value: 'PT. Pelabuhan Indonesia II (Persero)' }/*,  { key: 'F', value: $('#TGL_PELUNASAN_START').val() }, { key: 'G', value: '-' }, { key: 'H', value: $('#TGL_PELUNASAN_END').val() }*/,]);
                        var r4 = Addrow(5, [{ key: 'C', value: 'LAPORAN PERIODIK' },]);
                        var r1 = Addrow(6, [{ key: 'C', value: 'PERIODE : ' },{ key: 'D', value: $('#TGL_PELUNASAN_START').val() },{ key: 'E', value: '-' },{ key: 'F', value: $('#TGL_PELUNASAN_END').val() }, ]);
                        sheet.childNodes[0].childNodes[1].innerHTML =  r2+ r4+ r1 + sheet.childNodes[0].childNodes[1].innerHTML;
                    }
                }

            ],

            /* "columnDefs":[
                {
                    "width" : "300%" ,
                     "targets": [2] ,
                }
            ],*/
            "ajax": {
                "url": path,
                data : function ( d ) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    d.INV_NOTA_JENIS		= INV_NOTA_JENIS;
                    d.CUSTOMER_NAME			= CUSTOMER_NAME;
                    d.HEADER_CONTEXT		= HEADER_CONTEXT;
                    d.STATUS_LUNAS 			= STATUS_LUNAS;
                    d.TGL_PELUNASAN_START	= TGL_PELUNASAN_START;
                    d.TGL_PELUNASAN_END 	= TGL_PELUNASAN_END;
                    d.UNIT_CODE 			= '<?php echo $this->session->userdata('unit_id') ?>';
                    d.ROLE_TYPE				= '<?php echo $this->session->userdata('role_type') ?>';
                    d.ORG_ID				= '<?php echo $this->session->userdata('unit_org') ?>';
                },
                "type": "POST"
            },
            "columns": [
                //{ "data": "num" },
                { "data": "TRX_NUMBER" },
                { "data": "TRX_DATE" },
                { "data": "CUSTOMER_NAME"},
                { "data": "CURRENCY_CODE"},
                { "data": "INV_NOTA_LAYANAN" },
                { "data": "INV_NOTA_JENIS"},
                { "data": "CUSTOMER_NPWP"},
                { "data": "AMOUNT_DASAR_PENGHASILAN" },
                { "data": "PPN_10PERSEN"},
                { "data": "AMOUNT"},
                { "data": "AR_STATUS"},
                { "data": "STATUS_LUNAS"},
                { "data": "TGL_PELUNASAN"},
                { "data": "RECEIPT_ACCOUNT"},
            ],} );
        return false;
    }
</script>

<script type="text/javascript">

    function clearreset(){
        window.location.reload(true);
    }

    function checkAll(o) {
        var boxes = document.getElementsByTagName("input");
        for (var x = 0; x < boxes.length; x++) {
            var obj = boxes[x];
            if (obj.type == "checkbox") {
                //if (obj.name != "check")
                if (obj.name != "NO_NOTA" && obj.name != "TOTAL" && obj.name != "TGL_TRANSFER" && obj.name != "CUSTOMER_NM" && obj.name != "PENDAPATAN")
                    obj.checked = o.checked;
            }
        }
    }

    function checkSingle(o) {
        var boxes = document.getElementsByTagName("input");
        for (var x = 0; x < boxes.length; x++) {
            var obj = boxes[x];
            if (obj.type == "checkbox") {
                if (obj.name == "")
                    obj.checked = o.uncheck;
            }
        }
    }

    function exportexcel2(){
        var CUSTOMER_NAME		= $('#CUSTOMER').val();
        var INV_NOTA_JENIS		= $('#INV_NOTA_JENIS').val();
        var HEADER_CONTEXT	 	= $("#INV_NOTA_LAYANAN").val();
        var STATUS_LUNAS		= $("#STATUS_LUNAS").val();
        var TGL_PELUNASAN_START = $("#TGL_PELUNASAN_START").val(); //yyyy-mm-dd
        var PERIODIK_HARIAN     = true;
        if(TGL_PELUNASAN_START == '')
        {
            var now = new Date();
            var dataTgl = now.toISOString().substr(0, 10);
            var TGL_PELUNASAN_START = dataTgl; //yyyy-mm-dd
        }
        var NO_NOTA             = $("#NO_NOTA").is(":checked") ? true : false;
        var CURRENCY            = $("#CURRENCY").is(":checked") ? true : false;
        var LAYANAN             = $("#LAYANAN").is(":checked") ? true : false;
        var JENIS_NOTA          = $("#JENIS_NOTA").is(":checked") ? true : false;
        var PENDAPATAN          = $("#PENDAPATAN").is(":checked") ? true : false;
        var PPN                 = $("#PPN").is(":checked") ? true : false;
        var TOTAL               = $("#TOTAL").is(":checked") ? true : false;
        var STATUS_TRANSFER     = $("#STATUS_TRANSFER").is(":checked") ? true : false;
        var TGL_TRANSFER        = $("#TGL_TRANSFER").is(":checked") ? true : false;
        var CUSTOMER_NM         = $("#CUSTOMER_NM").is(":checked") ? true : false;
        var TANGGAL_LUNAS       = $("#TANGGAL_LUNAS").is(":checked") ? true : false;
        var BANK                = $("#BANK").is(":checked") ? true : false;
        var STS_LUNAS           = $("#STS_LUNAS").is(":checked") ? true : false;
        window.open('<?php echo ROOT.'einvoice/reporting/cetak_laporanharianperiodik_excel';?>?'
            +"CUSTOMER_NAME="+CUSTOMER_NAME+"&"
            +"INV_NOTA_JENIS="+INV_NOTA_JENIS+"&"
            +"HEADER_CONTEXT="+HEADER_CONTEXT+"&"
            +"STATUS_LUNAS="+STATUS_LUNAS+"&"
            +"TGL_PELUNASAN_START="+TGL_PELUNASAN_START+"&"
            +"ORG_ID="+'<?php echo $this->session->userdata('unit_org'); ?>'+"&"
            +"UNIT_CODE="+'<?php echo $this->session->userdata('unit_id'); ?>'+"&"
            +"NO_NOTA="+NO_NOTA+"&"
            +"CURRENCY="+CURRENCY+"&"
            +"LAYANAN="+LAYANAN+"&"
            +"JENIS_NOTA="+JENIS_NOTA+"&"
            +"PENDAPATAN="+PENDAPATAN+"&"
            +"PPN="+PPN+"&"
            +"TOTAL="+TOTAL+"&"
            +"STATUS_TRANSFER="+STATUS_TRANSFER+"&"
            +"TGL_TRANSFER="+TGL_TRANSFER+"&"
            +"CUSTOMER_NM="+CUSTOMER_NM+"&"
            +"TANGGAL_LUNAS="+TANGGAL_LUNAS+"&"
            +"BANK="+BANK+"&"
            +"STS_LUNAS="+STS_LUNAS+"&"
            +"PERIODIK_HARIAN="+PERIODIK_HARIAN+"&"
            ,'_blank');
    }

    function exportpdf2(){
        var CUSTOMER_NAME		= $('#CUSTOMER').val();
        var INV_NOTA_JENIS		= $('#INV_NOTA_JENIS').val();
        var HEADER_CONTEXT	 	= $("#INV_NOTA_LAYANAN").val();
        var STATUS_LUNAS		= $("#STATUS_LUNAS").val();
        var TGL_PELUNASAN_START = $("#TGL_PELUNASAN_START").val(); //yyyy-mm-dd
        var PERIODIK_HARIAN     = true;
            if(TGL_PELUNASAN_START == '')
            {
                var now = new Date();
                var dataTgl = now.toISOString().substr(0, 10);
                var TGL_PELUNASAN_START = dataTgl; //yyyy-mm-dd
            }
        var NO_NOTA             = $("#NO_NOTA").is(":checked") ? true : false;
        var CURRENCY            = $("#CURRENCY").is(":checked") ? true : false;
        var LAYANAN             = $("#LAYANAN").is(":checked") ? true : false;
        var JENIS_NOTA          = $("#JENIS_NOTA").is(":checked") ? true : false;
        var PENDAPATAN          = $("#PENDAPATAN").is(":checked") ? true : false;
        var PPN                 = $("#PPN").is(":checked") ? true : false;
        var TOTAL               = $("#TOTAL").is(":checked") ? true : false;
        var STATUS_TRANSFER     = $("#STATUS_TRANSFER").is(":checked") ? true : false;
        var TGL_TRANSFER        = $("#TGL_TRANSFER").is(":checked") ? true : false;
        var CUSTOMER_NM         = $("#CUSTOMER_NM").is(":checked") ? true : false;
        var TANGGAL_LUNAS       = $("#TANGGAL_LUNAS").is(":checked") ? true : false;
        var BANK                = $("#BANK").is(":checked") ? true : false;
        var STS_LUNAS           = $("#STS_LUNAS").is(":checked") ? true : false;
        window.open('<?php echo ROOT.'einvoice/reporting/cetak_laporanharianperiodik';?>?'
            +"CUSTOMER_NAME="+CUSTOMER_NAME+"&"
            +"INV_NOTA_JENIS="+INV_NOTA_JENIS+"&"
            +"HEADER_CONTEXT="+HEADER_CONTEXT+"&"
            +"STATUS_LUNAS="+STATUS_LUNAS+"&"
            +"TGL_PELUNASAN_START="+TGL_PELUNASAN_START+"&"
            +"ORG_ID="+'<?php echo $this->session->userdata('unit_org'); ?>'+"&"
            +"UNIT_CODE="+'<?php echo $this->session->userdata('unit_id'); ?>'+"&"
            +"NO_NOTA="+NO_NOTA+"&"
            +"CURRENCY="+CURRENCY+"&"
            +"LAYANAN="+LAYANAN+"&"
            +"JENIS_NOTA="+JENIS_NOTA+"&"
            +"PENDAPATAN="+PENDAPATAN+"&"
            +"PPN="+PPN+"&"
            +"TOTAL="+TOTAL+"&"
            +"STATUS_TRANSFER="+STATUS_TRANSFER+"&"
            +"TGL_TRANSFER="+TGL_TRANSFER+"&"
            +"CUSTOMER_NM="+CUSTOMER_NM+"&"
            +"TANGGAL_LUNAS="+TANGGAL_LUNAS+"&"
            +"BANK="+BANK+"&"
            +"STS_LUNAS="+STS_LUNAS+"&"
            +"PERIODIK_HARIAN="+PERIODIK_HARIAN+"&"
            ,'_blank');
    }
</script>

<script>
    function SetDate($date){
        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        var dt1;
        var formattedDate1 = new Date($date);
        var d1 = formattedDate1.getDate();
        var m1 = monthNames[formattedDate1.getMonth()];
        var y1 = formattedDate1.getFullYear();
        dt1  = d1+'-'+m1+'-'+y1;
        return dt1;
    }

    function GetDate(str)
    {
        var arr = str.split("-");
        var months = ["jan", "feb", "mar", "apr", "may", "jun", "jul", "aug", "sep", "oct", "nov", "dec"];

        var month = (1+months.indexOf(arr[1].toLowerCase())).toString();
        if(month.length==1) month='0'+month;
        var year = '20' + parseInt(arr[2]);
        var day = parseInt(arr[0]);
        var result = year + '-' + month + '-' + ((day < 10 ) ? "0"+day : day);
        return result;
    }

    function refreshRedaksi()
    {
        // alert('123');
        var path = '';
        path = "<?php echo ROOT.'einvoice/unit/getNota';?>";
        // var INV_NOTA_LAYANAN = 'KAPAL';

        $.post( path, {'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
            ,INV_NOTA_LAYANAN:$("#INV_NOTA_LAYANAN").val()
        }).done(function( data ) {
            // INV_NOTA_JENIS
            var parse = JSON.parse(data);
            var html = '<option value="" selected>All</option>';
            $.each( parse, function( key, value ) {
                console.log(value);
                html += "<option value='"+value.INV_NOTA_CODE+"'>"+value.INV_NOTA_JENIS+"</option>"
                // alert( key + ": " + value );
            });
            $("#INV_NOTA_JENIS").html(html);
            console.log(data);
            // $('#update_unit').modal('show');
        });
        return false;
    }
</script>