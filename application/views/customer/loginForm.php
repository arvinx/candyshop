<br><br>
<div class="row">
	<div class="medium-5 columns">
		<h3>Login</h3>
		<?php echo form_open('candystore/loginPost'); ?>
		<label for="username">Username:</label>
		<input type="text" size="24" id="username" name="username" required />
		<br/>
		<label for="password">Password:</label>
		<input type="password" size="24" id="passowrd" name="password" required />
		<br/>
		<?php
		$warning = $this->session->flashdata("login_error");
		if ($warning) {
			echo " <div data-alert class='alert-box' stlye='background-colour: red'>" . $warning . "</div>";
		}
		?>
		<br>
		<input type="submit" class="button small" value="Login"/>
	</form>

</div>
</div>



