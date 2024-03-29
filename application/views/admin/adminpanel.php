<div class="row">
  <div class="medium-11 small-centered columns">
  		<br><br>
		<h2 style='text-align: center'>Admin Panel</h2>
		<h3>Products</h3>
		<p>Click Name to Edit</p>
		<?php
			echo anchor('candystore/newForm','Add New Candy', array('class' => 'button medium'));
		?>
		<table>
			<thead>
				<tr>
					<th width='250'>Name</th>
					<th width='50'>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($products as $product) {
						echo "<tr>";
						echo "<td>" . anchor("candystore/editForm/$product->id", $product->name) .  "</td>";
						echo "<td class='product delete-item' align='center'><img class='delete-btn' alt=" . $product->id . " width=20 height=20 src=" . base_url() . "/images/remove.png /></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<br><br>
		<h3>Orders</h3>
		<h5>Click the order number for more information</h5>
		<table>
			<thead>
				<tr>
					<th widht='50'>ID</th>
					<th width='250'>Customer ID</th>
					<th width='250'>Date</th>
					<th width='250'>Time</th>
					<th width='250'>Total</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($orders as $order) {
						echo "<tr>";
						echo "<td>" . anchor("candystore/displayOrder/$order->id", $order->id) . "</td>";
						echo "<td>" . $order->customer_id .  "</td>";
						echo "<td>" . $order->order_date .  "</td>";
						echo "<td>" . $order->order_time .  "</td>";
						echo "<td>$" . $order->total .  "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<h3>Customers</h3>
		<h5>*Deleting a Customer deletes their Orders (and OrderItems)</h5>
 		<button id='delete-all-btn' class='button small'>Delete All Customers</button>
		<table>
			<thead>
				<tr>
					<th width='250'>ID</th>					
					<th width='250'>Username</th>
					<th width='250'>First Name</th>
					<th width='250'>Last Name</th>
					<th width='250'>Email</th>
					<th width='50'>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($customers as $customer) {
						echo "<tr>";
						echo "<td>" . $customer->id .  "</td>";
						echo "<td>" . $customer->login .  "</td>";
						echo "<td>" . $customer->first .  "</td>";
						echo "<td>" . $customer->last .  "</td>";
						echo "<td>" . $customer->email .  "</td>";
						echo "<td class='customer delete-item' align='center'><img class='delete-btn' alt=" . $customer->id . " width=20 height=20 src=" . base_url() . "/images/remove.png /></td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
		<br><br><br><br>
	</div>
</div>


<script src="<?= base_url() ?>/js/admin.js"></script>


