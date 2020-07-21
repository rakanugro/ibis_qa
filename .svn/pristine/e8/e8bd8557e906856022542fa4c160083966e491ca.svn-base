<style>
  div.DTTT.btn-group {
    display: none !important;
  }

  .label {
    display: inline-block;
  }
</style>
<script>
  $(document).ready(function() {
    //sql injection protection
    $(":input").keyup(function(event) {
      // $(this).val($(this).val().replace(/[@\*\-#=,;:'"()\[\]/\\]/gi, ''));
      $(this).val($(this).val().replace(/[\*\-#=,;:'"()?%~`$^&+{}|<>\[\]/\\]/gi, ''));
    });

  });

  $(document).ready(function() {

    $("#table-request a").on("mouseup", function() {
      $("#table-request a").attr('disabled', 'disabled');
    });
  });

  function clickDialog1(a) {
    $('#dialogViewReq').load("<?= ROOT ?>container/view_request/" + a)
      .dialog({
        modal: false,
        height: 500,
        width: 650,
        title: 'View Content',
        close: function(event, ui) {
          $('a').removeAttr('disabled');
        }
      });
  }

  function clickConfirm(a) {
    var r = confirm("Are you sure to confirm?");
    if (r == true) {
      var url = "<?= ROOT ?>container/confirm_request";
      $.blockUI();
      $.post(url, {
        '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
        REQUEST: a
      }, function(data) {
        $.unblockUI();
        alert(data);
        if (data == "Success")
          location.reload();
      });
    }
    $('a').removeAttr('disabled');
  }
</script>
<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.theme.css" />
<script src="<?= CUBE_ ?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?= CUBE_ ?>js/jquery.dataTables.shortingEuro.js"></script>
<script src="<?= CUBE_ ?>js/jquery.nanoscroller.min.js"></script>
<script src="<?= CUBE_ ?>js/modernizr.custom.js"></script>
<script src="<?= CUBE_ ?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?= CUBE_ ?>js/classie.js"></script>
<script src="<?= CUBE_ ?>js/notificationFx.js"></script>

<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<!-- global scripts -->
<script src="<?= JSQ ?>jquery-ui.min.js"></script>

</div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="main-box">
      <div class="main-box clearfix">
        <header class="main-box-header clearfix">
          <!-- <h2 class="pull-left">Search Request</h2> -->
        </header>
        <div class="main-box-body clearfix">
          <form class="form-inline" action="">
            <div class="form-group">
              <label for="email">Date Filter</label>
              <select class="form-control" id="jenis_date">
                <option value="transaction_date">Transaction Date</option>
                <option value="settle_date">Settle Date</option>
              </select>
            </div>
            <div class="form-group">
              <label for="email">From</label>
              <input type="date" class="form-control" id="from_date"></input>
            </div>
            <div class="form-group">
              <label for="email">To</label>
              <input type="date" class="form-control" id="to_date"></input>
            </div>
            <!-----<div class="col-md-12">
                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
                    	<input type="checkbox" class="custom-control-input" id="customControlInline">
                    	<div class="form-group example-twitter-oss">-->
            <input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success" />
            <button class="btn btn-success" onclick="download()" type="button"><i class="fa fa-file-excel-o"></i></button>
            <!--</div>
                    </div>-->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="gridRequest">
  <div class="col-lg-12">
    <div class="main-box clearfix">
      <header class="main-box-header clearfix">
        <!-- <h2 class="pull-left">Receiving Booking List</h2>-- -->

        <div id="reportrange" class="pull-right daterange-filter">
          <i class="icon-calendar"></i>
          <span></span> <b class="caret"></b>
        </div>
      </header>

      <div class="main-box-body clearfix">
        <div class="table-responsive">
          <table id='newtable' class="table table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Tgl Transaksi</th>
                <th>Kode Bayar</th>
                <th>Nama Cabang</th>
                <th>Bank</th>
                <th>Status Bank</th>
                <th>Status Merchant</th>
                <th>Jumlah</th>
                <th>No Receipt</th>
              </tr>
            </thead>
            <tbody id=show_data>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="dialogViewReq"></div>

<div id="billPaymentFormat" style="display:none; width:80mm;">
  <div class="page-thermal">
    <div class="header-thermal">
      <img src="http://localhost/ibis_qa/config/cube/img/logo-black.png" alt="" class="normal-logo logo-white" style="display:block; margin:0;">
    </div>
    <div>
      <h3 style="margin:0;padding:0;">Payment Code</h3>
      <h2 style="margin:0;padding:0;">0519222292929</h2>
    </div>
    <div class="body-thermal">
      <table style="width:80mm; margin-top:15px;">
        <thead>
          <tr>
            <th align="left">Biller Name</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left">IPC TPK Priok</td>
          </tr>
          <tr>
            <th align="left">Customer Name</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left">PT EMKL</td>
          </tr>
          <tr>
            <th align="left">Date</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left">12 Oct 2019 00:00:00</td>
          </tr>
        </thead>
      </table>
    </div>
    <div class="body-thermal">
      <table style="width:80mm; margin-top:15px;">
        <thead>
          <tr>
            <th align="left">Transaction Number</th>
            <th align="left">Amount</th>
          </tr>
          <tr>
            <td align="left">958061966000010</td>
            <td align="left">Rp. 122.100,00</td>
          </tr>
          <tr>
            <td align="left">958061966000010</td>
            <td align="left">Rp. 122.100,00</td>
          </tr>
          <tr>
            <th align="left">Total</th>
            <th align="left">Rp. 144.200,00</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="body-thermal">
      <table style="width:80mm; margin-top:15px;">
        <thead>
          <tr>
            <th align="left">Bank Channel</th>
          </tr>
          <tr>
            <td align="left">BNI</td>
            <td align="left">123400519222292929</td>
          </tr>
          <tr>
            <td align="left">CIMB Niaga</td>
            <td align="left">108500519222292929</td>
          </tr>
          <tr>
            <td align="left">Mandiri</td>
            <td align="left">189300519222292929</td>
          </tr>
        </thead>
      </table>
    </div>
    <div class="body-thermal">
      <table style="width:80mm; margin-top:15px;">
        <thead>
          <tr>
            <th align="left">Batas Waktu Pembayaran:</th>
          </tr>
          <tr>
            <td align="left">Sabtu, 30-Mar-2019, Pukul 23:00 WIB</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<div id="billTransactionFormat" style="display:none; width:80mm;">
  <div class="page-thermal">
    <div class="header-thermal">
      <center>
        <img src="http://localhost/ibis_qa/config/cube/img/logo-black.png" alt="" class="normal-logo logo-white" style="display:block; margin:0;">
        <center>
    </div>
    <center>
      <h3>Payment Code</h3>
      <h2>0519222292929</h2>
    </center>
    <div class="body-thermal">
      <table style="width:80mm;">
        <thead>
          <tr>
            <th align="left">Payment Code</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left"><?php echo $payment_detail['paycode']; ?></td>
          </tr>
          <tr>
            <th align="left">Biller Name</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left"><?php echo $payment_detail['biller_name']; ?></td>
          </tr>
          <tr>
            <th align="left">Customer Name</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left"><?php echo $payment_detail['customer']; ?></td>
          </tr>
          <tr>
            <th align="left">Payment Status</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left"><?php echo $payment_detail['payment_status']; ?></td>
          </tr>
          <tr>
            <th align="left">Payment Date</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left">29 Oct 2019 12:00:00</td>
          </tr>
          <tr>
            <th align="left">Bank Name</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left">Bank Mandiri</td>
          </tr>
          <tr>
            <th align="left">Channel</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left">H2H</td>
          </tr>
          <tr>
            <th align="left">Refnum</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left">02192929299292</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    load_table();

    var date = new Date();
    var currentDate = date.toISOString().slice(0, 10);
    var currentTime = date.getHours() + ':' + date.getMinutes();

    document.getElementById('from_date').value = currentDate;
    document.getElementById('to_date').value = currentDate;
  });

  function load_table() {
    //alert('test');
    $.blockUI();
    var url = "<?= ROOT ?>va/reconciliation/search_transaction_report";
    var search_input = $("#search_input").val();
    var jenis_date = $("#jenis_date").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var bank = $("#bank").val();
    var limit = $("#pagelimit").val();

    $('#newtable').DataTable({
      "pageLength": 10,
      "destroy": true,
      "dom": "lfrtip",
      "ajax": {
        "url": url,
        data: function(d) {
          d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
          d.layanan = jenis_date;
          d.search = search_input;
          d.to_date = to_date;
          d.from_date = from_date;
          d.bank = bank;

        },
        "type": "POST"
      },
      "columns": [{
          "data": "id"
        },
        {
          "data": "trx_date"
        },
        {
          "data": "payment_code"
        },
        {
          "data": "biller"
        },
        {
          "data": "bank_name"
        },
        {
          "data": "status_bank"
        },
        {
          "data": "status_merchant"
        },
        {
          "data": "amount"
        },
        {
          "data": "jkm_number"
        },
      ],
    });
    //var_dump();
    $.unblockUI();
  }

  function download() {
    var url = "<?= ROOT ?>va/reconciliation/download_reconciliation";
    var search_input = $("#search_input").val();
    var jenis_date = $("#jenis_date").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var limit = $("#pagelimit").val();

    const date1 = new Date(from_date);
    const date2 = new Date(to_date);
    const diffTime = Math.abs(date2 - date1);
    const diffDays = Math.ceil(diffTime);
    console.log(diffDays);


    if (from_date == '' || from_date == NaN) {
      alert('Maaf, silahkan isi tanggal di kolom FROM / format tanggal anda salah');
    }

    if (to_date == '' || to_date == NaN) {
      alert('Maaf, silahkan isi tanggal di kolom TO / format tanggal anda salah');
    }

    console.log(diffDays);
    window.location.href = url + '?jenis_date=' + jenis_date + '&from_date=' + from_date + '&to_date=' + to_date;
  }

  function print_bill() {
    var print_div = document.getElementById("billPaymentFormat");
    print_div.style.visibility = "block";
    var print_area = window.open();
    print_area.document.write(print_div.innerHTML);
    print_area.document.close();
    print_area.focus();
    print_area.print();
    print_area.close();
    // This is the code print a particular div element
  }

  function print_transaction() {
    var print_div = document.getElementById("billTransactionFormat");
    var print_area = window.open();
    print_div.style.visibility = "block";
    print_area.document.write(print_div.innerHTML);
    print_area.document.close();
    print_area.focus();
    print_area.print();
    print_area.close();
    // This is the code print a particular div element
  }
</script>
