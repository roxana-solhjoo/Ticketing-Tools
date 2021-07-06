<?php
$this->load->view('manager/header')
?>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('manager_staff');?>">Staff</a></li>
                <li class="breadcrumb-item active"><a href="<?php echo site_url ('manager_staff_add');?>">Add Staff</a></li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
        <a href="<?php echo site_url ('manager_staff_add');?>"><button class="btn btn-outline-primary float-right" id="addStaff"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Staff</button></a>
       
      </div>
  </div>
  <div class="main-sec-contant"> 

    <div class="staffDetails">
        <h2 class="heading">Staff Details</h2>

        <div class="row">
            <div class="col-md-12">
                <table id="table_id" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>User Name</th>
                            <th>Email Id</th>
                            <th>Mobile</th>
                            <th>Role</th>
                            <th>Sub Company</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach($staff as $n)
                    {
                        ?>
                        <tr>
                            <td><?php echo $n->first_name;?></td>
                            <td><?php echo $n->email;?></td>
                            <td><?php echo $n->mobile_no;?></td>
                            <td><?php echo $n->role;?></td>
                            <td><?php echo $n->company_name;?></td>
                            <!-- <td><span class="icoact"></span> <?php echo $n->status;?></td> -->
                            <td><span class="icoact"></span> 
                            <?php 
                                {
                               if($n->status==1){
                                 echo $status = "Active ";
                               } else if($n->status==0){ 
                                 echo $status = "Deactive";
                               }
                                }?>
                            </td> 
                            <td><a class="edit" href="<?php echo site_url('manager_staff_edit/'.$n->id);?>"><i class="fa fa-pencil-square-o"></i></a>&nbsp
                             <a class="delete" href="<?php echo site_url ('manager_staff_delete/'.$n->id);?>" onclick="return confirm('Are you sure want to Delete this Record?')"><i class="fa fa-trash-o"></i></a>&nbsp</td>
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
$this->load->view('manager/footer')
?>
