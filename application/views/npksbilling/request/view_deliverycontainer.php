<script src="<?= CUBE_ ?>js/jquery.nanoscroller.min.js"></script>
<script src="<?= CUBE_ ?>js/modernizr.custom.js"></script>
<script src="<?= CUBE_ ?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?= CUBE_ ?>js/classie.js"></script>
<script src="<?= CUBE_ ?>js/notificationFx.js"></script>

<script src="<?= CUBE_; ?>js/ipc/addressloading.js"></script>
<script src="<?= CUBE_; ?>js/ipc/validation.js"></script>
<script src="<?= CUBE_ ?>js/hogan.js"></script>
<script src="<?= CUBE_ ?>js/typeahead.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/bootstrap/searchbt.css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/bootstrap-timepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/select2.css" type="text/css" />

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
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label>Terminal</label>
                        <select id="DEL_TERMINAL" name="DEL_TERMINAL" class="form-control" required="" disabled>
                            <option value="not-selected"> -- Please Choose Terminal -- </option>
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label>PBM / EMKL</label>
                        <input name="DEL_PBM_NAME" id="DEL_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" disabled>
                        <input name="DEL_PBM_ID" id="DEL_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="" disabled>
                    </div>
                </div>
                <div class="row">
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
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="datepickerDate">Date</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input id="DEL_DATE" name="DEL_DATE" type="text" class="form-control" value="<?= date('Y-m-d') ?>" readonly="">
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        <label>To</label>
                        <select id="DEL_TO" name="DEL_TO" class="form-control" required="" disabled>
                            <option value="not-selected"> -- Please Choose To -- </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label>Payment Method</label>
                        <select id="DEL_PAYMETHOD" name="DEL_PAYMETHOD" class="form-control" required="" disabled>
                            <option value="not-selected"> -- Please Choose Payment Method -- </option>
                        </select>
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
                                <th>Ukuran</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Dangerous Goods</th>
                                <th>Kemasan</th>
                                <th>Via</th>
                                <th>Tanggal Rencana Delivery</th>
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
                        <button class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var counterdoc = 0;
    counterdetail = 0;
    var apiUrl = "http://10.88.48.33/api/public/";

    function goBack() {
        window.history.back();
    }

    $(document).ready(function() {
        $.blockUI();

        //TERMINAL
        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/mdm/get_terminalList",
            success: function(data) {
                var obj = JSON.parse(data);
                var toAppend = '';
                for (var i = 0; i < obj.length; i++) {
                    toAppend += '<option value="' + obj[i]['BRANCH_CODE'] + '" brchid="' + obj[i]['BRANCH_ID'] + '">' + obj[i]['TERMINAL_NAME'] + '</option>';
                }

                $('#DEL_TERMINAL').append(toAppend);
            }
        });

        //PBM
        $('#DEL_PBM_NAME').autocomplete({
            source: function(request, response) {
                console.log(request);
                $.ajax({
                    url: "<?= ROOT ?>npksbilling/mdm/pbm",
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        request: request.term,
                        branch_id: $('#DEL_TERMINAL').find('option:selected').attr('brchid')
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            select: function(event, ui) {
                console.log(ui);
                $('#DEL_PBM_NAME').val(ui.item.label);
                $('#DEL_PBM_ID').val(ui.item.pbm_id);
                return false;
            }
        });

        //To
        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/mdm/del_to",
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
        var id_del = "<?= $id ?>";
        if (id_del != "") {
            $.ajax({
                url: "<?= ROOT ?>npksbilling/deliverycontainer/update_del/<?= $id ?>",
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $.unblockUI();
                    if (data.HEADER != "") {
                        arrData = data;
                        console.log(arrData);
                        arrData.HEADER.forEach(function(item, index) {
                            $("#DEL_ID").val(item.del_id);
                            $("#DEL_NO").val(item.del_no);
                            $("#DEL_CREATE_BY").val();
                            $("#DEL_DATE").val(item.del_date);
                            $("#DEL_PBM_NAME").val(item.del_pbm_name);
                            $("#DEL_PBM_ID").val(item.del_pbm_id);
                            $("#DEL_PENUMPUKAN_OLEH_NAME").val(item.del_stackby_name);
                            $("#DEL_PENUMPUKAN_OLEH_ID").val(item.del_stackby_id);
                            $("#DEL_TO").val(item.del_to);
                            $("#DEL_PAYMETHOD").val(item.del_paymethod);
                            $("#DEL_VESSEL_NAME").val(item.del_vessel_name);
                            $("#DEL_VESSEL_CODE").val(item.del_vessel_code);
                            $("#DEL_VOYIN").val(item.del_voyin);
                            $("#DEL_VOYOUT").val(item.del_voyout);
                            $("#DEL_VESSEL_PKK").val(item.del_vessel_pkk);
                            $("#DEL_VESSEL").val(item.del_vessel_name);
                            $("#DEL_VESSEL_AGENT").val(item.del_vessel_agent);
                            $("#DEL_VESSEL_AGENT_NAME").val(item.del_vessel_agent_name);
                            $('#DEL_ETA').val(item.del_vessel_eta);
                            $('#DEL_ETD').val(item.del_vessel_etd);
                            $('#DEL_TERMINAL').val(item.del_branch_code);
                        });

                        $('#DTL_HDR_ID').val(arrData.DETAIL[0].hdr_del_id);
                        arrData.DETAIL.forEach(function(detail, index) {
                            var kemasan_val = detail.del_dtl_cmdty_name;
                            if (kemasan_val == null) {
                                var kemasan_label = "N/A";
                                var dtl_kemasan = "";
                                kemasan_val = "";
                            } else {
                                var kemasan_label = kemasan_val;
                                var dtl_kemasan = detail.del_dtl_cmdty_name;
                            }

                            $('#detail-list tbody').append(
                                '<tr>' +
                                '<td style="display: none;" class="tbl_dtl_del_id">' + detail.del_dtl_id + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_del_hdr_id">' + detail.del_hdr_id + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_del_owner_id">' + detail.del_dtl_owner + '</td>' +
                                '<td class="tbl_dtl_del_owner">' + detail.del_dtl_owner_name + '</td>' +

                                '<td class="tbl_dtl_del_no_cont">' + detail.del_dtl_cont + '</td>' +

                                '<td class="tbl_dtl_del_size_id">' + detail.del_dtl_cont_size + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_del_size_name">' + detail.del_dtl_cont_size + '</td>' +

                                '<td class="tbl_dtl_del_type_id">' + detail.del_dtl_cont_type + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_del_type_name">' + detail.del_dtl_cont_type + '</td>' +

                                '<td class="tbl_dtl_del_status_id">' + detail.del_dtl_cont_status + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_del_status_name">' + detail.del_dtl_cont_status + '</td>' +

                                '<td class="tbl_dtl_character_id">' + detail.del_dtl_cont_danger + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_character_name">' + detail.del_dtl_cont_danger + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_cmdty_id">' + dtl_kemasan + '</td>' +
                                '<td style="display: none;" class="tbl_dtl_cmdty_name">' + kemasan_val + '</td>' +
                                '<td class="tbl_dtl_cmdty_label">' + kemasan_label + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_del_via_id">' + detail.del_dtl_via + '</td>' +
                                '<td class="tbl_dtl_del_via_name">' + detail.del_dtl_via_name + '</td>' +

                                '<td style="display: none;" class="tbl_dtl_del_date_plan">' + detail.del_dtl_date_plan + '</td>' +
                                '<td>' + detail.del_dtl_date_plan + '</td>' +

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
    });
</script>