<?php
$this->load->view('manager/header');
?>
<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_tasks');?>">Tasks</a></li>
                <li class="breadcrumb-item active"> <a href="<?php echo site_url ('manager_tasks_add');?>">Add Tasks</a></li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
         <a href="<?php echo site_url ('manager_tasks_add');?>"><button class="btn btn-outline-primary float-right"  id="addTasks"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Tasks</button></a>
         
      </div>
  </div>
  <div class="main-sec-contant">  
    <div class="ProjectsDetails">
        <h2 class="heading">Task Details</h2>
        <div>
          <button type="button" class="btn btn-warning btn-status" id = "OnHold">On Hold <span class="badge badge-light"><?php echo $onHoldTasks?></span></button></a>
          <button type="button" class="btn btn-primary btn-status" id = "Open">Open <span class="badge badge-light"><?php echo $openTasks ?></span></button>
          <button type="button" class="btn btn-success btn-status" id = "InProgress">In Progress <span class="badge badge-light"><?php echo $inProgressTasks  ?></span></button>    
          <button type="button" class="btn btn-danger btn-status" id = "Completed">Completed <span class="badge badge-light"><?php echo $completedTasks?></span></button>  
          <button type="button" class="btn btn-warning btn-status" id = "Total">Total <span class="badge badge-light"><?php echo  $totalTasks?></span></button>

        </div><br>
        <div class="row"> 
            <div class="col-md-12">
                <table id="table_id" class="display">
                    <thead> 
                        <tr>
                            <th>Task ID</th>
                            <th>Task Name</th> 
                            <th>Start Date</th>
                            <th>End Date</th>
                            <!-- <th>Hours</th> -->
                            <th>Assigned</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id = "IncidentDetails">

                    <?php
                    foreach($tasks as $n)
                    { 
 
                        ?> 
                        <tr>
                          <td> <a href="<?php echo site_url ('manager_taskView/' .$n->id);?>"> <?php echo "aaaa_TA".str_pad($n->tasks_id, '4', '0', STR_PAD_LEFT);?></a> </td> 
                            <td><?php echo $n->task_name;?></td>
                            <td><?php echo $n->start_date;?></td>
                            <td><?php echo $n->end_date;?></td>
                            <!-- <td><?php echo date('H:m',strtotime($n->estimitate_hours));?></td> -->
                            <td><a class="pro-circle"><img class="img-sm" src="<?php echo site_url('assets/image/man.png');?>"  data-toggle="tooltip" data-placement="bottom" title="<?php echo $n->first_name;?>" data-original-title="Click to deactivate the user"></a>&nbsp&nbsp </td>
                            <td><span class="badge badge-danger"><?php echo $n->priority;?></span></td>
                            <td><?php echo $n->status;?></td>
                            
                            <td><a class="edit" href="<?php echo site_url('manager_tasks_edit/'.$n->id);?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp 
                            
                            <a class="delete" href="<?php echo site_url ('manager_tasks_delete/'.$n->id);?>"onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a>&nbsp</td>
                        </tr>
                        <?php
                        }
                        ?>

                        </tr> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </form> 
  </div>
  </div>
</div>
<?php 
$this->load->view('manager/footer');
?>
<script>
$(document).ready(function () {
  $('#InProgress').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>manager_InProgressTasks",
      dataType: "json",
     success: function(response) {
       console.log(response);
        $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })

  $('#OnHold').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>manager_OnHoldTasks",
      dataType: "json",
     success: function(response) {
       console.log(response);
       $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })

  $('#Completed').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>manager_CompletedTasks",
      dataType: "json",
     success: function(response) {
       console.log(response);
        $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })


  $('#Open').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>manager_OpenTasks",
      dataType: "json",
     success: function(response) {
       console.log(response);
         $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response); 
       $('#table_id').dataTable();
     }
    });
  })

  $('#Total').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>manager_TotalTasks",
      dataType: "json",
     success: function(response) {
       console.log(response);
        $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })
});
</script>
