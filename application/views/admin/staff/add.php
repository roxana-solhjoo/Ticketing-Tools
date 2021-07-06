<?php
$this->load->view('admin/header')
?>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('staff');?>">Staff</a></li>
                <li class="breadcrumb-item active">Add Staff</li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
        <!-- <button class="btn btn-outline-primary float-right" id="addStaff"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Staff</button> -->
       
      </div>
  </div>
  <div class="main-sec-contant">
    <div class="staffAdd">
        <h2 class="heading">Add Staff</h2>
           <?php echo form_open('staff_add'); ?>
        <div class="row">
          <div class="form-group col-md-4">
                  <label for="email">User Name</label>
                  <input type="text" class="form-control" id="Uname" placeholder="Name" name="Uname" value="<?php echo set_value('Uname'); ?>">
                  <div class="alert-danger"><?php echo form_error('Uname'); ?></div>
                </div>
                
               <div class="form-group col-md-4">
                  <label for="email">First Name</label>
                  <input type="text" class="form-control" id="Fname" placeholder="Name" name="Fname" value="<?php echo set_value('Fname'); ?>">
                  <div class="alert-danger"><?php echo form_error('Fname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Last Name</label>
                  <input type="text" class="form-control" id="Lname" placeholder="Last Name" name="Lname" value="<?php echo set_value('Lname'); ?>">
                  <div class="alert-danger"><?php echo form_error('Lname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Mobile Number</label>
                  <div class="input-group mb-3" >
                    <div class="input-group-prepend">
                      <span class="input-group-text">+60</span>
                    </div>
                    <input type="text" class="form-control" placeholder="01234567" name="Mobno" value="<?php echo set_value('Mobno'); ?>">
                    <div class="alert-danger"><?php echo form_error('Mobno'); ?></div>
                  </div>
                  
                </div>
                 <div class="form-group col-md-4">
                  <label for="pwd">Email ID</label>
                  <input type="emial" class="form-control" id="Email" placeholder="test@aaaa.com.my" name="Email" value="<?php echo set_value('Email'); ?>" >
                  <div class="alert-danger"><?php echo form_error('Email'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Employee ID</label>
                  <input type="text" class="form-control" id="Emp_id" placeholder="ID" name="Emp_id" value="<?php echo set_value('Emp_id'); ?>" >
                  <div class="alert-danger"><?php echo form_error('Emp_id'); ?></div>
                </div>
                <div class="form-group col-md-4">
                   <label for="pwd">Status</label>
                   <select  class="form-control" id="Status" placeholder="Status" name="Status" >   
                    <option value="">Select Status</option>
                    <option value="1" >Active</option>
                    <option value="0" >Deactive</option>
                  </select>
                  <div class="alert-danger"><?php echo form_error('Status'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Sub Company Name</label>
                   <div class="alert-danger"><?php echo form_error('Subcom'); ?></div>
                  <select  class="form-control" id="Subcom"  name="Subcom[]" multiple>
                  <!-- <option value="">Select Sub Company</option> -->
                  <?php 
                        
                   foreach($company_name as $row )
                   {
                      echo '<option value="'.$row->id.'" '.set_select('Subcom', $row->company_name).'>'.$row->company_name.'</option>';
                   }
                  ?> 
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Role</label>
                  <div class="alert-danger"> <?php echo form_error('role'); ?></div> 
                  <select class="form-control" id="role" name="role" placeholder="Select Role">
                   <option value="">Select Role</option></div>
                     <?php  
                        
                       foreach($role_name as $row )
                      {
                      echo '<option name="'.$row->role_name.'" value="'.$row->role_name.'" '.set_select('role', $row->role_name).'>'.$row->role_name.'</option>';
                      }
                     ?>
                  </select>
                </div>
                <!-- <div class="form-group col-md-4" >
                  <label  for="pwd" id="managerLabel" >Manager</label>
                  <select class="form-control" id="manager" name="manager"  placeholder="Select Manager" style="display:none"  disabled>
                 <option value="">Select Manager</option>
                 </select>
                 <div class="alert-danger">  <?php echo form_error('manager'); ?></div>
                </div> -->
           <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary" type="submit" name="create" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</button>
              <a href="<?php echo site_url ('staff');?>"><button class="btn btn-danger float-right" id="cancelStaff" type="button" name="cancel"  ><i class="fa fa-plus-circle" aria-hidden="true" href="<?php echo site_url('staff');?>"></i> Cancel</button></a>
            </div>
            </form>
        </div>
     </div>
    </div>
  </div>
 </div>
<?php
$this->load->view('admin/footer')
?>


<script type="text/javascript">
 $(document).ready(function(){
  $('#Subcom').multiselect();
  $('#managerLabel').hide();
  
  $(' #Subcom, #role').on('change' , function() {
  var company_name = $('#Subcom').val();
  var role = $('#role').val(); 
  //role = $('#role').find('option:selected').attr("name");
    // alert(role);

   if( company_name!= ''&& role != '' && role != 'Management Office' && role != 'Manager' && role != 'Admin')
    {
        //  $('label[for="managerlabel"]').css('display', 'none');

      $('#manager').prop('disabled', false);
       
       $.ajax({
         url:"<?php echo base_url()?>getManager",
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
          // alert('Error occur...');
         }
       });
    }else {
    //alert('sgsg');
      $('#manager').prop('disabled', true);
      $('#manager').hide();
       $('#managerLabel').hide();
    }
  });
 });
</script> 
 
 



 

 
