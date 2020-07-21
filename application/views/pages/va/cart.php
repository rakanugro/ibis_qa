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

      </div>
    </div>
  </div>
</div>
<div class="row" id="gridRequest">
  <div class="col-lg-12">
    <div class="main-box clearfix">
      <header class="main-box-header clearfix">
        <!-- <h2 class="pull-left">Receiving Booking List</h2> -->
      </header>

      <div class="main-box-body clearfix">
        <div class="table-responsive">
          <table id="mastertable" class="table table-hover">
            <thead>
              <tr>
                <th>Tgl Transaksi</th>
                <th>Layanan</th>
                <th>No Proforma</th>
                <th>Nama Pelanggan</th>
                <th>Cabang</th>
                <th>Jumlah Tagihan</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id=show_data>
            </tbody>
          </table>
          <div>
            <center>
              <button class="btn btn-success" onclick="checkout()" id="btn_cart" type="submit">Bayar</button>
            </center>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="dialogViewReq"></div>

<script>
  $(document).ready(function() {
    load_table();
  });

  function load_table() {
    //alert('test');
    $.blockUI();
    var layanan = $("#layanan").val();
    var search = $("#search_input").val();
    var url = "<?= ROOT ?>va/transaction/search_by_cart";
    $('#mastertable').DataTable({
      "pageLength": 25,
      "destroy": true,
      "dom": "lfrtip",
      "ajax": {
        "url": url,
        data: function(d) {
          d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
        },
        "type": "POST"
      },
      "columns": [{
          "data": "trx_date"
        },
        {
          "data": "service"
        },
        {
          "data": "proforma"
        },
        {
          "data": "customer_name"
        },
        {
          "data": "cabang"
        },
        {
          "data": "amount_format"
        },
        {
          "data": "action"
        }
      ],
    });
    $.unblockUI();
  }

  function checkout() {
    var msg = confirm("Apakah anda yakin akan membayar proforma di keranjang ?");
    if (msg == true) {
      checkoutCart();
    } else {

    }
  }

  function checkoutCart() {
    var url = "<?= ROOT ?>va/transaction/checkout_cart";
    $.ajax({
      url: url,
      type: "post",
      data: {
        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>'
      },
      beforeSend: function() {
        $.blockUI();
      },
      success: function(response) {
        var parseResponse = JSON.parse(response);
        if (parseResponse.status == 'success') {
          alert('Sukses, Data sudah tercheckout : ' + parseResponse.total);
          window.location.replace(parseResponse.url);
        } else {
          cart_checkout = [];
          unique_proforma = [];
          alert(parseResponse.msg);
        }
      },
      error: function(error) {
        alert(error.responseJSON.message);
      }
    }).done(function() {
      $.unblockUI();
    });
  }

  function deleteCart(id) {
    var r = confirm("Apakah anda yakin akan menghapus proforma ini?");
    if (r == true) {
      doSubmitProforma(id);
    }
  }

  function doSubmitProforma(id) {
    var url = "<?= ROOT ?>va/transaction/delete_cart";
    $.ajax({
      url: url,
      type: "post",
      data: {
        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
        data: id
      },
      success: function(response) {
        alert('Proforma berhasil terhapus');
        load_table();
      },
      error: function(error) {
        alert('Gagal, data gagal ditambahkan ke keranjang');
      }
    });
  }
</script>
