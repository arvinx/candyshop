<h1>Hello this is the login page</h1>


<style>
	input { display: block;}
	
</style>

<?php echo form_open('candystore/loginPost'); ?>
 <label for="username">Username:</label>
 <input type="text" size="24" id="username" name="username" required />
 <br/>
 <label for="password">Password:</label>
 <input type="password" size="24" id="passowrd" name="password" required />
 <br/>
 <input type="submit" class="button small" value="Login"/>
</form>



