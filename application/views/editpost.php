           <h1> edit post</h1>
           
           
           <?php if($success==1) { ?>
           
           <div style='background: green; color:#fff;'> Has been eddited</div>
           
           <?php } ?>
         <form action="<?=base_url();?>posts/editpost/<?=$post['postID'];?>" method="post">
            <p> <input type="text" name="title" value="<?=$post['title']?>">
            <p> <textarea name="post"><?=$post['post']?></textarea>
            <p> <input type="submit" name="submit" value="Ok" > </p>
         </form>
 