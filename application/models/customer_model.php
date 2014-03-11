<?php
Class Customer_model extends CI_Model
{
 function login($username, $password)
 {
   // $this->db->select('id, username, password, first');
   // $this->db->from('customer');
   // $this->db->where('login', $username);
   // $this->db->where('password', MD5($password));
   // $this->db->limit(1);

   // $query = $this->db->get();
   // $res = $query->result();

   $query = $this->db->get_where('customer',array('login' => $username, 
                                                  'password' => $password)); //MD5 pw
   $res = $query->result();
   //print_r($res);
   //print_r(MD5($password));
   if($query->num_rows() == 1) {
     return $res;
   }
   else {
     return false;
   }
 }
 function is_existing_email($email) {
   // $this->db->select('id, username, email');
   // $this->db->from('customer');
   // $this->db->where('email', $email);
   // $this->db->limit(1);

   // $query = $this->db->get();
   // $res = $query->result();
   $query = $this->db->get_where('customer',array('email' => $email));
   $res = $query->result();
   if($query->num_rows() > 0) {
     return false;
   }
   return true;

 }

 function is_existing_username($username) {
   // $this->db->select('id, username');
   // $this->db->from('customer');
   // $this->db->where('login', $username);
   // $this->db->limit(1);

   // $query = $this->db->get();
   $query = $this->db->get_where('customer',array('login' => $username));
   $res = $query->result();

   if($query->num_rows() > 0) {
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






//  function get($id)
//  {
//   $query = $this->db->get_where('product',array('id' => $id));

//   return $query->row(0,'Product');
// }

// function delete($id) {
//   return $this->db->delete("product",array('id' => $id ));
// }

// function insert($product) {
//   return $this->db->insert("product", array('name' => $product->name,
//     'description' => $product->description,
//     'price' => $product->price,
//     'photo_url' => $product->photo_url));
// }









}
?>
