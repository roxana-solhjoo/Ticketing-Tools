<?php
   $this->load->view('admin/header')
?>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('company');?>">Company</a></li>
                <li class="breadcrumb-item active">Add Company</li>
            </ol>
        </nav>
      </div>
      <div class="col-md-4">
        <!-- <button class="btn btn-outline-primary float-right" id="addCompany"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Company</button> -->
        
        </div>        
      </div>
      <div class="main-sec-contant">
      <div class="companyAdd">
        <h2 class="heading">Add Company</h2>
        <?php echo form_open('company_add'); ?>
         <form  method="post" id="AddCompanyForm">
        <div class="row">
               <div class="form-group col-md-4">
                  <label for="email">Company Name</label>
                  <input type="text" class="form-control" id="Cname" placeholder="Name" name="Cname" value="<?php echo set_value('Cname'); ?>">
                  <div class="alert-danger"><?php echo form_error('Cname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Short Name</label>
                  <input type="text" class="form-control" id="shname" placeholder="Short Name" name="shname" value="<?php echo set_value('shname'); ?>">
                  <div class="alert-danger"><?php echo form_error('shname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Registration No</label>
                  <input type="number" class="form-control" id="regNo" placeholder="01234567" name="regNo" value="<?php echo set_value('regNo'); ?>">
                  <div class="alert-danger"><?php echo form_error('regNo'); ?></div>
                
                  
                </div>
            <div class="col-md-12">
             <div class="btn-section float-right">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-plus-circle" aria-hidden="true" id="Ccreat"></i> Create</button>
                <a href="<?php echo site_url ('company');?>"><button class="btn btn-danger float-right" id="cancelCompany" type="button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Cancel</button></a>
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

