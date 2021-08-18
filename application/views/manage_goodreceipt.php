<?= $header_start ?>

<!-- Add aditional CSS script & Files -->
<link rel="stylesheet" href="<?= $COMP_DIR ?>datatables-bs/css/dataTables.bootstrap.min.css">

<!-- End css script -->

<?= $header_end ?>

<?= $menu ?>

  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <div class="col-sm-6 p-0"><h2 class="box-title">Manage <?= $heading ?></h2></div>
              <div class="col-sm-6 text-right">
                <?php if(checkModulePermission(11,2)){ ?>
                  <a href="<?= $main_page ?>/addedit" class="btn btn-primary"><?= $heading ?></a>
                <?php } ?>
                
                <?php if(checkModulePermission(11,4)){ ?>
                 <a href="javascript:;" class="btn btn-danger" onclick="return deleterecord();">Delete</a>
                <?php } ?>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="col-sm-6 col-sm-offset-2"><?= getFlashMsg('success_message'); ?></div>
                <div class="clearfix"></div>
                
              <?= form_open('', 'class="tableForm form-horizontal" id="tableForm"'); ?>
              <input type="hidden" name="bulk_action" value="1">
              <div class="table-responsive">
              <table id="mytable" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <?php if(checkModulePermission(11,4)){ ?>
                  <th  class="nosort width-20 p-r-0"><input type="checkbox" id="checkAll"> </th>
                  <?php } ?>
					<th>Receipt Date</th>
					<th>Goodreceipt No.</th>
					<th>Against Shipments ID</th>
					<th>Total CS Pack</th>
					<th>Previous Received</th>
					<th>Quantity Pending</th>
					<th>Quantity Received</th>
					<th>Status</th>
                </tr>
                </thead>
                <tbody>
                <?php

                if($resultList){
                  foreach ($resultList as  $value) {
                    $ID=$value->ID;
                    $status_val=$value->status;
                    if($status_val==1){
                      $status=singleAction('deactive','',$ID);                       
                    }else{
                      $status=singleAction('active','',$ID);                     
                    }
                    
                    $delete=singleAction('delete','',$ID); 
                    ?> 
                    <tr <?php if(checkModulePermission(11,2) && $value->gr_status!=1){ ?> class='clickable-row' data-href="<?= $main_page ?>/edit/<?= md5($ID) ?>" <?php }else{?>class='clickable-row' data-href="<?= $main_page ?>/view/<?= md5($ID) ?>" <?php }?>style="cursor: pointer;" >
                      
					  <?php if(checkModulePermission(11,4)){ ?>
                        <td><input type="checkbox" class="checkboxitem" value="<?= $ID ?>" name="item_ids[]"> </td>
                        <?php } ?>
						<td><?= dateFormate($value->receipt_date,"m/d/Y") ?></td>
                        <td><?= $value->goodreceipt_invoiceid ?></td>
						<td><?=$value->shipment_id;?></td>
						<td><?= $value->total_currentstock_val ?></td>
						<td><?= $value->total_received_val ?></td>
						<td><?= $value->total_pending_val ?></td>
                        <td><?= $value->total_receipted_val ?></td>
                        <td  width="150px;"><?= ($value->gr_status==1)?"Approved":"In Transit/Unapproved"; ?></td>
                       </tr>
 </a>
  <?php } ?>                  
                    <?php }?>
                
                
                
                
                </tbody>
               
              </table>
              </div>
              <?= form_close() ?>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?= $footer_start ?>
<!-- Add aditional js script & files -->
<script src="<?= $COMP_DIR ?>datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= $COMP_DIR ?>datatables-bs/js/dataTables.bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        $('#mytable').DataTable({
            "dom": 'l<"toolbar">frtip',
            "lengthMenu": [[50, -1], [50, "All"]]
        });
    });
  

$('.clickable-row').each(function () {
    $(this).children('td:not(:first)').click(function () {
        window.location = $(this).closest('tr').data('href');
        return false;
    });
});

</script>
<style> #mytable_filter{margin-top: -32px;}</style>

<!-- End js script -->
<?= $footer_end ?>