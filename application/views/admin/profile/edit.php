<?php
$this->load->view('admin/header')
?>
<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
        <nav> 
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('myProfile');?>">Profile</a></li>
                <li class="breadcrumb-item active">Edit Profile</li>
            </ol>
        </nav>
      </div>
</div> 
 
<div class="main-sec-contant">
   <div class="ProjectsAdd" >
      <div class="tab-content profile-tab" id="myTabContent">
         <div class="tab-pane fade show active" id="About" role="tabpanel" aria-labelledby="home-tab">
	      	<form action="<?php echo site_url('admin/profile/update/'.$userInfo->user_id);?>" method="post">      
		      <div class="row">
			    <div class="form-group col-md-4">
			    <label>First Name</label>
			     <input type="text" class="form-control" id="Fname" placeholder="Name" name="Fname" value="<?php echo $userInfo->first_name;?>">
           <div class="alert-danger"><?php echo form_error('Fname'); ?></div>
			    </div>
			    <div class="form-group col-md-4">
			     <label>Last Name</label>
            <input type="text" class="form-control" id="Lname" placeholder="Last Name" name="Lname" value="<?php echo $userInfo->last_name;?>">
            <div class="alert-danger"><?php echo form_error('Lname'); ?></div>

			    </div>
			    <div class="form-group col-md-4">
				   <label>Email Id</label>
             <input type="text" class="form-control" id="Email" placeholder="test@aaaa.com.my" name="Email" value="<?php echo $userInfo->email;?>">
              <div class="alert-danger"><?php echo form_error('Email'); ?></div>

			    </div>
			   <div class="form-group col-md-4">
                  <label for="pwd">Mobile Number</label>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">+60</span>
                    </div>
                    <input type="text" class="form-control" placeholder="01234567" name="Mobno" value="<?php echo $userInfo->mobile_no;?>">
                     <div class="alert-danger"><?php echo form_error('Mobno'); ?></div>

                  </div>
                </div>
			   <div class="form-group col-md-4">
                  <label for="pwd">Sub Company Name</label>
                  <select  class="form-control" id="Subcom"  name="Subcom" >
                 <?php 
                    foreach($company_name as $row )
                    {
                     if($row->company_name == $userInfo->company_name){
                      echo '<option value="'.$row->company_name.'" selected=selected >'.$row->company_name.'</option>';
                     }else{
                      echo '<option value="'.$row->company_name.'">'.$row->company_name.'</option>';
                    }
                 }
               ?>
                  </select>
                  <div class="alert-danger"><?php echo form_error('Subcom'); ?></div>

                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Role</label>
                  <select class="form-control" id="sel1" name="role" >
                    <?php 
                    foreach($role_name as $row )
                    {
                     if($row->role_name == $userInfo->role){
                      echo '<option value="'.$row->role_name.'" selected=selected >'.$row->role_name.'</option>';
                     }else{
                      echo '<option value="'.$row->role_name.'">'.$row->role_name.'</option>';
                    }
                 }
               ?>
                  </select>
                  <div class="alert-danger"><?php echo form_error('role'); ?></div>
                </div>
			  <div class="col-md-12">
            <div class="btn-section float-right">
                <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> update</button>
              <a href="<?php echo site_url ('myProfile');?>"><button class="btn btn-danger float-right" id="cancelTasks" type="button" name="cancel"  ><i class="fa fa-plus-circle" aria-hidden="true" href="<?php echo site_url('myProfile');?>"></i> Cancel</button></a>
            </div>			
		</div>
	</div>
  </div>
</div>

<?php $this->load->view('admin/footer')
?>