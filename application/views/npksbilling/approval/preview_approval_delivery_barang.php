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
                    <input name="DEL_CARGO_PBM_NAME" id="DEL_CARGO_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input name="DEL_CARGO_PBM_ID" id="DEL_CARGO_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Nomor Request</label>
                    <input name="DEL_CARGO_NO" id="DEL_CARGO_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
                    <input name="DEL_CARGO_ID" id="DEL_CARGO_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>To</label>
                    <select id="DEL_CARGO_TO" name="DEL_CARGO_TO" class="form-control" disabled>
                        <option value="not-selected"> -- Please Choose To -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label>Payment Method</label>
                    <select id="DEL_CARGO_PAYMETHOD" name="DEL_CARGO_PAYMETHOD" class="form-control" disabled>
                        <option value="not-selected"> -- Please Choose Payment Method -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Date</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="DEL_CARGO_DATE" name="DEL_CARGO_DATE" type="text" class="form-control" value="<?= date('Y-m-d') ?>" disabled readOnly>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label>Penumpukan Oleh</label>
                    <input name="DEL_CARGO_STACKBY_NAME" id="DEL_CARGO_STACKBY_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input name="DEL_CARGO_STACKBY_ID" id="DEL_CARGO_STACKBY_ID" type="hidden" class="form-control" placeholder="Autocomplete" disabled>
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
                    <input name="DEL_CARGO_VESSEL_NAME" id="DEL_CARGO_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input type="hidden" id="DEL_CARGO_VESSEL_CODE" class="form-control" name="DEL_CARGO_VESSEL_CODE" required>
                    <input type="hidden" id="DEL_VESSEL" class="form-control" name="DEL_VESSEL" required>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="DEL_CARGO_VESSEL_AGENT" id="DEL_CARGO_VESSEL_AGENT" type="text" class="form-control" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>No PKK</label>
                    <input name="DEL_CARGO_VESSEL_PKK" id="DEL_CARGO_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" disabled readonly="">
                    <input name="DEL_CARGO_VVD_ID" id="DEL_CARGO_VVD_ID" type="hidden" class="form-control" placeholder="No PKK" disabled readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage In</label>
                    <input name="DEL_CARGO_VOYIN" id="DEL_CARGO_VOYIN" type="text" class="form-control" placeholder="Voyage In" disabled readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage Out</label>
                    <input name="DEL_CARGO_VOYOUT" id="DEL_CARGO_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" disabled readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETA</label>
                    <input name="DEL_CARGO_VESSEL_ETA" id="DEL_CARGO_VESSEL_ETA" type="text" class="form-control" placeholder="ETA" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label>ETD</label>
                    <input name="DEL_CARGO_VESSEL_ETD" id="DEL_CARGO_VESSEL_ETD" type="text" class="form-control" placeholder="ETD" disabled>
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
                </table>

                <div class="form-group example-twitter-oss pull-right">
                </div>
            </div>
        </div>
    </div>
</div>

<div class="hidden_content" id='show-detail'>
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
                                <th>Cargo Owner</th>
                                <th>BL/SI/DO</th>
                                <th>Jumlah</th>
                                <th>Sifat</th>
                                <th>Kemasan</th>
                                <th>Barang</th>
                                <th>Satuan</th>
                                <th>Delivery Via</th>
                                <th>Stacking Area</th>
                                <th>Tanggal Receiving</th>
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
                    <table class="table table-striped table-hover" id="detail-penumpukan-list">
                        <thead>
                            <tr>
                                <th rowspan="2"></th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">BL/SI/DO</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Kemasan</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Barang</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">QTY</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Satuan</th>
                                <th colspan="3" style="vertical-align:middle; text-align:center;">Hari</th>
                                <th colspan="3" style="vertical-align:middle; text-align:center;">Tarif</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Total</th>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle; text-align:center;">Massa 1</th>
                                <th style="vertical-align:middle; text-align:center;">Massa 2</th>
                                <th style="vertical-align:middle; text-align:center;">Massa 1</th>
                                <th style="vertical-align:middle; text-align:center;">Massa 2</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table><br>
                    <table class="table table-striped table-hover" id="detail-handling-list">
                        <thead>
                            <tr>
                                <th></th>
                                <th style="vertical-align:middle; text-align:center;">Layanan</th>
                                <th style="vertical-align:middle; text-align:center;">BL/SI/DO</th>
                                <th style="vertical-align:middle; text-align:center;">Barang</th>
                                <th style="vertical-align:middle; text-align:center;">QTY</th>
                                <th style="vertical-align:middle; text-align:center;">Tarif Dasar</th>
                                <th style="vertical-align:middle; text-align:center;">Total</th>
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
            urlaction = "<?php echo ROOT ?>npksbilling/appbookdelcargo/approve/<?php echo $id; ?>";
        } else {
            urlaction = "<?php echo ROOT ?>npksbilling/appbookdelcargo/reject/<?php echo $id; ?>";
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
                                    text: "Approval " + $('#DEL_CARGO_NO').val() + " berhasil"
                                })
                                approvedeliverycargo_log(no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/appbookdelcargo";
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
                                        text: "Approval " + $('#DEL_CARGO_NO').val() + " berhasil"
                                    })
                                    approvedeliverycargo_log(no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/appbookdelcargo";
                                    }, 1000);
                                } else {
                                    $.unblockUI();
                                    Swal.fire({
                                        icon: 'error',
                                        title: array_data['result'],
                                        showConfirmButton: false,
                                        timer: 1500,
                                        text: "Approval " + $('#DEL_CARGO_NO').val() + " gagal"
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
                            text: "Reject " + $('#DEL_CARGO_NO').val() + " berhasil"
                        })
                        rejectdeliverycargo_log(no_req);
                        setTimeout(function() {
                            window.location = "<?= ROOT ?>npksbilling/appbookdelcargo";
                        }, 1000);
                    } else {
                        if (array_data['Success'] == true) {
                            $('#modal_reject').modal('hide');
                            $.unblockUI();
                            resp = JSON.parse(array_data);
                            no_req = resp.no_req;
                            Swal.fire({
                                icon: 'success',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#DEL_CARGO_NO').val() + " berhasil"
                            })
                            rejectdeliverycargo_log(no_req);
                            setTimeout(function() {
                                window.location = "<?= ROOT ?>npksbilling/appbookdelcargo";
                            }, 1000);
                        } else {
                            $.unblockUI();
                            Swal.fire({
                                icon: 'error',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#DEL_CARGO_NO').val() + " gagal"
                            })
                        }
                    }
                }
            });
        }
    }

    function rejectdeliverycargo_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/rejectdeliverycargo_log",
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

    function approvedeliverycargo_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/approvedeliverycargo_log",
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
        $.blockUI();

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

                $('#DEL_CARGO_TO').append(toAppend);
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

                $('#DEL_CARGO_PAYMETHOD').append(toAppend);
            }
        });

        //getdata
        var id_del = "<?= $id ?>";
        if (id_del != "") {
            $.blockUI();
            $.ajax({
                url: "<?= ROOT ?>npksbilling/appbookdelcargo/update_del/" + id_del,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    if (data.HEADER != "") {
                        $.unblockUI();
                        arrData = data;
                        arrData.HEADER.forEach(function(item, index) {
                            $("#DEL_CARGO_ID").val(item.del_cargo_id);
                            $("#DEL_CARGO_NO").val(item.del_cargo_no);
                            $("#DEL_CARGO_DATE").val(item.del_cargo_date);
                            $("#DEL_CARGO_PAYMETHOD").val(item.del_cargo_paymethod);
                            $("#DEL_CARGO_CUST_ID").val(item.del_cargo_cust_id);
                            $("#DEL_CARGO_CUST_NAME").val(item.del_cargo_cust_name);
                            $("#DEL_CARGO_CUST_ADDRESS").val(item.del_cargo_cust_address);
                            $("#DEL_CARGO_CUST_NPWP").val(item.del_cargo_cust_npwp);
                            $("#DEL_CARGO_CUST_ACCOUNT").val(item.del_cargo_cust_account);
                            $("#DEL_CARGO_STACKBY_ID").val(item.del_cargo_stackby_id);
                            $("#DEL_CARGO_STACKBY_NAME").val(item.del_cargo_stackby_name);
                            $("#DEL_CARGO_VESSEL_CODE").val(item.del_cargo_vessel_code);
                            $("#DEL_CARGO_VESSEL_NAME").val(item.del_cargo_vessel_name);
                            $("#DEL_CARGO_VOYIN").val(item.del_cargo_voyin);
                            $("#DEL_CARGO_VOYOUT").val(item.del_cargo_voyout);
                            $("#DEL_CARGO_VVD_ID").val(item.del_cargo_vvd_id);
                            $("#DEL_CARGO_VESSEL_ETA").val(item.del_cargo_vessel_eta);
                            $("#DEL_CARGO_VESSEL_ETD").val(item.del_cargo_vessel_etd);
                            $("#DEL_CARGO_BRANCH_ID").val(4);
                            $("#DEL_CARGO_NOTA").val(item.del_cargo_nota);
                            //$("#DEL_CARGO_CO").val(item.del_cargo_corDEL_CARGOtion);
                            //$("#DEL_CARGO_NO").val(item.del_cargo_corDEL_CARGOtion_date);
                            //$("#DEL_CARGO_NO").val(item.del_cargo_print_card);
                            $("#DEL_CARGO_TO").val(item.del_cargo_to);
                            $("#DEL_CARGO_CREATE_BY").val(item.del_cargo_create_by);
                            //$("#DEL_CARGO_CREATE_DATE").val(item.del_cargo_create_date);
                            //$("#DEL_CARGO_NO").val(item.del_cargo_bl);
                            //$("#DEL_CARGO_NO").val(item.del_cargo_do);
                            $("#DEL_CARGO_STATUS").val(1);
                            $("#DEL_CARGO_VESSEL_AGENT").val(item.del_cargo_vessel_agent);
                            $("#DEL_CARGO_VESSEL_AGENT_NAME").val(item.del_cargo_vessel_agent_name);
                            $("#DEL_CARGO_BRANCH_CODE").val(item.del_cargo_branch_code);
                            $("#DEL_CARGO_PBM_ID").val(item.del_cargo_pbm_id);
                            $("#DEL_CARGO_PBM_NAME").val(item.del_cargo_pbm_name);
                            $("#DEL_CARGO_VESSEL_PKK").val(item.del_cargo_vessel_pkk);
                        });

                        $('#show-detail').removeClass('hidden_content');
                        arrData.DETAIL.forEach(function(detail, index) {
                            var owner_name = (detail.del_cargo_dtl_owner_name) ? detail.del_cargo_dtl_owner_name : "";
                            var owner_id = (detail.del_cargo_dtl_owner) ? detail.del_cargo_dtl_owner : "";
                            var no_bl = (detail.del_cargo_dtl_si_no) ? detail.del_cargo_dtl_si_no : "";
                            var jumlah = (detail.del_cargo_dtl_qty) ? detail.del_cargo_dtl_qty : "";
                            var sifat_id = (detail.del_cargo_dtl_character_id) ? detail.del_cargo_dtl_character_id : "";
                            var sifat_name = (detail.del_cargo_dtl_character_name) ? detail.del_cargo_dtl_character_name : "";
                            var kemasan_pkg_id = (detail.del_cargo_dtl_pkg_parent_id) ? detail.del_cargo_dtl_pkg_parent_id : "";
                            var kemasan_id = (detail.del_cargo_dtl_pkg_id) ? detail.del_cargo_dtl_pkg_id : "";
                            var kemasan_name = (detail.del_cargo_dtl_pkg_name) ? detail.del_cargo_dtl_pkg_name : "";
                            var barang_id = (detail.del_cargo_dtl_cmdty_id) ? detail.del_cargo_dtl_cmdty_id : "";
                            var barang_name = (detail.del_cargo_dtl_cmdty_name) ? detail.del_cargo_dtl_cmdty_name : "";
                            var satuan_id = (detail.del_cargo_dtl_unit_id) ? detail.del_cargo_dtl_unit_id : "";
                            var satuan_name = (detail.del_cargo_dtl_unit_name) ? detail.del_cargo_dtl_unit_name : "";
                            var via_id = (detail.del_cargo_dtl_via) ? detail.del_cargo_dtl_via : "";
                            var via_name = (detail.del_cargo_dtl_via_name) ? detail.del_cargo_dtl_via_name : "";
                            var tanggal_del = (detail.del_cargo_dtl_del_date) ? detail.del_cargo_dtl_del_date : "";
                            var stacking_id = (detail.del_cargo_dtl_stack_area) ? detail.del_cargo_dtl_stack_area : "";
                            var stacking_name = (detail.del_cargo_dtl_stack_area_name) ? detail.del_cargo_dtl_stack_area_name : "";
                            var del_dtl_id = (detail.del_cargo_dtl_id) ? detail.del_cargo_dtl_id : "";
                            var del_hdr_id = (detail.del_cargo_hdr_id) ? detail.del_cargo_hdr_id : "";

                            $('#detail-list tbody').append(
                                '<tr>' +
                                '<td style="display: none;" class="tbl_cargo_dtl_id">' + del_dtl_id + '</td>' +
                                '<td style="display: none;" class="tbl_cargo_dtl_hdr_id">' + del_hdr_id + '</td>' +

                                '<td style="display: none;" class="tbl_cargo_dtl_owner_id">' + owner_id + '</td>' +
                                '<td class="tbl_cargo_dtl_owner_name">' + owner_name + '</td>' +

                                '<td class="tbl_cargo_dtl_bl">' + no_bl + '</td>' +

                                '<td class="tbl_cargo_dtl_qty">' + jumlah + '</td>' +

                                '<td style="display: none;" class="tbl_cargo_dtl_character_id">' + sifat_id + '</td>' +
                                '<td class="tbl_cargo_dtl_character_name">' + sifat_name + '</td>' +

                                '<td style="display: none;" class="tbl_cargo_dtl_pkg_id">' + kemasan_id + '</td>' +
                                '<td class="tbl_cargo_dtl_pkg_name">' + kemasan_name + '</td>' +
                                '<td style="display: none;" class="tbl_cargo_dtl_pkg_parent_id">' + kemasan_pkg_id + '</td>' +

                                '<td style="display: none;" class="tbl_cargo_dtl_cmdty_id">' + barang_id + '</td>' +
                                '<td class="tbl_cargo_dtl_cmdty_name">' + barang_name + '</td>' +

                                '<td style="display: none;" class="tbl_cargo_dtl_unit_id">' + satuan_id + '</td>' +
                                '<td class="tbl_cargo_dtl_unit_name">' + satuan_name + '</td>' +

                                '<td style="display: none;" class="tbl_cargo_dtl_via_id">' + via_id + '</td>' +
                                '<td class="tbl_cargo_dtl_via_name">' + via_name + '</td>' +

                                '<td style="display: none;" class="tbl_cargo_dtl_stack_area">' + stacking_id + '</td>' +
                                '<td class="tbl_cargo_dtl_stack_area_name">' + stacking_name + '</td>' +

                                '<td class="tbl_cargo_dtl_del_date">' + tanggal_del + '</td>' +
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

                                cols += '<div class="col-xs-5"><label>Nama File</label></div><div class="col-xs-5"><a href="' + apiUrl + file.doc_path + '" target="_blank">' + file.doc_name + '</a></div>';


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
                url: "<?= ROOT ?>npksbilling/appbookdelcargo/getTarif/<?= $id ?>",
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
                            if (del2.Penumpukan) {
                                del2.Penumpukan.forEach(function(val) {
                                    no++;
                                    var masa1 = (val.masa1) ? val.masa1 : "N/A";
                                    var trf1 = (val.trf1) ? val.trf1 : "N/A";
                                    var masa2 = (val.masa2) ? val.masa2 : "N/A";
                                    var trf2 = (val.trf2) ? val.trf2 : "N/A";
                                    $('#detail-penumpukan-list tbody').append(
                                        '<tr>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + no + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:left">' + val.no_bl + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.pkg_name + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.commodity_name + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.qty + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.unit_name + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + masa1 + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + masa2 + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:right">' + formatNumber(trf1) + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:right">' + formatNumber(trf2) + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:right">' + formatNumber(val.dpp) + '</td>' +
                                        '</tr>'
                                    );
                                });
                            }
                            if (del2.Handling) {
                                del2.Handling.forEach(function(val) {
                                    no++;
                                    $('#detail-handling-list tbody').append(
                                        '<tr>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + no + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:left">' + val.group_tariff_name + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.no_bl + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.commodity_name + '</td>' +
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