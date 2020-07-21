<style>
    .centered
    {
        text-align:center;
    }
    th{
        text-align: center;
        width: 1px;
    }
    .table tbody > tr > td:first-child {font-size: 13px;font-weight: 100;}
    tbody>tr>td:nth-child(3){text-align:center;}
    tbody>tr>td:nth-child(5){text-align:center;}
    tbody>tr>td:nth-child(6){text-align:right;}
    tbody>tr>td:nth-child(7){text-align:center;}
</style>

<div class="row">
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li>USTER</li>
            <li class="active"><span>CREATE INVOICE</span></li>
        </ol>

        <h1>CREATE INVOICE USTER</h1>
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
                            <div class="box-body">
                                <div class="col-md-5">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="box-body">
                                                <label for="" class="col-sm-3 control-label">No Nota</label>
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <input type="text" name="NO_NOTA" id="NO_NOTA" class="form-control" placeholder="Nomor Nota">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="box-body">
                                                <label for="" class="col-sm-3 control-label">No Request</label>
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <input type="text" name="NO_REQUEST" id="NO_REQUEST" class="form-control" placeholder="Nomor Request">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="box-body">
                                                <label for="" class="col-sm-3 control-label">Jenis Nota</label>
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <select for="" name="JENIS_NOTA" id="JENIS_NOTA" class="form-control select" style="width: 100%;">
                                                            <option value="">ALL</option>
                                                            <option value="UST02">RECEIVING DELIVERY</option>
                                                            <!--<option value="UST02">RECEIVING DEPO</option>-->
                                                            <option value="UST04">STUFFING</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="box-body">
                                        <div class="form-group">
                                            <div class="box-body">
                                                <label for="" class="col-sm-3 control-label">Customer</label>
                                                <div class="row">
                                                    <div class="col-xs-5">
                                                        <input type="text" name="CUSTOMER_NAME" id="CUSTOMER_NAME" class="form-control" placeholder="Customer">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="box-body">
                                                <label for="" class="col-sm-3 control-label">Tanggal Nota</label>
                                                <div class="row">
                                                    <div class="col-xs-4">
                                                        <input type="date" name="tgl_nota" id="tgl_nota" class="form-control" placeholder="dd/mm/yy">
                                                    </div>
                                                    <div class="col-xs-4">
                                                        <input type="date" name="tgl_nota2" id="tgl_nota2" class="form-control" placeholder="dd/mm/yy">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-body">
                                    <div class="col-sm-12 text-right">
                                        <button type="button" class="btn btn-primary btn-sm" data-toggle="" data-target="" onclick="clearreset()"> Clear</button>
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search" style="color:white;"> </i> Search</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <div class="main-box-body clearfix">
                <div class="table-responsive" id="tables">
                    <table id="dttable" class="table table-hover">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>No Nota</th>
                            <th>Jenis Nota</th>
                            <th>No Request</th>
                            <th>Tanggal Nota</th>
                            <th>Customer</th>
                            <th>Jumlah Total</th>
                            <th>Keterangan</th>
                        </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="confirmModal" class="modal fade" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div style="background-color:#B22222;" class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 style="color:white"; class="modal-title">Invoice</span></h4>
            </div>
            <div class="modal-body" style="height:500px; ">
                <span class="iframeuster"></span>
                <span class="text-me"></span>
            </div>

            <div class="modal-footer">
<!--                <a href="javascript:void(0)"  class="btn btn-primary btn-sm" data-orgid="" data-trxnumber="" data-jenisnota="" class="btn btn-primary" id="ok" ><i class="fa fa fa-file-text-o"></i> Invoice</a>-->
                <button type="button" class="btn btn-sm pull-left" data-dismiss="modal">Tutup</button>
            </div>
        </div>

    </div>
</div>

<script>
    var tableUster ;
    $(document).ready(function() {
        path = "<?php echo ROOT.'einvoice/nota_cabang/ustersearchcreate';?>";
        panjang = 20;
        data    = 0;
        if(data==1){
            if($("select[name=dttable_length]").val()!=undefined){
                panjang = $("select[name=dttable_length]").val();
            }
        }

        var NO_NOTA         = $("#NO_NOTA").val();
        var JENIS_NOTA	    = $("#JENIS_NOTA").val();
        var NO_REQUEST	    = $("#NO_REQUEST").val();
        var CUSTOMER_NAME	= $("#CUSTOMER_NAME").val();
        var tgl_nota	    = $("#tgl_nota").val();
        var tgl_nota2	    = $("#tgl_nota2").val();
        var panjang		    = panjang;
        var PAGE		    = 1;
        var datenota        = "-";

        tableUster = $('#dttable').DataTable({
            // "destroy": true,
            "serverSide": true,
            // "ordering": false,
            "processing": true,
            "order": [[ 2, "desc" ]],
            // "orderable": false,
            "dom" : "brtlp",
            "ajax": {
                "url": path,
                data : function ( d ) {
                    d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
                    d.KD_CABANG 	= $("#KD_CABANG").val();
                    d.NO_NOTA 	    = $("#NO_NOTA").val();
                    d.JENIS_NOTA 	= $("#JENIS_NOTA").val();
                    d.NO_REQUEST    = $("#NO_REQUEST").val();
                    d.CUSTOMER_NAME = $("#CUSTOMER_NAME").val();
                    d.tgl_nota 		= $("#tgl_nota").val();
                    d.tgl_nota2 	= $("#tgl_nota2").val();
                    d.panjang 		= panjang;
                    d.PAGE 			= PAGE;
                },
                "type": "POST"
            },
            "columns": [
                { "data": "RNUM" },
                { "data": "NO_NOTA" },
                { "data": "NAMA_LAYANAN" },
                { "data": "NO_REQUEST" },
                { "data": "TGL_REQUEST" },
                { "data": "CUSTOMER_NAME" },
                { "data": "jumlah" },
                { "data": "action2" },
            ],
        });
    });

    $("#formsearch").on('submit',(function(e) {
        e.preventDefault();
        loaddata();
    }));

    function print_usahaterminal(a,b,c,d,e){
        $(".iframeuster").html('<iframe width="100%" height="400px" src="<?php echo ROOT.'einvoice/nota_cabang/priview_create_nota/';?>'+a+'/'+b+'/'+c+'/'+d+'/'+e+'"></iframe>');
        $(".text-me").text("");
        $("#ok").attr('disabled',false);
        $("#ok").data("trxnumber",a);
        $("#ok").data("jenisnota",b);
        $("#ok").data("orgid",c);
        $("#ok").data("branchcode",d);
        $("#ok").data("kdcabang",e);
        $('#confirmModal').modal("show");
    }

    function loaddata(){
        tableUster.draw();
        return false;
    }

    function clearreset(){
        window.location.reload(true);
    }
</script>
