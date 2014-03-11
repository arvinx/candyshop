<h1>Hello this is the register page</h1>


<style>
input { display: block;}

</style>

<?php echo form_open('candystore/register_post'); ?>
<label for="username">Username:</label>
<input type="text" size="24" id="username" name="username" required />
<br/>

<label for="password">Password:</label>
<input type="password" size="24" id="passowrd" name="password" required />
<br/>

<label for="email">Email:</label>
<input type="email" size="45" id="email" name="email" required />
<br/>

<label for="first">First Name:</label>
<input type="text" size="24" id="first" name="first" required />
<br/>

<label for="last">Last Name:</label>
<input type="text" size="24" id="last" name="last" required />
<br/>
<input type="submit" class="button small" value="Register"/>
</form>



