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
					$total = 0;
					foreach ($products as $product) {
						echo "<tr>";
						echo "<td>" . $product->name . "</td>";
						echo "<td class='product-price'>$" . $product->price . "</td>";
						echo "<td><form>
								<input name='quantity' class='quantity-input' type='number' min='0' value=" . $session_cart_items[$product->id] . " required disabled />
								</form></td>";
						echo "<td>$" . $session_cart_items[$product->id]*$product->price . "</td>";
						echo "<td class='delete-item' style='display: none'><img class='delete-btn' alt=" . $product->id . " width=20 height=20 src=" . base_url() . "/images/remove.png /></td>";
						$total += $session_cart_items[$product->id]*$product->price;
						$this->session->set_userdata('total', $total);
					}
				?>
			</tbody>
		</table>
		<?php
			echo "<h3 id='order-total'>Order Total: $" . $this->session->userdata("total") . "</h3>";
		?>
		<br><br>
		<button id="edit-btn" class="button tiny">Edit</button>
		<button id="checkout-btn" class="button tiny">Checkout</button>

	</div>
</div>

<script src="<?= base_url() ?>/js/cart.js"></script>
