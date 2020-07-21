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
                <div class="form-group col-xs-12">
                    <label>Terminal</label>
                    <select id="REC_TERMINAL" name="REC_TERMINAL" class="form-control" required="" disabled>
                        <option value="not-selected"> -- Please Choose Terminal -- </option>
                    </select>
                </div>
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

                $('#REC_TERMINAL').append(toAppend);
            }
        });

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
                            $('#REC_TERMINAL').val(item.rec_cargo_branch_code);
                        });

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
    });
</script>