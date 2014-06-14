<h2> Log in</h2>
<?php if($error==1){ ?>
    <p style="background: red; color:#fff;"> Your username OR passwor did not match.</p>
<?php }  ?>

<form action="<?=base_url()?>users/login" method="post">
<p><input type="text" placeholder="username" name="username" >
<p><input type="password" placeholder="password" name="password" >
<p> <select name="user_type">
        <option vale="" selected="selected">--- </option>   
        <option vale="admin">Admin</option>
        <option vale="author" >Author</option>
        <option vale="user" > User</option>   
    </select>
<p><input type="submit" value="login" ></p>
</form>