<br><br>
<div class="row">
	<div class="medium-5 columns">
		<h2>Order Reciept</h2>
		<table>
			<thead>
				<tr>
					<th width='100'>Date</th>
					<th width='50'>Product</th>
					<th width='250'>Description</th>
					<th width='100'>Unit Price</th>
					<th width='50'>Quantity</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ($products as $order) {
					echo "<tr>";
					echo "<td>" . $this->session->userdata['orderDate'] . "</td>";
					echo "<td>" . $order->name .  "</td>";
					echo "<td>" . $order->description . "</td>";
					echo "<td>" . $order->price . "</td>";
					echo "<td>" . $order->quantity . "</td>";
					echo "</tr>";
				}
				?>
			</tbody>
		</table>
		<br>
		<?php echo "<h4>Total: </h4><h3> $" . $this->session->userdata['total'] . "</h3>";?>
		<button onClick="window.print()">Print this receipt</button>
	</div>
</div>