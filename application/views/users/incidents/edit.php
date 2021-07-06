<?php
$this->load->view('users/header');
?>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('dashboardd');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('front_incidents');?>">Incidents</a></li>
                <li class="breadcrumb-item active">Edit Incidents</li>
            </ol>
        </nav>
      </div> 
  </div>
      <div class="main-sec-contant">
        <div class="TasksAdd" > 
        <h2 class="heading">Edit Incident</h2>
        <?php echo form_open_multipart('users/incidents/update/'.$incidents->id);?>
          <div class="row">
               <div class="form-group col-md-4">
                  <label for="email">Incidents ID</label>
                  <input type="text" class="form-control"  id="T_id" placeholder="Name" name="T_id" value="<?php echo $incidents->incidents_id;?>" readOnly>
                </div>
               <div class="form-group col-md-4">
                  <label for="email">Incidents Name</label>
                  <input type="text" class="form-control" id="Tname" placeholder="Name" name="Tname" value="<?php echo $incidents->incident_name;?>">
                  <div class="alert-danger"><?php echo form_error('Tname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Company Name</label>
                  <select class="form-control" id="Cname" name="Cname" >
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
                  <select class="form-control" id="Pname" name="Pname" value="<?php echo $incidents->project_name;?>">
                  </select>
                  <div class="alert-danger"><?php echo form_error('Pname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Version</label>
                  <select class="form-control" id="Pversion" name="Pversion" >
                   <?php 
                    for($i=1; $i<=3; $i++){
                          if($i == $incidents->project_version){
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
                      // $i = array('Cawangan', 'Staff Cawangan', 'AIM HQ','Sahabat');
                      // foreach($i as $i) 
                      // { 
                      //     $selected = ($i == $incidents->report_form) ? ' selected="selected"' : '';
                      //     echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                      // }
                      foreach ($clients as $value) { ?>
                        <option value="<?php echo $value->id;?>" <?php if($value->id == $incidents->report_form){ echo "selected='selected'";  } ?>><?php echo $value->client_name;?></option>
                      <?php }  ?>
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
                          $selected = ($i == $incidents->internal) ? ' selected="selected"' : '';
                          echo '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
                      }
                   ?>
                  </select>
                  <div class="alert-danger"><?php echo form_error('Internal'); ?></div>
                </div> 
                <div class="form-group col-md-4">
                  <label for="pwd">Assign To</label>
                  <div class="alert-danger"><?php echo form_error('Assignto'); ?></div>
                  <select class="form-control" id="Assignto" name="Assignto" >
                  </select>
                </div>
                 <div class="form-group col-md-4">
                  <label for="pwd">Start Date</label>
                  <input type="date" class="form-control" id='Sdate' name='Sdate'  min="<?php echo date('Y-m-d'); ?>"  value="<?php echo $incidents->start_date;?>">
                  <div class="alert-danger"><?php echo form_error('Sdate'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">End Date</label>
                  <input type="date" class="form-control" id='Edate' name='Edate' value="<?php echo $incidents->end_date;?>">
                  <div class="alert-danger"><?php echo form_error('Edate'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Status</label>
                  <select class="form-control"  id="Status" name="Status" >
                  <?php
                      $i = array('In Progress', 'On Hold', 'Waiting','Cancel','Completed'); 
                      foreach($i as $i)
                      {
                          $selected = ($i == $incidents->status) ? ' selected="selected"' : '';
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
                
                <div class="form-group col-md-4">
                  <label for="email">Description</label>
                  <textarea class="form-control" rows="3" id="Description" name="Description" placeholder="Describe..."></textarea>
                  <div class="alert-danger"><?php echo form_error('Description'); ?></div>
                </div>
                 <div class="form-group col-md-4">
                 <div >
                 <input id = "choose_image" type="file" name="filename" size="20" />
               </div> 
               </div>
               <?php if(!empty($incidents->file)){ ?>
                <div class="form-group col-md-4">
                  <a href="<?=base_url('users/incidents/downloadFile/' .$incidents->incidents_id)?>">Download file </a>
                </div>
              <?php } ?>
                
           <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> update</button>
              <a href="<?php echo site_url ('front_incidents');?>"><button class="btn btn-danger float-right" id="cancelTasks" type="button" name="cancel"  ><i class="fa fa-plus-circle" aria-hidden="true" href="<?php echo site_url('front_incidents');?>"></i> Cancel</button></a>
            </div>
        </div>
         </div>
      </form>
   </div>
   </div>
   <div class="col-md-12">
                <div id="accordion">
                  <?php 
                    foreach($incidents_history as  $row) { ?>
                    <div class="card">
                      <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#test<?php echo $row->id;?>">
                         <?php echo  $row->incident_status;?>
                        </a>
                      </div>
                      <div id="test<?php echo $row->id;?>" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                        <?php echo $row->incident_description;?>                   
                        </div>
                      </div> 
                    </div> 
                  <?php } ?> 
                 
                </div>
     </div>
<?php
$this->load->view('users/footer');
?>

<script>
  $(document).ready(function(){

     var today = new Date();
    var sdate = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+(today.getDate() < 10 ? '0'+today.getDate() : today.getDate());
    $('#Sdate').prop('min', sdate);

    $('#Sdate').on('change', function(){
    $('#Edate').prop('min', $(this).val() );
  });


  //var company_name = "<?php echo $incidents->company_name;?>";
  var company_name = $('#Cname').val();
  if(company_name != '')
  {
    var project_name = "<?php echo $incidents->project_name;?>";
   $.ajax({
    url:"<?php echo base_url(); ?>front_getProjectList",
    method:"POST",
    //dataType :'JSON',
    data:{company_name:company_name,project_name : project_name },
    success:function(data)
    {
     console.log(data);
    //  false;
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
  //alert(project_name);
  if(company_name != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>front_getProject",
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



 var project_name = "<?php echo $incidents->project_name;?>";
  if(project_name != '')
  {
    var support_staff = "<?php echo $incidents->assign_to;?>";
   $.ajax({
    url:"<?php echo base_url(); ?>front_getstaffsList",
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
  if(project_name != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>front_getStaff",
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


