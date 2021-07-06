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
                <li class="breadcrumb-item active"><a href="<?php echo site_url ('manager_project_add');?>">Add Projects</a></li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
       <a href="<?php echo site_url ('manager_project_add');?>"><button class="btn btn-outline-primary float-right"  id="addProjects"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Projects</button></a>
        
      </div>
  </div>
  <div class="main-sec-contant">
    <div class="ProjectsDetails">
        <h2 class="heading">Projects Details</h2>
        <div class="row">
            <div class="col-md-12">
                <table id="table_id" class="display">
                    <thead>
                        <tr>
                            <th>Project Name</th>
                            <th>Client Name</th>
                            <th>Company</th>
                            <th>Project Manager</th>
                            <th>Support Staff</th>
                            <!-- <th>Status</th> -->
                            <th>Actions</th>
                        </tr>
                    </thead>
                <tbody>
                    <?php
                    foreach($project as $n)
                    {
                        
                        ?>
                        <tr>
                            <td><?php echo $n->project_name;?></td>
                            <td><?php echo $n->client_name;?></td>
                            <td><?php echo $n->company;?></td>
                            <td><a class="pro-circle"><img class="img-sm" src="<?php echo site_url('assets/image/man.png');?>"  data-toggle="tooltip" data-placement="bottom" title="<?php echo $n->project_manager;?>" data-original-title="Click to deactivate the user"></a>&nbsp&nbsp </td>
                            <td>
                            <?php
                            $support_staff = explode(",",$n->support_staff); 
                            foreach($support_staff as $row){ ?>
                                <a class="pro-circle"><img class="img-sm" src="<?php echo site_url('assets/image/man.png');?>" 
                                 data-toggle="tooltip" data-placement="bottom" title="<?php echo $row;?>" data-original-title="Click to deactivate the user">
                                 </a>&nbsp&nbsp 
                            <?php } ?>
                            </td>
                            <!-- <td><span class="icoact"></span> Active</td> -->
                            <td><a class="edit" href="<?php echo site_url('manager_project_edit/'.$n->id);?>"><i class="fa fa-pencil-square-o" ></i></a>&nbsp&nbsp
                            <a class="delete"  href="<?php echo site_url('manager_project_delete/'.$n->id);?>"  onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </div>
    
  </div>
</div>

<?php
$this->load->view('manager/footer');
?>