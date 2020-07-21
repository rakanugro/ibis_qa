
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Daftar Kapal</h4>
      </div>
      <div class="modal-body">

        <div class="table-responsive clearfix">
          <?php
            $tmpl = array (
                      'table_open'          => '<table id="table_bank" class="table table-hover">',
                      'heading_row_start'   => '<tr class=\'clickableRow\'>'
                    );

            $this->table->set_template($tmpl);
            echo $this->table->generate();
          ?>
        </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
