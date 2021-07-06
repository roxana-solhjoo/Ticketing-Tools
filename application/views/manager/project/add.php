<?php
$this->load->view('manager/header');
?>
<div class="main-sec">
  <div class="row">
    <div class="col-md-8">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_project');?>">Projects</a></li>
                <li class="breadcrumb-item active">Add Projects</li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
       <!-- <button class="btn btn-outline-primary float-right"  id="addProjects"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Projects</button> -->
        <!-- <?php
        if($this->session->flashdata('success'))
        {
          ?>
      <div class="alert alert-success" role="alert">
            <?php
               echo $this->session->flashdata('success');
            ?> 
            </div>
            <?php
            }?> -->
      </div>
  </div>
  <div class="main-sec-contant">
    <div class="ProjectsAdd" id="AddProject" >
        <h2 class="heading">Add Project</h2>
        <?php echo form_open('manager_project_add'); ?>
        <div class="row">
               <div class="form-group col-md-4">
                  <label for="text">Project Name</label>
                  <input type="text" class="form-control" id="Pname" placeholder="Name" name="Pname" value="<?php echo set_value('Pname'); ?>">
                  <div class="alert-danger"><?php echo form_error('Pname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Client Name</label>
                  <input type="text" class="form-control" id="Cname" placeholder="Client Name" name="Cname" value="<?php echo set_value('Cname'); ?>">
                  <div class="alert-danger"><?php echo form_error('Cname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Assign To</label>
                  <select class="form-control" id="company" name="PassignTo" value="<?php echo set_value('PassignTo'); ?>">
                  <div class="alert-danger"><?php echo form_error('PassignTo'); ?></div>
                  <option value="">Select Company</option>
                   <?php 
                         
                    foreach($company_name as $row )
                  {
                      echo '<option value="'.$company_name->company_name.'" '.set_select('Subcom', $company_name->company_name).'>'.$company_name->company_name.'</option>';
                   }
                  ?> 
                    <!-- <?php foreach($company_name as $row ):?>
                    <option value="<?php echo $row->company_name; ?>"><?php echo $row->company_name; ?></option>
                    <?php endforeach;?> -->
                  </select>

                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Manager</label>
                  <select class="form-control" id="manager" name="manager" value="<?php echo set_value('manager'); ?>">
                    <div class="alert-danger"><?php echo form_error('manager'); ?></div>
                    <option value="">Select Manager</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Add Support Staff</label>
                  <select id="addStaffMulti" placeholder="Selecct" multiple="multiple" name="staff[]" value="<?php echo set_value('staff'); ?>">
                  <div class="alert-danger"><?php echo form_error('staff'); ?></div>
                    <option value="">Select Staff</option>
                </select>
                </div> 
           <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary" type="submit" name="create" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</button>
               <a href="<?php echo site_url ('manager_project');?>"> <button class="btn btn-danger float-right" id="cancelProjects" type="button" name="cancel" href="<?php echo site_url('manager_project');?>" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Cancel</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$this->load->view('manager/footer');
?>

<script type="text/javascript">
$(document).ready(function(){
  $('#company').on('change' , function() {
   // var company_name = $(this).val();
     var company_name = "<?php echo $company_name->company_name ;?>";

    if(company_name == '')
    {
      $('#manager').prop('disabled', true);
      $('#addStaffMulti').prop('disabled', true);

    }
    else
    {
       $('#manager' ).prop('disabled', false);
       $('#addStaffMulti').prop('disabled', false);
      console.log(company_name);
       $.ajax({
         url:"<?php echo base_url()?>manager_getManager",
         type: "POST",
         data: { company_name : company_name},
         dataType:'json',
         success: function(data){
          // alert('ok');
           console.log(data);
          // false;
           $('#manager').html(data.manager);
           $('#addStaffMulti').html(data.staffs);
           $('#addStaffMulti').multiselect('rebuild');
         },
         error: function(event){
           console.log(event);
           alert('Error occurdfgfdg...');
         }
       });
    }
  });
});
 </script>

