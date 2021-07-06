<?php
$this->load->view('users/header')
?>
<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('dashboardd');?>">Home</a></li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
       <a href="<?php echo site_url ('users/profile/edit/');?>"><button class="btn btn-outline-primary float-right"  id=""><i class="fa fa-plus-circle" aria-hidden="true"></i> Edit Profile</button></a>
      </div>
  </div>
   <div class="main-sec-contant">
    <div class="ProjectsDetails">
        <h2 class="heading">Profile</h2>
             <div class="row"> 
               <div class="col-md-3">
                <div class="profile-img">
				<?php if (!empty($userInfo[0]->photo)){ ?>
                   <img id="img-upload" src="<?php echo base_url('uploads/'. $userInfo[0]->photo) ?>">
				<?php } else {?>  
				<img id="img-upload" > 
				<?php } ?>
					  <?php //echo $error;?>
					  <!-- <img src="<?php echo base_url('uploads/');?>" alt=""/>-->
                     <?php echo form_open_multipart('users/profile/do_upload');?>
                     <div class="file btn btn-lg btn-primary">
                         <i class="fa fa-pencil-square-o"></i>
						  <input id="choose_image" type="file" name="filename" />
					</div>
					<button id="SubmitBtn" type="submit" style="display:none">Upload photo</button>
					</form>
                </div>
                <div class="profile-contant text-center">
					<br><br>
					<?php 
						 foreach($userInfo as $n)
						 {
						 ?>

                     <h5> <?php echo $n->first_name;?><?php echo $n->last_name;?></h5>
                      <h6><?php echo $n->role;?></h6>
                       <p class="proile-id">Emp ID : <b><?php echo $n->employee_id;?></b></p>
					   <?php
                        }
                        ?>
                </div>
                <hr style="margin-top: 0;" />
                <div class="profile-work">
                    <!-- <div class="list-inline-buttons">
                        <span class="btn-danger" id="#Projects" ><?php echo $numberOfUserProjects?></span>&nbsp;Projects
                    </div> -->
                    <div class="list-inline-buttons">
                        <span class="btn-primary" id="#Tasks"><?php echo $numberOfUserTasks?></span>&nbsp;Tasks
                    </div>
                    <div class="list-inline-buttons">
                        <span class="btn-success" id="#Incidents"><?php echo $numberOfUserIncidents?></span>&nbsp;Incidents
                    </div>
                    <div class="list-inline-buttons">
                        <span class="btn-warning">0</span>&nbsp;Activities
                    </div>
                 </div>
                </div>
                <div class="col-md-9 profile-head">
                	<ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                           <a class="nav-link active" id="home-tab" data-toggle="tab" href="#About" role="tab" aria-controls="home" aria-selected="true"><i class="fa fa-info-circle"></i>&nbsp;About</a>
                        </li>
                        <li class="nav-item">
                         	<!-- <a class="nav-link" id="profile-tab" data-toggle="tab" href="#Projects" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-product-hunt"></i>&nbsp;Projects</a> -->
                        </li>
                        <li class="nav-item">
                         	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Tasks" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-tasks"></i>&nbsp;Tasks</a>
                        </li>
                        <li class="nav-item">
                         	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#Incidents" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-bug"></i>&nbsp;Incidents</a>
                        </li>
						<li class="nav-item">
                         	<a class="nav-link" id="profile-tab" data-toggle="tab" href="#ChangePass" role="tab" aria-controls="profile" aria-selected="false"><i class="fa fa-bug"></i>&nbsp;Change Password</a>
                        </li>
                     </ul>

                     <div class="tab-content profile-tab" id="myTabContent">
                      <div class="tab-pane fade show active" id="About" role="tabpanel" aria-labelledby="home-tab">
					   <?php 
						 foreach($userInfo as $n)
						 {
						 ?>
							<div class="row">
				               <div class="form-group col-md-6">
				                  <label>First Name</label>
				                  <span class="form-control" readonly><?php echo $n->first_name;?></span>
				                </div>
				                <div class="form-group col-md-6">
				                  <label>Last Name</label>
				                  <span class="form-control" readonly><?php echo $n->last_name;?></span>
				                </div>
				                <div class="form-group col-md-6">
				                  <label>Email Id</label>
				                  <span class="form-control" readonly><?php echo $n->email;?></span>
				                </div>
				                <div class="form-group col-md-6">
				                  <label>Phone</label>
				                  <span class="form-control" readonly><?php echo $n->mobile_no;?></span>
				                </div>
				                <div class="form-group col-md-6">
				                  <label>Sub-Company Name</label>
				                  <span class="form-control" readonly><?php echo $n->company_name;?></span>
				                </div>
				                <div class="form-group col-md-6" >
				                  <label>Role</label>
				                  <span class="form-control" readonly><?php echo $n->role;?></span>
								</div>
						
						    </div>
						<?php
                        }
                        ?>
					 </div>
                        <div class="tab-pane fade" id="Tasks" role="tabpanel" aria-labelledby="profile-tab">
                        	<table id="table_id2" class="display">
			                    <thead>
			                        <tr>
			                            <th>Task ID</th>
			                            <th>Task Name</th>
			                            <th>Start Date</th>
			                            <th>End Date</th>
			                            <!-- <th>Hours</th> -->
			                            <th>Assigned</th>
			                            <th>Priority</th>
			                            <th>Status</th>
			                        </tr>
			                    </thead>
			                    <tbody>
								<?php
                                foreach($task_list as $n)
                                  {
                                    ?>
			                        <tr>
			                           <td><a id="TaskView"><?php echo "aaaa_I".str_pad($n->tasks_id, '3', '0', STR_PAD_LEFT);?></a></td>
			                            <td><?php echo $n->task_name;?></td>
			                            <td><?php echo $n->start_date;?></td>
			                            <td><?php echo $n->end_date;?></td>
			                            <!-- <td><?php echo date('H:m',strtotime($n->estimitate_hours));?></td> -->
			                            <td><a class="pro-circle"><img class="img-sm" src="<?php echo getUserImage($n->first_name);?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $n->first_name;?>" data-original-title="Click to deactivate the user"></a>&nbsp&nbsp</td>
			                            <td><span class="badge badge-danger"><?php echo $n->priority;?></span></td>
			                            <td><?php echo $n->status;?></td>
			                                <!-- <ul class="dropdown-menu-status" style="list-style-type: none;padding-left: 0;">
			                                  <li><a style="padding: 5px 4px 5px 22px!important;" href="#" class="dropdown-item inprogress"><?php echo $n->status;?></a></li>
			                                </ul></td> -->
									</tr>
								  <?php }?>
			                    </tbody>
			                </table>
                        </div>
                        <div class="tab-pane fade" id="Incidents" role="tabpanel" aria-labelledby="profile-tab">
                        	<table id="table_id3" class="display">
			                    <thead>
			                        <tr>
			                            <th>Incidents ID</th>
			                            <th>Incidents Name</th>
			                            <th>Start Date</th>
			                            <th>End Date</th>
			                            <!-- <th>Hours</th> -->
			                            <th>Assigned</th>
			                            <th>Priority</th>
			                            <th>Status</th>
			                        </tr>
			                    </thead>
			                    <tbody>
									<?php
                                    foreach($incident_list as $n) 
                                    {
                                     ?>
			                        <tr>
			                           <td><a id="TaskView"><?php echo "aaaa_I".str_pad($n->incidents_id, '3', '0', STR_PAD_LEFT);?></a></td>
			                            <td><?php echo $n->incident_name;?></td>
			                            <td><?php echo $n->start_date;?></td>
			                            <td><?php echo $n->end_date;?></td>
			                            <!-- <td><?php echo date('H:m',strtotime($n->estimate_hours));?></td> -->
			                            <td><a class="pro-circle"><img class="img-sm" src="<?php echo getUserImage($n->first_name);?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $n->first_name;?>" data-original-title="Click to deactivate the user"></a>&nbsp&nbsp </td>
			                            <td><span class="badge badge-danger"><?php echo $n->priority;?></span></td>
			                            <td><?php echo $n->status;?></td>
			                                <!-- <ul class="dropdown-menu-status" style="list-style-type: none;padding-left: 0;">
			                                  <li><a style="padding: 5px 4px 5px 22px!important;" href="#" class="dropdown-item inprogress"><?php echo $n->status;?></a></li>
			                                </ul></td> -->
									</tr>
								 <?php }?>
			                    </tbody>
			                </table>
						</div>
						

                         <div class="tab-pane fade " id="ChangePass" role="tabpanel" aria-labelledby="profile-tab">
							<div class="row">
							  <form action="<?php echo site_url('front_edit_password');?>" method="post">    
				               <div class="form-group col-md-12">
								  <label>Current Password</label>
								  <input type="password" class="form-control" placeholder="Current Password" name="OldPass" autocomplete="old-password" value="<?php echo set_value('OldPass'); ?>" required >
								   <div class="alert-danger"><?php echo form_error('OldPass'); ?></div>
				                </div>
				                <div class="form-group col-md-12">
								  <label>New Password</label>
								 <input type="password" class="form-control" placeholder="New Password" name="NewPass" autocomplete="new-password" value="<?php echo set_value('NewPass'); ?>" required>
								  <div class="alert-danger"><?php echo form_error('NewPass'); ?></div>
				                </div>
				                <div class="form-group col-md-12">
								  <label>Confirm New Password</label>
								 <input type="password" class="form-control" placeholder="Confirm Password" name="ConfPass" autocomplete="new-password" value="<?php echo set_value('ConfPass'); ?>" required>
								<div class="alert-danger"><?php echo form_error('ConfPass'); ?></div>
								</div>
								 <div class="col-md-12">
                                  <div class="btn-section float-right">
                                     <button class="btn btn-outline-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> update</button>
                                   <a href="<?php echo site_url ('myProfile');?>"><button class="btn btn-danger float-right" id="cancelTasks" type="button" name="cancel"><i class="fa fa-plus-circle" aria-hidden="true" href="<?php echo site_url('myProfile');?>"></i> Cancel</button></a>
                                 </div>			
						 </div>
						 </form>
                    </div>
             </div>
        </div>    
    </div>
   </div>
</div>
<?php
  $this->load->view('users/footer')
 ?> 
<script>

$("#choose_image").change(function(){
	readURL(this);
	$("#SubmitBtn").css('display','block');
});

function readURL(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();
		
		reader.onload = function (e) {
			$('#img-upload').attr('src', e.target.result);
		}
		
		reader.readAsDataURL(input.files[0]);
	}
}
</script>
