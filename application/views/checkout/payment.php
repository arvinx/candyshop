<div class="row">
	<div class="medium-5 columns">
		<h3>Order Summary</h3>
		<div class="row">
			<div class="medium-11 small-centered columns">
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
				echo "<h5 id='order-total'>Order Total: $" . $this->session->userdata("total") . "</h5>";
				?>
				<br><br>
			</div>
		</div>

		<?php echo form_open('candystore/paymentPost'); ?>

		<label for="creditcard_number">Credit Card Number:</label>
		<?php echo form_error('creditcard_number'); ?>
		<input type="text" maxlength="16" id="creditcard_number" name="creditcard_number" required />
		<br/>

		<label for="creditcard_month">Credit Card Expiry Month:</label>
		<input type="text" pattern="[0-9]{2}" maxlength="2" id="creditcard_month" name="creditcard_month" required />
		<br/>

		<label for="creditcard_year">Credit Card Expiry Year:</label>
		<input type="text" pattern="[0-9]{4}" maxlength="4" id="creditcard_year" name="creditcard_year" required />
		<br/>
		<?php
			$warning = $this->session->flashdata("payment_error");
			if ($warning) {
				echo " <div data-alert class='alert-box' stlye='background-colour: red'>" . $warning . "</div>";
			}
		?>
		<input type="submit" class="button small" value="Buy"/>
	</form>
</div>
</div>

