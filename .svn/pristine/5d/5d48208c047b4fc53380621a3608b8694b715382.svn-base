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

<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>



<script>
   var current_data = {};

   function reload_graph() {
     var url = "<?=ROOT?>va/reconciliation/get_chart_ajax";
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
         current_data = parseResponse;
         console.log(current_data);
       },
       error: function(error) {
         alert(error.responseJSON.message);
       }
     }).done(function() {
       $.unblockUI();
       draw_graph();
     });
   }

   function draw_graph()
   {
     $('#container1').highcharts({
       title: {
         text: 'Data Transaksi Bulan Desember',
         x: -20 //center
       },
       subtitle: {
         text: 'All Unit',
         x: -20
       },
       xAxis: {
         "type": "category",
         "title": {
           "text": "",
           "style": {
             "fontSize": "12px"
           }
         },
         "labels": {
           "rotation": -45,
           "style": {
             "fontSize": "12px"
           },
           "step": null
         },
         "dateTimeLabelFormats": {
           "second": "%H:%M",
           "minute": "%H:%M",
           "hour": "%H:%M",
           "day": "%e-$b-%y",
           "week": "%e",
           "month": "%e",
           "year": "%e"
         },
         "alternateGridColor": "#FAFAFA",
         "startOnTick": true,
       },
       yAxis: {
         title: {
           text: 'Transaksi (COUNT)'
         },
         plotLines: [{
           value: 0,
           width: 1,
           color: '#808080'
         }]
       },
       tooltip: {
         formatter: function() {
                var s = [];

                $.each(this.points, function(i, point) {
                    s.push('<span style="color:#e84e40;font-weight:bold;">'+ point.series.name +' : '+
                        point.y +'<span>');
                });

                return s.join(' and ');
            },
        shared: true
       },
       legend: {
         layout: 'vertical',
         align: 'right',
         verticalAlign: 'middle',
         borderWidth: 0
       },
       series: current_data
     });
     Highcharts.setOptions({
       lang: {
         decimalPoint: ',',
         thousandsSep: '.'
       }
     });
   }


  //var bni=$bni;
  $(function() {
    reload_graph();
  });
</script>
</div>
</div>
<div class="row">
  <?php foreach($data_dash as $index => $value) : ?>
  <div class="col-lg-4 col-xs-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title" style="border-bottom:0px;"><b><?php echo $index; ?></b></h3>
      </div>
      <div class="panel-body">
        <p><b>NILAI TRANSAKSI : <?php echo 'Rp. '. format_rupiah($value['totalAmount']); ?></b></p>
        <p><b>JUMLAH : <?php echo $value['totalTrx']; ?></b></p>
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div><!-- /.row -->
<!-- Main row -->
<div class="row">
  <!-- Left col -->
  <section class="col-lg-12 connectedSortable">
    <!-- Custom tabs (Charts with tabs)-->
    <div class="nav-tabs-custom">
      <!-- Tabs within a box -->
      <div class="tab-content no-padding">
        <!-- Morris chart - Sales -->
        <div class="chart tab-pane active" id="line-chart" style="position: relative; height: 350px;">
          <div id="container1" style="min-width: 310px; height: 350px; margin: 0 auto"></div>
        </div>

      </div>
    </div><!-- /.nav-tabs-custom -->

    <!-- solid sales graph -->
    <!-- <div class="box box-solid bg-teal-gradient">
      <div class="box-header">
        <i class="fa fa-th"></i>
        <h3 class="box-title">Grafik Transaksi Bulanan</h3>
        <div class="box-tools pull-right">
          <button class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
      </div>
      <div class="box-body border-radius-none">
        <div id="container2" style="min-width: 310px; height: 335px; margin: 0 auto"></div>
      </div><!-- /.box-body


    </div>-->
    <!-- /.box -->


    <div id="dialogViewReq"></div>

    <script>
      $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
          var min = $('#cabang').val();
          var age = data[0];
          if (min == 'All') {
            return true;
          }
          if (min == age) {
            return true;
          }
        }
      );

      $(document).ready(function() {
        var url = "<?= ROOT ?>va/reconciliation/search_dashboard";

        var table = $('#mastertable').DataTable({
          "pageLength": 10,
          "destroy": true,
          "dom": "frtip",
          "ajax": {
            "url": url,
            data: function(d) {
              d.<?php echo $this->security->get_csrf_token_name(); ?> = '<?php echo $this->security->get_csrf_hash(); ?>';
            },
            "type": "POST"
          },
          "columns": [{
              "data": "cabang"
            },
            {
              "data": "settle_date"
            },
            {
              "data": "bank_name"
            },
            {
              "data": "total_amount"
            },
          ],
        });

        $('#cabang').on('change', function() {
          table.draw();
        });
      });
    </script>
