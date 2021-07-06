<?php
$this->load->view('manager/header')
?>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8"> 
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('staff');?>">Staff</a></li>
                <li class="breadcrumb-item active">Edit Staff</li>
            </ol>
        </nav>
      </div>
    </div>
    <div class="main-sec-contant">   
<div class="staffAdd">
        <h2 class="heading">Edit Staff</h2>
         <form action="<?php echo site_url('manager_staff_update/'.$staff->id);?>" method="post">
        <div class="row">
          <div class="form-group col-md-4">
                  <label for="pwd">User Name:</label>
                  <input type="text" class="form-control" id="Uname" placeholder="Name" name="Uname" value="<?php echo $staff->username;?>" readOnly>
                </div>

               <div class="form-group col-md-4">
                  <label for="pwd">First Name:</label>
                  <input type="text" class="form-control" id="Fname" placeholder="Name" name="Fname" value="<?php echo $staff->first_name;?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Last Name</label>
                  <input type="text" class="form-control" id="Lname" placeholder="Last Name" name="Lname" value="<?php echo $staff->last_name;?>">
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Mobile Number</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+60</span>
                    </div>
                    <input type="text" class="form-control" placeholder="01234567" name="Mobno" value="<?php echo $staff->mobile_no;?>">
                  </div>
                </div>
                 <div class="form-group col-md-4">
                  <label for="pwd">Email ID</label>
                  <input type="text" class="form-control" id="Email" placeholder="test@aaaa.com.my" name="Email" value="<?php echo $staff->email;?>">
                </div>
                 <div class="form-group col-md-4">
                  <label for="pwd">Employee ID</label>
                  <input type="emial" class="form-control" id="Emp_id" placeholder="ID" name="Emp_id" value="<?php echo $staff->employee_id ; ?>" >
                  <div class="alert-danger"><?php echo form_error('Emp_id'); ?></div>
                </div>
                <div class="form-group col-md-4">
                   <label for="pwd">Status</label>
                 <select  class="form-control" id="Status" placeholder="Status" name="Status" >
                   <option value="1"<?php if ($staff->status == 1) echo " selected";?>>Active</option>
                    <option value="0"<?php if ($staff->status == 0) echo " selected";?>>Deactive</option> 
                 </select>
                 <div class="alert-danger"><?php echo form_error('Status'); ?> </div> 
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Sub Company Name</label>
                  <select  class="form-control" id="Subcom"  name="Subcom" >
                   <?php 
                    foreach($company_name as $row )
                    {
                     if($company_name->company_name == $staff->company_name){
                      echo '<option value="'.$company_name->company_name.'" selected=selected >'.$company_name->company_name.'</option>';
                     }else{
                      echo '<option value="'.$company_name->company_name.'">'.$company_name->company_name.'</option>';
                    }
                   }
                   ?>
                  </select>
                   <div class="alert-danger"><?php echo form_error('Subcom'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Role</label>
                  <select class="form-control" id="role" name="role">
                  <?php 
                    foreach($role_name as $row )
                    {
                     if($row->role_name == $staff->role){
                      echo '<option value="'.$row->role_name.'" selected=selected >'.$row->role_name.'</option>';
                     }else{
                      echo '<option value="'.$row->role_name.'">'.$row->role_name.'</option>';
                        }
                      }
                    ?>
                  </select> 
                  <div class="alert-danger"><?php echo form_error('role'); ?></div>
                </div>
                  <div class="form-group col-md-4"  >
                  <label for="pwd" id="managerLabel">Manager</label>
                  <div class="alert-danger">  <?php echo form_error('manager'); ?></div>
                  <select class="form-control" id="manager" name="manager" value="<?php echo $staff->manager; ?>">
                 </select>
                </div>
           <div class="col-md-12">
             <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Update</button>
                <a href="<?php echo site_url ('manager_staff');?>"><button class="btn btn-danger float-right" id="cancelStaff"type="button" name="cancel" href="<?php echo site_url('manager_staff');?>" > <i class="fa fa-plus-circle" aria-hidden="true"></i> Cancel</button>
            </div> 
        </form>
    </div>
  </div>
 </div>
<?php
$this->load->view('manager/footer')
?>

<script type="text/javascript">
 $(document).ready(function(){
   $('#managerLabel').hide();

   var company_name = "<?php echo $staff->company_name;?>";
   var role ="<?php echo $staff->role;?>";
   //role = $('#role').find('option:selected').attr("name");
    //alert(role);
   if( company_name!= ''&& role != '' && role != 'Manager' && role != 'Admin'&& role != 'Management Office')
    {
      //alert('ok');
         $('#manager').prop('disabled', false);
        var project_manager = "<?php echo $staff->manager; ?>";
       // alert(project_manager);
       $.ajax({
         url:"<?php echo base_url()?>manager_getMangerList",
         //type: "POST",
         method:"POST",
         data: { 'company_name' : company_name, project_manager : project_manager},
         //dataType:'json',
         success: function(data){
           console.log(data);
           //false;
           //$('#manager').html(data.manager);  
           $('#manager').html(JSON.parse(data));
           $('#manager').show();
             $('#managerLabel').show();

         },
         error: function(event){
           console.log(event);
          alert('Error occur...');
         }
       });
    }else {
    //alert('sgsg');
      $('#manager').prop('disabled', true);
      $('#manager').hide();
       $('#managerLabel').hide();

    }
  
 $(' #Subcom, #role').on('change' , function() {
  var company_name = $('#Subcom').val();
  var role = $('#role').val(); 
  //role = $('#role').find('option:selected').attr("name");
    // alert(role);
   if( company_name!= ''&& role != '' && role != 'Manager' && role != 'Admin'&& role != 'Management Office')
    {
     // alert('ok');
      $('#manager').prop('disabled', false);
       
       $.ajax({
         url:"<?php echo base_url()?>manager_getManager",
         type: "POST",
         data: { 'company_name' : company_name},
         dataType:'json',
         success: function(data){
           console.log(data);
           //false;
           $('#manager').html(data.manager);  
           $('#manager').show();
            $('#managerLabel').show();
         },
         error: function(event){
           console.log(event);
          alert('Error occur...');
         }
       });
    }else {
   // alert('sgsg');
      $('#manager').prop('disabled', true);
      $('#manager').hide();
      $('#managerLabel').hide();
    }
  });
 });
</script> 