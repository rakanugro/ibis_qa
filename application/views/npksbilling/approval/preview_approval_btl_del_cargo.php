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
                <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Delivery Barang Reference</b></h2>
            </header>
            <div class="main-box-body clearfix">
                <div class="form-group col-xs-6">
                    <label>Nomor Request Reff</label>
                    <input name="DEL_NO_REFF" id="DEL_NO_REFF" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input name="DEL_ID_REFF" id="DEL_ID_REFF" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input name="CANCEL_ID" id="CANCEL_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Tanggal Request Reff</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="DEL_DATE_REFF" name="DEL_DATE_REFF" type="text" class="form-control" value="<?= date('Y-m-d') ?>" readonly="">
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
                    <input name="DEL_PBM_NAME" id="DEL_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input name="DEL_PBM_ID" id="DEL_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Nomor Request</label>
                    <input name="DEL_NO" id="DEL_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
                    <input name="DEL_ID" id="DEL_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>Penumpukan Oleh</label>
                    <input name="DEL_PENUMPUKAN_OLEH_NAME" id="DEL_PENUMPUKAN_OLEH_NAME" type="text" class="form-control" placeholder="Autocomplete" disabled>
                    <input name="DEL_PENUMPUKAN_OLEH_ID" id="DEL_PENUMPUKAN_OLEH_ID" type="hidden" class="form-control" placeholder="Autocomplete" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Tanggal Request Batal</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="DEL_DATE_BATAL" name="DEL_DATE_BATAL" type="text" class="form-control" value="<?= date('Y-m-d') ?>" readonly="">
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label>To</label>
                    <select id="DEL_TO" name="DEL_TO" class="form-control" required="" disabled>
                        <option value="not-selected"> -- Please Choose To -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label>Payment Method</label>
                    <select id="DEL_PAYMETHOD" name="DEL_PAYMETHOD" class="form-control" required="" disabled>
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
                    <input name="DEL_VESSEL_NAME" id="DEL_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input type="hidden" id="DEL_VESSEL_CODE" class="form-control" name="DEL_VESSEL_CODE" required disabled>
                    <input type="hidden" id="DEL_VESSEL" class="form-control" name="DEL_VESSEL" required disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="DEL_VESSEL_AGENT" id="DEL_VESSEL_AGENT" type="text" class="form-control" readonly="">
                    <input name="DEL_VESSEL_AGENT_NAME" id="DEL_VESSEL_AGENT_NAME" type="hidden" disabled>
                </div>
                <div class="form-group col-xs-4">
                    <label>No PKK</label>
                    <input name="DEL_VESSEL_PKK" id="DEL_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage In</label>
                    <input name="DEL_VOYIN" id="DEL_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage Out</label>
                    <input name="DEL_VOYOUT" id="DEL_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETA</label>
                    <input name="DEL_ETA" id="DEL_ETA" type="text" class="form-control" placeholder="ETA" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETD</label>
                    <input name="DEL_ETD" id="DEL_ETD" type="text" class="form-control" placeholder="ETD" required="" readonly="">
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
                            <th>BL/SI/DO</th>
                            <th>Jumlah Request Batal</th>
                            <th>Jumlah Realisasi</th>
                            <th>Sifat</th>
                            <th>Kemasan</th>
                            <th>Barang</th>
                            <th>Satuan</th>
                            <th>Delivery Via</th>
                            <th>Tanggal Delivery</th>
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
            urlaction = "<?php echo ROOT ?>npksbilling/appbtldelcargo/approve/" + $('#CANCEL_ID').val();
        } else {
            urlaction = "<?php echo ROOT ?>npksbilling/appbtldelcargo/reject/" + $('#CANCEL_ID').val();
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
                                    text: "Approval " + $('#DEL_NO').val() + " berhasil"
                                })
                                approvebtl_del_cargo_log(no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/appbtldelcargo";
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
                                        text: "Approval " + $('#DEL_NO').val() + " berhasil"
                                    })
                                    approvebtl_del_cargo_log(no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/appbtldelcargo";
                                    }, 1000);
                                } else {
                                    $.unblockUI();
                                    Swal.fire({
                                        icon: 'error',
                                        title: array_data['result'],
                                        showConfirmButton: false,
                                        timer: 1500,
                                        text: "Approval " + $('#DEL_NO').val() + " gagal"
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
                            text: "Reject " + $('#DEL_NO').val() + " berhasil"
                        })
                        rejecbtl_del_cargo_log(no_req);
                        setTimeout(function() {
                            window.location = "<?= ROOT ?>npksbilling/appbtldelcargo";
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
                                text: "Reject " + $('#DEL_NO').val() + " berhasil"
                            })
                            rejecbtl_del_cargo_log(no_req);
                            setTimeout(function() {
                                window.location = "<?= ROOT ?>npksbilling/appbtldelcargo";
                            }, 1000);
                        } else {
                            $.unblockUI();
                            Swal.fire({
                                icon: 'error',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#DEL_NO').val() + " gagal"
                            })
                        }
                    }
                }
            });
        }
    }

    function rejecbtl_del_cargo_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/rejecbtl_del_cargo_log",
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

    function approvebtl_del_cargo_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/approvebtl_del_cargo_log",
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

        //To
        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/mdm/to",
            success: function(data) {
                var obj = JSON.parse(data);
                var record = obj['result'];

                var toAppend = '';
                for (var i = 0; i < record.length; i++) {
                    toAppend += '<option value="' + record[i]['reff_order'] + '">' + record[i]['reff_name'] + '</option>';
                }

                $('#DEL_TO').append(toAppend);
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

                $('#DEL_PAYMETHOD').append(toAppend);
            }
        });

        //getdata
        $.ajax({
            url: "<?= ROOT ?>npksbilling/appbtldelcargo/get_data/<?= $del_id ?>",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.unblockUI();
                if (data.HEADER != "") {
                    arrData = data;
                    arrData.HEADER.forEach(function(item, index) {
                        $("#DEL_ID_REFF").val(item.del_cargo_id);
                        $("#DEL_NO_REFF").val(item.del_cargo_no);
                        $("#DEL_CREATE_BY").val();
                        $("#DEL_DATE_REFF").val(item.del_cargo_date);
                        $("#DEL_PBM_NAME").val(item.del_cargo_pbm_name);
                        $("#DEL_PBM_ID").val(item.del_cargo_pbm_id);
                        $("#DEL_PENUMPUKAN_OLEH_NAME").val(item.del_cargo_stackby_name);
                        $("#DEL_PENUMPUKAN_OLEH_ID").val(item.del_cargo_stackby_id);
                        $("#DEL_TO").val(item.del_cargo_to);
                        $("#DEL_PAYMETHOD").val(item.del_cargo_paymethod);
                        $("#DEL_VESSEL_NAME").val(item.del_cargo_vessel_name);
                        $("#DEL_VESSEL_CODE").val(item.del_cargo_vessel_code);
                        $("#DEL_VOYIN").val(item.del_cargo_voyin);
                        $("#DEL_VOYOUT").val(item.del_cargo_voyout);
                        $("#DEL_VESSEL_PKK").val(item.del_cargo_vessel_pkk);
                        $("#DEL_VESSEL").val(item.del_cargo_vessel_name);
                        $("#DEL_VESSEL_AGENT").val(item.del_cargo_vessel_agent);
                        $("#DEL_VESSEL_AGENT_NAME").val(item.del_cargo_vessel_agent_name);
                        $('#DEL_ETA').val(item.del_cargo_vessel_eta);
                        $('#DEL_ETD').val(item.del_cargo_vessel_etd);
                    });

                    var table = $("#detail tbody");
                    arrData.DETAIL.forEach(function(abc) {
                        var jumlah_cargo_real = abc.del_cargo_dtl_qty - abc.del_cargo_dtl_canc_qty;
                        $('#detail-list tbody').append(
                            '<tr>' +
                            '<td>' + abc.del_cargo_dtl_si_no + '</td>' +
                            '<td>' + abc.del_cargo_dtl_canc_qty + '</td>' +
                            '<td>' + jumlah_cargo_real + '</td>' +
                            '<td>' + abc.del_cargo_dtl_character_name + '</td>' +
                            '<td>' + abc.del_cargo_dtl_pkg_name + '</td>' +
                            '<td>' + abc.del_cargo_dtl_cmdty_name + '</td>' +
                            '<td>' + abc.del_cargo_dtl_unit_name + '</td>' +
                            '<td>' + abc.del_cargo_dtl_via_name + '</td>' +
                            '<td>' + abc.del_cargo_dtl_del_date + '</td>' +
                            '</tr>'
                        );
                    });
                }
            }
        });

        //getcancelid
        $.ajax({
            url: "<?= ROOT ?>npksbilling/appbtldelcargo/get_cancel_id/<?= $del_no ?>",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.unblockUI();
                if (data.HEADER != "") {
                    arrData = data;
                    arrData.HEADER.forEach(function(item, index) {
                        $('#DEL_NO').val(item.cancelled_no);
                        $('#DEL_DATE_BATAL').val(item.cancelled_create_date);
                        $('#CANCEL_ID').val(item.cancelled_id);
                    });
                }
            }
        });
    });
</script>