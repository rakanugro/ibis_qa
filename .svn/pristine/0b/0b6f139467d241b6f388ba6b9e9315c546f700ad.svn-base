<style>
  div.DTTT.btn-group {
    display: none !important;
  }

  .label {
    display: inline-block;
  }
</style>
<script>

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
          <div class="col-md-6 col-md-offset-3">
            <div class="form-group">
              <label>Layanan</label>
              <select class="form-control" id="layanan" name="layanan">
                <?php foreach ($services[0] as $service) : ?>
                  <option value="<?php echo $service; ?>"><?php echo $service; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="form-group">
              <label for="exampleAutocomplete">No Faktur</label>
              <input type="text" class="form-control" id="search_input" name="search_input" value="" placeholder="">
            </div>

            <div class="form-group example-twitter-oss">
              <input type="button" onclick="load_table()" value="Add" id="search_reqs" name="search_reqs" class="btn btn-success" />
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<div class="row" id="gridRequest">
  <div class="col-lg-12">
    <div class="main-box clearfix">
      <header class="main-box-header clearfix">
        <!-- <h2 class="pull-left">Receiving Booking List</h2> -->

        <div id="reportrange" class="pull-right daterange-filter">
          <i class="icon-calendar"></i>
          <span></span> <b class="caret"></b>
        </div>
      </header>
      <div class="main-box-body clearfix">
        <div class="table-responsive">
          <table class="table table-striped table-hover transaction-list" id="mastertable" style="width:100%;">
            <thead>
              <th width='100px'>Tgl Transaksi</th>
              <th width='100px'>No Faktur</th>
              <th width='100px'>Customer</th>
              <th width='100px'>Service</th>
              <th width='100px'>Cabang</th>
              <th width='100px'>Amount</th>
              <th width='100px'>Action</th>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <center>
          <button class="btn btn-info" onclick="submitProforma()" id="btn_checkout" type="button" style="border-radius: 50px; height: 50px; padding: 15px 50px;">Bayar</button>
        </center>
      </div>
    </div>
  </div>
</div>
<div id="dialogViewReq"></div>

<script>
  $(document).ready(function() {
    $('#btn_checkout').hide();
  });

  var counter = 0;
  var cart_checkout = [];
  var unique_proforma = [];
  var table;
  var has_va = 0;

  function load_table() {
    var layanan = $("#layanan").val();
    var search_input = $("#search_input").val();
    var layanan_selected = $("#layanan_selected").val(layanan);
    var proforma_number = $("#proforma_number").val(search_input);
    var url = "<?= ROOT ?>va/transaction/search_by_proforma";

    // $('#mastertable').DataTable({
    //     "pageLength": 10,
    //     "destroy": true,
    //     "dom" : "lfrtip",
    //     "ajax": {
    //     "url": url,
    //     data : function (d) {
    //           d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
    //           d.layanan = layanan;
    //           d.search = search_input;
    //
    //     },
    //     "type": "POST"
    //     },
    //     "columns": [
    //                 { "data": "id" },
    //                 { "data": "proforma" },
    //                 { "data": "customer" },
    //                 { "data": "service" },
    //                 { "data": "cabang" },
    //                 { "data": "amount" }
    //     ],});
    $.ajax({
      url: url,
      type: "post",
      data: {
        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
        layanan: layanan,
        search: search_input
      },
      beforeSend: function() {
        $.blockUI();
      },
      success: function(response) {
        var parseResponse = JSON.parse(response);

        if (parseResponse.length == 0) {
          alert('Maaf, data tidak ditemukan.');
          $.unblockUI();
        }

        data = {
          'amount': parseResponse[0].amount,
          'amount_currency': parseResponse[0].amount_currency,
          'trx_date': parseResponse[0].trx_date,
          'cabang': parseResponse[0].cabang,
          'customer': parseResponse[0].customer,
          'customer_number': parseResponse[0].customer_number,
          'proforma': parseResponse[0].proforma,
          'service': parseResponse[0].service,
          'layanan': layanan,
          'payment_code': parseResponse[0].payment_code
        };

        if (cart_checkout.length == 0) {
          if (parseResponse[0].payment_code != null) {
            has_va = 1;
            alert('Data gagal di tambahkan, proforma sudah ada nomor VA: ' + parseResponse[0].payment_code);
          } else {
            cart_checkout.push(data);
            unique_proforma.push(data.proforma);
            table_redraw();
          }
        } else {
          var result = unique_proforma.indexOf(data.proforma);
          if (result != -1) {
            alert('Gagal, Data duplicate : ' + data.proforma);
          } else {
            if (parseResponse[0].payment_code != null) {
              has_va = 1;
            } else {
              cart_checkout.push(data);
              unique_proforma.push(data.proforma);
              table_redraw();
            }
          }

          if (has_va > 0) {
            alert('Data gagal di tambahkan, proforma sudah ada nomor VA');
          }

          console.log(result);
        }

        console.log(cart_checkout);
      },
      error: function(error) {
        alert(error.responseJSON.message);
      }
    }).done(function() {
      $.unblockUI();
    });
  }


  $("table.transaction-list").on("click", ".ibtnDel", function(event) {
    $(this).closest("tr").remove();
    counter -= 1;
    if (counter == 0) {
      $("#btn_checkout").addClass("hidden");
      $("#tfoot_total").addClass("hidden");
    }

    var total = hitungTotal();
    $("#totalnya").text(total);

  });

  function hitungTotal() {
    var jumlah = $("input[name=amount]").val();
    var total = 0;
    $('input[name^="amount"]').each(function() {
      total = total + parseInt($(this).val());
    });

    return total;
  }

  function hapus(id)
  {
    var r = confirm('Apakah anda yakin akan menghapus?');
    if(r==true) {
      doHapus(id);
    }
  }

  function doHapus(id) {
    remove_index = cart_checkout.map(function(item) {
      return item.proforma;
    }).indexOf(id);

    cart_checkout.splice(remove_index, 1);
    unique_proforma.splice(remove_index, 1);

    table_redraw();

    console.log('proforma di hapus: ' + id);
  }

  function submitProforma() {
    var r = confirm("Apakah anda yakin akan membayar proforma di list?");
    if (r == true) {
      doSubmitProforma();
    } else {

    }
  }

  function doSubmitProforma() {
    var url = "<?= ROOT ?>va/transaction/submit_payment";
    var layanan = $('#layanan').val();
    $.ajax({
      url: url,
      type: "post",
      data: {
        <?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo $this->security->get_csrf_hash(); ?>',
        layanan: layanan,
        data: cart_checkout
      },
      beforeSend: function() {
        $.blockUI();
      },
      success: function(response) {
        $table = $('#mastertable').find('tbody');
        $('#btn_checkout').hide();
        var parseResponse = JSON.parse(response);
        if (parseResponse.status == 'success') {
          $table.find('tr').remove();
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

  function table_redraw() {
    $table = $('#mastertable').find('tbody');

    var render = cart_checkout.map(function(record) {
      if (record.payment_code == null) {
        return `
                  <tr>
                    <td>${record.trx_date}</td>
                    <td>${record.proforma}</td>
                    <td>${record.customer}</td>
                    <td>${record.service}</td>
                    <td>${record.cabang}</td>
                    <td>${record.amount_currency}</td>
                    <td><input type="button" value="Hapus" class="btn btn-default" onclick="hapus('${record.proforma}')"></td>
                  </tr>
                `;
      } else {
        return `
                  <tr>
                    <td>${record.trx_date}</td>
                    <td>${record.proforma}</td>
                    <td>${record.customer}</td>
                    <td>${record.service}</td>
                    <td>${record.cabang}</td>
                    <td>${record.amount_currency}</td>
                    <td>${record.payment_code}</td>
                  </tr>
                `;
      }
    });

    $table.find('tr').remove();
    $table.append(render);

    if (cart_checkout.length != 0) {
      $('#btn_checkout').show();
    } else {
      $('#btn_checkout').hide();
    }
  }
</script>
