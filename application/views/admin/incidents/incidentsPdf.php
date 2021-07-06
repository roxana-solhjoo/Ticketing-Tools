<head>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<style type="text/css">
*,::after,::before{box-sizing:border-box;}
nav{display:block;}
body{margin:0;font-family: 'Open Sans', sans-serif;font-size:1rem;font-weight:400;line-height:1.5;color:#212529;text-align:left;background-color:#fff;}
h2{margin-top:0;margin-bottom:.5rem;}
ol,ul{margin-top:0;margin-bottom:1rem;}
a{color:#007bff;text-decoration:none;background-color:transparent;}
a:hover{color:#0056b3;text-decoration:underline;}
img{vertical-align:middle;border-style:none;}
label{display:inline-block;margin-bottom:.5rem;}
button{border-radius:0;}
button:focus{outline:1px dotted;outline:5px auto -webkit-focus-ring-color;}
button,input{margin:0;font-family: 'Open Sans', sans-serif;font-size:inherit;line-height:inherit;}
button,input{overflow:visible;}
button{text-transform:none;}
[type=button],button{-webkit-appearance:button;}
[type=button]::-moz-focus-inner,button::-moz-focus-inner{padding:0;border-style:none;}
h2{margin-bottom:.5rem;font-weight:500;line-height:1.2;}
h2{font-size:2rem;}
.container-fluid{width:100%;padding-right:15px;padding-left:15px;margin-right:auto;margin-left:auto;}
.row{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;margin-right:-100px;margin-left:px;}
.col-md-12,.col-md-4,.col-md-8{position:relative;width:100%;padding-right:15px;padding-left:15px;}
@media (min-width:1px){
.col-md-4{-ms-flex:0 0 33.333333%;flex:0 0 33.333333%;max-width:33.333333%;}
.col-md-8{-ms-flex:0 0 66.666667%;flex:0 0 66.666667%;max-width:66.666667%;}
.col-md-12{-ms-flex:0 0 100%;flex:0 0 100%;max-width:100%;}
}
.form-control{display:block;width:100%;height:calc(8em + .89rem + 5px);padding:.375rem .75rem;font-size:1.1rem;font-weight:400;line-height:1.5;color:#495057;background-color:#fff;background-clip:padding-box;border:1px solid #ced4da;border-radius:.25rem;transition:border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.form-control{transition:none;}
}
.form-control::-ms-expand{background-color:transparent;border:0;}
.form-control:-moz-focusring{color:transparent;text-shadow:0 0 0 #495057;}
.form-control:focus{color:#495057;background-color:#fff;border-color:#80bdff;outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25);}
.form-control::-webkit-input-placeholder{color:#6c757d;opacity:1;}
.form-control::-moz-placeholder{color:#6c757d;opacity:1;}
.form-control:-ms-input-placeholder{color:#6c757d;opacity:1;}
.form-control::-ms-input-placeholder{color:#6c757d;opacity:1;}
.form-control::placeholder{color:#6c757d;opacity:1;}
.form-control:disabled,.form-control[readonly]{background-color:#e9ecef;opacity:1;}
.form-group{margin-bottom:1rem;}
.btn{display:inline-block;font-weight:400;color:#212529;text-align:center;vertical-align:middle;cursor:pointer;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;background-color:transparent;border:1px solid transparent;padding:.375rem .75rem;font-size:1rem;line-height:1.5;border-radius:.25rem;transition:color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
@media (prefers-reduced-motion:reduce){
.btn{transition:none;}
}
.btn:hover{color:#212529;text-decoration:none;}
.btn:focus{outline:0;box-shadow:0 0 0 .2rem rgba(0,123,255,.25);}
.btn:disabled{opacity:.65;}
.btn-outline-primary{color:#007bff;border-color:#007bff;}
.btn-outline-primary:hover{color:#fff;background-color:#007bff;border-color:#007bff;}
.btn-outline-primary:focus{box-shadow:0 0 0 .2rem rgba(0,123,255,.5);}
.btn-outline-primary:disabled{color:#007bff;background-color:transparent;}
.collapse:not(.show){display:none;}
.dropdown{position:relative;}
.dropdown-toggle{white-space:nowrap;}
.dropdown-toggle::after{display:inline-block;margin-left:.255em;vertical-align:.255em;content:"";border-top:.3em solid;border-right:.3em solid transparent;border-bottom:0;border-left:.3em solid transparent;}
.dropdown-toggle:empty::after{margin-left:0;}
.dropdown-menu{position:absolute;top:100%;left:0;z-index:1000;display:none;float:left;min-width:10rem;padding:.5rem 0;margin:.125rem 0 0;font-size:1rem;color:#212529;text-align:left;list-style:none;background-color:#fff;background-clip:padding-box;border:1px solid rgba(0,0,0,.15);border-radius:.25rem;}
.dropdown-menu-right{right:0;left:auto;}
.dropdown-divider{height:0;margin:.5rem 0;overflow:hidden;border-top:1px solid #e9ecef;}
.dropdown-item{display:block;width:100%;padding:.25rem 1.5rem;clear:both;font-weight:400;color:#212529;text-align:inherit;white-space:nowrap;background-color:transparent;border:0;}
.dropdown-item:focus,.dropdown-item:hover{color:#16181b;text-decoration:none;background-color:#f8f9fa;}
.dropdown-item:active{color:#fff;text-decoration:none;background-color:#007bff;}
.dropdown-item:disabled{color:#6c757d;pointer-events:none;background-color:transparent;}
.nav{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;padding-left:0;margin-bottom:0;list-style:none;}
.nav-link{display:block;padding:.5rem 1rem;}
.nav-link:focus,.nav-link:hover{text-decoration:none;}
.navbar{position:relative;display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;-ms-flex-align:center;align-items:center;-ms-flex-pack:justify;justify-content:space-between;padding:.5rem 1rem;}
.navbar-brand{display:inline-block;padding-top:.3125rem;padding-bottom:.3125rem;margin-right:1rem;font-size:1.25rem;line-height:inherit;white-space:nowrap;}
.navbar-brand:focus,.navbar-brand:hover{text-decoration:none;}
.navbar-nav{display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;padding-left:0;margin-bottom:0;list-style:none;}
.navbar-nav .nav-link{padding-right:0;padding-left:0;}
.navbar-nav .dropdown-menu{position:static;float:none;}
.navbar-collapse{-ms-flex-preferred-size:100%;flex-basis:100%;-ms-flex-positive:1;flex-grow:1;-ms-flex-align:center;align-items:center;}
.navbar-toggler{padding:.25rem .75rem;font-size:1.25rem;line-height:1;background-color:transparent;border:1px solid transparent;border-radius:.25rem;}
.navbar-toggler:focus,.navbar-toggler:hover{text-decoration:none;}
.navbar-toggler-icon{display:inline-block;width:1.5em;height:1.5em;vertical-align:middle;content:"";background:no-repeat center center;background-size:100% 100%;}
@media (min-width:992px){
.navbar-expand-lg{-ms-flex-flow:row nowrap;flex-flow:row nowrap;-ms-flex-pack:start;justify-content:flex-start;}
.navbar-expand-lg .navbar-nav{-ms-flex-direction:row;flex-direction:row;}
.navbar-expand-lg .navbar-nav .dropdown-menu{position:absolute;}
.navbar-expand-lg .navbar-nav .nav-link{padding-right:.5rem;padding-left:.5rem;}
.navbar-expand-lg .navbar-collapse{display:-ms-flexbox!important;display:flex!important;-ms-flex-preferred-size:auto;flex-basis:auto;}
.navbar-expand-lg .navbar-toggler{display:none;}
}
.navbar-light .navbar-brand{color:rgba(0,0,0,.9);}
.navbar-light .navbar-brand:focus,.navbar-light .navbar-brand:hover{color:rgba(0,0,0,.9);}
.navbar-light .navbar-nav .nav-link{color:rgba(0,0,0,.5);}
.navbar-light .navbar-nav .nav-link:focus,.navbar-light .navbar-nav .nav-link:hover{color:rgba(0,0,0,.7);}
.navbar-light .navbar-nav .active>.nav-link{color:rgba(0,0,0,.9);}
.navbar-light .navbar-toggler{color:rgba(0,0,0,.5);border-color:rgba(0,0,0,.1);}
.navbar-light .navbar-toggler-icon{background-image:url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='30' height='30' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(0, 0, 0, 0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");}
.card{position:relative;display:-ms-flexbox;display:flex;-ms-flex-direction:column;flex-direction:column;min-width:0;word-wrap:break-word;background-color:#fff;background-clip:border-box;border:1px solid rgba(0,0,0,.125);border-radius:.25rem;}
.card-body{-ms-flex:1 1 auto;flex:1 1 auto;min-height:1px;padding:1.25rem;}
.card-link:hover{text-decoration:none;}
.card-header{padding:.75rem 1.25rem;margin-bottom:0;background-color:rgba(0,0,0,.03);border-bottom:1px solid rgba(0,0,0,.125);}
.card-header:first-child{border-radius:calc(.25rem - 1px) calc(.25rem - 1px) 0 0;}
.breadcrumb{display:-ms-flexbox;display:flex;-ms-flex-wrap:wrap;flex-wrap:wrap;padding:.75rem 1rem;margin-bottom:1rem;list-style:none;background-color:#e9ecef;border-radius:.25rem;}
.breadcrumb-item+.breadcrumb-item{padding-left:.5rem;}
.breadcrumb-item+.breadcrumb-item::before{display:inline-block;padding-right:.5rem;color:#6c757d;content:"/";}
.breadcrumb-item+.breadcrumb-item:hover::before{text-decoration:underline;}
.breadcrumb-item+.breadcrumb-item:hover::before{text-decoration:none;}
.breadcrumb-item.active{color:#6c757d;}
.float-right{float:right!important;}
.ml-auto{margin-left:auto!important;}
.text-center{text-align:center!important;}
@media print{
*,::after,::before{text-shadow:none!important;box-shadow:none!important;}
a:not(.btn){text-decoration:underline;}
img{page-break-inside:avoid;}
h2{orphans:3;widows:3;}
h2{page-break-after:avoid;}
body{min-width:992px!important;}
.navbar{display:none;}
}
/*! CSS Used from: https://zafir.uvisionpk.com/ticketing_tool_v2/assets/css/mystyle.css */
*{font-family:Open Sans;}
body{font-family:Open Sans;font-size:17px;}
a{color:#6C6C6C;text-decoration:none!important;}
.navbar-brand img{height:35px;}
.navbar-cus{position:fixed;width:100%;flex-direction:row;align-items:center;padding:0;border-radius:0;box-shadow:0 4px 0 0 rgba(0,0,0,.01), 0 2px 3px 0 rgba(0,0,0,.06);z-index:999;}
.dropdown-menu{border-radius:0;box-shadow:0 1px 6px 0 rgba(32, 33, 36, .05);border:1px solid #e9ecef;margin-top:6px;padding:0px;}
.dropdown-item:hover{background-color:rgba(30,131,236,.3)!important;}
.dropdown-item i{padding-right:10px;}
.dropdown-item{color:#1890cf;padding:0.5rem 1.5rem;}
.navbar-mob-bar{margin-right:25px;}
.navbar-cus .navbar-brand{text-align:center;font-size:10rem;line-height:1.5rem;padding:5px;font-weight:400;}
.container-fluid-cus .fixed-nav .fixed-nav-inner{display:inline-flex;flex-direction:column;position:fixed;top:45px;left:0;bottom:0;background-color:#14243d;border-right:1px solid lightgray;flex:1;z-index:99;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul{list-style-type:none;padding:0;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a{display:flex;align-items:center;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a:before{content:"";opacity:0;width:0.175rem;visibility:hidden;position:absolute;background:#0275d8;top:0;left:0;bottom:0;right:auto;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a:hover{background-color:#fff;box-shadow:inset 0 1px 3px rgba(0, 0, 0, 0.1), inset 0 1px 1px rgba(0, 0, 0, 0.04), inset 0 2px 1px -1px rgba(0, 0, 0, 0.02);}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a:hover li i,.container-fluid-cus .fixed-nav .fixed-nav-inner ul a:hover li:nth-child(2n){color:#0275d8!important;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a:hover:before{opacity:1;visibility:visible;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a li{padding:0.25rem 1rem;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a li i{font-size:16px;line-height:3rem;color:#fff;}
.container-fluid-cus .fixed-nav .fixed-nav-inner ul a li:nth-child(2n){color:#fff;font-size:1rem;padding:0;margin-left:0;letter-spacing:0.05rem;width:0px;text-align:left;opacity:1;transition:0.25s ease-in-out width, 0.25s linear transform;transform:translateX(2rem);}
.container-fluid-cus .fixed-nav .fixed-nav-inner.open-nav li:nth-child(2n){margin:0;padding:0.25rem 1rem;letter-spacing:0.025rem;width:8.5rem;opacity:1;transform:translateX(0.75rem);}
::-webkit-scrollbar{width:7px;}
::-webkit-scrollbar-track{background:#f1f1f1;}
::-webkit-scrollbar-thumb{background:#d1ddee;}
::-webkit-scrollbar-thumb:hover{opacity:0.5;}
.main-sec {
    margin-top: 55px;
    position: absolute;
    margin-left: 450px;
    width: 84vw;
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 10px;
}
.main-two {
    margin-top: 55px;
    position: absolute;
    margin-left: 450px;
    width: 180vw;
    height: 100%;
    overflow-y: auto;
    overflow-x: hidden;
    padding: 10px;
}
.breadcrumb{background:transparent;padding:0;margin-bottom:0;margin-top:30px;}
.breadcrumb-item + .breadcrumb-item::before{content:">";}
.form-group label{color:#75787d;font-weight:500;}
.form-control{border-radius:0;}
.btn-section button:first-child{margin-right:10px;}
@media only screen and (max-width: 760px){
.main-sec{width:auto;height:93vh;overflow-y:auto;overflow-x:hidden;}
}
/*! CSS Used from: https://zafir.uvisionpk.com/ticketing_tool_v2/assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css */
.fa{display:inline-block;font:normal normal normal 14px/1 FontAwesome;font-size:inherit;text-rendering:auto;-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale;}
.fa-user:before{content:"\f007";}
.fa-cog:before{content:"\f013";}
.fa-pencil-square-o:before{content:"\f044";}
.fa-plus-circle:before{content:"\f055";}
.fa-cogs:before{content:"\f085";}
.fa-sign-out:before{content:"\f08b";}
.fa-briefcase:before{content:"\f0b1";}
.fa-dashboard:before{content:"\f0e4";}
.fa-ticket:before{content:"\f145";}
.fa-product-hunt:before{content:"\f288";}
.fa-address-book-o:before{content:"\f2ba";}
.fa-user-circle:before{content:"\f2bd";}

/*! CSS Used fontfaces */
</style>

<div class="main-sec">
  <div class="row">
      <div class="col-md-8">
        <nav>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item active"> Incidents View</li> -->
            </ol>
        </nav>
      </div>
   </div> 
  <div class="TaskView" > 
        <h3 class="breadcrumb" ><?php echo "aaaa_IN".str_pad($incidents['incidents_id'], '4', '0', STR_PAD_LEFT);?></h3>
        <div class="row">
               <div class="form-group col-md-4">
                 <h5> <label for="email" >Incidents ID</label></h5>
                  <input type="text" class="form-control" id="T_id" placeholder="Name" name="T_id" value="<?php echo "aaaa_IN".str_pad($incidents['incidents_id'], '4', '0', STR_PAD_LEFT);?>" readonly>
                </div>
               <div class="form-group col-md-4">
                  <h5><label for="email">Incidents Name</label></h5>
                  <input type="text" class="form-control" id="Tname" placeholder="Name" name="Tname" value="<?php echo $incidents['incident_name'];?>" readonly>
                </div>
                  <div class="form-group col-md-4">
                  <h5><label for="pwd">Company Namey</label></h5>
                  <input type="text" class="form-control" id="Cname" name="Cname" value="<?php echo $incidents['company_name'];?>" readonly>
                </div>
                <div class="form-group col-md-4">
                 <h5> <label for="pwd">Project Name</label></h5>
                  <input type="text" class="form-control" id="Pname" name="Pname" value="<?php echo $incidents['project_name'];?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <h5><label for="pwd">Project Version</label></h5>
                  <input  type="text" class="form-control" id="Pversion" name="Pversion" value="<?php echo $incidents['project_version'];?>" readonly >
                </div> 
                <div class="form-group col-md-4">
                 <h5> <label for="pwd">Report From</label></h5>
                  <input  type="text" class="form-control" id="Rform" name="Rform" value="<?php echo $incidents['report_form'];?>" readonly >
                </div>
                <div class="form-group col-md-4">
                  <h5><label for="pwd">Assign To</label></h5>
                  <input  type="text" class="form-control" id="Assignto" name="Assignto" value="<?php echo $incidents['assign_to'];?>" readonly>
                </div>
                 <div class="form-group col-md-4">
                 <h5> <label for="pwd">Start Date</label></h5>
                  <input  type="text" class="form-control" id='Sdate' name='Sdate' value="<?php echo $incidents['start_date'];?>" readonly>
                </div>
                <div class="form-group col-md-4">
                <h5>  <label for="pwd">End Date</label></h5>
                  <input  type="text" class="form-control" id='Edate' name='Edate' value="<?php echo $incidents['end_date'];?>" readonly>
                </div>
                <div class="form-group col-md-4">
                 <h5> <label for="pwd">Status</label></h5>
                  <input type="text" class="form-control" id="Status" name="Status" value="<?php echo $incidents['status'];?>" readonly>
                </div>
                <div class="form-group col-md-4">
                  <h5><label for="pwd">Priority</label></h5>
                  <input   type="text" class="form-control" id="Priority" name="Priority" value="<?php echo $incidents['priority'];?>" readonly>
                </div>
                <div class="form-group col-md-4">
                <h5>  <label for="pwd">Description</label></h5>
                  <input type="text" class="form-control" id="Description" placeholder="Name" name="Description" value="<?php echo $incidents['description'];?>" readonly>
                </div>     
               </div>
               </div>
              </div>
             <pagebreak />
             <div class="main-two "> 
              <div class=" breadcrumb" >  
             <h5> <label class=" breadcrumb" for="pwd">Incident's History</label></h5>
             </div>  
             <div class="col-md-12" >
                <div id="accordion">
                <?php 
                    foreach($incidents_history as  $row) { ?>
                     <div class="card">
                      <div class="card-header">
                        <a class="card-link" data-toggle="collapse" href="#test<?php echo $row->id;?>">
                        <?php echo  $row['incident_status'];?>            
                                  </a>
                      </div>
                      <div id="test<?php echo $row->id;?>" class="collapse show" data-parent="#accordion">
                        <div class="card-body">
                       <?php echo $row['incident_description'];?>               
                        </div>
                      </div> 
                    </div> 
                  <?php } ?> 
                 
                </div>
              </div>

         </div>
    </div>
    </form>
  </div>
  </div>
