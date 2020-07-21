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
                <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>fumiging Reefer reference</b></h2>
            </header>
            <div class="main-box-body clearfix">

                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Nomor Request Reff</label>
                    <input name="fumi_no" id="fumi_no" type="text" class="form-control" placeholder="Auto Generate" readonly="">

                </div>

                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Tanggal Request Reff</label>
                    <input name="tgl_request_reff" id="tgl_request" type="text" class="form-control" placeholder="Auto Generate" readonly="">

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
                <div class="form-group col-xs-12">
                    <label>PBM / EMKL</label>
                    <input name="fumi_PBM_NAME" id="fumi_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input name="fumi_PBM_ID" id="fumi_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Nomor Request</label>
                    <input name="fumi_NO" id="fumi_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
                    <input name="fumi_ID" id="fumi_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label for="datepickerDate">Date</label>
                    <div class="input-group">
                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        <input id="fumi_DATE" name="fumi_DATE" type="text" class="form-control" value="<?= date('Y-m-d') ?>" readonly="">
                    </div>
                </div>
                <div class="form-group col-xs-6">
                    <label>From</label>
                    <select id="fumi_FROM" name="fumi_FROM" class="form-control" required="" disabled>
                        <option value="not-selected"> -- Please Choose From -- </option>
                    </select>
                </div>
                <div class="form-group col-xs-6">
                    <label>Payment Method</label>
                    <select id="fumi_PAYMETHOD" name="fumi_PAYMETHOD" class="form-control" required="" disabled>
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
                <h2><span class="glyphicon glyphicon-folder-open"></span>&nbsp;&nbsp;<b>Customer</b></h2>
            </header>
            <div class="main-box-body clearfix">
                <div class="form-group col-xs-12">
                    <label>Customer</label>
                    <input name="cust_name" id="cust_name" type="text" class="form-control" placeholder="Autocomplete" required="" required="">
                </div>
                <div class="form-group col-xs-12">
                    <label>NPWP</label>
                    <input name="cust_npwp" id="cust_npwp" type="text" class="form-control" placeholder="Auto Generate" required="" readonly="">
                </div>
                <div class="form-group col-xs-12">
                    <label>Alamat</label>
                    <input name="cust_address" id="cust_address" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
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
                    <input name="fumi_VESSEL_NAME" id="fumi_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                    <input type="hidden" id="fumi_VESSEL_CODE" class="form-control" name="fumi_VESSEL_CODE" required disabled>
                    <input type="hidden" id="fumi_VESSEL" class="form-control" name="fumi_VESSEL" required disabled>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="fumi_VESSEL_AGENT" id="fumi_VESSEL_AGENT" type="text" class="form-control" readonly="">
                    <input name="fumi_VESSEL_AGENT_NAME" id="fumi_VESSEL_AGENT_NAME" type="hidden" disabled>
                </div>
                <div class="form-group col-xs-4">
                    <label>No PKK</label>
                    <input name="fumi_VESSEL_PKK" id="fumi_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage In</label>
                    <input name="fumi_VOYIN" id="fumi_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage Out</label>
                    <input name="fumi_VOYOUT" id="fumi_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETA</label>
                    <input name="fumi_ETA" id="fumi_ETA" type="text" class="form-control" placeholder="Port Of Loading" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETD</label>
                    <input name="fumi_ETD" id="fumi_ETD" type="text" class="form-control" placeholder="Port Of Destination" required="" readonly="">
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

                                <th>No Container</th>
                                <th>Ukuran</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Sifat</th>
                                <th>Komoditi</th>
                                <th>Tanggal Kegiatan</th>
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
    //var apiUrl = "http://10.88.48.33/api/public/";

    function show_reject() {
        $('#modal_reject').modal();
    }

    function save_approval(action, remarks) {
        var text = '';
        var urlaction = "";
        if (action == 'approve') {
            urlaction = "<?php echo ROOT ?>npksbilling/appbtlfumi/approve/<?php echo $cancel_id; ?>";
        } else {
            urlaction = "<?php echo ROOT ?>npksbilling/appbtlfumi/reject/<?php echo $cancel_id; ?>";
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
                                    text: "Approval " + $('#fumi_no').val() + " berhasil"
                                })
                                approvebtl_fumi_log(no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/appbtlfumi";
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
                                        text: "Approval " + $('#fumi_no').val() + " berhasil"
                                    })
                                    approvebtl_fumi_log(no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/appbtlfumi";
                                    }, 1000);
                                } else {
                                    $.unblockUI();
                                    Swal.fire({
                                        icon: 'error',
                                        title: array_data['result'],
                                        showConfirmButton: false,
                                        timer: 1500,
                                        text: "Approval " + $('#fumi_no').val() + " gagal"
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
                            text: "Reject " + $('#fumi_no').val() + " berhasil"
                        })
                        rejecbtl_fumi_log(no_req);
                        setTimeout(function() {
                            window.location = "<?= ROOT ?>npksbilling/appbtlfumi";
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
                                text: "Reject " + $('#fumi_no').val() + " berhasil"
                            })
                            rejecbtl_fumi_log(no_req);
                            setTimeout(function() {
                                window.location = "<?= ROOT ?>npksbilling/appbtlfumi";
                            }, 1000);
                        } else {
                            $.unblockUI();
                            Swal.fire({
                                icon: 'error',
                                title: array_data['result'],
                                showConfirmButton: false,
                                timer: 1500,
                                text: "Reject " + $('#fumi_no').val() + " gagal"
                            })
                        }
                    }
                }
            });
        }
    }

    function rejecbtl_fumi_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/rejecbtl_fumi_log",
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

    function approvebtl_fumi_log(no_req) {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/approvebtl_fumi_log",
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

        //From
        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/mdm/from",
            success: function(data) {
                var obj = JSON.parse(data);
                var record = obj['result'];

                var toAppend = '';
                for (var i = 0; i < record.length; i++) {
                    toAppend += '<option value="' + record[i]['reff_order'] + '">' + record[i]['reff_name'] + '</option>';
                }

                $('#fumi_FROM').append(toAppend);
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

                $('#fumi_PAYMETHOD').append(toAppend);
            }
        });

        //getdata
        var id_fumi = "<?= $id ?>";
        if (id_fumi != "") {
            $.ajax({
                url: "<?= ROOT ?>npksbilling/appbtlfumi/update_fumi/<?= $id ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.unblockUI();
                    if (data.HEADER != "") {
                        arrData = data;
                        arrData.HEADER.forEach(function(item, index) {
                            //$("#fumi_ID").val(item.cancelled_req_no);
                            $("#cust_name").val(item.fumi_cust_name);
                            $("#cust_npwp").val(item.fumi_cust_npwp);
                            $("#cust_address").val(item.fumi_cust_address);
                            $("#fumi_no").val(item.fumi_no);
                            $("#tgl_request").val(item.fumi_create_date);
                            $("#fumi_STATUS").val(1);
                            $("#fumi_BRANCH_ID").val(14);
                            $("#fumi_CREATE_BY").val();
                            $("#fumi_DATE").val(item.fumi_date);
                            $("#fumi_PBM_NAME").val(item.fumi_pbm_name);
                            $("#fumi_PBM_ID").val(item.fumi_pbm_id);
                            $("#fumi_FROM").val(item.fumi_from);
                            $("#fumi_PAYMETHOD").val(item.fumi_paymethod);
                            $("#fumi_VESSEL_NAME").val(item.fumi_vessel_name);
                            $("#fumi_VESSEL_CODE").val(item.fumi_vessel_code);
                            $("#fumi_VOYIN").val(item.fumi_voyin);
                            $("#fumi_VOYOUT").val(item.fumi_voyout);
                            $("#fumi_VESSEL_PKK").val(item.fumi_vessel_pkk);
                            $("#fumi_VESSEL").val(item.fumi_vessel_name);
                            $("#fumi_VESSEL_AGENT").val(item.fumi_vessel_agent);
                            $("#fumi_VESSEL_AGENT_NAME").val(item.fumi_vessel_agent_name);
                            $('#fumi_ETA').val(item.fumi_vessel_eta);
                            $('#fumi_ETD').val(item.fumi_vessel_etd);
                        });

                        $('#DTL_HDR_ID').val(arrData.DETAIL[0].hdr_fumi_id);
                        arrData.DETAIL.forEach(function(detail, index) {

                            $('#detail-list tbody').append(
                                '<tr>' +
                                '<td>' + detail.fumi_dtl_cont + '</td>' +
                                '<td>' + detail.fumi_dtl_cont_size + '</td>' +
                                '<td>' + detail.fumi_dtl_cont_type + '</td>' +
                                '<td>' + detail.fumi_dtl_cont_status + '</td>' +
                                '<td>' + detail.fumi_dtl_cont_danger + '</td>' +
                                '<td>' + detail.fumi_dtl_cmdty_name + '</td>' +

                                '<td>' + detail.fumi_dtl_activity_date + '</td>' +


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
    });

    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,');
    }
</script>