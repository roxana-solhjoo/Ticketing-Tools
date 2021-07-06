<?php
$this->load->view('admin/header');
?>
<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('admin/dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('tasks');?>">Tasks</a></li>
                <li class="breadcrumb-item active">Tasks View</li>
            </ol>
        </nav>
      </div>
</div>
<div class="TaskView" >
      <h2 class="heading"><?php echo "aaaa_TA".str_pad($tasks->tasks_id, '4', '0', STR_PAD_LEFT);?></h2>
      <form action="<?php echo site_url('get_pdf_task/'.$tasks->id);?>" method="post">  
        <div class="row">
               <div class="form-group col-md-4">
                  <label for="email">Tasks ID</label>
                  <input type="text" class="form-control" id="T_id" placeholder="Name" name="T_id" value="<?php echo "aaaa_TA".str_pad($tasks->tasks_id, '4', '0', STR_PAD_LEFT);?>" readonly>
                </div>
               <div class="form-group col-md-4">
                  <label for="email">Tasks Name</label> 
                  <input type="text" class="form-control" id="Tname" placeholder="Name" name="Tname" value="<?php echo $tasks->task_name;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Company Name</label>
                  <input class="form-control" id="Cname" name="Cname" value="<?php echo $tasks->company_name;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Name</label>
                  <input class="form-control" id="Pname" name="Pname" value="<?php echo $tasks->project_name;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Version</label>
                  <input class="form-control" id="Pversion" name="Pversion" value="<?php echo $tasks->project_version;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Report From</label>
                  <input class="form-control" id="Rform" name="Rform" value="<?php echo $tasks->report_form;?>" readonly >
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Received From</label>
                  <input class="form-control" id="Internal" name="Internal" value="<?php echo $tasks->internal;?>" readonly >
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Assign To</label>
                  <input class="form-control" id="Assignto" name="Assignto" value="<?php echo $tasks->assign_to;?>" readonly>
                </div>
                 <div class="form-group col-md-4">
                  <label for="pwd">Start Date</label>
                  <input type="date" class="form-control" id='Sdate' name='Sdate'  value="<?php echo $tasks->start_date;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">End Date</label>
                  <input type="date" class="form-control" id='Edate' name='Edate' value="<?php echo $tasks->end_date;?>" readonly>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="pwd">Status</label>
                  <input class="form-control" id="Status" name="Status" value="<?php echo $tasks->status;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Priority</label>
                  <input class="form-control" id="Priority" name="Priority" value="<?php echo $tasks->priority;?>" readonly>
                </div>
                <!-- <div class="form-group col-md-4">
                  <label for="email">Estimate Hours</label>
                  <input type="text" class="form-control"  id="Ehours" name="Ehours" value="<?php echo $tasks->estimitate_hours;?>" readonly> 
                </div> -->
                <div class="form-group col-md-4">
                  <label for="email">Description</label>
                  <input type="text" class="form-control" id="Description" placeholder="Name" name="Description" value="<?php echo $tasks->description;?>" readonly>
                </div>
                <div class="col-md-12">
                  <div id="accordion">
                    <?php 
                    foreach($tasks_history as  $row) { ?>
                    <div class="card">
                      <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#test<?php echo $row->id;?>" >
                         <?php echo  $row->task_status;?>
                        </a>
                      </div>
                      <div id="test<?php echo $row->id;?>" class="collapse" data-parent="#accordion">
                        <div class="card-body">
                        <?php echo $row->task_description;?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-md-12">
             <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Print</button>
             </div>
            </div>
         </div>
    </div>
    </form>
  </div>
  </div>
</div>
<?php
$this->load->view('admin/footer');
?>

<script>
$(document).ready(function(){
 $('#Cname').change(function(){
  var company_name = $('#Cname').val();
  if(company_name != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>getProject",
    method:"POST",
    //dataType :'JSON',
    data:{company_name:company_name},
    success:function(data)
    {
     console.log(data);
     $('#Pname').html(JSON.parse(data));
     $('#Assignto').html('<option value="">Select Staff</option>');
    },
    error:function (err){
      console.log(err);
    }
   });
  }
  else
  {
   $('#Pname').html('<option value="">Select Project</option>');
   $('#Assignto').html('<option value="">Select Staff</option>');
  }
 });

 $('#Pname').change(function(){
  var project_name = $('#Pname').val();
  if(project_name != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>getStaff",
     method:"POST",
    data:{project_name:project_name},
    success:function(data)
    {
      console.log(data);
     $('#Assignto').html(data);
      $('#Assignto').html(JSON.parse(data));

    },
    error:function (err){
      console.log(err);
    }

   });
  }
  else
  {
   $('#Assignto').html('<option value="">Select Staff</option>');
  }
 });
});
</script>