$(document).ready(function () {
  // $('[data-toggle="offcanvas"]').click(function () {
  //   $('.fixed-nav-inner').toggleClass('open-nav')
  // });

   $('#table_id').DataTable();
   $('#table_id2').DataTable();
   $('#table_id3').DataTable();
   $('#table_id4').DataTable();
   $('#table_id5').DataTable();
   $('[data-toggle="tooltip"]').tooltip();   
   $('#addStaffMulti').multiselect();


});
$('#addCompany').click(function () {
    $('.companyDetails').hide();
    $('.companyAdd').show();
});
$('#cancelCompany').click(function(){
   $('.companyAdd').hide();
   $('.companyDetails').show();
});
$('#addStaff').click(function () {
    $('.staffDetails').hide();
    $('.staffAdd').show();
});
$('#cancelStaff').click(function(){
   $('.staffAdd').hide();
   $('.staffDetails').show();
});
$('#addProjects').click(function () {
    $('.ProjectsDetails').hide();
    $('.ProjectsAdd').show();
});
$('#cancelProjects').click(function(){
   $('.ProjectsAdd').hide();
   $('.ProjectsDetails').show();
});
$('#TaskView').click(function () {
   $('.ProjectsDetails').hide();
   $('.TaskView').show();
});