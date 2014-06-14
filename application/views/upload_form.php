<?=$error?>
            
<!--<form action="uploads/do_upload" method="post">-->
<?php echo form_open_multipart('upload/do_upload');?>
    <?php
        $data_form = array (
            'name'=>'userfile'       
        );
        // <input type="file" name="userfile">
        echo form_upload($data_form);
    ?>
    <!--<input type="submit" >-->
    <?php echo form_submit('','Upload'); ?>

<!--</form>-->
<?php echo form_close(); ?>