<?php
$this->load->view('management/header');
?>
<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('management_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url (' management_settings');?>">Settings</a></li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
        <!-- <button class="btn btn-outline-primary float-right" id="addProjects"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Role</button> -->
 
      </div>
  </div>
  <div class="main-sec-contant">
    <div class="SettingsDetails">
        <!-- <h2 class="heading">Projects Details</h2> -->
        <div class="row">
            <div class="col-md-12">
              <ul class="nav nav-pills" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home">ROLES</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu1">DEPARTMENTS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu2">TEAMS</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#menu3">Email Settings</a>
              </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
              <div id="home" class="tab-pane active"><br>
                <div class="row">
                  <div class="col-md-8">
                      <h3 class="heading-tab">Role Settings</h3>
                  </div>
                  <div class="col-md-4">
                      <button class="btn btn-outline-primary float-right" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#AddRole"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Role</button>
                              
                  </div>
                </div>
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Role Name</th>
                            <th>Role Slug</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($role as $n)
                    {
                        ?>
                        <tr>
                            <td><?php echo $n->role_name;?></td>
                            <td><?php echo $n->role_slug;?></td>
                            <td><?php echo $n->description?></td>
                             <td>
                             <a  class="edit" onclick="GetDetails('<?php echo $n->id;?>');" data-target="#EditeRole" data-backdrop="static" data-keyboard="false" data-toggle="modal" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp&nbsp<a class="delete"  href="<?php echo site_url('management/settings/Delete/'.$n->id);?>"onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a></td>
                             <!-- <button class="btn btn-outline-primary float-right" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#AddRole"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Role</button> -->

                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
              </div>
              <div id="menu1" class="tab-pane fade"><br>
                <div class="row">
                  <div class="col-md-8">
                      <h3 class="heading-tab">Department Settings</h3>
                  </div>
                  <div class="col-md-4">
                      <button class="btn btn-outline-primary float-right" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#AddDepartment"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Department</button>
                  </div>
                </div>
                <table id="table_id2" class="display">
                    <thead>
                        <tr>
                            <th>Department</th>
                            <th>Total Staff</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($department as $n)
                    {
                        ?>
                        <tr>
                            <td><?php echo $n->department;?></td>
                            <td><?php echo $n->total_staff;?></td>
                             <td><a class="edit"  data-target="#EditDepartment"  onclick="GetDepartmentDetails('<?php echo $n->id;?>');" data-backdrop="static" data-keyboard="false"  data-toggle="modal"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>&nbsp&nbsp<a class="delete" href="<?php echo site_url('management/settings/Delete/'.$n->id);?>" onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                          <?php
                           }
                          ?>
                    </tbody>
                </table>
              </div>

              <div id="menu2" class="tab-pane fade"><br>
                 <div class="row">
                  <div class="col-md-8">
                      <h3 class="heading-tab">Team Settings</h3>
                  </div>
                  <div class="col-md-4">
                      <button class="btn btn-outline-primary float-right" data-backdrop="static" data-keyboard="false" data-toggle="modal" data-target="#AddTeam">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Team</button>
                  </div>
                  </div>
                <table id="table_id3" class="display">
                    <thead>
                        <tr>
                            <th>Team Name</th>
                            <th>Member</th>
                            <th>Leader</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($team as $n)
                    {
                        ?>
                        <tr>
                            <td><?php echo $n->team_name;?> </td>
                            <td>
                             <?php
                            $member = explode(",",$n->member); 
                            foreach($member as $row){ ?>
                                <a class="pro-circle"><img class="img-sm" src="<?php echo site_url('assets/image/man.png');?>"  data-toggle="tooltip" data-placement="bottom" title="<?php echo $row;?>" data-original-title="Click to deactivate the user"></a>&nbsp&nbsp 
                            <?php } ?>
                            
                            
                           </td>
                            <td><a class="pro-circle"><img class="img-sm" src="<?php echo site_url('assets/image/man.png');?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo $n->leader;?>" data-original-title="Click to deactivate the user"></a></td>
                             <td><a class="edit" data-target="#EditTeam" onclick="getTeamDetails('<?php echo $n->id;?>');"  data-backdrop="static" data-keyboard="false"  data-toggle="modal"><i class="fa fa-pencil-square-o"></i></a>&nbsp&nbsp<a class="delete" href="<?php echo site_url('admin/settings/Delete/'.$n->id);?>"onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                         <?php
                           }
                          ?>

                    </tbody>
                </table>
              </div>

              <div id="menu3" class="tab-pane fade"><br>
               <div class="row">
                  <div class="col-md-8">
                      <h3 class="heading-tab">Email Settings</h3>
                      
                  </div>
                  <div class="col-md-4">
                    <!-- <button class="btn btn-outline-primary float-right" id="addProjects"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Role</button> -->
                  </div>
                </div>

              <form id="emailSettings" action="<?php echo site_url('management/settings/create');?>" method="post">
                <div class="row">
                    <div class="form-group col-md-4">
                        <label for="pwd">COMPANY EMAIL</label>
                        <input type="email" class="form-control"  placeholder="test@aaaa.com.my" name="Cemail" required >
                    </div>
                      <div class="form-group col-md-4">
                        <label for="pwd">EMAIL PROTOCOL</label>
                        <select class="form-control" id="Eprotocol" name="Eprotocol" required>
                          <option>SMTP</option>
                        </select>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="pwd">SMTP HOST</label>
                        <input type="email" class="form-control" name="Shost"  placeholder="Host" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="pwd">SMTP USER</label>
                        <input type="text" class="form-control" id="regNo" placeholder="test@aaaa.com.my" name="Suser" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="pwd">SMTP PASSWORD</label>
                        <input type="text" class="form-control" name="Spassword"  placeholder="Password" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="pwd">SMTP PORT</label>
                        <input type="text" class="form-control" name="Sport"  placeholder="Port" required>
                      </div>
                      <div class="form-group col-md-4">
                        <label for="pwd">EMAIL ENCRYPTION</label>
                        <select class="form-control" id="sel1" name="Eencription" required>
                          <option>TLS</option>
                          <option>SSL</option>
                        </select>
                      </div>
                      <div class="col-md-12">
                        <div class="btn-section float-right">
                         <button class="btn btn-outline-primary" type="submit" name="create" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Create</button>
                         <a href="<?php echo site_url ('management_setting');?>"><button class="btn btn-danger float-right" id="cancelCompany" type="button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Cancel</button></a>
                       </div>
                     </div>
                  </div>
              </form>
             </div>
              </div>
            </div>
            </div>
        </div>
    </div>
  </div>
</div>


<div class="modal fade" id="AddRole">
  <div class="modal-dialog">
   <form id="AddRoleForm" action="<?php echo site_url('management/settings/addRole');?>" method="post">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Role</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
              <label for="email">Role Name:</label>
              <input type="text" class="form-control" id="Rname" placeholder="Name" name="Rname" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Role Slug</label>
              <input type="text" class="form-control" id="RSlug" placeholder="Role Slug" name="Rslug" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Description</label>
              <input type="text" class="form-control" id="RDec" placeholder="Description" name="RDec" required>
            </div>
        </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary" >Create</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal" >Cancel</button>
      </div>
    </div>
  </form>
  </div>
</div>



<div class="modal fade" id="AddDepartment">
  <div class="modal-dialog">
   <form id='AddDepartmentForm' action="<?php echo site_url('management/settings/addDepartment');?>" method="post">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Department</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
              <label for="email">Department:</label>
              <input type="text" class="form-control" id="Dname" placeholder="Department" name="Department" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Total Staff</label>
              <input type="text" class="form-control" id="Tstaff" placeholder="Total Staff" name="Tstaff" required>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary" data-target='#menu1'>Create</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div>
  </div>
</div>


<div class="modal fade" id="AddTeam">
  <div class="modal-dialog">
    <form  id ='AddTeamForm' action="<?php echo site_url('management/settings/addTeam');?>" method="post">

    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Add Team</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
              <label for="email">Team Name:</label>
              <input type="text" class="form-control" id="Tname" placeholder="Team Name" name="Tname" required>
            </div>
            <!-- <div class="form-group col-md-12">
                  <label for="pwd">Member</label>
                  <select class="form-control" id="Member" placeholder="Selecct" multiple="multiple" name="Member[]" value="<?php echo set_value('Member'); ?>">
                    <option value="">Select Members</option>
                   <option value="">Select Members</option>
                     <option value="">Select Members</option>
                </select>
                </div>  -->
             <div class="form-group col-md-12">
              <label for="pwd">Member</label>
              <input type="text" class="form-control" id="Member" placeholder="Member" name="Member" required>
            </div> 
            <div class="form-group col-md-12">
              <label for="pwd">Leader</label>
              <input type="text" class="form-control" id="Leader" placeholder="Leader" name="Leader" required>
            </div>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary">Create</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div>
  </div>
</div>

<div class="modal fade" id="EditeRole">
  <div class="modal-dialog">
    <form id="EditeRoleForm" action="<?php echo site_url('management/settings/update_role');?>" method="post">
        <input type="hidden" id="EditRow" name="Edit_row" value= "">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Role</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
              <label for="email">Role Name</label>
              <input type="text" class="form-control" id="EditRname" placeholder="Name" name="Rname"  value="<?php //echo $role->role_name;?>" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Role Slug</label>
              <input type="text" class="form-control" id="EditRSlug" placeholder="Role Slug" name="Rslug" value="<?php //echo $role->role_slug;?>" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Description</label>
              <input type="text" class="form-control" id="EditRDec" placeholder="Description" name="RDec" value="<?php //echo $role->description;?>" required>
            </div>
           </div>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div>
  </div>
</div>




<div class="modal fade" id="EditDepartment">
  <div class="modal-dialog">
    <form id="EditDepartmentForm" action="<?php echo site_url('management/settings/update_Department');?>" method="post">
        <input type="hidden" id="DEditRow" name="DEdit_row" value= "">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Department</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
              <label for="email">Department</label>
              <input type="text" class="form-control" id="EditDname" placeholder="Department" name="Dname" value="<?php //echo $role->role_name;?>" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Total Staff</label>
              <input type="text" class="form-control" id="EditTstaff" placeholder="Total Staff" name="Tstaff" value="<?php //echo $role->role_slug;?>" required>
            </div>
           </div>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div>
  </div>
</div>


<div class="modal fade" id="EditTeam">
  <div class="modal-dialog">
    <form id="#EditTeamForm" action="<?php echo site_url('management/settings/update_Team');?>" method="post">
        <input type="hidden" id="TEditRow" name="TEdit_row" value= "">
      <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Team</h4>

        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
              <label for="email">Team Name</label>
              <input type="text" class="form-control" id="EditTname" placeholder="Team Name" name="Tname" value="<?php //echo $role->role_name;?>" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Member</label>
              <input type="text" class="form-control" id="EditMember" placeholder="Member" name="Member" value="<?php //echo $role->role_slug;?>" required>
            </div>
            <div class="form-group col-md-12">
              <label for="pwd">Leader</label>
              <input type="text" class="form-control" id="EditLeader" placeholder="Leader" name="Leader" value="<?php //echo $role->role_slug;?>" required>
            </div>
           </div>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-outline-primary" >Update</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
     </form>
    </div>
  </div>
</div>

<?php
$this->load->view('management/footer');
?>

<script>
function GetDetails(id){
  $.ajax({
    url: "<?php echo site_url('management/settings/edit');?>",
    data:{
      id: id,
    },
    type : 'GET',
    dataType: 'json',
    success : function (data){
      var id = data.id;
      var role_name = data.role_name;
      var description = data.description;
      var role_slug = data.role_slug;
      $('#EditeRole').modal('show');
      $('#EditRow').val(id);
      $('#EditRname').val(role_name);
      $('#EditRDec').val(description);
      $('#EditRSlug').val(role_slug);


    }
  });
}

function GetDepartmentDetails(id){
  $.ajax({
    url: "<?php echo site_url('management/settings/edit_department');?>",
    data:{
      id: id,
    },
    type : 'GET',
    dataType: 'json',
    success : function (data){
      console.log(data);
      var id = data.id;
      var department = data.department;
      var total_staff = data.total_staff;
      $('#EditDepartment').modal('show');
      $('#DEditRow').val(id);
      $('#EditDname').val(department);
      $('#EditTstaff').val(total_staff);
    }
 });
}

function getTeamDetails(id){
  $.ajax({
    url: "<?php echo site_url('management/settings/edit_team');?>",
    data:{
      id: id,
    },
    type : 'GET',
    dataType: 'json',
    success : function (data){
      console.log(data);
      var id = data.id;
      var team_name = data.team_name;
      var leader = data.leader;
      var member = data.member;

      $('#EditTeam').modal('show');
      $('#TEditRow').val(id);
      $('#EditTname').val(team_name);
      $('#EditMember').val(member);
      $('#EditLeader').val(leader);

    }
 });
}
</script>
<script>
$('#AddRoleForm').validate()
$('#AddDepartmentForm').validate()
$('#AddTeamForm').validate()
$('#EditeRoleForm').validate()
$('#EditDepartmentForm').validate()
$('#EditTeamForm').validate()

$().ready(function(){
$('#emailSettings').validate()
// $().ready(function(){
// $('#emailSettings').validate()
//{
//     rules: {
//       Cemail:"required",
//      },
//      Eprotocol: {
//        required: "#Eprotocol:checked"

//      }
//   })
// })
</script>

