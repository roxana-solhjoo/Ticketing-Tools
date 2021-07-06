<?php
$this->load->view('manager/header');
?>
<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_incidents');?>">Incidents</a></li>
                <li class="breadcrumb-item active"><a href="<?php echo site_url ('manager_incidents_add');?>"> Add Incident</li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
         <a href="<?php echo site_url ('manager_incidents_add');?>"><button class="btn btn-outline-primary float-right"  id="addIncidents"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Incidents</button></a>
        
      </div>
  </div>
  <div class="main-sec-contant">
    <div class="ProjectsDetails">
        <h2 class="heading" >Incident Details</h2>
        <div>
          <button type="button" class="btn btn-warning btn-status" id = "OnHold">On Hold <span class="badge badge-light"><?php echo $onHoldIncidentsNumber?></span></button>
          <button type="button" class="btn btn-primary btn-status" id = "Open" >Open <span class="badge badge-light"><?php echo $openIncidents?></span></button>
          <button type="button" class="btn btn-success btn-status" id= "InProgress">In Progress <span class="badge badge-light"><?php echo $inProgressIncidents ?></span></button>    
          <button type="button" class="btn btn-danger btn-status"id = "Completed">Completed <span class="badge badge-light"><?php echo $completedIncidents?></span></button>  
          <button type="button" class="btn btn-warning btn-status" id = "Total">Total <span class="badge badge-light"><?php echo $totalIncidents ?></span></button>
        </div><br>
        <div class="row">
            <div class="col-md-12">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Incident ID</th>
                            <th>Incident Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <!-- <th>Hours</th> -->
                            <th>Assigned</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id = "IncidentDetails" >
                    <?php
                     foreach($incidents as $n)
                     {
                        ?>
                        <tr >
                            <td><a href="<?php echo site_url ('manager_incidentsView/' .$n->id);?>"> <?php echo "aaaa_IN".str_pad($n->incidents_id, '4', '0', STR_PAD_LEFT);?></a></td>
                            <td><?php echo $n->incident_name;?></td>
                            <td><?php echo $n->start_date;?></td>
                            <td><?php echo $n->end_date;?></td>
                            <!-- <td><?php echo date('H:m',strtotime($n->estimate_hours));?></td> -->
                            <td><a class="pro-circle"><img class="img-sm" src="<?php echo site_url('assets/image/man.png');?>"  data-toggle="tooltip" data-placement="bottom" title="<?php echo $n->first_name;?>" data-original-title="Click to deactivate the user"></a>&nbsp&nbsp </td>
                            <td><span class="badge badge-danger"><?php echo $n->priority;?></span></td>
                            <td><?php echo $n->status;?></td>
                            <td><a class="edit" href="<?php echo site_url('manager_incidents_edit/'.$n->id);?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp
                             <a class="delete" href="<?php echo site_url ('manager_incidents_delete/'.$n->id);?>"onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a>&nbsp</td>
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
      url:"<?php echo base_url(); ?>manager_InProgressIncidents",
      //data:$('#IncidentDetails').serialize(),
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
      url:"<?php echo base_url(); ?>manager_OnHoldIncidents",
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
      url:"<?php echo base_url(); ?>manager_CompletedIncidents",
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
      url:"<?php echo base_url(); ?>manager_OpenIncidents",
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
      url:"<?php echo base_url(); ?>manager_TotalIncidents",
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

var Type = '<?php echo $Type;?>';
setTimeout(function(){
  if(Type != ""){
    $('#'+Type).click();
  }
},2000)
</script>


