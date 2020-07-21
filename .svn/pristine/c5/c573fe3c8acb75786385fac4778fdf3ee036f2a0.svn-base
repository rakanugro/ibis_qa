<?php

header("Content-type: application/vnd-ms-excel");

header("Content-Disposition: attachment; filename=force_flagging.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<div class="row" id="gridRequest">
	<div class="col-lg-12">
		<div class="main-box clearfix">


			<div class="main-box-body clearfix">
				<div class="table-responsive">
          <table id="mastertable" class="table table-hover">
				    <thead>
					    <tr>
								<th width='30px'>No</th>
								<th width='100px'>Trx Date</th>
								<th width='100px'>Customer No</th>
								<th width='100px'>Payment Code</th>
								<th width='100px'>Expired Date</th>
								<th width='100px'>Bank</th>
								<th width='100px'>Amount</th>
								<th width='100px'>Merchant Status</th>
					    </tr>
				    </thead>
				   <tbody id=show_data>
             <?php foreach($force_flagging as $data) : ?>
               <tr>
                 <th><?php echo $data['id']; ?> </th>
                 <th><?php echo $data['trx_date']; ?> </th>
                 <th><?php echo $data['customer']; ?> </th>
								 <th><?php echo $data['payment_code']; ?> </th>
								 <th><?php echo $data['expired_date']; ?> </th>
                 <th><?php echo $data['bank_name']; ?> </th>
								 <th><?php echo $data['amount']; ?> </th>
                 <th><?php echo $data['status_merchant']; ?> </th>
             <?php endforeach; ?>
				   </tbody>
			    </table>
				</div>
			</div>
		</div>
	</div>
</div>
