<br><br>
<div class="row">
	<div class="medium-5 columns">
		<h3>Edit Product</h3>

		<?php 
		echo "<p>" . anchor('candystore/adminpanel','Back', array('class' => 'button tiny')) . "</p>";

		echo form_open("candystore/update/$product->id");

		echo form_label('Name'); 
		echo form_error('name');
		echo form_input('name',$product->name,"required");

		echo form_label('Description');
		echo form_error('description');
		echo form_input('description',$product->description,"required");

		echo form_label('Price');
		echo form_error('price');
		echo form_input('price',$product->price,"required");

		echo form_submit('submit', 'Save');
		echo form_close();
		?>	

	</div>
</div>