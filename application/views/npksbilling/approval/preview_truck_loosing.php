<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.theme.css" />
<script src="<?= CUBE_ ?>js/jquery.nanoscroller.min.js"></script>
<script src="<?= CUBE_ ?>js/modernizr.custom.js"></script>
<script src="<?= CUBE_ ?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?= CUBE_ ?>js/classie.js"></script>
<script src="<?= CUBE_ ?>js/notificationFx.js"></script>
<script src="<?= CUBE_ ?>js/sweetalert2/dist/sweetalert2.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>js/sweetalert2/dist/sweetalert2.min.css" />

<!-- global scripts -->
<script src="<?= JSQ ?>jquery-ui.min.js"></script>

<style type="text/css">
    .upload_info {
        font-size: small;
        font-style: italic;
        float: right;
    }

    .hidden_content {
        display: none;
    }

    #component_type {
        float: left;
    }

    #component_reefer {
        float: left;
        margin-left: 10px;
    }

    .main-box-footer {
        text-align: center;
        margin-bottom: 30px;
    }

    .btn-footer {
        width: 100px;
    }

    input[type=radio] {
        vertical-align: middle;
        width: 17px;
        height: 17px;
    }
</style>

<script>
</script>
<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Header</b></h2>
            </header>
            <div class="main-box-body clearfix">
                <div class="form-group col-xs-6">
                    <label>PBM / EMKL</label>
                    <input name="TL_PBM_NAME" id="TL_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input name="TL_PBM_ID" id="TL_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Nomor Request</label>
                    <input name="TL_NO" id="TL_NO" type="text" class="form-control" placeholder="Auto Generate" disabled>
                    <input name="TL_ID" id="TL_ID" type="hidden" class="form-control" placeholder="Auto Generate" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label>Penumpukan Oleh</label>
                    <input name="TL_STACKBY_NAME" id="TL_STACKBY_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input name="TL_STACKBY_ID" id="TL_STACKBY_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Date</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="TL_DATE" name="TL_DATE" type="text" class="form-control" value="<?= date('Y-m-d') ?>" disabled readOnly>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label>Receiving From</label>
                    <select id="TL_FROM" name="TL_FROM" class="form-control" disabled>
                        <option value="not-selected"> -- Please Choose Receiving From -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label>Delivery From</label>
                    <select id="TL_TO" name="TL_TO" class="form-control" disabled>
                        <option value="not-selected"> -- Please Choose Delivery From -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-12">
                    <label>Payment Method</label>
                    <select id="TL_PAYMETHOD" name="TL_PAYMETHOD" class="form-control" disabled>
                        <option value="not-selected"> -- Please Choose Payment Method -- </option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Data Kapal</b></h2>
            </header>
            <div class="main-box-body clearfix">
                <div class="form-group col-xs-6">
                    <label>Vessel</label>
                    <input name="TL_VESSEL_NAME" id="TL_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input type="hidden" id="TL_VESSEL_CODE" class="form-control" name="TL_VESSEL_CODE" required>
                    <input type="hidden" id="TL_VESSEL" class="form-control" name="TL_VESSEL" required>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="TL_VESSEL_AGENT" id="TL_VESSEL_AGENT" type="text" class="form-control" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>No PKK</label>
                    <input name="TL_VESSEL_PKK" id="TL_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" disabled readonly="">
                    <input name="TL_VVD_ID" id="TL_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" disabled readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage In</label>
                    <input name="TL_VOYIN" id="TL_VOYIN" type="text" class="form-control" placeholder="Voyage In" disabled readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage Out</label>
                    <input name="TL_VOYOUT" id="TL_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" disabled readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETA</label>
                    <input name="TL_VESSEL_ETA" id="TL_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label>ETD</label>
                    <input name="TL_VESSEL_ETD" id="TL_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 ">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Dokumen</b></h2>
            </header>

            <div class="main-box-body clearfix">
                <table id="myTable" class="table order-list list_file">
                    <tr>

                    </tr>
                    <div class="form-group example-twitter-oss">
                    </div>
                </table>

                <div class="form-group example-twitter-oss pull-right">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="" id='show-detail'>
    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Detail</b></h2>
                </header>
                <input id="DTL_ID" name="DTL_ID" type="hidden" class="form-control">
                <div class="main-box-body clearfix">

                    <table class="table table-striped table-hover" id="detail-list">
                        <thead>
                            <tr>
                                <th>Container Owner</th>
                                <th>No Container</th>
                                <th>TL</th>
                                <th>Ukuran</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Dangerous Goods</th>
                                <th>Kemasan</th>
                                <th>Receiving Via</th>
                                <th>Delivery Via</th>
                                <th>Tanggal Receiving</th>
                                <th>Tanggal Delivery</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2>
                        <div id="tagihan-cust"></div>
                    </h2>
                </header>
                <div class="main-box-body clearfix">
                    <div id="tagihan-label" class="hidden_content">
                        <strong>Detail Tagihan not Found.</strong>
                    </div>
                    <table class="table table-striped table-hover" id="detail-handling-list">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Layanan</th>
                                <th colspan="3" style="vertical-align:middle; text-align:center;">Keterangan</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Quantity</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Tarif Dasar</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Total</th>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle; text-align:center;">Size</th>
                                <th style="vertical-align:middle; text-align:center;">Type</th>
                                <th style="vertical-align:middle; text-align:center;">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table><br><br>
                    <div id="total-label" class="">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4">
                            <h5><strong>Total</strong></h5>
                            <hr>
                            <div class="form-group">
                                <label>DPP:</label>
                                <input name="DEL_DPP" id="DEL_DPP" type="text" class="form-control" required="" style="text-align:right;" readonly>
                            </div>
                            <div class="form-group">
                                <label>PPN 10%:</label>
                                <input name="DEL_PPN" id="DEL_PPN" type="text" class="form-control" required="" style="text-align:right;" readonly>
                            </div>
                            <div class="form-group">
                                <label>Total Perhitungan:</label>
                                <input name="DEL_TOTAL" id="DEL_TOTAL" type="text" class="form-control" required="" style="text-align:right;" readonly>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    &nbsp;
                </header>
                <div class="main-box-body clearfix">
                    <div class="form-group example-twitter-oss pull-right">
                        <button class="btn btn-danger btn-footer" onclick="save_approval('approve')"><span class="glyphicon glyphicon-ok-sign"></span>&nbsp;&nbsp;Approve</button>
                        <button class="btn btn-primary btn-footer" onclick="show_reject('reject')"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Reject</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal reject -->
<div class="modal fade" id="modal_reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Input Remarks</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control" id="alasan_reject" name="alasan_reject"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" onclick="save_approval('reject', $('#alasan_reject').val())" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
    var counterdoc = 0;
    counterdetail = 0;
    var apiUrl = "http://10.88.48.33/api/public/";

    function show_reject() {
        $('#modal_reject').modal();
    }

    function save_approval(action, remarks) {
        var text = '';
        var urlaction = "";
        if (action == 'approve') {
            urlaction = "<?php echo ROOT ?>npksbilling/appbooktl/approve/<?php echo $id; ?>";
        } else {
            urlaction = "<?php echo ROOT ?>npksbilling/appbooktl/reject/<?php echo $id; ?>";
        }
        if (action == 'approve') {
            text = "Apakah Anda Yakin Approve Data Ini ?";
            Swal.fire({
                title: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    $.blockUI();
                    $.ajax({
                        url: urlaction,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.unblockUI();
                            var array_data = JSON.parse(data);
                            if (array_data['Success'] == undefined) {
                                $.unblockUI();
                                resp = JSON.parse(array_data);
                                no_req = resp.no_req;
                                Swal.fire({
                                    icon: 'success',
                                    title: array_data['result'],
                                    showConfirmButton: false,
                                    timer: 1500,
                                    text: "Approval " + $('#TL_NO').val() + " berhasil"
                                })
                                approvetl_log(no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/appbooktl";
                                }, 1000);
                            } else {
                                if (array_data['Success'] == true) {
                                    $.unblockUI();
                                    resp = JSON.parse(array_data);
                                    no_req = resp.no_req;
                                    Swal.fire({
                                        icon: 'success',
                                        title: array_data['result'],
                                        showConfirmButton: false,
                                        timer: 1500,
                                        text: "Approval " + $('#TL_NO').val() + " berhasil"
                                    })
                                    approvetl_log(no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/appbooktl";
                                    }, 1000);
                                } else {
                                    $.unblockUI();
                                    Swal.fire({
                                        icon: 'error',
                                        title: array_data['result'],
                                        showConfirmButton: false,
                                        timer: 1500,
                                        text: "Approval " + $('#TL_NO').val() + " gagal"
                                    })
                                }
                            }
                        }
                    });
                }
            });
        } else {
            $.blockUI();
            $.ajax({
                url: urlaction,
                type: 'POST',
                dataType: 'json',
                data: {
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                    remarks: remarks
                },
                success: function(data) {
                    var array_data = JSON.parse(data);
                    $('#modal_reject').modal('hide');
                    if (array_data['Success'] == undefined) {
                        $.unblockUI();
                        resp = JSON.parse(array_data);
                        no_req = resp.no_req;
                        Swal.fire({
                            icon: 'success',
                            title: array_data['result'],
                            showConfirmButton: false,
                            timer: 1500,
                            text: "Reject " + $('#TL_NO').val() + " berhasil"
                        })
                        rejecttl_log(no_req);
                        setTimeout(function() {
                            window.location = "<?= ROOT ?>npksbilling/appbooktl";
                        }, 1000);
                    } else {
                        if (array_data['Success'] == true) {
                            $('#modal_reject').modal('hide');
                            $.unblockUI();

                            Swal.fire({
                                icon: 'success',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#TL_NO').val() + " berhasil"
                            })
                            rejecttl_log(no_req);
                            setTimeout(function() {
                                window.location = "<?= ROOT ?>npksbilling/appbooktl";
                            }, 1000);
                        } else {
                            $.unblockUI();
                            Swal.fire({
                                icon: 'error',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#TL_NO').val() + " gagal"
                            })
                        }
                    }
                }
            });
        }
    }

    function rejecttl_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/rejecttl_log",
            type: 'POST',
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                no_req: no_req,

            },
            success: function(data) {
                if (data != null) {
                    console.log('Data Tersimpan ke LOG');
                }

            }
        });
    }

    function approvetl_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/approvetl_log",
            type: 'POST',
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                no_req: no_req,

            },
            success: function(data) {
                if (data != null) {
                    console.log('Data Tersimpan ke LOG');
                }

            }
        });
    }

    $(document).ready(function() {

        //from
        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/mdm/from",
            success: function(data) {
                var obj = JSON.parse(data);
                var record = obj['result'];

                var toAppend = '';
                for (var i = 0; i < record.length; i++) {
                    toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
                }

                $('#TL_FROM').append(toAppend);
            }
        });

        //tO
        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/mdm/to",
            success: function(data) {
                var obj = JSON.parse(data);
                var record = obj['result'];

                var toAppend = '';
                for (var i = 0; i < record.length; i++) {
                    toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
                }

                $('#TL_TO').append(toAppend);
            }
        });

        //payment method
        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/mdm/paymethod",
            success: function(data) {
                var obj = JSON.parse(data);
                var record = obj['result'];

                var toAppend = '';
                for (var i = 0; i < record.length; i++) {
                    toAppend += '<option value="' + record[i]['reff_order'] + '">' + record[i]['reff_name'] + '</option>';
                }

                $('#TL_PAYMETHOD').append(toAppend);
            }
        });
        //getdata
        var id_tl = "<?= $id ?>";
        if (id_tl != "") {
            $.blockUI();
            $.ajax({
                url: "<?= ROOT ?>npksbilling/appbooktl/update_tl/" + id_tl,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.HEADER != "") {
                        $.unblockUI();
                        arrData = data;
                        arrData.HEADER.forEach(function(item, index) {
                            $("#TL_ID").val(item.tl_id);
                            $("#TL_NO").val(item.tl_no);
                            $("#TL_DATE").val(item.tl_date);
                            $("#TL_PAYMETHOD").val(item.tl_paymethod);
                            $("#TL_CUST_ID").val(item.tl_cust_id);
                            $("#TL_CUST_NAME").val(item.tl_cust_name);
                            $("#TL_CUST_ADDRESS").val(item.tl_cust_address);
                            $("#TL_CUST_NPWP").val(item.tl_cust_npwp);
                            $("#TL_CUST_ACCOUNT").val(item.tl_cust_account);
                            $("#TL_STACKBY_ID").val(item.tl_stackby_id);
                            $("#TL_STACKBY_NAME").val(item.tl_stackby_name);
                            $("#TL_VESSEL_CODE").val(item.tl_vessel_code);
                            $("#TL_VESSEL_NAME").val(item.tl_vessel_name);
                            $("#TL_VOYIN").val(item.tl_voyin);
                            $("#TL_VOYOUT").val(item.tl_voyout);
                            $("#TL_VVD_ID").val(item.tl_vvd_id);
                            $("#TL_VESSEL_ETA").val(item.tl_vessel_eta);
                            $("#TL_VESSEL_ETD").val(item.tl_vessel_etd);
                            $("#TL_BRANCH_ID").val(4);
                            $("#TL_NOTA").val(item.tl_nota);
                            //$("#TL_CO").val(item.tl_cortltion);
                            //$("#TL_NO").val(item.tl_cortltion_date);
                            //$("#TL_NO").val(item.tl_print_card);
                            $("#TL_FROM").val(item.tl_from);
                            $("#TL_TO").val(item.tl_to);
                            $("#TL_CREATE_BY").val(item.tl_create_by);
                            //$("#TL_CREATE_DATE").val(item.tl_create_date);
                            //$("#TL_NO").val(item.tl_bl);
                            //$("#TL_NO").val(item.tl_do);
                            $("#TL_STATUS").val(1);
                            $("#TL_VESSEL_AGENT").val(item.tl_vessel_agent);
                            $("#TL_VESSEL_AGENT_NAME").val(item.tl_vessel_agent_name);
                            $("#TL_BRANCH_CODE").val(item.tl_branch_code);
                            $("#TL_PBM_ID").val(item.tl_pbm_id);
                            $("#TL_PBM_NAME").val(item.tl_pbm_name);
                            $("#TL_VESSEL_PKK").val(item.tl_vessel_pkk);
                            $("#TL_VESSEL").val(item.tl_vessel_name);
                        });

                        $('#show-detail').removeClass('hidden_content');
                        arrData.DETAIL.forEach(function(detail, index) {
                            var owner_name = (detail.tl_dtl_owner_name) ? detail.tl_dtl_owner_name : "";
                            var owner_id = (detail.tl_dtl_owner) ? detail.tl_dtl_owner : "";
                            var no_cont = (detail.tl_dtl_cont) ? detail.tl_dtl_cont : "";
                            var no_tl = (detail.tl_dtl_is_tl) ? detail.tl_dtl_is_tl : "";
                            var size_id = (detail.tl_dtl_cont_size) ? detail.tl_dtl_cont_size : "";
                            var size_name = (detail.tl_dtl_cont_size) ? detail.tl_dtl_cont_size : "";
                            var type_id = (detail.tl_dtl_cont_type) ? detail.tl_dtl_cont_type : "";
                            var type_name = (detail.tl_dtl_cont_type) ? detail.tl_dtl_cont_type : "";
                            var status_id = (detail.tl_dtl_cont_status) ? detail.tl_dtl_cont_status : "";
                            var status_name = (detail.tl_dtl_cont_status) ? detail.tl_dtl_cont_status : "";
                            var sifat_id = (detail.tl_dtl_cont_danger) ? detail.tl_dtl_cont_danger : "";
                            var sifat_name = (detail.tl_dtl_cont_danger) ? detail.tl_dtl_cont_danger : "";
                            var barang_id = (detail.tl_dtl_cmdty_id) ? detail.tl_dtl_cmdty_id : "";
                            var barang_name = (detail.tl_dtl_cmdty_name) ? detail.tl_dtl_cmdty_name : "";
                            var rec_via_id = (detail.tl_dtl_rec_via) ? detail.tl_dtl_rec_via : "";
                            var rec_via_name = (detail.tl_dtl_via_rec_name) ? detail.tl_dtl_via_rec_name : "";
                            var del_via_id = (detail.tl_dtl_del_via) ? detail.tl_dtl_del_via : "";
                            var del_via_name = (detail.tl_dtl_del_via_name) ? detail.tl_dtl_del_via_name : "";

                            $('#detail-list tbody').append(
                                '<tr>' +
                                '<td style="display: none;" class="tbl_dtl_id">' + detail.tl_dtl_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_hdr_id">' + detail.tl_hdr_id + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_owner_id">' + owner_id + '</td>' +
                                '<td class="tbl_dtl_owner_name">' + owner_name + '</td>' +

                                '<td class="tbl_dtl_cont">' + no_cont + '</td>' +
                                '<td class="tbl_dtl_tl">' + no_tl + '</td>' +

                                '<td class="tbl_dtl_size_id">' + size_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_size_name">' + size_name + '</td>' +

                                '<td class="tbl_dtl_type_id">' + type_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_type_name">' + type_name + '</td>' +

                                '<td class="tbl_dtl_status_id">' + status_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_status_name">' + status_name + '</td>' +

                                '<td class="tbl_dtl_character_id">' + sifat_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_character_name">' + sifat_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_cmdty_id">' + barang_id + '</td>' +
                                '<td class="tbl_dtl_cmdty_name">' + barang_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_rec_via_id">' + rec_via_id + '</td>' +
                                '<td class="tbl_dtl_rec_via_name">' + rec_via_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_del_via_id">' + del_via_id + '</td>' +
                                '<td class="tbl_dtl_del_via_name">' + del_via_name + '</td>' +

                                '<td class="tbl_dtl_rec_date">' + detail.tl_dtl_rec_date + '</td>' +
                                '<td class="tbl_dtl_del_date">' + detail.tl_dtl_del_date + '</td>' +
                                '</tr>'
                            );
                        });

                        var record = <?php echo json_encode($docType); ?>;
                        data.FILE.forEach(function(file, index) {
                            if (data.FILE.length != 0) {

                                counterdoc++;
                                var newRow = $("<tr>");
                                var cols = "";

                                cols += '';
                                cols += '<div class="col-xs-3"<label>Doc Type</label><select id="DOC_TYPE' + counterdoc + '" name="DOC_TYPE' + counterdoc + '" class="form-control" maxlength="40" disabled><option value="not-selected"> -- Please Choose Type  -- </option></select></div>';

                                cols += '<div class="col-xs-4"><label>Nomor Dokumen</label><input id="DOC_NO' + counterdoc + '" name="DOC_NO' + counterdoc + '" value="' + file.doc_no + '" type="text" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="booking_ship" maxlength="40" disabled></div>';

                                cols += '<div class="col-xs-5"><label>Nama File</label></div><div class="col-xs-5"><a href="' + apiUrl + file.doc_path + '" 	target="_blank">' + file.doc_name + '</a></div>';

                                newRow.append(cols);

                                $(".list_file").append(newRow);

                                var toAppend = '';
                                for (var i = 0; i < record.length; i++) {
                                    var isSelect = (record[i]['reff_id'] == file.doc_type) ? 'selected' : '';
                                    toAppend += '<option value="' + record[i]['reff_id'] + '" ' + isSelect + '>' + record[i]['reff_name'] + '</option>';
                                }
                                $('#DOC_TYPE' + counterdoc).append(toAppend);
                            }
                        });

                    }
                }
            });
        }

        //gettarif
        var id_del = "<?= $id ?>";
        if (id_del != "") {
            $.ajax({
                url: "<?= ROOT ?>npksbilling/appbooktl/getTarif/<?= $id ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.unblockUI();
                    var obj = JSON.parse(data);
                    console.log(obj);
                    if (obj.result[0]) {
                        var cust = "Detail Tagihan";
                        var no = 0;
                        var total = 0;
                        var dpp = 0;
                        var ppn = 0;
                        var total_perhitungan = 0;
                        cust += " - " + obj.result[0].uper_cust_name;
                        dpp = obj.result[0].dpp;
                        ppn = obj.result[0].ppn;
                        total_perhitungan = obj.result[0].total;
                        obj.result[0].nota_view.forEach(function(del2) {
                            if (del2.Handling) {
                                del2.Handling.forEach(function(val) {
                                    no++;
                                    $('#detail-handling-list tbody').append(
                                        '<tr>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + no + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:left">' + val.group_tariff_name + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.cont_size + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.cont_type + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.cont_status + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.qty + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:right">' + formatNumber(val.tariff) + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:right">' + formatNumber(val.dpp) + '</td>' +
                                        '</tr>'
                                    );
                                });
                            }
                            no = 0;
                        });
                    } else {
                        var cust = "Detail Tagihan";
                        var dpp = 0;
                        var ppn = 0;
                        var total_perhitungan = 0;
                        $("#detail-penumpukan-list").last().addClass("hidden_content");
                        $("#detail-handling-list").last().addClass("hidden_content");
                        $("#detail-handling-list").last().addClass("hidden_content");
                        $("#total-label").last().addClass("hidden_content");
                        $("#tagihan-label").last().removeClass("hidden_content");
                    }
                    $('#tagihan-cust').html('<span class=" glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;' + '<b>' + cust + '</b>');
                    $('#DEL_DPP').val(formatNumber(dpp));
                    $('#DEL_PPN').val(formatNumber(ppn));
                    $('#DEL_TOTAL').val(formatNumber(total_perhitungan));
                }
            });
        }
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
</script>