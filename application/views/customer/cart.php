<div class="row">
  <div class="medium-11 small-centered columns">
  		<br><br>
		<h3 style='text-align: center'>Your Cart</h3>
		<br><br><br>

		<table>
			<thead>
				<tr>
					<th width="200">Product Name</th>
					<th width="200">Price</th>
					<th width="200">Quantity</th>
					<th width="200">Sub Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$session_cart_items = $this->session->userdata('cart');
					foreach ($products as $product) {
						echo "<tr>";
						echo "<td>" . $product->name . "</td>";
						echo "<td>$" . $product->price . "</td>";
						echo "<td>" . $session_cart_items[$product->id] . "</td>";
						echo "<td>$" . $session_cart_items[$product->id]*$product->price . "</td>";
					}
				?>
			</tbody>
		</table>		
	</div>
</div>

<script src="<?= base_url() ?>/js/addcandy.js"></script>
