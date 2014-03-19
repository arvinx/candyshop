<br><br>
<div class="row">
	<div class="medium-5 columns">
		<h3>Create a New Product</h3>
		<?php 
		echo "<p>" . anchor('candystore/adminpanel','Back', array('class' => 'button tiny')) . "</p>";

		echo form_open_multipart('candystore/create');
		
		echo form_label('Name'); 
		echo form_error('name');
		echo form_input('name',set_value('name'),"required");

		echo form_label('Description');
		echo form_error('description');
		echo form_input('description',set_value('description'),"required");

		echo form_label('Price');
		echo form_error('price');
		echo form_input('price',set_value('price'),"required");

		echo form_label('Photo');

		echo form_open_multipart('upload/do_upload');

		if(isset($fileerror))
			echo $fileerror;

		echo form_open_multipart('candystore/create');
		?>	
		<input type="file" name="userfile" size="20" />

		<?php 	
		$warning = $this->session->flashdata("product_form_error");

		if ($warning) {
			echo " <div data-alert class='alert-box'>" . $warning . "</div>";
		}
		echo form_submit('submit', 'Create');
		echo form_close();
		?>	
	</div>
</div>
