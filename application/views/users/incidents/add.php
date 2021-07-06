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
                <li class="breadcrumb-item active">Add Incidents</li>
            </ol> 
        </nav>
      </div>
</div>
       <div class="main-sec-contant">
       <?php
        if($this->session->flashdata('success'))
         {
         ?>
         <div class="alert alert-success" role="alert">
           <button type="button" class="close" data-dismiss="alert" >×</button>
            <?php
               echo $this->session->flashdata('success');
            ?>
          </div>
          <?php
         }?>

         <div class="TasksAdd" >
        <h2 class="heading">Add Incidents</h2>
        <?php echo form_open_multipart('front_incidents_add'); ?>
        <div class="row">
               <div class="form-group col-md-4">
                  <label for="email">Incidents ID</label>
                  <input type="text" class="form-control"  id="T_id" placeholder="Name" name="T_id"value="<?php echo $T_id;?>" readonly >
                </div>
               <div class="form-group col-md-4">
                  <label for="email">Tasks Name</label>
                  <input type="text" class="form-control" id="Tname" placeholder="Name" name="Tname" value="<?php echo set_value('Tname'); ?>">
                  <div class="alert-danger"><?php echo form_error('Tname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Company Name</label>
                  <div class="alert-danger"><?php echo form_error('Cname'); ?></div>
                  <select class="form-control" id="Cname" name="Cname" >
                    <option value="">Select Company </option>
                    <?php 
                        
                foreach($company_name as $row )
                {
                   echo '<option value="'.$row->company_name.'" '.set_select('Cname', $row->company_name).'>'.$row->company_name.'</option>';
                  //echo '<option value="'.$row->company_name.'">'.$row->company_name.'</option>';
                 }
                ?>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Name</label>
                  <div class="alert-danger"><?php echo form_error('Pname'); ?></div>
                  <select class="form-control" id="Pname" name="Pname" value="<?php echo set_value('Pname'); ?>">
                    <option value="">Select Project</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Version</label>
                  <div class="alert-danger"><?php echo form_error('Pversion'); ?></div>
                  <select class="form-control" id="Pversion" name="Pversion" value="<?php echo set_value('Pversion'); ?>">
                    <option>Select Project Version </option>
                    <option>1.0</option>
                    <option>2.0</option>
                    <option>3.0</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Report From</label>
                  <div class="alert-danger"><?php echo form_error('Rform'); ?></div>
                  <select class="form-control" id="Rform" name="Rform" value="<?php echo set_value('Rform'); ?>">
                     <?php 
                    foreach ($clients as $value) { ?>
                        <option value="<?php echo $value->id;?>"><?php echo $value->client_name;?></option>
                    <?php } ?>
                    <!-- <option>Select Report From </option>
                    <option>Cawangan</option>
                    <option>Staff Cawangan</option>
                    <option>AIM HQ</option>
                    <option>Sahabat</option> -->
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Received From</label>
                  <div class="alert-danger"><?php echo form_error('Internal'); ?></div>
                  <select class="form-control" id="Internal" name="Internal" value="<?php echo set_value('Internal'); ?>">
                  <option>Select Internal </option>
                    <option>Client HQ/ HQ Klien</option>
                    <option>Client Staff/ Staf Lapangan Klien</option>
                    <option>Customer/ Pelanggan</option>
                    <option>Internal/ Dalaman</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Assign To</label>
                  <div class="alert-danger"><?php echo form_error('Assignto'); ?></div>
                  <select class="form-control" id="Assignto" name="Assignto" value="<?php echo set_value('Assignto'); ?>">
                   <option value="">Select staff</option>
                  </select>
                </div>
                 <div class="form-group col-md-4">
                  <label for="pwd">Start Date</label>
                  <input type="date" class="form-control" id='Sdate' name='Sdate' min="" value="">
                  <div class="alert-danger"><?php echo form_error('Sdate'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">End Date</label>
                  <input type="date" class="form-control" id='Edate' name='Edate'  value="<?php echo set_value('Edate'); ?>">
                  <div class="alert-danger"><?php echo form_error('Edate'); ?></div>
                </div>
                
                <div class="form-group col-md-4">
                  <label for="pwd">Status</label>
                  <div class="alert-danger"><?php echo form_error('Status'); ?></div>
                  <select class="form-control"  id="Status" name="Status" value="<?php echo set_value('Status'); ?>">
                   <option>Select Status</option>
                    <option>In Progress</option>
                    <option>On Hold</option>
                    <option>Waiting</option>
                    <option>Cancel</option>
                    <option>Completed</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Priority</label>
                  <select class="form-control" id="Priority" name="Priority" value="<?php echo set_value('Priority'); ?>">
                  <div class="alert-danger"><?php echo form_error('Priority'); ?></div>
                  <option>Select Priority </option>
                    <option>Medium</option>
                    <option>Urgent</option>
                    <option>Very High</option>
                    <option>Low</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="email">Description</label>
                  <textarea  class="form-control" rows="3" name="Description" id="Description" placeholder="Describe..."><?php echo set_value('Description'); ?></textarea>
                  <div class="alert-danger"><?php echo form_error('Description'); ?></div>
                </div>
                <div >
                 <input id = "choose_image" type="file" name="filename" size="20" />
               </div> 
           <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</button>
              <a href="<?php echo site_url ('front_incidents');?>"><button class="btn btn-danger float-right" id="cancelTasks" type="button" name="cancel"  ><i class="fa fa-plus-circle" aria-hidden="true" href="<?php echo site_url('front_incidents');?>"></i> Cancel</button></a>
            </div>
        </div>
         </div>
    </form>
    </div>
<?php
$this->load->view('users/footer');
?>

<script>
$(document).ready(function(){

  const options1 = {
    year: 'numeric',
    month: 'numeric',
    day: 'numeric'
  };
  var today = new Date();
  y = today.getFullYear()
  m = today.getMonth() + 1
  m = m < 10 ? '0' + m : m;
  d = today.getDate()
  d = d < 10 ? '0' + d : d;
  sdate = y + '-' + m + '-' + d

  $('#Sdate').prop('min', sdate);

  $('#Sdate').on('change', function() {
    $('#Edate').prop('min', $(this).val());
  });


 $('#Cname').change(function(){
  var company_name = $('#Cname').val();
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

