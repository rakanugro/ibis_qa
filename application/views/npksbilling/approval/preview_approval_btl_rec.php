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
                <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Receiving Container Reference</b></h2>
            </header>
            <div class="main-box-body clearfix">
                <div class="form-group col-xs-6">
                    <label>Nomor Request Reff</label>
                    <input name="REC_NO_REFF" id="REC_NO_REFF" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input name="REC_ID_REFF" id="REC_ID_REFF" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input name="CANCEL_ID" id="CANCEL_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Tanggal Request Reff</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="REC_DATE_REFF" name="REC_DATE_REFF" type="text" class="form-control" value="<?= date('Y-m-d') ?>" readonly="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                    <label for="datepickerDate">Tanggal Request Batal</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="REC_DATE_BATAL" name="REC_DATE_BATAL" type="text" class="form-control" value="<?= date('Y-m-d') ?>" readonly="">
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
                    <input type="hidden" id="REC_VESSEL_CODE" class="form-control" name="REC_VESSEL_CODE" required disabled>
                    <input type="hidden" id="REC_VESSEL" class="form-control" name="REC_VESSEL" required disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="REC_VESSEL_AGENT" id="REC_VESSEL_AGENT" type="text" class="form-control" readonly="">
                    <input name="REC_VESSEL_AGENT_NAME" id="REC_VESSEL_AGENT_NAME" type="hidden" disabled>
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

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <header class="main-box-header clearfix">
                <table class="table table-striped table-hover" id="detail-list">
                    <thead>
                        <tr>
                            <th>No Container</th>
                            <th>Ukuran</th>
                            <th>Type</th>
                            <th>Status</th>
                            <th>Sifat</th>
                            <th>Receiving Via</th>
                            <th>Komoditi</th>
                            <th>Tanggal Rencana Receiving</th>
                            <th>Cancel</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                &nbsp;
            </header>
        </div>
    </div>
</div>

<div class="" id='show-detail'>
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
            urlaction = "<?php echo ROOT ?>npksbilling/appbtlrec/approve/" + $('#CANCEL_ID').val();
        } else {
            urlaction = "<?php echo ROOT ?>npksbilling/appbtlrec/reject/" + $('#CANCEL_ID').val();
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
                                approvebtlrec_log(no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/appbtlrec";
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
                                    approvebtlrec_log(no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/appbtlrec";
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
                        rejecbtlrec_log(no_req);
                        setTimeout(function() {
                            window.location = "<?= ROOT ?>npksbilling/appbtlrec";
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
                            rejecbtlrec_log(no_req);
                            setTimeout(function() {
                                window.location = "<?= ROOT ?>npksbilling/appbtlrec";
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

    function rejecbtlrec_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/rejecbtlrec_log",
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

    function approvebtlrec_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/approvebtlrec_log",
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
        $.ajax({
            url: "<?= ROOT ?>npksbilling/appbtlrec/get_data/<?= $rec_id ?>",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.unblockUI();
                if (data.HEADER != "") {
                    arrData = data;
                    arrData.HEADER.forEach(function(item, index) {
                        $("#REC_ID_REFF").val(item.rec_id);
                        $("#REC_NO_REFF").val(item.rec_no);
                        $("#REC_CREATE_BY").val();
                        $("#REC_DATE_REFF").val(item.rec_date);
                        $("#REC_PBM_NAME").val(item.rec_pbm_name);
                        $("#REC_PBM_ID").val(item.rec_pbm_id);
                        $("#REC_PENUMPUKAN_OLEH_NAME").val(item.rec_stackby_name);
                        $("#REC_PENUMPUKAN_OLEH_ID").val(item.rec_stackby_id);
                        $("#REC_FROM").val(item.rec_from);
                        $("#REC_PAYMETHOD").val(item.rec_paymethod);
                        $("#REC_VESSEL_NAME").val(item.rec_vessel_name);
                        $("#REC_VESSEL_CODE").val(item.rec_vessel_code);
                        $("#REC_VOYIN").val(item.rec_voyin);
                        $("#REC_VOYOUT").val(item.rec_voyout);
                        $("#REC_VESSEL_PKK").val(item.rec_vessel_pkk);
                        $("#REC_VESSEL").val(item.rec_vessel_name);
                        $("#REC_VESSEL_AGENT").val(item.rec_vessel_agent);
                        $("#REC_VESSEL_AGENT_NAME").val(item.rec_vessel_agent_name);
                        $('#REC_ETA').val(item.rec_vessel_eta);
                        $('#REC_ETD').val(item.rec_vessel_etd);
                    });

                    var table = $("#detail tbody");
                    arrData.DETAIL.forEach(function(abc) {
                        if (abc.rec_dtl_cmdty_name == null) {
                            $label_cmdty_name = "N/A";
                        } else {
                            $label_cmdty_name = abc.rec_dtl_cmdty_name;
                        }
                        $('#detail-list tbody').append(
                            '<tr>' +
                            '<td>' + abc.rec_dtl_cont + '</td>' +
                            '<td>' + abc.rec_dtl_cont_size + '</td>' +
                            '<td>' + abc.rec_dtl_cont_type + '</td>' +
                            '<td>' + abc.rec_dtl_cont_status + '</td>' +
                            '<td>' + abc.rec_dtl_cont_danger + '</td>' +
                            '<td>' + abc.rec_dtl_via_name + '</td>' +
                            '<td>' + $label_cmdty_name + '</td>' +
                            '<td>' + abc.rec_dtl_date_plan + '</td>' +
                            '<td>' +
                            '<input type="checkbox" name="check[]" id="chk" checked disabled />' +
                            '</td>' +
                            '</tr>'
                        );
                    });
                }
            }
        });

        //getcancelid
        $.ajax({
            url: "<?= ROOT ?>npksbilling/appbtlrec/get_cancel_id/<?= $rec_no ?>",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.unblockUI();
                if (data.HEADER != "") {
                    arrData = data;
                    arrData.HEADER.forEach(function(item, index) {
                        $('#REC_NO').val(item.cancelled_no);
                        $('#REC_DATE_BATAL').val(item.cancelled_create_date);
                        $('#CANCEL_ID').val(item.cancelled_id);
                    });
                }
            }
        });
    });
</script>