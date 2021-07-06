<?php
class Settings_model extends CI_Model
{
    function getRoleDetails()
    {
    //table  (roles_settings)
     $delete_flag=1;
    return  $this->db->get_where('roles_settings',array('delete_flag!='=>$delete_flag))->result();
    }
    //tabel (departments_settings)
    function getDepartmentDetails() 
    {
         $delete_flag=1;
    return  $this->db->get_where('departments_settings',array('delete_flag!='=>$delete_flag))->result();
    }
    function getTeamDetails()
   {
        $delete_flag=1;
    return  $this->db->get_where('teams_settings',array('delete_flag!='=>$delete_flag))->result();
   } 
   function getById($id)
    {
       return $this->db->get_where('roles_settings',array('id'=>$id))->row();
    }
    function getByIdDepartment($id){
        return $this->db->get_where('departments_settings',array('id'=>$id))->row();
    }
    function getByIdTeam($id){
        return $this->db->get_where('teams_settings',array('id'=>$id))->row();
    }

   function create()
    {
        $arr['company_email'] = $this->input->post('Cemail');
        $arr['email_protocol'] = $this->input->post('Eprotocol');
        $arr['smtp_host'] = $this->input->post('Shost');
        $arr['smpt_user'] = $this->input->post('Suser');
        $arr['smtp_password'] = $this->input->post('Spassword');
        $arr['smtp_port'] = $this->input->post('Sport');
        $arr['email_encription'] = $this->input->post('Eencription');
         $arr['flag'] = 4;
        //table (emails_settings)
        $this->db->insert('emails_settings',$arr);

    }
    function addRole()
    {
        $arr['role_name'] = $this->input->post('Rname');
        $arr['role_slug'] = $this->input->post('Rslug');
        $arr['description'] = $this->input->post('RDec');
         $arr['flag'] = 4;
        $this->db->insert('roles_settings',$arr);

    }
    function addDepartment()
    {
        $arr['Department'] = $this->input->post('Department');
        $arr['total_staff'] = $this->input->post('Tstaff');
         $arr['flag'] = 4;
        $this->db->insert('departments_settings',$arr);

    }

    function addTeam()
    {
        $arr['team_name'] = $this->input->post('Tname');
        $arr['member'] = $this->input->post('Member');
        $arr['leader'] = $this->input->post('Leader');
         $arr['flag'] = 4;
        $this->db->insert('teams_settings',$arr);

    } 

    function update_role($id)
    {
        $arr['role_name'] = $this->input->post('Rname');
        $arr['role_slug'] = $this->input->post('Rslug');
        $arr['description'] = $this->input->post('RDec');
         $arr['flag'] = 4;
        $this->db->where(array('id'=>$id));
        $this->db->update('roles_settings',$arr);


    }
    function update_Department($id)    
       {
         $arr['department'] = $this->input->post('Dname');
         $arr['total_staff'] = $this->input->post('Tstaff');
          $arr['flag'] = 4;
         $this->db->where(array('id'=>$id));
         $this->db->update('departments_settings',$arr);

    }
    function update_team($id)
    {
        $arr['team_name'] = $this->input->post('Tname');
        $arr['member'] = $this->input->post('Member');
        $arr['leader'] = $this->input->post('Leader');
         $arr['flag'] = 4;
        $this->db->where(array('id'=>$id));
        $this->db->update('teams_settings',$arr);
    }


    function Delete($id)
    {

         $delete_flag=1;
      $this->db->where('id',$id)->update('roles_settings',array('delete_flag'=>$delete_flag, 'flag'=>4));

       $delete_flag=1;
      $this->db->where('id',$id)->update('departments_settings',array('delete_flag'=>$delete_flag,'flag'=>4));

       $delete_flag=1;
      $this->db->where('id',$id)->update('teams_settings',array('delete_flag'=>$delete_flag,'flag'=>4));

    }
}