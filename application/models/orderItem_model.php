<?php
Class OrderItem_model extends CI_Model
{
	function insert($orderItem) {
		return $this->db->insert("order_item", array(
			'order_id' => $orderItem->order_id,
			'product_id' => $orderItem->product_id,
			'quantity' => $orderItem->quantity)); 
	}

	function delete($order_id, $product_id) {
		return $this->db->delete("order_item", array(
			'order_id' => $order_id,
			'product_id' => $product_id));
	}

	function getItems($id) {
		$query = $this->db->get_where('order_item', array(
			'order_id' => $id));
		return $query->result('OrderItem');
	}

}
?>