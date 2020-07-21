<script src="<?= CUBE_ ?>js/jquery.nanoscroller.min.js"></script>
<script src="<?= CUBE_ ?>js/modernizr.custom.js"></script>
<script src="<?= CUBE_ ?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?= CUBE_ ?>js/classie.js"></script>
<script src="<?= CUBE_ ?>js/notificationFx.js"></script>
<script src="<?= CUBE_; ?>js/ipc/addressloading.js"></script>
<script src="<?= CUBE_; ?>js/ipc/validation.js"></script>
<script src="<?= CUBE_ ?>js/hogan.js"></script>
<script src="<?= CUBE_ ?>js/typeahead.min.js"></script>
<script src="<?= CUBE_ ?>js/jquery.datetimepicker.full.js"></script>
<script src="<?= CUBE_ ?>js/sweetalert2/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/bootstrap/searchbt.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>js/sweetalert2/dist/sweetalert2.min.css" />

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
                        <select id="STUFF_TERMINAL" name="STUFF_TERMINAL" class="form-control" required="" disabled>
                            <option value="not-selected"> -- Please Choose Terminal -- </option>
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <label>PBM / EMKL</label>
                        <input name="STUFF_PBM_NAME" id="STUFF_PBM_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
                        <input name="STUFF_PBM_ID" id="STUFF_PBM_ID" type="hidden" class="form-control" placeholder="Autocomplete" required="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="datepickerDate">Nomor Request</label>
                        <input name="STUFF_NO" id="STUFF_NO" type="text" class="form-control" placeholder="Auto Generate" readonly="">
                        <input name="STUFF_ID" id="STUFF_ID" type="hidden" class="form-control" placeholder="Auto Generate" readonly="">
                    </div>
                    <div class="form-group col-xs-6">
                        <label>Penumpukan Oleh</label>
                        <input name="STUFF_PENUMPUKAN_OLEH_NAME" id="STUFF_PENUMPUKAN_OLEH_NAME" type="text" class="form-control" value="<?= $this->session->userdata('customernamealt_phd') ?>" readonly="">
                        <input name="STUFF_PENUMPUKAN_OLEH_ID" id="STUFF_PENUMPUKAN_OLEH_ID" type="hidden" class="form-control" value="<?= $this->session->userdata('customerid_phd') ?>" readonly="">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label for="datepickerDate">Date</label>
                        <div class="input-group">
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            <input id="STUFF_DATE" name="STUFF_DATE" type="text" class="form-control" value="<?= date('Y-m-d h:i:s') ?>" required="" readOnly>
                        </div>
                    </div>
                    <div class="form-group col-xs-6">
                        <label>From</label>
                        <select id="STUFF_FROM" name="STUFF_FROM" class="form-control" required="" disabled>
                            <option value="not-selected"> -- Please Choose From -- </option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-xs-12">
                        <label>Payment Method</label>
                        <select id="STUFF_PAYMETHOD" name="STUFF_PAYMETHOD" class="form-control" required="" disabled>
                            <option value="not-selected"> -- Please Choose Payment Method -- </option>
                        </select>
                    </div>
                    <div class="form-group col-xs-6">
                        <input name="STUFF_ID_NOTA" id="STUFF_ID_NOTA" type="hidden" class="form-control" readonly="">
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
                    <input name="STUFF_VESSEL_NAME" id="STUFF_VESSEL_NAME" type="text" class="form-control" placeholder="Autocomplete" required="" readonly="">
                    <input type="hidden" id="STUFF_VESSEL_CODE" class="form-control" name="STUFF_VESSEL_CODE" required>
                    <input type="hidden" id="STUFF_VESSEL" class="form-control" name="STUFF_VESSEL" required>
                </div>
                <div class="form-group col-xs-6">
                    <label>Nama Agen</label>
                    <input name="STUFF_VESSEL_AGENT" id="STUFF_VESSEL_AGENT" type="text" class="form-control" readonly="">
                    <input name="STUFF_VESSEL_AGENT_NAME" id="STUFF_VESSEL_AGENT_NAME" type="hidden">
                </div>
                <div class="form-group col-xs-4">
                    <label>No PKK</label>
                    <input name="STUFF_VESSEL_PKK" id="STUFF_VESSEL_PKK" type="text" class="form-control" placeholder="No PKK" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage In</label>
                    <input name="STUFF_VOYIN" id="STUFF_VOYIN" type="text" class="form-control" placeholder="Voyage In" required="" readonly="">
                </div>
                <div class="form-group col-xs-4">
                    <label>Voyage Out</label>
                    <input name="STUFF_VOYOUT" id="STUFF_VOYOUT" type="text" class="form-control" placeholder="Voyage Out" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETA</label>
                    <input name="STUFF_ETA" id="STUFF_ETA" type="text" class="form-control" placeholder="ETA" required="" readonly="">
                </div>
                <div class="form-group col-xs-6">
                    <label>ETD</label>
                    <input name="STUFF_ETD" id="STUFF_ETD" type="text" class="form-control" placeholder="ETD" required="" readonly="">
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
                        <button id="submit_header" class="btn btn-primary btn-footer" onclick="goBack()"><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;&nbsp;Cancel</button>
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

                $('#STUFF_TERMINAL').append(toAppend);
            }
        });

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

                $('#STUFF_FROM').append(toAppend);
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

                $('#STUFF_PAYMETHOD').append(toAppend);
            }
        });

        //getdata
        $.ajax({
            url: "<?= ROOT ?>npksbilling/stuffing/update_stuff/<?= $id ?>",
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                $.unblockUI();
                if (data.HEADER != "") {
                    arrData = data;
                    console.log(arrData);
                    arrData.HEADER.forEach(function(item, index) {
                        $("#STUFF_ID").val(item.stuff_id);
                        $("#STUFF_NO").val(item.stuff_no);
                        $("#STUFF_STATUS").val(1);
                        $("#STUFF_BRANCH_ID").val(14);
                        $("#STUFF_CREATE_BY").val();
                        $("#STUFF_DATE").val(item.stuff_date);
                        $("#STUFF_PBM_NAME").val(item.stuff_pbm_name);
                        $("#STUFF_PBM_ID").val(item.stuff_pbm_id);
                        $("#STUFF_PENUMPUKAN_OLEH_NAME").val(item.stuff_stackby_name);
                        $("#STUFF_PENUMPUKAN_OLEH_ID").val(item.stuff_stackby_id);
                        $("#STUFF_FROM").val(item.stuff_from);
                        $("#STUFF_PAYMETHOD").val(item.stuff_paymethod);
                        $('#STUFF_ID_NOTA').val(item.stuff_nota);
                        $("#STUFF_VESSEL_NAME").val(item.stuff_vessel_name);
                        $("#STUFF_VESSEL_CODE").val(item.stuff_vessel_code);
                        $("#STUFF_VOYIN").val(item.stuff_voyin);
                        $("#STUFF_VOYOUT").val(item.stuff_voyout);
                        $("#STUFF_VESSEL_PKK").val(item.stuff_vessel_pkk);
                        $("#STUFF_VESSEL").val(item.stuff_vessel_name);
                        $("#STUFF_VESSEL_AGENT").val(item.stuff_vessel_agent);
                        $("#STUFF_VESSEL_AGENT_NAME").val(item.stuff_vessel_agent_name);
                        $('#STUFF_ETA').val(item.stuff_vessel_eta);
                        $('#STUFF_ETD').val(item.stuff_vessel_etd);
                        $('#STUFF_TERMINAL').val(item.stuff_branch_code);
                    });

                    set_detail();

                    $('#show-detail').removeClass('hidden_content');

                    $('#DTL_HDR_ID').val(arrData.DETAIL[0].stuff_hdr_id);

                    if ($('#STUFF_ID_NOTA').val() == 7) {
                        var show_tgl_rec = "";
                        var show_tgl_del = "display: none;";
                    } else if ($('#STUFF_ID_NOTA').val() == 8) {
                        var show_tgl_rec = "";
                        var show_tgl_del = "";
                    } else if ($('#STUFF_ID_NOTA').val() == 9) {
                        var show_tgl_rec = "display: none;";
                        var show_tgl_del = "";
                    } else {
                        var show_tgl_rec = "display: none;";
                        var show_tgl_del = "display: none;";
                    }
                    arrData.DETAIL.forEach(function(detail, index) {
                        var kemasan_val = detail.stuff_dtl_cmdty_name;
                        if (kemasan_val == null) {
                            var kemasan_label = "N/A";
                            var dtl_kemasan = "";
                            kemasan_val = "";
                        } else {
                            var kemasan_label = kemasan_val;
                            var dtl_kemasan = detail.stuff_dtl_cmdty_name;
                        }

                        var status_val = detail.stuff_dtl_cont_status;
                        if (status_val == null) {
                            var status_label = "N/A";
                            var dtl_status = "";
                            status_val = "";
                        } else {
                            var status_label = status_val;
                            var dtl_status = detail.stuff_dtl_cont_status;
                        }

                        $('#detail-list tbody').append(
                            '<tr>' +
                            '<td style="display: none;" class="tbl_dtl_stuff_id">' + detail.stuff_dtl_id + '</td>' +
                            '<td style="display: none;" class="tbl_dtl_stuff_hdr_id">' + detail.stuff_hdr_id + '</td>' +


                            '<td style="display: none;" class="tbl_dtl_exbatalsp2_id">' + detail.stuff_dtl_sp2 + '</td>' +
                            '<td class="tbl_dtl_exbatalsp2_name">' + detail.stuff_dtl_sp2 + '</td>' +

                            '<td style="display: none;" class="tbl_dtl_stuff_owner_id">' + detail.stuff_dtl_owner + '</td>' +
                            '<td class="tbl_dtl_stuff_owner">' + detail.stuff_dtl_owner_name + '</td>' +

                            '<td class="tbl_dtl_stuff_no_cont">' + detail.stuff_dtl_cont + '</td>' +

                            '<td style="display: none;" class="tbl_dtl_stuff_size_id">' + detail.stuff_dtl_cont_size + '</td>' +
                            '<td class="tbl_dtl_stuff_size_name">' + detail.stuff_dtl_cont_size + '</td>' +

                            '<td style="display: none;" class="tbl_dtl_stuff_type_id">' + detail.stuff_dtl_cont_type + '</td>' +
                            '<td class="tbl_dtl_stuff_type_name">' + detail.stuff_dtl_cont_type + '</td>' +

                            '<td style="display: none;" class="tbl_dtl_stuff_status_id">' + dtl_status + '</td>' +
                            '<td style="display: none;" class="tbl_dtl_stuff_status_name">' + status_val + '</td>' +
                            '<td class="tbl_dtl_stuff_status_label">' + status_label + '</td>' +

                            '<td style="display: none;" class="tbl_dtl_character_id">' + detail.stuff_dtl_cont_danger + '</td>' +
                            '<td class="tbl_dtl_character_name">' + detail.stuff_dtl_cont_danger + '</td>' +

                            '<td style="display: none;" class="tbl_dtl_stuff_via_id">' + detail.stuff_dtl_via + '</td>' +
                            '<td class="tbl_dtl_stuff_via_name">' + detail.stuff_dtl_via_name + '</td>' +

                            '<td style="display: none;" class="tbl_dtl_stuff_kemasan_id">' + dtl_kemasan + '</td>' +
                            '<td style="display: none;" class="tbl_dtl_stuff_kemasan">' + kemasan_val + '</td>' +
                            '<td class="tbl_dtl_stuff_kemasan_label">' + kemasan_label + '</td>' +

                            '<td class="tbl_dtl_stuff_date_start">' + detail.stuff_dtl_start_date + '</td>' +

                            '<td class="tbl_dtl_stuff_date_end">' + detail.stuff_dtl_end_date + '</td>' +

                            '<td style="' + show_tgl_rec + '" class="tbl_dtl_stuff_rec_date">' + detail.stuff_dtl_rec_date + '</td>' +

                            '<td style="' + show_tgl_del + '" class="tbl_dtl_stuff_del_date">' + detail.stuff_dtl_del_date + '</td>' +
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
                } else {
                    get_id_nota();
                }
            }
        });

    });

    function get_id_nota() {
        $.ajax({
            url: "<?= ROOT ?>npksbilling/stuffing/get_nota_id",
            type: 'GET',
            data: {},
            success: function(data) {
                $.unblockUI();
                var obj = JSON.parse(JSON.parse(data));
                if (obj.result[0]) {
                    $('#STUFF_ID_NOTA').val(obj.result[0].nota_id);
                    $("#STUFF_ID_NOTA").val();
                } else {
                    $('#STUFF_ID_NOTA').val(3);
                    $("#STUFF_ID_NOTA").val();
                }
                set_detail();
            }
        });
    }

    function set_detail() {
        if ($("#STUFF_ID_NOTA").val() == 7) {
            $('#detail-list thead').append(
                '<tr>' +
                '<th>' + 'Ex Batal SP2' + '</th>' +
                '<th>' + 'Container Owner' + '</th>' +
                '<th>' + 'No Container' + '</th>' +
                '<th>' + 'Ukuran' + '</th>' +
                '<th>' + 'Type' + '</th>' +
                '<th>' + 'Status' + '</th>' +
                '<th>' + 'Dangerous Goods' + '</th>' +
                '<th>' + 'Stuffing Via' + '</th>' +
                '<th>' + 'Kemasan' + '</th>' +
                '<th>' + 'Start Stuffing' + '</th>' +
                '<th>' + 'End Stuffing' + '</th>' +
                '<th>' + 'Tanggal Receiving' + '</th>' +
                '<th>' + '</th>' +
                '</tr>'
            );
        } else if ($("#STUFF_ID_NOTA").val() == 8) {
            $('#detail-list thead').append(
                '<tr>' +
                '<th>' + 'Ex Batal SP2' + '</th>' +
                '<th>' + 'Container Owner' + '</th>' +
                '<th>' + 'No Container' + '</th>' +
                '<th>' + 'Ukuran' + '</th>' +
                '<th>' + 'Type' + '</th>' +
                '<th>' + 'Status' + '</th>' +
                '<th>' + 'Dangerous Goods' + '</th>' +
                '<th>' + 'Stuffing Via' + '</th>' +
                '<th>' + 'Kemasan' + '</th>' +
                '<th>' + 'Start Stuffing' + '</th>' +
                '<th>' + 'End Stuffing' + '</th>' +
                '<th>' + 'Tanggal Receiving' + '</th>' +
                '<th>' + 'Tanggal Delivery' + '</th>' +
                '<th>' + '</th>' +
                '</tr>'
            );
        } else if ($("#STUFF_ID_NOTA").val() == 9) {
            $('#detail-list thead').append(
                '<tr>' +
                '<th>' + 'Ex Batal SP2' + '</th>' +
                '<th>' + 'Container Owner' + '</th>' +
                '<th>' + 'No Container' + '</th>' +
                '<th>' + 'Ukuran' + '</th>' +
                '<th>' + 'Type' + '</th>' +
                '<th>' + 'Status' + '</th>' +
                '<th>' + 'Dangerous Goods' + '</th>' +
                '<th>' + 'Stuffing Via' + '</th>' +
                '<th>' + 'Kemasan' + '</th>' +
                '<th>' + 'Start Stuffing' + '</th>' +
                '<th>' + 'End Stuffing' + '</th>' +
                '<th>' + 'Tanggal Delivery' + '</th>' +
                '<th>' + '</th>' +
                '</tr>'
            );
        } else {
            $('#detail-list thead').append(
                '<tr>' +
                '<th>' + 'Ex Batal SP2' + '</th>' +
                '<th>' + 'Container Owner' + '</th>' +
                '<th>' + 'No Container' + '</th>' +
                '<th>' + 'Ukuran' + '</th>' +
                '<th>' + 'Type' + '</th>' +
                '<th>' + 'Status' + '</th>' +
                '<th>' + 'Dangerous Goods' + '</th>' +
                '<th>' + 'Stuffing Via' + '</th>' +
                '<th>' + 'Kemasan' + '</th>' +
                '<th>' + 'Start Stuffing' + '</th>' +
                '<th>' + 'End Stuffing' + '</th>' +
                '<th>' + '</th>' +
                '</tr>'
            );
        }
    }
</script>