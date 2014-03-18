<div class="row">
  <div class="medium-11 small-centered columns">
  		<br><br><br><br>
		<h3>Order Info</h3>
		<ul class='square'>
				<?php
					echo "<li>Customer ID: " . $orderinfo->customer_id .  "</li>";
					echo "<li>Order Date: " . $orderinfo->order_date . "</li>";
					echo "<li>Order Time: " . $orderinfo->order_time . "</li>";
					echo "<li>Total: " . $orderinfo->total . "</li>";
					echo "<li>Credit Card Number: " . $orderinfo->creditcard_number . "</li>";
					echo "<li>Credit Card Month: " . $orderinfo->creditcard_month . "</li>";
					echo "<li>Credit Card Year: " . $orderinfo->creditcard_year . "</li>";
				?>
		</ul>
		<br><br>

		<h3>Order Items</h3>
		<table>
			<thead>
				<tr>
					<th width='200'>Name</th>
					<th width='50'>Quantity</th>
					<th width='50'>Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach ($orderitems_withnames as $item) {
						echo "<tr>";
						echo "<td>" . $item[1] .  "</td>";
						echo "<td>" . $item[0] . "</td>";
						echo "<td>$" . $item[2] . "</td>";
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
	</div>
</div>