<h1>Hello this is the register page</h1>


<style>
input { display: block;}

</style>

<?php echo form_open('candystore/registerPost'); ?>
<label for="username">Username:</label>
<input type="text" maxlength="16" id="username" name="username" required />
<br/>

<label for="password">Password:</label>
<input type="password" pattern=".{6,16}" maxlength="16" id="passowrd" name="password"
title="Must be at least 6 characters" required />
<br/>

<label for="email">Email:</label>
<input type="email" maxlength="45" id="email" name="email" required />
<br/>

<label for="first">First Name:</label>
<input type="text" maxlength="24" id="first" name="first" required />
<br/>

<label for="last">Last Name:</label>
<input type="text" maxlength="24" id="last" name="last" required />
<br/>
<input type="submit" class="button small" value="Register"/>
</form>



