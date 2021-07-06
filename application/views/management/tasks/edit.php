<?php
$this->load->view('management/header');
?>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8"> 
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('management_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('management_tasks');?>">Tasks</a></li>
                <li class="breadcrumb-item active">Edit Tasks</li>
            </ol>
        </nav> 
      </div> 
</div>
    <div class="main-sec-contant">  
      <div class="TasksAdd" >
        <h2 class="heading">Edit Tasks</h2>
        <?php echo form_open_multipart('management/tasks/update/'.$tasks->id);?>     
          <div class="row">
               <div class="form-group col-md-4">
                  <label for="email">Tasks ID</label>
                  <input type="text" class="form-control"  id="T_id" placeholder="Name" name="T_id" value="<?php echo $tasks->tasks_id;?>" readOnly>
                </div>
               <div class="form-group col-md-4">
                  <label for="email">Tasks Name</label>
                  <input type="text" class="form-control" id="Tname" placeholder="Name" name="Tname" value="<?php echo $tasks->task_name;?>">
                  <div class="alert-danger"><?php echo form_error('Tname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Company Name</label>
                  <select class="form-control" id="Cname" name="Cname">
                   <?php 
                    foreach($company_name as $row ) 
                    {
                     if($row->company_name == $tasks->company_name){
                      echo '<option value="'.$row->company_name.'" selected=selected >'.$row->company_name.'</option>';
                     }else{
                      echo '<option value="'.$row->company_name.'">'.$row->company_name.'</option>';
                    }
                 }
               ?> 
                  </select>
                  <div class="alert-danger"><?php echo form_error('Cname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Name</label>
                  <select class="form-control" id="Pname" name="Pname">
                  </select>
                  <div class="alert-danger"><?php echo form_error('Pname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Version</label>
                  <select class="form-control" id="Pversion" name="Pversion" >
                    <?php 
                    for($i=1; $i<=3; $i++){
                          if($i == $tasks->project_version){
                            echo '<option value="'.$i.'" selected=selected >'.$i.'</option>';
                          }else{
                            echo '<option value="'.$i.'">'.$i.'</option>';
                          }
                        }
                        ?> 
                  </select>
                  <div class="alert-danger"><?php echo form_error('Pversion'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Report From</label>
                   <select class="form-control"  id="Rform" name="Rform" >
                   <?php
                      $i = array('Cawangan', 'Staff Cawangan', 'AIM HQ','Sahabat');
                      foreach($i as $i) 
                      { 
                          $selected = ($i == $tasks->report_form) ? ' selected="selected"' : '';
                          echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                      }
                   ?>
                  </select>
                  <div class="alert-danger"><?php echo form_error('Rform'); ?></div>
                </div> 

                <div class="form-group col-md-4">
                  <label for="pwd">Received From</label>
                   <select class="form-control"  id="Internal" name="Internal" >
                   <?php
                      $i = array('Client HQ/ HQ Klien', 'Client Staff/ Staf Lapangan Klien', 'Customer/ Pelanggan','Internal/ Dalaman');
                      foreach($i as $i) 
                      { 
                          $selected = ($i == $tasks->internal) ? ' selected="selected"' : '';
                          echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                      }
                   ?>
                  </select>
                  <div class="alert-danger"><?php echo form_error('Internal'); ?></div>
                  </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Assign To</label>
                  <select class="form-control" id="Assignto" name="Assignto">
                  </select>
                   <div class="alert-danger"><?php echo form_error('Assignto'); ?></div>
                </div>

                 <div class="form-group col-md-4">
                  <label for="pwd">Start Date</label>
                  <input type="date" class="form-control" id='Sdate' name='Sdate'   min="<?php echo date('Y-m-d'); ?>"  value="<?php echo $tasks->start_date;?>">
                  <div class="alert-danger"><?php echo form_error('Sdate'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">End Date</label>
                  <input type="date" class="form-control" id='Edate' name='Edate' value="<?php echo $tasks->end_date;?>">
                  <div class="alert-danger"><?php echo form_error('Edate'); ?></div>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="pwd">Status</label>
                  <select class="form-control"  id="Status" name="Status" >                   
                      <?php
                      $i = array('In Progress', 'On Hold', 'Waiting','Cancel','Completed');
                      foreach($i as $i)
                      {
                          $selected = ($i == $tasks->status) ? ' selected="selected"' : '';
                          echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                      }
                   ?> 
                  </select>
                  <div class="alert-danger"><?php echo form_error('Status'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Priority</label>
                  <select class="form-control" id="Priority" name="Priority" >
                     <?php
                      $i = array('Urgent', 'Very High', 'Medium','Low');
                      foreach($i as $i)
                      { 
                          $selected = ($i == $tasks->priority) ? ' selected="selected"' : '';
                          echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                      }
                   ?> 
                  </select>
                  <div class="alert-danger"><?php echo form_error('Priority'); ?></div>
                </div>
                <!-- <div class="form-group col-md-4">
                  <label for="email">Estimate Hours</label>
                  <input type="text" class="form-control" id="Ehours" name="Ehours" value="<?php echo date('H:m',strtotime($tasks->estimitate_hours));?>">
                  <div class="alert-danger"><?php echo form_error('Ehours'); ?></div>
                </div> -->
                <div class="form-group col-md-4">
                  <label for="email">Description</label>
                  <textarea  class="form-control" rows="3" name="Description" id="Description" placeholder="Describe..." ></textarea>
                  <div class="alert-danger"><?php echo form_error('Description'); ?></div>
                </div>

                <div class="form-group col-md-4">
                 <div >
                 <input id = "choose_image" type="file" name="filename" size="20" />
               </div> 
               </div>

                <div class="form-group col-md-4">
                  <a href="<?=base_url('management/tasks/downloadFile/' .$tasks->tasks_id)?>">Download file </a>
                </div>
           <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> update</button>
              <a href="<?php echo site_url ('management_tasks');?>"><button class="btn btn-danger float-right" id="cancelTasks" type="button" name="cancel"  ><i class="fa fa-plus-circle" aria-hidden="true" href="<?php echo site_url('management_tasks');?>"></i> Cancel</button></a>
            </div>
        </div>
         </div>
     </form>
   </div>
   <div class="col-md-12">
      <div id="accordion">
        <?php 
           foreach($tasks_history as  $row) { ?>
          <div class="card">
            <div class="card-header">
              <a class="card-link" data-toggle="collapse" href="#test<?php echo $row->id;?>">
               <?php echo  $row->task_status;?>
              </a>
            </div>
            <div id="test<?php echo $row->id;?>" class="collapse show" data-parent="#accordion">
              <div class="card-body">
              <?php echo $row->task_description;?>                   
              </div>
            </div> 
          </div> 
        <?php } ?> 
       </div>
     </div>


<?php
$this->load->view('management/footer');
?>
<script>
  $(document).ready(function(){

    var today = new Date();
    var sdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+(today.getDate() < 10 ? '0'+today.getDate() : today.getDate());
    $('#Sdate').prop('min', sdate);

    $('#Sdate').on('change', function(){
    $('#Edate').prop('min', $(this).val() );
  });


  //var company_name = $('#Cname').val();
  var company_name = "<?php echo $tasks->company_name;?>";
  if(company_name != '')
  {
    var project_name = "<?php echo $tasks->project_name;?>";
   $.ajax({
    url:"<?php echo base_url(); ?>management_getProjectList",
    method:"POST",
    //dataType :'JSON',
    data:{company_name:company_name,project_name : project_name },
    success:function(data)
    {
     console.log(data);
     $('#Pname').html(JSON.parse(data));
     //$('#Assignto').html('<option value="">Select Staff</option>');
    },
    error:function (err){
      console.log(err);
    }
   });
  }   
  

 $('#Cname').change(function(){
  var company_name = $('#Cname').val();
  if(company_name != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>management_getProject",
    method:"POST",
    //dataType :'JSON',
    data:{company_name:company_name},
    success:function(data)
    {
     console.log(data);
     $('#Pname').html(JSON.parse(data));
    // $('#Assignto').html('<option value="">Select Staff</option>');
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






 var project_name = "<?php echo $tasks->project_name;?>";
  if(project_name != '')
  {
    var support_staff = "<?php echo $tasks->assign_to;?>";
   $.ajax({
    url:"<?php echo base_url(); ?>management_getstaffsList",
    method:"POST",
    //dataType :'JSON',
    data:{project_name:project_name,support_staff : support_staff },
    success:function(data)
    {
      // alert (ok);
     console.log(data);
     $('#Assignto').html(JSON.parse(data));
     //$('#Assignto').html('<option value="">Select Staff</option>');
    },
    error:function (err){
      console.log(err);
    }
   });
  }   
 



 $('#Pname').change(function(){
  var project_name = $('#Pname').val();
  //alert(support_staff);
  if(project_name != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>management_getStaff",
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

  