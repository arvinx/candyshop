<?php
Class Customer_model extends CI_Model
{
 function login($username, $password)
 {
   $query = $this->db->get_where('customer',array('login' => $username, 
                                                  'password' => $password)); //MD5 pw
   $res = $query->result();
   if($query->num_rows() == 1) {
     return $res;
   }
   else {
     return false;
   }
 }

 function is_existing_email($email) {
   $query = $this->db->get_where('customer',array('email' => $email));
   $res = $query->result();
   error_log("NUM ROWS EMAIL: " . $query->num_rows() . $res);
   if($query->num_rows() == 0) {
     return false;
   }
   return true;
 }

 function is_existing_username($username) {
   $query = $this->db->get_where('customer',array('login' => $username));
   $res = $query->result();

   if($query->num_rows() == 0) {
     return false;
   }
   return true;
 }

 function insert($new_customer) {
  return $this->db->insert("customer", array('first' => $new_customer->first,
    'last' => $new_customer->last,
    'email' => $new_customer->email,
    'login' => $new_customer->username,
    'password' => $new_customer->password)); //MD5 pw
 }

 function getAll() {  
  $query = $this->db->get('customer');
  return $query->result('Customer');
 }  

 function delete($id) {
  return $this->db->delete("customer",array('id' => $id ));
 }

}
?>
