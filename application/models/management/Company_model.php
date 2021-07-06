<?php
class Company_model extends CI_Model
{
    //table name: company_details
    function getCompanyDetails()
    { 
     $delete_flag=1;
     return  $this->db->get_where('company_details',array('delete_flag!='=>$delete_flag))->result();
     }
    
     function getById($id) 
    {
       return $this->db->get_where('company_details',array('id'=>$id,))->row();

    }

     function add()
     {
         $arr['company_name'] = $this->input->post('Cname');
         $arr['short_name'] = $this->input->post('shname');
         $arr['registration_no'] = $this->input->post('regNo');
          $arr['flag'] = 4;
         $this->db->insert('company_details',$arr);
     }
     function update($id)
     {
         $arr['company_name'] = $this->input->post('Cname');
         $arr['short_name'] = $this->input->post('shname');
         $arr['registration_no'] = $this->input->post('regNo');
          $arr['flag'] = 4;
         $this->db->where(array('id'=>$id));
         $this->db->update('company_details',$arr);
     } 

     function delete($id)
    {
        $delete_flag=1;
        $this->db->where('id',$id)->update('company_details',array('delete_flag'=>$delete_flag, 'flag'=> 4));
    }

}