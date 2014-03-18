<?php
Class Order_model extends CI_Model
{
 function insert($order) {
    $date = date("Y/m/d");
    $time = date("H:i:s");
    $this->session->set_userdata('orderDate', $date);
    $this->session->set_userdata('orderTime', $time);
    return $this->db->insert("`order`", array(
        'customer_id' => $order->customer_id,
        'order_date' => $date,
        'order_time' => $time,
        'total' => $order->total,
        'creditcard_number' => $order->creditcard_number,
        'creditcard_month' => $order->creditcard_month,
        'creditcard_year' => $order->creditcard_year)); 
}

function delete($customer_id) {
    return $this->db->delete("`order`", array(
      'customer_id' => $customer_id));
}

function getAll() {  
    $query = $this->db->get('`order`');
    return $query->result('Order');
}
    
function get($id) {
    $query = $this->db->get_where('`order`', array('id' => $id));
    return $query->row(0,'Order');
}

}
?>