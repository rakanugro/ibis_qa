<script>
$("#checkall").click(function() {
   // $(".checkcontclass").attr('checked', this.checked);
     if(this.checked) {
        // Iterate each checkbox
        $(':checkbox').each(function() {
            this.checked = true;                        
        });
    }
    else {
        $(':checkbox').each(function() {
            this.checked = false;                        
        });
    }
});
    
function create_detail(){
    var id_req  = $("#no_request").val();
    var old_req = $("#old_request").val();
    var no_bl   = $("#no_bl").val();
    var no_do   = $("#no_do").val();
    var tgl_do  = $("#tgl_do").val();
    var sppb_date = $("#sppb_date").val();
    var perpdelivery_date = $("#perpdelivery_date").val();
    var terminal = $("#terminal").val();
    var sppb = $("#no_sppb").val();
    
   var myCheckboxes = new Array();
    $("input:checked").each(function() {
        if($(this).val() != 'on'){
            myCheckboxes.push($(this).val());
        }
    });
    var url = "<?=ROOT?>/container/save_detail_delivery_perp";
    $.post(url,{alldetail:myCheckboxes, ID_REQ:id_req, OLD_REQ:old_req, BLNUMB:no_bl, NODO:no_do, TGLDO:tgl_do,TGLSPPB:sppb_date,
               TGLDELP:perpdelivery_date, TERMINAL:terminal, SPPB:sppb},function(data){
        var row_data = data;
        var explode = row_data.split(',');
        var v_msg = explode[0];
        var v_req = explode[1];
        if (v_msg!='OK')
        {
            alert('Request gagal : '+v_msg);
            return false;
        }
        else {
            alert('Request berhasil : '+v_msg);
            if(v_msg == 'OK'){
                window.open("<?=ROOT?>/container/main_delivery_ext",'_self');
            }
        }
            
    });
    
}
</script>

<div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">
                    <header class="main-box-header clearfix">
                        <h2 class="pull-left">Daftar Kontainer</h2>
                    </header>

                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th><span><input type="checkbox" id="checkall" title="Check all / Uncheck all" data-toggle="tooltip" data-placement="bottom"></span></a></th>
                                        <th><span>No Kontainer</span></a></th>
                                        <th><span>Ukuran</span></a></th>
                                        <th><span>Tipe</span></a></th>
                                        <th><span>Status</span></a></th>
                                        <th><span>Tinggi</span></a></th>
                                        <th><span>Berbahaya</span></a></th>
                                        <th><span>Carrier</span></a></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; foreach($detail as $det) {  ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="check_cont" name="check_cont[]" class="checkcontclass" value="<?=$det['NO_CONTAINER']?>">
                                        </td>
                                        <td>
                                            <a href="#"> <?=$det['NO_CONTAINER']?></a>
                                        </td>
                                        <td>
                                            <?=$det['SIZE_CONT']?>
                                        </td>
                                        <td>
                                            <a href="#"><?=$det['TYPE_CONT']?></a>
                                        </td>
                                        <td>
                                            <a href="#"><?=$det['STATUS_CONT']?></a>
                                        </td>
                                        <td>
                                            <?=$det['HEIGHT_CONT']?>
                                        </td>
                                        <td>
                                            <a href="#"><?=$det['HZ']?></a>
                                        </td>
                                        <td>
                                            <a href="#"><?=$det['CARRIER']?></a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        <button id="btn_create" name="btn_create" class="btn btn-success" onclick="create_detail()">Simpan</button>
        </div>