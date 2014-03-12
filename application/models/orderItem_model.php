<?php
Class OrderItem_model extends CI_Model
{
 function insert($order_item) {
   return $this->db->insert("order_item", array(
   	'order_id' => $order_item->order_id,
    'product_id' => $order_item->product_id,
    'quantity' => $order_item->quantity); 
 }

 function delete($order_id, $product_id) {
    return $this->db->delete("order_item", array(
    	'order_id' => $order_id,
    	'product_id' => $product_id));
 }

}
?>