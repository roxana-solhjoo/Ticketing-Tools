<?php
   $this->load->view('management/header')
?>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
          <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo site_url ('management_dashboard');?>">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo site_url ('management_company');?>">Company</a></li>
                <li class="breadcrumb-item active">Edit Company</li>
            </ol>
        </nav>
      </div>
      </div>
      <div class="main-sec-contant">
      <div class="companyAdd">
        <h2 class="heading">Edit Company</h2>
         <form action="<?php echo base_url('management/company/update/'.$company->id);?>" method="post">
         <form  method="post" id="EditCompanyForm">
        <div class="row">
               <div class="form-group col-md-4">
                  <label for="email">Company Name</label>
                  <input type="text" class="form-control" id="Cname" placeholder="Name" name="Cname" value="<?php echo $company->company_name;?>">
                  <div class="alert-danger"><?php echo form_error('Cname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Short Name</label>
                  <input type="text" class="form-control" id="shname" placeholder="Short Name" name="shname" value="<?php echo $company->short_name;?>">
                  <div class="alert-danger"><?php echo form_error('shname'); ?></div>
                </div>
                <div class="form-group col-md-4">
                  <label for="pwd">Registration No</label>
                  <input type="text" class="form-control" id="regNo" placeholder="01234567" name="regNo" value="<?php echo $company->registration_no;?>">
                  <div class="alert-danger"><?php echo form_error('regNo'); ?></div>
                
                  
                </div>
            <div class="col-md-12">
             <div class="btn-section float-right">
                <button class="btn btn-outline-primary" type="submit"><i class="fa fa-plus-circle" aria-hidden="true" id="Ccreat"></i> Update</button>
                <a href="<?php echo site_url ('management_company');?>"><button class="btn btn-danger float-right" id="cancelCompany" type="button" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Cancel</button></a>
             </div>
             </form>
            </div>
          </div>
    </div>
  </div>
</div>
 <?php
$this->load->view('management/footer')
?>
