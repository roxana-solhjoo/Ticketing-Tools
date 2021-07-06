<?php
$this->load->view('users/header')
?>
<div class="main-sec">
  <div class="">
    <div class="row">
        <div class="col-md-3">
          <div class="card-block">
            <div class="media">
              <div class="card-icon-3 mr-3 card-icon-1">
                <i class="fa fa-universal-access font-l-1"></i>
              </div>
              <div class="media-body ml-3">
               <a href="<?php echo base_url('front_tasks');?>">
                <h3 class="font-l-1 mb-1"><?php echo $TasksNumber?></h3>
                <span>Tasks</span>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-block">
            <div class="media">
              <div class="card-icon-4 mr-3 card-icon-1">
                <i class="fa fa-user-circle font-l-1"></i>
              </div>
              <div class="media-body ml-3">
              <a href="<?php echo base_url('front_incidents');?>">
                <h3 class="font-l-1 mb-1"><?php echo $IncidentsNumber?></h3>
                <span>Incidents</span>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
          <div class="card-block">
            <div class="media">
              <div class="mr-3 card-icon-1">
                <i class="fa fa-newspaper-o font-l-1"></i>
              </div>
              <div class="media-body ml-3">
                <a href="<?php echo base_url('front_incidents/InProgress');?>">
                 <h3 class="font-l-1 mb-1"><?php echo $inProgressIncidents?></h3>
                <span>In Progress Incidents</span> </a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3"> 
          <div class="card-block">
            <div class="media">
              <div class="card-icon-2 mr-3 card-icon-1">
                <i class="fa fa-users font-l-1"></i>
              </div>
              <div class="media-body ml-3">
                <a href="<?php echo base_url('front_incidents/Completed');?>">
                <h3 class="font-l-1 mb-1"><?php echo $completedIncidents?></h3>
                <span>Completed Incidents</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-block">
            <div class="media">
              <div class="card-icon-3 mr-3 card-icon-1">
                <i class="fa fa-universal-access font-l-1"></i>
              </div>
              <div class="media-body ml-3">
                <a href="<?php echo base_url('front_incidents/Open');?>">
                <h3 class="font-l-1 mb-1"><?php echo $openIncidents?></h3>
                <span>Open Incidents</span></a>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="card-block">
            <div class="media">
              <div class="card-icon-4 mr-3 card-icon-1">
                <i class="fa fa-user-circle font-l-1"></i>
              </div>
              <div class="media-body ml-3">
                <a href="<?php echo base_url('front_incidents/OnHold');?>">
                <h3 class="font-l-1 mb-1"><?php echo $onHoldIncidents?></h3>
                <span>On Hold Incidents</span></a>
              </div>
            </div>
          </div>
        </div>
    </div>
  </div>
</div>
 <?php
$this->load->view('users/footer')
?> 
