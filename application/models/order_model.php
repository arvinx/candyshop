<?php
Class Order_model extends CI_Model
{
 function insert($order) {
   return $this->db->insert("order", array(
    'customer_id' => $order->customer_id,
    'order_date' => date("Y/m/d"),
    'order_time' => date("H:i:s"),
    'total' => $order->total,
    'creditcard_number' => $order->creditcard_number,
    'creditcard_month' => $order->creditcard_month,
    'creditcard_year' => $order->creditcard_year)); 
 }

 function delete($customer_id) {
    return $this->db->delete("order", array(
      'customer_id' => $customer_id));
 }

 function getAll()
 {  
    $query = $this->db->get('order');
    return $query->result('Order');
 } 

}
?>