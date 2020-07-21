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
                    <input name="STRIPP_PBM_NAME" id="STRIPP_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
                    <input name="STRIPP_PBM_ID" id="STRIPP_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Nomor Request</label>
                    <input name="STRIPP_NO" id="STRIPP_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
                    <input name="STRIPP_ID" id="STRIPP_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>Penumpukan Oleh</label>
                    <input name="STRIPP_PENUMPUKAN_OLEH_NAME" id="STRIPP_PENUMPUKAN_OLEH_NAME" type="text" class="form-control" placeholder="Autocomplete" value="<?= $this->session->userdata('customernamealt_phd') ?>" readonly="">
                    <input name="STRIPP_PENUMPUKAN_OLEH_ID" id="STRIPP_PENUMPUKAN_OLEH_ID" type="hidden" class="form-control" placeholder="Autocomplete" value="<?= $this->session->userdata('customerid_phd') ?>" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Date</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="STRIPP_DATE" name="STRIPP_DATE" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required="" readOnly>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label>From</label>
                    <select id="STRIPP_FROM" name="STRIPP_FROM" class="form-control" required="" disabled>
                        <option value="not-selected"> -- Please Choose From -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label>Payment Method</label>
                    <select id="STRIPP_PAYMETHOD" name="STRIPP_PAYMETHOD" class="form-control" required="" disabled>
                        <option value="not-selected"> -- Please Choose Payment Method -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <input name="STRIPP_ID_NOTA" id="STRIPP_ID_NOTA" type="text" class="form-control" readonly="">
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
                    <input name="STRIPP_VESSEL_NAME" id="STRIPP_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
                    <input type="hidden" id="STRIPP_VESSEL_CODE" class="form-control" name="STRIPP_VESSEL_CODE" required>
                    <input type="hidden" id="STRIPP_VESSEL" class="form-control" name="STRIPP_VESSEL" required>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="STRIPP_VESSEL_AGENT" id="STRIPP_VESSEL_AGENT" type="text" class="form-control" readonly="">
                    <input name="STRIPP_VESSEL_AGENT_NAME" id="STRIPP_VESSEL_AGENT_NAME" type="hidden">
                </div>
                <div class="form-group col-xs-4">
                    <label>No PKK</label>
                    <input name="STRIPP_VESSEL_PKK" id="STRIPP_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage In</label>
                    <input name="STRIPP_VOYIN" id="STRIPP_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage Out</label>
                    <input name="STRIPP_VOYOUT" id="STRIPP_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETA</label>
                    <input name="STRIPP_ETA" id="STRIPP_ETA" type="text" class="form-control" placeholder="ETA" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETD</label>
                    <input name="STRIPP_ETD" id="STRIPP_ETD" type="text" class="form-control" placeholder="ETD" required="" readonly="">
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
                                <th>Ex Batal SP2</th>
                                <th>Container Owner</th>
                                <th>No Container</th>
                                <th>Ukuran</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Dangerous Goods</th>
                                <th>Stripping Via</th>
                                <th>Kemasan</th>
                                <th>Start Stripping</th>
                                <th>End Stripping</th>
                                <th>Tanggal Receiving</th>
                                <th>Tanggal Delivery</th>
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
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">No Container</th>
                                <th colspan="3" style="vertical-align:middle; text-align:center;">Keterangan</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Quantity</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Date</th>
                                <th colspan="2" style="vertical-align:middle; text-align:center;">Hari</th>
                                <th colspan="2" style="vertical-align:middle; text-align:center;">Tarif</th>
                                <th rowspan="2" style="vertical-align:middle; text-align:center;">Total</th>
                            </tr>
                            <tr>
                                <th style="vertical-align:middle; text-align:center;">Size</th>
                                <th style="vertical-align:middle; text-align:center;">Type</th>
                                <th style="vertical-align:middle; text-align:center;">Status</th>
                                <th style="vertical-align:middle; text-align:center;">Massa 1</th>
                                <th style="vertical-align:middle; text-align:center;">Massa 2</th>
                                <th style="vertical-align:middle; text-align:center;">Massa 1</th>
                                <th style="vertical-align:middle; text-align:center;">Massa 2</th>
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
                                <input name="STRIPP_DPP" id="STRIPP_DPP" type="text" class="form-control" required="" style="text-align:right;" readonly>
                            </div>
                            <div class="form-group">
                                <label>PPN 10%:</label>
                                <input name="STRIPP_PPN" id="STRIPP_PPN" type="text" class="form-control" required="" style="text-align:right;" readonly>
                            </div>
                            <div class="form-group">
                                <label>Total Perhitungan:</label>
                                <input name="STRIPP_TOTAL" id="STRIPP_TOTAL" type="text" class="form-control" required="" style="text-align:right;" readonly>
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
            urlaction = "<?php echo ROOT ?>npksbilling/appbookstrip/approve/<?php echo $id; ?>/" + $("#STRIPP_ID_NOTA").val();
        } else {
            urlaction = "<?php echo ROOT ?>npksbilling/appbookstrip/reject/<?php echo $id; ?>/" + $("#STRIPP_ID_NOTA").val();
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
                                    text: "Approval " + $('#STRIPP_NO').val() + " berhasil"
                                })
                                approvestripping_log(no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/appbookstrip";
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
                                        text: "Approval " + $('#STRIPP_NO').val() + " berhasil"
                                    })
                                    approvestripping_log(no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/appbookstrip";
                                    }, 1000);
                                } else {
                                    $.unblockUI();
                                    Swal.fire({
                                        icon: 'error',
                                        title: array_data['result'],
                                        showConfirmButton: false,
                                        timer: 1500,
                                        text: "Approval " + $('#STRIPP_NO').val() + " gagal"
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
                            text: "Reject " + $('#STRIPP_NO').val() + " berhasil"
                        })
                        rejectstripping_log(no_req);
                        setTimeout(function() {
                            window.location = "<?= ROOT ?>npksbilling/appbookstrip";
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
                                text: "Reject " + $('#STRIPP_NO').val() + " berhasil"
                            })
                            rejectstripping_log(no_req);
                            setTimeout(function() {
                                window.location = "<?= ROOT ?>npksbilling/appbookstrip";
                            }, 1000);
                        } else {
                            $.unblockUI();
                            Swal.fire({
                                icon: 'error',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#STRIPP_NO').val() + " gagal"
                            })
                        }
                    }
                }
            });
        }
    }

    function rejectstripping_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/rejectstripping_log",
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

    function approvestripping_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/approvestripping_log",
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

                $('#STRIPP_FROM').append(toAppend);
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

                $('#STRIPP_PAYMETHOD').append(toAppend);
            }
        });

        //getdata
        var id_stripp = "<?= $id ?>";
        if (id_stripp != "") {
            $.ajax({
                url: "<?= ROOT ?>npksbilling/appbookstrip/update_stripp/<?= $id ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.HEADER != "") {
                        arrData = data;
                        console.log(arrData);
                        arrData.HEADER.forEach(function(item, index) {
                            $("#STRIPP_ID").val(item.stripp_id);
                            $("#STRIPP_NO").val(item.stripp_no);
                            $("#STRIPP_STATUS").val(1);
                            $("#STRIPP_BRANCH_ID").val(14);
                            $("#STRIPP_CREATE_BY").val();
                            $("#STRIPP_DATE").val(item.stripp_date);
                            $("#STRIPP_PBM_NAME").val(item.stripp_pbm_name);
                            $("#STRIPP_PBM_ID").val(item.stripp_pbm_id);
                            $("#STRIPP_PENUMPUKAN_OLEH_NAME").val(item.stripp_stackby_name);
                            $("#STRIPP_PENUMPUKAN_OLEH_ID").val(item.stripp_stackby_id);
                            $("#STRIPP_FROM").val(item.stripp_from);
                            $("#STRIPP_PAYMETHOD").val(item.stripp_paymethod);
                            $('#STRIPP_ID_NOTA').val(item.stripp_nota);
                            $("#STRIPP_VESSEL_NAME").val(item.stripp_vessel_name);
                            $("#STRIPP_VESSEL_CODE").val(item.stripp_vessel_code);
                            $("#STRIPP_VOYIN").val(item.stripp_voyin);
                            $("#STRIPP_VOYOUT").val(item.stripp_voyout);
                            $("#STRIPP_VESSEL_PKK").val(item.stripp_vessel_pkk);
                            $("#STRIPP_VESSEL").val(item.stripp_vessel_name);
                            $("#STRIPP_VESSEL_AGENT").val(item.stripp_vessel_agent);
                            $("#STRIPP_VESSEL_AGENT_NAME").val(item.stripp_vessel_agent_name);
                            $('#STRIPP_ETA').val(item.stripp_vessel_eta);
                            $('#STRIPP_ETD').val(item.stripp_vessel_etd);
                        });

                        $('#DTL_HDR_ID').val(arrData.DETAIL[0].stripp_hdr_id);
                        arrData.DETAIL.forEach(function(detail, index) {
                            $('#detail-list tbody').append(
                                '<tr>' +
                                '<td style="display: none;" class="tbl_dtl_stripp_id">' + detail.stripp_dtl_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_stripp_hdr_id">' + detail.stripp_hdr_id + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_exbatalsp2_id">' + detail.stripp_dtl_sp2 + '</td>' +
                                '<td class="tbl_dtl_exbatalsp2_name">' + detail.stripp_dtl_sp2 + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_stripp_owner_id">' + detail.stripp_dtl_owner + '</td>' +
                                '<td class="tbl_dtl_stripp_owner">' + detail.stripp_dtl_owner_name + '</td>' +

                                '<td class="tbl_dtl_stripp_no_cont">' + detail.stripp_dtl_cont + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_stripp_size_id">' + detail.stripp_dtl_cont_size + '</td>' +
                                '<td class="tbl_dtl_stripp_size_name">' + detail.stripp_dtl_cont_size + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_stripp_type_id">' + detail.stripp_dtl_cont_type + '</td>' +
                                '<td class="tbl_dtl_stripp_type_name">' + detail.stripp_dtl_cont_type + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_stripp_status_id">' + detail.stripp_dtl_cont_status + '</td>' +
                                '<td class="tbl_dtl_stripp_status_name">' + detail.stripp_dtl_cont_status + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_character_id">' + detail.stripp_dtl_cont_danger + '</td>' +
                                '<td class="tbl_dtl_character_name">' + detail.stripp_dtl_cont_danger + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_stripp_via_id">' + detail.stripp_dtl_via + '</td>' +
                                '<td class="tbl_dtl_stripp_via_name">' + detail.stripp_dtl_via_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_stripp_kemasan_id">' + detail.stripp_dtl_cmdty_id + '</td>' +
                                '<td class="tbl_dtl_stripp_kemasan">' + detail.stripp_dtl_cmdty_name + '</td>' +

                                '<td class="tbl_dtl_stripp_date_start">' + detail.stripp_dtl_start_date + '</td>' +

                                '<td class="tbl_dtl_stripp_date_end">' + detail.stripp_dtl_end_date + '</td>' +

                                '<td class="tbl_dtl_stripp_rec_date">' + detail.stripp_dtl_rec_date + '</td>' +

                                '<td class="tbl_dtl_stripp_del_date">' + detail.stripp_dtl_del_date + '</td>' +
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

                                cols += '<div class="col-xs-4"><label>Nama Dokumen</label></div><div class="col-xs-5"><a href="' + apiUrl + file.doc_path + '" target="_blank">' + file.doc_name + '</a></div>';

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

                        get_tarif();
                    }
                }
            });
        }
    });

    function get_tarif() {
        var id_stripp = "<?= $id ?>";
        if (id_stripp != "") {
            $.ajax({
                url: "<?= ROOT ?>npksbilling/appbookstrip/getTarif/<?= $id ?>/" + $("#STRIPP_ID_NOTA").val(),
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
                                        '<td style="vertical-align:baseline;text-align:center">' + val.cont_size + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.cont_type + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.cont_status + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.qty + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + val.date_in_out + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + masa1 + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:center">' + masa2 + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:right">' + formatNumber(trf1) + '</td>' +
                                        '<td style="vertical-align:baseline;text-align:right">' + formatNumber(trf2) + '</td>' +
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
                    $('#STRIPP_DPP').val(formatNumber(dpp));
                    $('#STRIPP_PPN').val(formatNumber(ppn));
                    $('#STRIPP_TOTAL').val(formatNumber(total_perhitungan));
                }
            });
        }
    }

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
</script>