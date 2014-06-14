
            <h3><a href="<?=base_url()?>posts/new_post"  style="color:red;"> New post </a> </h3>
            <h3><a href="<?=base_url()?>upload/"  style="color:red;"> Upload image </a> </h3>            
            <h3><a href="<?=base_url()?>emails/email/"  style="color:red;"> Send emails </a> </h3>
            <h3><a href="<?=base_url()?>callendar/"  style="color:green;"> Callendar </a> </h3>
            <?php
            if(!isset($post)){?>
            <p> There are currently no posts on my blog ! </p>
            <?php } else {
                foreach($post as $row){
                ?>
                <h2> <a href="<?=base_url()?>posts/single/<?=$row['postID']?>"> <?=$row['title'] ?> </a>
                <a href="<?=base_url()?>posts/deletepost/<?=$row['postID']?>"> Delete </a>
                <a href="<?=base_url()?>posts/editpost/<?=$row['postID']?>"> Edit </a>
                
                </h2>
                <p><?=substr(htmlentities($row['post']),0,2000)?> </p>
                <p>  <a href="<?=base_url()?>posts/single/<?=$row['postID']?>"> Reade more </a> </p><hr />
                <?php
                    }
                }
                ?>
                
                <?=$pages;?>
         