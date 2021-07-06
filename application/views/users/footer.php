  <script src="<?php echo site_url ('assets/js/jquery.min.js');?>"></script>
  <script src="<?php echo site_url('assets/js/popper.min.js');?>"></script>
  <script src="<?php echo site_url('assets/js/bootstrap.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo site_url('assets/js/datatables.min.js');?>"></script>
  <script type="text/javascript" src="<?php echo site_url('assets/js/bootstrap-multiselect.js');?>"></script>
  <script src="<?php echo site_url('assets/js/jquery.steps.js');?>"></script>
  <script src="<?php echo site_url('assets/js/jquery.validate.js');?>"></script>
  <script src="<?php echo site_url('assets/js/myscript.js');?>"></script>
  <script src="https://cmccs.superapp.com.my/assets/admin/jquery-toast-plugin/dist/jquery.toast.min.js"></script>



  


  <script>
  function alerts(type, msg) {
     'use strict';
       resetToastPosition();
       $.toast({
           text: msg,
           showHideTransition: 'slide',
           icon: type,
           loaderBg: '#f96868',
           position: 'top-right',
           hideAfter: 8000,
         })
    }

resetToastPosition = function () {
    $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
    $(".jq-toast-wrap").css({
        "top": "",
        "left": "",
        "bottom": "",
        "right": ""
    }); //to remove previous position style
}


<?php
        if($this->session->flashdata('success'))
        {
          ?>
          alerts('success','<?php echo $this->session->flashdata('success'); ?>');

        <?php }else if($this->session->flashdata('fail')){  ?>
          //alert('dfd');
          alerts('error','<?php echo $this->session->flashdata('fail'); ?>');
        <?php } ?>
<?php
        if($this->session->flashdata('Successmessages'))
        {
          ?>
          var arrayval = '<?php echo $this->session->flashdata('Successmessages');?>';
          var arrayval = arrayval.split("</p>");
          console.log(arrayval);
          for (var i=0; i<arrayval.length; i++){
            if ( arrayval[i].length >  5){
              alerts('error',arrayval[i]); 
            }
          }
          

        <?php } ?>

//alerts("error", "Inconceivable!");
 // alerts("info", "Inconceivable!");
 </script>
</body>
</html>
