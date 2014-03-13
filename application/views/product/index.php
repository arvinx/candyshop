<div class="row">
  <div class="medium-11 small-centered columns">
  		<br><br>
		<h2 style='text-align: center'>Shop Candy</h2>
		<?php 
				if($this->session->userdata('logged_in')) {
					$session_data = $this->session->userdata('logged_in');
					echo "<h1>Hi " . $session_data['username'] . "</h1>";
				}
				echo "<p>" . anchor('candystore/newForm','Add New Candy') . "</p>";
				echo "<ul class='small-block-grid-3'>";
				
				foreach ($products as $product) {
					echo "<li>";
					echo "<ul class='pricing-table'>";
					  echo "<li class='title'>" . $product->name .  "</li>";
					  echo "<li class='price'>$" . $product->price . "</li>";
					  echo "<li class='description'>" . $product->description . "</li>";
					  echo "<li><img class='prod-img' src='" . base_url() . "images/product/" . $product->photo_url . "'  /></li>";
					  echo "<li class='cta-button'><button class='small' id='add-cart-btn' value=" . $product->id . ">Add to Cart</button></li>";
					  //echo "<li class='cta-button'>" . anchor("candystore/addToCart/$product->id", 'Add to Cart', array('class' => 'button')) . " </li>";
					echo "</ul>";
					// echo "<td>" . anchor("candystore/delete/$product->id",'Delete',"onClick='return confirm(\"Do you really want to delete this record?\");'") . "</td>";
					// echo "<td>" . anchor("candystore/editForm/$product->id",'Edit') . "</td>";
					// echo "<td>" . anchor("candystore/read/$product->id",'View') . "</td>";
						
					echo "</li>";
				}
				echo "</ul>";
		?>	
	</div>
</div>

<script src="<?= base_url() ?>/js/addcandy.js"></script>
