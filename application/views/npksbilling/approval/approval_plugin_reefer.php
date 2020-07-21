<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.min.css" />
<link rel="stylesheet" type="text/css" href="<?= JSQ ?>jquery-ui.theme.css" />
<script src="<?= CUBE_ ?>js/jquery.dataTables.shortingCustom.js"></script>
<script src="<?= CUBE_ ?>js/jquery.dataTables.shortingEuro.js"></script>
<script src="<?= CUBE_ ?>js/jquery.nanoscroller.min.js"></script>
<script src="<?= CUBE_ ?>js/modernizr.custom.js"></script>
<script src="<?= CUBE_ ?>js/snap.svg-min.js"></script> <!-- For Corner Expand and Loading circle effect only -->
<script src="<?= CUBE_ ?>js/classie.js"></script>
<script src="<?= CUBE_ ?>js/notificationFx.js"></script>
<script src="<?= JSQ ?>jquery-ui.min.js"></script>

<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-default.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-growl.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-bar.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-attached.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-other.css" />
<link rel="stylesheet" type="text/css" href="<?= CUBE_ ?>css/libs/ns-style-theme.css" />
<!-- global scripts -->
<style>
    div.DTTT.btn-group {
        display: none !important;
    }

    .label {
        display: inline-block;
    }

    a.disabled {
        pointer-events: none;
        cursor: default;
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="main-box clearfix">
            <header class="main-box-header clearfix">
                <h2 class="pull-left">List - Approval Plugin Reefer</h2>
            </header>

            <div class="main-box-body clearfix">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="example1">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NOMOR REQUEST</th>
                                <th>TANGGAL REQUEST</th>
                                <th>CARGO OWNER</th>
                                <th>VESSEL</th>
                                <th>STATUS</th>
                                <th>ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $.blockUI();
        var table = $("#example1 tbody");

        $.ajax({
            type: "GET",
            url: "<?= ROOT ?>npksbilling/appbookplug/getList?",
            data: {},
            success: function(data) {
                var obj = JSON.parse(JSON.parse(data));
                var no = 1;
                obj.result.forEach(function(plug) {
                    table.append(
                        '<tr>' +
                        '<td>' + no++ + '</td>' +
                        '<td>' + plug.plug_no + '</td>' +
                        '<td>' + plug.plug_date + '</td>' +
                        '<td>' + plug.plug_cust_name + '</td>' +
                        '<td>' + plug.plug_vessel_name + '</td>' +
                        '<td style="font-weight:bold;"> ' + plug.reff_name + '</td>' +
                        //'<td>'+ mark +'</td>' +
                        '<td>' +
                        '<a class="btn btn-primary" href="<?= ROOT ?>npksbilling/appbookplug/preview/' + plug.plug_id + '" title="Preview"><span class="glyphicon glyphicon-list-alt"></span></a>' + "&nbsp" + "&nbsp" +
                        '</td>' +
                        '</tr>'
                    );

                });

                $("#example1").DataTable();
                $.unblockUI();
            }
        });
    });
</script>