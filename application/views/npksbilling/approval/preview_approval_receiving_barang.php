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
                    <input name="REC_PBM_NAME" id="REC_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input name="REC_PBM_ID" id="REC_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Nomor Request</label>
                    <input name="REC_NO" id="REC_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
                    <input name="REC_ID" id="REC_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>Penumpukan Oleh</label>
                    <input name="REC_PENUMPUKAN_OLEH_NAME" id="REC_PENUMPUKAN_OLEH_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input name="REC_PENUMPUKAN_OLEH_ID" id="REC_PENUMPUKAN_OLEH_ID" type="hidden" class="form-control" placeholder="Autocomplete" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Date</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="REC_DATE" name="REC_DATE" type="text" class="form-control" value="<?= date('Y-m-d') ?>" readonly="" disabled>
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label>From</label>
                    <select id="REC_FROM" name="REC_FROM" class="form-control" required="" disabled>
                        <option value="not-selected"> -- Please Choose From -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label>Payment Method</label>
                    <select id="REC_PAYMETHOD" name="REC_PAYMETHOD" class="form-control" required="" disabled>
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
                    <input name="REC_VESSEL_NAME" id="REC_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input type="hidden" id="REC_VESSEL_CODE" class="form-control" name="REC_VESSEL_CODE" required>
                    <input type="hidden" id="REC_VESSEL" class="form-control" name="REC_VESSEL" required>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="REC_VESSEL_AGENT" id="REC_VESSEL_AGENT" type="text" class="form-control" readonly="">
                    <input name="REC_VESSEL_AGENT_NAME" id="REC_VESSEL_AGENT_NAME" type="hidden">
                </div>
                <div class="form-group col-xs-4">
                    <label>No PKK</label>
                    <input name="REC_VESSEL_PKK" id="REC_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage In</label>
                    <input name="REC_VOYIN" id="REC_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage Out</label>
                    <input name="REC_VOYOUT" id="REC_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETA</label>
                    <input name="REC_ETA" id="REC_ETA" type="text" class="form-control" placeholder="ETA" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETD</label>
                    <input name="REC_ETD" id="REC_ETD" type="text" class="form-control" placeholder="ETD" required="" readonly="">
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
                                <th>Cargo Owner</th>
                                <th>BL/SI/DO</th>
                                <th>Jumlah</th>
                                <th>Sifat</th>
                                <th>Kemasan</th>
                                <th>Barang</th>
                                <th>Satuan</th>
                                <th>Receiving Via</th>
                                <th>Stacking Area</th>
                                <th>Tanggal Receiving</th>
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
                                <th></th>
                                <th style="vertical-align:middle; text-align:center;">Layanan</th>
                                <th style="vertical-align:middle; text-align:center;">BL/SI/DO</th>
                                <th style="vertical-align:middle; text-align:center;">Barang</th>
                                <th style="vertical-align:middle; text-align:center;">Quantity</th>
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
                                <input name="REC_DPP" id="REC_DPP" type="text" class="form-control" required="" style="text-align:right;" readonly>
                            </div>
                            <div class="form-group">
                                <label>PPN 10%:</label>
                                <input name="REC_PPN" id="REC_PPN" type="text" class="form-control" required="" style="text-align:right;" readonly>
                            </div>
                            <div class="form-group">
                                <label>Total Perhitungan:</label>
                                <input name="REC_TOTAL" id="REC_TOTAL" type="text" class="form-control" required="" style="text-align:right;" readonly>
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
            urlaction = "<?php echo ROOT ?>npksbilling/appbookreccargo/approve/<?php echo $id; ?>";
        } else {
            urlaction = "<?php echo ROOT ?>npksbilling/appbookreccargo/reject/<?php echo $id; ?>";
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
                                    text: "Approval " + $('#REC_NO').val() + " berhasil"
                                })
                                approvereceivecargo_log(no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/appbookreccargo";
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
                                        text: "Approval " + $('#REC_NO').val() + " berhasil"
                                    })
                                    approvereceivecargo_log(no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/appbookreccargo";
                                    }, 1000);
                                } else {
                                    $.unblockUI();
                                    Swal.fire({
                                        icon: 'error',
                                        title: array_data['result'],
                                        showConfirmButton: false,
                                        timer: 1500,
                                        text: "Approval " + $('#REC_NO').val() + " gagal"
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
                            text: "Reject " + $('#REC_NO').val() + " berhasil"
                        })
                        rejectreceivecargo_log(no_req);
                        setTimeout(function() {
                            window.location = "<?= ROOT ?>npksbilling/appbookreccargo";
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
                                text: "Reject " + $('#REC_NO').val() + " berhasil"
                            })
                            rejectreceivecargo_log(no_req);
                            setTimeout(function() {
                                window.location = "<?= ROOT ?>npksbilling/appbookreccargo";
                            }, 1000);
                        } else {
                            $.unblockUI();
                            Swal.fire({
                                icon: 'error',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#REC_NO').val() + " gagal"
                            })
                        }
                    }
                }
            });
        }
    }

    function approvereceivecargo_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/approvereceivecargo_log",
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

    function rejectreceivecargo_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/rejectreceivecargo_log",
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
            url: "<?= ROOT ?>npksbilling/mdm/from_cargo",
            success: function(data) {
                var obj = JSON.parse(data);
                var record = obj['result'];

                var toAppend = '';
                for (var i = 0; i < record.length; i++) {
                    toAppend += '<option value="' + record[i]['reff_id'] + '">' + record[i]['reff_name'] + '</option>';
                }

                $('#REC_FROM').append(toAppend);
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

                $('#REC_PAYMETHOD').append(toAppend);
            }
        });

        //getdata
        var id_rec = "<?= $id ?>";
        if (id_rec != "") {
            $.ajax({
                url: "<?= ROOT ?>npksbilling/receivebarang/update_rec/<?= $id ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.unblockUI();
                    if (data.HEADER != "") {
                        arrData = data;
                        console.log(arrData);
                        arrData.HEADER.forEach(function(item, index) {
                            $("#REC_ID").val(item.rec_cargo_id);
                            $("#REC_NO").val(item.rec_cargo_no);
                            $("#REC_STATUS").val(1);
                            $("#REC_BRANCH_ID").val(14);
                            $("#REC_CREATE_BY").val();
                            $("#REC_DATE").val(item.rec_cargo_date);
                            $("#REC_PBM_NAME").val(item.rec_cargo_pbm_name);
                            $("#REC_PBM_ID").val(item.rec_cargo_pbm_id);
                            $("#REC_PENUMPUKAN_OLEH_NAME").val(item.rec_cargo_stackby_name);
                            $("#REC_PENUMPUKAN_OLEH_ID").val(item.rec_cargo_stackby_id);
                            $("#REC_FROM").val(item.rec_cargo_from);
                            $("#REC_PAYMETHOD").val(item.rec_cargo_paymethod);
                            $("#REC_VESSEL_NAME").val(item.rec_cargo_vessel_name);
                            $("#REC_VESSEL_CODE").val(item.rec_cargo_vessel_code);
                            $("#REC_VOYIN").val(item.rec_cargo_voyin);
                            $("#REC_VOYOUT").val(item.rec_cargo_voyout);
                            $("#REC_VESSEL_PKK").val(item.rec_cargo_vessel_pkk);
                            $("#REC_VESSEL").val(item.rec_cargo_vessel_name);
                            $("#REC_VESSEL_AGENT").val(item.rec_cargo_vessel_agent);
                            $("#REC_VESSEL_AGENT_NAME").val(item.rec_cargo_vessel_agent_name);
                            $('#REC_ETA').val(item.rec_cargo_vessel_eta);
                            $('#REC_ETD').val(item.rec_cargo_vessel_etd);
                        });

                        // $('#show-detail').removeClass('hidden_content');

                        $('#DTL_HDR_ID').val(arrData.DETAIL[0].rec_cargo_hdr_id);
                        $('#DTL_HDR_ID').val(arrData.DETAIL[0].rec_cargo_hdr_id);
                        arrData.DETAIL.forEach(function(detail, index) {

                            $('#detail-list tbody').append(
                                '<tr>' +
                                '<td style="display: none;" class="tbl_dtl_rec_id">' + detail.rec_cargo_dtl_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_rec_hdr_id">' + detail.rec_cargo_hdr_id + '</td>' +

                                '<td class="tbl_dtl_rec_owner">' + detail.rec_cargo_dtl_owner_name + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_rec_owner_id">' + detail.rec_cargo_dtl_owner + '</td>' +

                                '<td class="tbl_dtl_rec_no_si">' + detail.rec_cargo_dtl_si_no + '</td>' +

                                '<td class="tbl_dtl_rec_jumlah">' + detail.rec_cargo_dtl_qty + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_character_id">' + detail.rec_cargo_dtl_character_id + '</td>' +
                                '<td class="tbl_dtl_character_name">' + detail.rec_cargo_dtl_character_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_rec_kemasan_id">' + detail.rec_cargo_dtl_pkg_id + '</td>' +
                                '<td class="tbl_dtl_rec_kemasan">' + detail.rec_cargo_dtl_pkg_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_rec_kemasan_parent_id">' + detail.rec_cargo_dtl_pkg_parent_id + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_komoditi_id">' + detail.rec_cargo_dtl_cmdty_id + '</td>' +
                                '<td class="tbl_dtl_komoditi_name">' + detail.rec_cargo_dtl_cmdty_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_rec_satuan_id">' + detail.rec_cargo_dtl_unit_id + '</td>' +
                                '<td class="tbl_dtl_rec_satuan_name">' + detail.rec_cargo_dtl_unit_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_rec_via_id">' + detail.rec_cargo_dtl_via + '</td>' +
                                '<td class="tbl_dtl_rec_via_name">' + detail.rec_cargo_dtl_via_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_rec_stacking_area_id">' + detail.rec_cargo_dtl_stack_area + '</td>' +
                                '<td class="tbl_dtl_rec_stacking_area_name">' + detail.rec_cargo_dtl_stack_area_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_rec_date_plan">' + detail.rec_cargo_dtl_rec_date + '</td>' +
                                '<td>' + detail.rec_cargo_dtl_rec_date + '</td>' +
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
                    }
                }
            });
        }

        //gettarif
        var id_rec = "<?= $id ?>";
        if (id_rec != "") {
            $.ajax({
                url: "<?= ROOT ?>npksbilling/appbookreccargo/getTarif/<?= $id ?>",
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
                    $('#REC_DPP').val(formatNumber(dpp));
                    $('#REC_PPN').val(formatNumber(ppn));
                    $('#REC_TOTAL').val(formatNumber(total_perhitungan));
                }
            });
        }
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
</script>