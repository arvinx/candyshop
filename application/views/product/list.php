<html>
	<head>
		<meta charset="UTF-8">
		<script type='text/javascript' src="<?= base_url() ?>js/jquery-2.1.0.min.js"></script>
		<script type='text/javascript' src="<?= base_url() ?>js/foundation/foundation.js"></script>
		<script type='text/javascript' src="<?= base_url() ?>js/foundation/foundation.topbar.js"></script>
		<script>
			$(document).foundation();
		</script>
	</head>
	<body>
		<div class="sticky">
			<nav class="top-bar" data-topbar>
			  <ul class="title-area">
			    <li class="name">
			      <h1><a href="#">My Site</a></h1>
			    </li>
			    <li class="toggle-topbar menu-icon"><a href="#">Menu</a></li>
			  </ul>

			  <section class="top-bar-section">
			    <!-- Right Nav Section -->
			    <ul class="right">
			      <li class="active"><a href="#">Right Button Active</a></li>
			      <li class="has-dropdown">
			        <a href="#">Right Button with Dropdown</a>
			        <ul class="dropdown">
			          <li><a href="#">First link in dropdown</a></li>
			        </ul>
			      </li>
			    </ul>

			    <!-- Left Nav Section -->
			    <ul class="left">
			      <li><a href="#">Left Nav Button</a></li>
			    </ul>
			  </section>
			</nav>
		</div>

		<h2>Product Table</h2>
		<?php 
				echo "<p>" . anchor('candystore/newForm','Add New Candy') . "</p>";
		 	  
				echo "<table>";
				echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
				
				foreach ($products as $product) {
					echo "<tr>";
					echo "<td>" . $product->name . "</td>";
					echo "<td>" . $product->description . "</td>";
					echo "<td>" . $product->price . "</td>";
					echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
						
					echo "<td>" . anchor("candystore/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
					echo "<td>" . anchor("candystore/editForm/$product->id",'Edit') . "</td>";
					echo "<td>" . anchor("candystore/read/$product->id",'View') . "</td>";
						
					echo "</tr>";
				}
				echo "<table>";
		?>

	</body>
</html>
	

