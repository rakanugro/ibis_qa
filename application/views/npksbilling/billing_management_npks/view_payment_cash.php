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

    table#table_detail_bl {
        border-collapse: collapse;
        width: 100%;
    }

    table#table_detail_bl th,
    td {
        text-align: left;
        padding: 8px;
    }

    table#table_detail_bl tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /**
  Component
**/

    label {
        width: 100%;
    }

    .card-input-element {
        display: none;
    }

    .card-input {
        margin: 10px;
        padding: 00px;
    }

    .card-input:hover {
        cursor: pointer;
    }

    .card-input-element:checked+.card-input {
        box-shadow: 0 0 2px 2px #2ecc71;
    }

    hr {
        display: block;
        margin-top: 0.5em;
        margin-bottom: 0.5em;
        margin-left: auto;
        margin-right: auto;
        border-style: inset;
        border-width: 1px;
    }

    .container_img {
        height: 60px;
        width: 60px;
        overflow: hidden;
    }

    .container_img img {
        max-width: 60px;
        max-height: 60px;
    }
</style>
<!--  <?php
        $no = 1;
        $total_amount = 0;
        foreach ($detail_payment as $details) {
            if ($details->nota_paid == "Y") {
                $banka = $details->pay_account_no;
                $btn = "hidden_content";
                $dis = "disabled";
            } else {
                $btn = "";
                $banka = "$details->pay_account_no";
                $dis = "";
            }
        } ?> -->
<div class="row" style="background:white;">
    <div class="col-lg-6">
        <div class="main-box clearfix" style="background:transparent; box-shadow:none !important;">
            <header class="main-box-header clearfix">
                <!-- <h2 class="pull-left">Form Payment</h2> -->
                <h3 class="pull-center">SILAHKAN PILIH BANK</h3>
            </header>
            <div class="main-box-body clearfix">
                <?php foreach ($bank as $banks) {
                    if ($banks->account_no == $banka) {
                        $cek = "checked";
                    } else {
                        $cek = "";
                    }
                ?>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <label>
                            <input type="radio" name="PAY_BANK_CODE" onclick="radioBankChange(this);" value="<?php echo $banks->bank_code . '||' . $banks->bank_name . '||' . $banks->branch_id . '||' . $banks->branch_code . '||' . $banks->account_no . '||' . $banks->account_name . '||' . $banks->bank_id ?>" class="card-input-element" <?= $cek ?> <?= $dis ?> />
                            <div class="panel panel-default card-input">
                                <div class="panel-heading" style="border:none !important; background: white;">
                                    <center>
                                        <strong style="color:black;"><?php echo $banks->bank_name ?></strong><br><br>
                                        <div class="container_img">
                                            <img alt="" src="<?= CUBE_ ?>img/<?php echo $banks->bank_icon ?>" />
                                        </div>
                                        <strong style="color:black;"><?php echo $banks->account_name ?></strong><br><br>
                                    </center>
                                </div>
                                <div class="panel-body" style="background:#ededed;">
                                    <p>✓ ATM</p>
                                    <p>✓ Teller</p>
                                    <p>✓ Internet</p>
                                </div>
                            </div>
                        </label>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6 hidden_content">
        <div class="main-box clearfix" style="background:transparent; box-shadow:none !important;">
            <header class="main-box-header clearfix">
                <!-- <h2 class="pull-left">Form Payment</h2> -->
            </header>
            <div class="main-box-body clearfix">
                <!-- <div class="col-md-4 col-lg-4 col-sm-4">
                        <label>
                        <input type="radio" name="product" class="card-input-element" />
                            <div class="panel panel-default card-input">
                                <div class="panel-heading" style="border:none !important; background: white;">
                                    <center>
                                        <strong style="color:black;">MANDIRI CLICKPAY</strong><br><br>
                                        <div class="container_img">
                                            <img alt="" src="<?= CUBE_ ?>img/mandiri_clickpay.png" />
                                        </div>
                                    </center>
                                </div>
                                <div class="panel-body" style="background:#ededed;">
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p> 
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <label>
                        </label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <label>
                        </label>
                    </div> -->
                <!-- <h2>Auto Collection</h2> -->
                <!-- <div class="col-md-4 col-lg-4 col-sm-4">
                        <label>
                        <input type="radio" name="product" class="card-input-element" />
                            <div class="panel panel-default card-input">
                                <div class="panel-heading" style="border:none !important; background: white;">
                                    <center>
                                        <strong style="color:black;">BNI AUTOCOLLECTION</strong><br><br>
                                        <div class="container_img">
                                            <img alt="" src="<?= CUBE_ ?>img/bni.png" />
                                        </div>
                                    </center>
                                </div>
                                <div class="panel-body" style="background:#ededed;">
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p> 
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="col-md-4 col-lg-4 col-sm-4">
                        <label>
                        <input type="radio" name="product" class="card-input-element" />
                            <div class="panel panel-default card-input">
                                <div class="panel-heading" style="border:none !important; background: white;">
                                    <center>
                                        <strong style="color:black;">MANDIRI AUTOCOLLECTION</strong><br><br>
                                        <div class="container_img">
                                            <img alt="" src="<?= CUBE_ ?>img/mandiri.png" />
                                        </div>
                                    </center>
                                </div>
                                <div class="panel-body" style="background:#ededed;">
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p>
                                    <p>&nbsp;</p> 
                                </div>
                            </div>
                        </label>
                    </div> -->
            </div>
        </div>
    </div>
    <!-- <hr> -->
    <div class="col-lg-12">
        <div class="main-box">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix">
                    <!-- <h2 class="pull-left">Form Payment</h2> -->
                </header>
                <div class="main-box-body clearfix">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NOMOR PROFORMA</th>
                                    <th>CUSTOMER</th>
                                    <th>SERVICE</th>
                                    <th>QTY</th>
                                    <th>TARIF</th>
                                    <!-- <th>SUB SERVICE</th> -->
                                    <th>AMOUNT</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!--  <?php
                                        $no = 1;
                                        $total_amount = 0;
                                        foreach ($detail_payment as $details) { ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo ($type_data == 'nota') ? $details->nota_no : $details->uper_no; ?></td>
                                            <td><?php echo ($type_data == 'nota') ? $details->nota_cust_name : $details->uper_cust_name ?></td>
                                            <td><?php echo $details->dtl_service_type ?></td>
                                            <td><p class="text-right">Rp. <?php echo number_format($details->dtl_amount, 2, ",", ".") ?></p></td>
                                        </tr>
                                        <?php
                                            $no++;
                                            $total_amount = $total_amount + $details->dtl_amount;
                                        ?>
                                    <?php } ?> -->
                                <?php
                                $no = 1;
                                $total_amount = 0;
                                $nota_no = '';
                                $customer_name = '';
                                $service_type = '';
                                $amount = 0;
                                $isPFs = 0;
                                foreach ($detail_payment as $details) {
                                    if (substr($details->dtl_service_type, 0, 3) == 'PFS') {
                                        $nota_no = ($type_data == 'nota') ? $details->nota_no : $details->uper_no;
                                        $customer_name = ($type_data == 'nota') ? $details->nota_cust_name : $details->uper_cust_name;
                                        $service_type = 'PFS';
                                        $amount  = $amount + $details->dtl_amount;
                                        $isPFs++;
                                    }
                                }
                                if ($isPFs > 0) { ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $nota_no; ?></td>
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $service_type ?></td>
                                        <td>
                                            <p class="text-right">Rp. <?php echo number_format($amount, 2, ",", ".") ?></p>
                                        </td>
                                    </tr>
                                    <?php $no++;
                                }

                                foreach ($detail_payment as $details) {
                                    if (substr($details->dtl_service_type, 0, 3) != 'PFS') { ?>
                                        <tr>
                                            <td><?php echo $no ?></td>
                                            <td><?php echo ($type_data == 'nota') ? $details->nota_no : $details->uper_no; ?></td>
                                            <td><?php echo ($type_data == 'nota') ? $details->nota_cust_name : $details->uper_cust_name ?></td>
                                            <td><?php echo $details->dtl_service_type ?></td>
                                            <td><?php echo $details->dtl_qty ?></td>
                                            <td><?php echo $details->dtl_tariff ?></td>
                                            <td>
                                                <p class="text-right">Rp. <?php echo number_format($details->dtl_amount, 2, ",", ".") ?></p>
                                            </td>
                                        </tr>
                                <?php $no++;
                                    }
                                    $total_amount = $total_amount + $details->dtl_amount;
                                }
                                ?>
                                <tr>
                                    <td colspan="6"><strong>Total Pembayaran</strong></td>
                                    <td><strong>
                                            <p class="text-right">Rp. <?php echo number_format($total_amount, 2, ",", ".") ?></p>
                                        </strong></td>
                                    <input type="hidden" value="<?php echo $total_amount ?>" id="payment_amount" name="payment_amount">
                                <tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="main-box">
            <div class="main-box clearfix">
                <header class="main-box-header clearfix <?= $btn ?>">
                    <h2 class="pull-left">Upload Bukti Transfer</h2>
                    <input type="hidden" value="<?php echo ($type_data == 'nota') ? $detail_payment[0]->nota_no : $detail_payment[0]->uper_no; ?>" id="pay_no" name="pay_no">
                    <input type="hidden" value="<?php echo ($type_data == 'nota') ? $detail_payment[0]->nota_req_no : $detail_payment[0]->uper_req_no; ?>" id="pay_req_no" name="pay_req_no">
                    <input type="hidden" value="<?php echo ($type_data == 'nota') ? $detail_payment[0]->nota_cust_id : $detail_payment[0]->uper_cust_id; ?>" id="pay_cust_id" name="pay_cust_id">
                    <input type="hidden" value="<?php echo ($type_data == 'nota') ? $detail_payment[0]->nota_cust_name : $detail_payment[0]->uper_cust_name; ?>" id="pay_cust_name" name="pay_cust_name">
                    <input type="hidden" value="<?php echo ($type_data == 'nota') ? $detail_payment[0]->nota_id : $detail_payment[0]->uper_id; ?>" id="id_hdr" name="id_hdr">
                    <input name="payment_date" id="payment_date" type="hidden" class="form-control" value="<?php echo date('Y-m-d H:i') ?>">
                    <input name="type_data" id="type_data" type="hidden" class="form-control" value="<?php echo $type_data ?>">
                </header>
                <div class="main-box-body clearfix">
                    <div class="form-group col-xs-6 <?= $btn ?>">
                        <label for="exampleTooltip">Nama Bank</label>
                        <input name="pay_sender_bank_code" id="pay_sender_bank_code" type="hidden" class="form-control" placeholder="Nama Bank">
                        <input name="pay_sender_bank_name" id="pay_sender_bank_name" type="text" class="form-control" placeholder="Nama Bank" readonly>
                    </div>
                    <!--  <div class="form-group col-xs-6">
                            <label for="exampleTooltip">Pemilik Rekening</label>
                            <input name="pay_sender_account_name" id="pay_sender_account_name" type="text" class="form-control" placeholder="Pemilik Rekening">
                        </div> -->
                    <input name="pay_sender_account_name" id="pay_sender_account_name" type="hidden" class="form-control" value="null">
                    <div class="form-group col-xs-6 <?= $btn ?>">
                        <label for="exampleTooltip">Payment Amount</label>
                        <input name="pay_amount" id="pay_amount" type="text" class="form-control" placeholder="payment_amount" value="<?php echo $total_amount ?>" readonly>
                    </div>
                    <div class="form-group col-xs-6 <?= $btn ?>">
                        <label for="exampleTooltip">Payment Date</label>
                        <input name="pay_date" id="pay_date" type="text" class="form-control" placeholder="payment_date" value="<?= date('Y-m-d') ?>">
                    </div>
                    <!--  <div class="form-group col-xs-6">
                            <label for="exampleTooltip">No Rek Pengirim</label>
                            <input name="pay_sender_account_no" id="pay_sender_account_no" type="text" class="form-control" placeholder="No Rek Pengirim">
                        </div> -->
                    <input name="pay_sender_account_no" id="pay_sender_account_no" type="hidden" class="form-control" placeholder="No Rek Pengirim" value="null">
                    <div class="form-group col-xs-6 <?= $btn ?>">
                        <label>Upload Bukti Transfer</label>
                        <input type="file" accept=".pdf" class="form-control" name="BUKTI_TRANSFER" id="BUKTI_TRANSFER" doc_name="">
                        <input type="hidden" id="BUKTI_TRANSFER_PATH1" name="BUKTI_TRANSFER_PATH1" value="" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
                        <input type="hidden" id="BUKTI_TRANSFER_BASH1" name="BUKTI_TRANSFER_BASH1" value="" class="form-control" data-toggle="tooltip" data-placement="bottom" maxlength="40">
                    </div>
                    <div class="form-group example-twitter-oss">
                        <input type="button" onclick="save_payment()" value="Confirm" id="confirm" name="confirm" class="btn btn-danger <?= $btn ?>" />
                        <input type="button" onclick="cancel_payment()" id="cancel" name="cancel" class="btn btn-primary" value="Cancel" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('#BUKTI_TRANSFER').change(function(event) {
            var inputf = document.getElementById('BUKTI_TRANSFER').files[0];
            if (inputf != null) {
                var reader = new FileReader();
                reader.readAsArrayBuffer(inputf);
                reader.onloadend = function(oFREvent) {
                    var byteArray = new Uint8Array(oFREvent.target.result);
                    var file = (new Uint8Array(oFREvent.target.result)).subarray(0, 4);
                    var len = byteArray.byteLength;
                    var binary = '';
                    for (var i = 0; i < len; i++) {
                        binary += String.fromCharCode(byteArray[i]);
                    }
                    byteArray = window.btoa(binary);
                    var path = inputf.name;
                    $("#BUKTI_TRANSFER_PATH1").val(path);
                    $("#BUKTI_TRANSFER").attr("doc_name", path);
                    $("#BUKTI_TRANSFER_BASH1").val(byteArray);

                    var code = "";
                    for (var i = 0; i < file.length; i++) {
                        code += file[i].toString(16);
                    }

                    if (code) {
                        switch (code) {
                            case '89504e47':
                                return 'image/png'
                            case '25504446':
                                // alert('application/pdf');
                            case "ffd8ffe0":
                            case "ffd8ffe1":
                            case "ffd8ffe2":
                                return 'image/jpeg'
                            default:
                                alert('File harus PDF');
                                $('#BUKTI_TRANSFER').val('');
                        }
                    }
                }
            }
        });
    });

    function radioBankChange(myRadio) {
        currentValue = myRadio.value;
        var split_bank_radio = currentValue.split('||');
        $('#pay_sender_bank_code').val(split_bank_radio[0]);
        $('#pay_sender_bank_name').val(split_bank_radio[1]);
    }

    function save_payment() {
        var totalamountall = <?php echo $total_amount; ?>;

        if ($('#pay_amount').val() < totalamountall) {
            alert('tidak boleh lebih kecil dari total amount');
            $('#pay_amount').val(totalamountall);
            return false;
        }


        // validasi
        var pay_sender_bank_code = $('#pay_sender_bank_code').val();
        var pay_sender_bank_name = $('#pay_sender_bank_name').val();
        var pay_sender_account_name = $('#pay_sender_account_name').val();
        var pay_sender_account_no = $('#pay_sender_account_no').val();
        var bukti_transfer = $('#BUKTI_TRANSFER').val();

        if (pay_sender_bank_code === "" || pay_sender_bank_name === "" || bukti_transfer === "") {
            Swal.fire({
                icon: 'error',
                title: 'Form harus diisi dengan lengkap !!!',
                showConfirmButton: false,
                timer: 1500
            })
            return false;
        }

        var bank_radio = $("input[name='PAY_BANK_CODE']:checked").val();
        var split_bank_radio = bank_radio.split('||');
        var bank_code = split_bank_radio[0];
        var bank_name = split_bank_radio[1];
        var branch_id = split_bank_radio[2];
        var branch_code = split_bank_radio[3];
        var account_no = split_bank_radio[4];
        var account_name = split_bank_radio[5];
        var bank_id = split_bank_radio[6];

        if ($('#type_data').val() == 'nota') {
            var pay_type = '2';
        } else {
            var pay_type = '1';
        }

        arrData = {
            "action": "storePaymentPLG",
            "service_branch_id": "4",
            "service_branch_code": "PTG",
            "pay_id": "",
            "pay_nota_no": $('#pay_no').val(),
            "pay_req_no": $('#pay_req_no').val(),
            "pay_method": "2",
            "pay_cust_id": $('#pay_cust_id').val(),
            "pay_cust_name": $('#pay_cust_name').val(),
            "pay_bank_code": bank_code,
            "pay_bank_name": bank_name,
            "pay_branch_id": branch_id,
            "pay_account_no": account_no,
            "pay_account_name": account_name,
            "pay_amount": $('#pay_amount').val(),
            "pay_date": $('#pay_date').val(),
            "pay_note": "NOTED",
            "pay_create_by": "<?php echo $this->session->userdata('customerid_phd'); ?>",
            "pay_type": pay_type,
            "pay_file": {
                "PATH": $('#BUKTI_TRANSFER_PATH1').val(),
                "BASE64": $('#BUKTI_TRANSFER_BASH1').val()
            }
        }
        console.log(arrData);
        // return;

        Swal.fire({
            title: "Apakah anda yakin ?",
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
                    url: "<?= ROOT ?>npksbilling/payment_cash/save_payment_cash",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        data: JSON.stringify(arrData)
                    },
                    success: function(data) {
                        console.log(data);
                        var n = data.includes("org.codehaus");
                        if (n === true) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Pembayaran Gagal!',
                                showConfirmButton: false,
                                timer: 1500
                            });
                            // setTimeout(function() {
                            //     window.location = "<?= ROOT ?>npksbilling/proforma";
                            // }, 3000);
                            $.unblockUI();
                        } else {
                            var obj = JSON.parse(data);
                            if (obj.Success === undefined) {
                                if (obj.sendInvPay.Success === true) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: obj.result,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    savepayment_log(obj.no_req);
                                    setTimeout(function() {
                                        window.location = "<?= ROOT ?>npksbilling/proforma";
                                    }, 3000);
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Data Gagal Disimpan!',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                    // setTimeout(function() {
                                    //     window.location = "<?= ROOT ?>npksbilling/proforma";
                                    // }, 3000);
                                }
                            } else if (obj.Success === true) {
                                Swal.fire({
                                    icon: 'success',
                                    title: obj.result,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                savepayment_log(obj.no_req);
                                setTimeout(function() {
                                    window.location = "<?= ROOT ?>npksbilling/proforma";
                                }, 3000);
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Data Gagal Disimpan!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                // setTimeout(function() {
                                //     window.location = "<?= ROOT ?>npksbilling/proforma";
                                // }, 3000);
                            }
                        }
                        $.unblockUI();
                    }
                });
            }
        })

    }

    function savepayment_log(no_req) {

        $.ajax({
            url: "<?= ROOT ?>npksbilling/transaction_log/savepayment_log",
            type: 'POST',
            //dataType: 'json',
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                no_req: no_req

            },
            success: function(data) {
                if (data != null) {
                    console.log('Data Tersimpan ke LOG')
                }

            }
        });
    }

    function cancel_payment() {
        window.history.back();
    }

    $(function() {
        $("#pay_date").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true,
        });
    });
</script>

<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/datepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/daterangepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/jquery.datetimepicker.css" type="text/css" />
<link rel="stylesheet" href="<?= CUBE_ ?>css/libs/select2.css" type="text/css" />