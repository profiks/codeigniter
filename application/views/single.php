
            <?php if(!isset($post)){  ?>
            <p> Something wrong </p>
          <?php } else {?>

                <h2> <p> <?=$post['title'];?> </p>  </h2>
                
                <p><?=htmlentities($post['post'])?> </p>
                
         <?php }  ?>
         <hr />
         <h3> Comments </h3> 
         
         <?php
         if(count($comment)>0){
            foreach($comment as $row){ ?>
                
    <p><b><?=$row['username']?></b> said at <?=date('m/d/Y H:i A',strtotime($row['date_added']))?></p>            
                
            <p><?=$row['comment']?> </p>
            <hr />
           <?php }//end foreach
                      
            
       /*end if*/ }else { ?> 
            <p><i> There are  currently no comments </i> </p>
            
          <?php } /*end else*/ ?>  
            <!--//form to add comment-->
            <!--<form action="comments/add_comment">-->
         <?php echo form_open(base_url().'comments/add_comment/'.$post['postID']); ?>
         
         <!--<textarea> text comment </textarea>-->
         <p> <?php
         $data_format = array(
                        'name'=>'comment',
                        'value'=>set_value('comment')
                        );
         echo form_textarea($data_format);
         ?> </p>
         
        
         <!--captcha-->
         <p> <?=$captcha?><br /></p>
         <?php
         $data_form = array (
                        'name'=>'captcha' 
             
                       );
         echo form_input($data_form);
         ?>
        
         <!--<input type="submit">-->
        <p> <?php echo form_submit('','Add comment'); ?> </p>
         
         <?php echo form_close(); ?>
            
            
            
            
        
        
        
