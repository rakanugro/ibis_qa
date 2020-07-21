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
              <label for="email">From</label>
              <input type="date" class="form-control" id="from_date"></input>
            </div>
            <div class="form-group">
              <label for="email">To</label>
              <input type="date" class="form-control" id="to_date"></input>
            </div>
            <!-- <div class="col-md-12">
                    	<label class="my-1 mr-2" for="inlineFormCustomSelectPref">Preference</label>
                    	<input type="checkbox" class="custom-control-input" id="customControlInline">
                    	<div class="form-group example-twitter-oss"> -->
            <input type="button" onclick="load_table()" value="Search" id="search_reqs" name="search_reqs" class="btn btn-success" />
            <button class="btn btn-success" onclick="download()" type="button"><i class="fa fa-file-excel-o"></i></button>
            <!-- </div>
                    </div> -->
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="gridRequest">
  <div class="col-lg-12">
    <div class="main-box clearfix">
      <div class="main-box-body clearfix">
        <div class="table-responsive">
          <table id="mastertable" class="table table-hover">
            <thead>
              <tr>
                <th>Trx Date</th>
                <th>Total Trx</th>
                <th>Total Amount</th>
                <th>Bank Mandiri</th>
                <th>Bank BRI</th>
                <th>Bank BNI</th>
                <th>Receipt</th>
                <th>Receipt Null</th>
                <th>Action</th>
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

<div id="thermalFormat" style="display:none; width:80mm;">
  <div class="page-thermal">
    <div class="header-thermal">
      <img src="http://localhost/ibis_qa/config/cube/img/logo-black.png" alt="" class="normal-logo logo-white" style="display:block;">
    </div>
    <div class="body-thermal">
      <table style="width:80mm;">

      </table>
    </div>
  </div>
</div>

<script>
  function load_table() {
    //alert('test');
    $.blockUI();
    var url = "<?= ROOT ?>va/transaction/search_transaction";
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var limit = $("#pagelimit").val();

    $('#mastertable').DataTable({
      "pageLength": 10,
      "destroy": true,
      "dom": "lfrtip",
      "ajax": {
        "url": url,
        data: function(d) {
          d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
          d.layanan = jenis_date;
          d.search = search_input;

        },
        "type": "POST"
      },
      "columns": [
        {
          "data": "trx_date"
        },
        {
          "data": "total_trx"
        },
        {
          "data": "jumlah"
        },
        {
          "data": "bni_qty"
        },
        {
          "data": "bni_amount"
        },
        {
          "data": "bri_qty"
        },
        {
          "data": "bri_amount"
        },
        {
          "data": "mandiri_qty"
        },
        {
          "data": "mandiri_amount"
        },
        {
          "data": "receipt"
        }
        {
          "data": "receipt_null"
        }
      ],
    });
    $.unblockUI();
  }

  function download() {
    var url = "<?= ROOT ?>va/transaction/download_transaction";
    var search_input = $("#search_input").val();
    var jenis_date = $("#jenis_date").val();
    var from_date = $("#from_date").val();
    var to_date = $("#to_date").val();
    var limit = $("#pagelimit").val();

    window.location.href = url + '?jenis_date=' + jenis_date + '&from_date=' + from_date + '&to_date=' + to_date;
  }

  function print_bill() {
    var print_div = document.getElementById("thermalFormat");
    print_div.style.visibility = "block";
    var print_area = window.open();
    print_area.document.write(print_div.innerHTML);
    print_area.document.close();
    print_area.focus();
    print_area.print();
    print_area.close();
    // This is the code print a particular div element
  }
</script>
