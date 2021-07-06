<?php
$this->load->view('admin/header');
?>
<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('incidents');?>">Incidents</a></li>
                <li class="breadcrumb-item active"><a href="<?php echo site_url ('incidents_add');?>"> Add Incident</li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
         <a href="<?php echo site_url ('incidents_add');?>"><button class="btn btn-outline-primary float-right"  id="addIncidents"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Incidents</button></a>
        
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
                            <td><a href="<?php echo site_url ('incidentsView/' .$n->id);?>"> <?php echo "aaaa_IN".str_pad($n->incidents_id, '4', '0', STR_PAD_LEFT);?></a></td>
                            <td><?php echo $n->incident_name;?></td>
                            <td><?php echo $n->start_date;?></td>
                            <td><?php echo $n->end_date;?></td>
                            <!-- <td><?php echo date('H:m',strtotime($n->estimate_hours));?></td> -->
                            <td><a class="pro-circle"><img class="img-sm" src="<?php echo getUserImage($n->first_name);;?>"  data-toggle="tooltip" data-placement="bottom" title="<?php echo $n->first_name;?>" data-original-title="Click to deactivate the user"></a>&nbsp&nbsp </td>
                            <td><span class="badge badge-danger"><?php echo $n->priority;?></span></td>
                            <td><?php echo $n->status;?></td>
                            <td><a class="edit" href="<?php echo site_url('incidents_edit/'.$n->id);?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp
                             <a class="delete" href="<?php echo site_url ('incidents_delete/'.$n->id);?>"onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a>&nbsp</td>
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
  <!-- <div class="TaskView" style="display: none;">
        <h2 class="heading">aaaa020</h2>
        <form action="<?php echo site_url('incidents/add');?>" method="post">
        <div class="row">
               <div class="form-group col-md-4">
                  <label for="email">Tasks ID</label>
                  <input type="text" class="form-control" id="Tid" placeholder="Name" name="Tid">
                </div>
               <div class="form-group col-md-4">
                  <label for="email">Tasks Name</label>
                  <input type="text" class="form-control" id="Tname" placeholder="Name" name="Tname">
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Company Name</label>
                  <select class="form-control" id="Cname" name="Cname">
                    <option>AIMSSB</option>
                    <option>AIMISB</option>
                    <option>AIMCSB</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Name</label>
                  <select class="form-control" id="Pname" name="Pname">
                    <option>CMCCS</option>
                    <option>TEST</option>
                    <option>TEST</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Version</label>
                  <select class="form-control" id="Pversion" name="Pversion">
                    <option>1.0</option>
                    <option>2.0</option>
                    <option>3.0</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Assign To</label>
                  <select class="form-control" id="Assignto" name="Assignto">
                    <option>Mani</option>
                    <option>Test</option>
                    <option>123456</option>
                  </select>
                </div>
                 <div class="form-group col-md-4">
                  <label for="pwd">Start Date</label>
                  <input type="date" class="form-control" id='Sdate' name='Sdate'>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">End Date</label>
                  <input type="date" class="form-control" id='Edate' name='Edate'>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="pwd">Status</label>
                  <select class="form-control" id="Status" name="Status">
                    <option>In Progress</option>
                    <option>On Hold</option>
                    <option>Waiting</option>
                    <option>Cancel</option>
                    <option>Completed</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Priority</label>
                  <select class="form-control" id="Priority" name="Priority">
                    <option>Urgent</option>
                    <option>Very High</option>
                    <option>Medium</option>
                    <option>Low</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Estimate Hours</label>
                  <input type="text" class="form-control"  id="Ehours" name="Ehours"> 
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Description</label>
                  <input type="text" class="form-control" id="Description" placeholder="Name" name="Description">
                </div>
                <div class="col-md-12">
                  <div id="accordion">
                    <div class="card">
                      <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#collapseOne">
                          In Progress
                        </a>
                      </div>
                      <div id="collapseOne" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                        On Hold
                      </a>
                      </div>
                      <div id="collapseTwo" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                      </div>
                    </div>
                    <div class="card">
                      <div class="card-header">
                        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
                          Completed
                        </a>
                      </div>
                      <div id="collapseThree" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
           <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</button>
                <button class="btn btn-danger float-right" id="cancelProjects"><i class="fa fa-plus-circle" aria-hidden="true"></i> Cancel</button>
            </div>
        </div>
         </div>
    </div>
    </form>
  </div> -->
  </div>
</div>
<?php
$this->load->view('admin/footer');
?>

<script>
$(document).ready(function () {
  $('#InProgress').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>InProgressIncidents",
      //data:$('#IncidentDetails').serialize(),
      dataType: "json",
     success: function(response) {
       // console.log(response);
         $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })

  $('#OnHold').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>OnHoldIncidents",
      dataType: "json",
     success: function(response) {
       // console.log(response);
       $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })

  $('#Completed').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>CompletedIncidents",
      dataType: "json",
     success: function(response) {
       // console.log(response);
       $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })


  $('#Open').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>OpenIncidents",
      dataType: "json",
     success: function(response) {
       // console.log(response);
       $('#table_id').dataTable().fnDestroy();
       $('#IncidentDetails').html(response);
       $('#table_id').dataTable();
     }
    });
  })

  $('#Total').click(function(){
    $.ajax({
      method: "post",
      url:"<?php echo base_url(); ?>TotalIncidents",
      dataType: "json",
     success: function(response) {
       // console.log(response);
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


