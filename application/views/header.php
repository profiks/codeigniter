<!DOCTYPE html>
<html>
    <head>
        <title> Mysite</title>
    </head>
    <body>
        
        
            <div style="border:1px solid red">
                <?php
                if($this->session->userdata('userID')){ ?>
                <p>Hello !! <b><?=$this->session->userdata('username')?></b></p>
                    <p>You are logged in as <b><?=$this->session->userdata('user_type')?></b></p>
                    <p> <a href="<?=base_url()?>users/logout">Logout </a></p>
               <?php }else { ?>
                    <p> <a href="<?=base_url()?>users/login">Log in </a></p>
                    <p> <a href="<?=base_url()?>users/register">Sing up </a></p>
               <?php } ?>
                
            </div>
            