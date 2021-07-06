<?php
$this->load->view('management/header');
?>
<div class="main-sec">
  <div class="row"> 
    <div class="col-md-8">
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('management_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('management_project');?>">Projects</a></li>
                <li class="breadcrumb-item active">Edit Projects</li>
            </ol>
        </nav>
      </div>
  </div>
  <div class="main-sec-contant">
    <div class="ProjectsAdd" >
        <h2 class="heading">Edit Project</h2>
        <form action="<?php echo site_url('management/project/update/'.$project->id);?>" method="post">
        <div class="row">
               <div class="form-group col-md-4">
                  <label for="text">Project Name</label>
                  <input type="text" class="form-control" id="Pname" placeholder="Name" name="Pname" value="<?php echo $project->project_name;?>">
                  <div class="alert-danger"><?php echo form_error('Pname'); ?></div>
                </div> 
                <div class="form-group col-md-4">
                  <label for="pwd">Client Name</label>
                  <input type="text" class="form-control" id="Cname" placeholder="Client Name" name="Cname" value="<?php echo $project->client_name;?>"> 
                  <div class="alert-danger"><?php echo form_error('Cname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Assign To</label>
                  <select class="form-control" id="company" name="PassignTo">
                   <?php 
                    foreach($company_name as $row )
                    {
                     if($row->company_name == $project->company){
                      echo '<option value="'.$row->company_name.'" selected=selected >'.$row->company_name.'</option>';
                     }else{
                      echo '<option value="'.$row->company_name.'">'.$row->company_name.'</option>';
                    }
                   }
                   ?>
                  </select>
                    <div class="alert-danger"><?php echo form_error('PassignTo'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Project Manager</label>
                  <select class="form-control" id="manager" name="manager" value="<?php echo $project->project_manager;?>">
                    <div class="alert-danger"><?php echo form_error('manager'); ?></div>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd"> Support Staff</label>
                  <select id="addStaffMulti" placeholder="Selecct" multiple="multiple" name="staff[]" value="<?php echo $project->support_staff;?>">
                  <div class="alert-danger"><?php echo form_error('staff'); ?></div>
                    <!-- <option value=""><?php echo $project->support_staff;?></option> -->
                </select>
                </div>
           <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update</button>
               <a href="<?php echo site_url ('management_project');?>"> <button class="btn btn-danger float-right" id="cancelProjects" type="button" name="cancel"  href="<?php echo site_url('management_project');?>" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Cancel</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
$this->load->view('management/footer');
?>

<script type="text/javascript">
$(document).ready(function(){
  var company_name = "<?php echo $project->company;?>";
  //alert(company_name);
  if(company_name != '')
  {
  var project_manager = "<?php echo $project->project_manager;?>";
   //alert(project_manager);

   $.ajax({
    url:"<?php echo base_url(); ?>management_getMangerList",
    method:"POST",
    //dataType :'JSON',
    data:{company_name:company_name, project_manager : project_manager },
    success:function(data)
    {
     console.log(data);
     //false;
     $('#manager').html(JSON.parse(data));
    // $('#Assignto').html('<option value="">Select Staff</option>');
    },
    error:function (err){
      console.log(err);
    }
   }); 
  }   


  var company_name = "<?php echo $project->company;?>";
  if(company_name != '')
  {
    var support_staff = "<?php echo $project->support_staff;?>";
    //alert(support_staff);
    $.ajax({
    url:"<?php echo base_url(); ?>management_getAllStaffsList",
    method:"POST",
    //dataType :'JSON',
    data:{company_name:company_name,support_staff : support_staff },
    success:function(data)
    {
      // alert (ok);
     console.log(data);
     //false;
     $('#addStaffMulti').html(JSON.parse(data));
     $('#addStaffMulti').multiselect('rebuild');
    // $('#addStaffMulti').html((data.support_staff));
    },
    error:function (err){
      console.log(err);
    }
   });
  }   


  $('#company').on('change' , function() {
    var company_name = $(this).val();
     // alert(project_manager);
    if(company_name == '')
    {
      $('#manager').prop('disabled', true);
      $('#addStaffMulti').prop('disabled', true);
    }
    else
    {
       $('#manager' ).prop('disabled', false);
       $('#addStaffMulti').prop('disabled', false);
       $.ajax({
         url:"<?php echo base_url();?>management_getManager",
         type: "POST",
         data: { 'company_name' : company_name},
         dataType:'json',
         success: function(data){
           //alert('ok');
           console.log(data);
           $('#manager').html(data.manager);
           $('#addStaffMulti').html(data.staffs);
           $('#addStaffMulti').multiselect('rebuild');
         },
         error: function(event){
           console.log(event);
           alert('Error occur...');
         }
       });
    }
  });
});
</script>

