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
        <div>
          <center>
            <img src="config/cube/img/logo-black.png" alt="" class="normal-logo logo-white">
            <h4><strong>Payment Code</strong></h4>
            <h4><strong><?php echo $proforma_header->paymentCode; ?></strong></h4>
          </center>
        </div>
        <br />
        <div class="col-md-6 col-md-offset-3 col-sm-offset-3">
          <center>
            <table style="width: 100%;">
              <tr>
                <td class="tg-0pky" width="130px" style="padding-left: 10px; text-align: right;">Biller Name</td>
                <td width="100px" class="text-center">:</td>
                <td class="tg-0pky"><?php echo $proforma_header->billerName; ?></td>
              </tr>
              <tr>
                <td class="tg-0pky" width="130px" style="padding-left: 10px; text-align: right;">Expired Date</td>
                <td width="100px" class="text-center">:</td>
                <td class="tg-0pky"><?php echo $proforma_header->expiredDate; ?></td>
              </tr>
              <tr>
                <td class="tg-0pky" width="130px" style="padding-left: 10px; text-align: right;">Customer No</td>
                <td width="100px" class="text-center">:</td>
                <td class="tg-0pky"><?php echo $proforma_header->customerNumber; ?></td>
              </tr>
              <tr>
                <td class="tg-0pky" width="130px" style="padding-left: 10px; text-align: right;">Customer Name</td>
                <td width="100px" class="text-center">:</td>
                <td class="tg-0pky"><?php echo $proforma_header->customerName; ?></td>
              </tr>
            </table>
          </center>

        </div>
        <br />
        <br />
        <br /><br /><br />
        <div class="table-responsive">
          <table class="table table-striped table-hover transaction-list" style="width:100%;">
            <thead>
              <th width='30px'>No</th>
              <th width='100px'>Trx Date</th>
              <th width='100px'>No Faktur</th>
              <th width='100px'>Layanan</th>
              <th width='100px'>Amount</th>
            </thead>
            <tbody>
              <?php foreach ($proforma_detail as $row => $value) : ?>
                <tr>
                  <td><?php echo $value['id']; ?></td>
                  <td><?php echo $value['trx_date']; ?></td>
                  <td><?php echo $value['proforma']; ?></td>
                  <td><?php echo $value['layanan']; ?></td>
                  <td><?php echo 'Rp. '.format_rupiah($value['amount']); ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
            <tfoot id="tfoot_total" class="">
							<tr>
								<td colspan="4" class="text-center"><strong>Total Pembayaran</strong></td>
								<td  colspan="1" id="totalnya"><h2><b><?php echo 'Rp. '.format_rupiah($proforma_header->totalAmount); ?></b></h2></td>
							</tr>
						</tfoot>
          </table>
        </div>

        <br />

        <br /><br /><br /><br /><br />
        <center>
          <button class="btn btn-info" id="btn_checkout" type="button" onclick="codespeedy()">Print</button>
        </center>
      </div>
    </div>
  </div>
</div>
<div id="dialogViewReq"></div>
<div id="billPaymentFormat" style="display:none; width:80mm;">
  <div class="page-thermal">
    <div class="header-thermal">
      <img src="/config/cube/img/logo-black.png" alt="" class="normal-logo logo-white" style="display:block; margin:0;">
    </div>
    <div>
      <h3 style="margin:0;padding:0;">Payment Code</h3>
      <h2 style="margin:0;padding:0;"><?php echo $proforma_header->paymentCode; ?></h2>
    </div>
    <div class="body-thermal">
      <table style="width:80mm; margin-top:15px;">
        <thead>
          <tr>
            <th align="left">Biller Name</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left"><?php echo $proforma_header->billerName; ?></td>
          </tr>
          <tr>
            <th align="left">Customer Name</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left"><?php echo $proforma_header->customerName; ?></td>
          </tr>
          <tr>
            <th align="left">Date</th>
            <th align="left" style="vertical-align:top;">:</th>
            <td align="left"><?php echo date('d-m-Y', strtotime($proforma_header->trxDate)); ?></td>
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
          <?php $total = 0; ?>
          <?php foreach ($proforma_detail as $row) : ?>
            <tr>
              <td align="left"><?php echo $row['proforma']; ?></td>
              <td align="left"><?php echo $row['amount']; ?></td>
            </tr>
            <?php $total += $row['jumlah']; ?>
          <?php endforeach; ?>
          <tr>
            <th align="left">Total</th>
            <th align="left">Rp. <?php echo format_rupiah($total); ?></th>
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
            <?php foreach ($banks as $bank) : ?>
              <tr>
                <td align="left"><?php echo $bank->NAMA_BANK; ?></td>
                <td align="left">:</td>
                <td align="left"><?php echo $bank->PAYMENT_CODE; ?><?php echo $proforma_header->paymentCode; ?></td>
              </tr>
            <?php endforeach; ?>
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
            <td align="left"><?php echo date('d-m-Y', strtotime($proforma_header->expiredDate)); ?> 23:00:00</td>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
  function codespeedy() {
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
</script>
