<h2> Register</h2>
            <center>
<?php if($errors){ 
    echo "<p style='background:red;'>".$errors."</p>" ;
}  ?>


<?php echo form_open(base_url().'users/register'); ?>
    <p> <!-- username input -->
        <?php
        $data_format = array(
            'name'          =>  'username',
            'placeholder'   =>  'username',
            'style'         =>  'border:1px solid black',
            'value'         =>  set_value('username')
            );
        echo form_input($data_format);
        ?>
    </p>
     <p> <!-- email input-->
        <?php
            $data_format = array(
            'name'          =>  'email',
            'placeholder'   =>  'email',
            'style'         =>  'border:1px solid black',
            'value'         =>  set_value('email')
            );
        echo form_input($data_format);
        ?>
        
    </p>
    
    <p> <!-- password input-->
        <?php
            $data_format = array(
            'name'          =>  'password',
            'placeholder'   =>  'password',
            'style'         =>  'border:1px solid black',
            'value'         =>  set_value('password')
            );
        echo form_password($data_format);
        ?>
        
    </p>
     <p> <!-- confirm password input-->
        <?php
            $data_format = array(
            'name'          =>  'password2',
            'placeholder'   =>  'confirm password',
            'style'         =>  'border:1px solid black'
            );
        echo form_password($data_format);
        ?>
        
    </p>
    
    <p>  <!-- dropdown yser_type-->
       <?php
       $options = array(
                        ''       => '====',
                        'admin'  => 'Admin',
                        'user'   => 'User',
                        'author' => 'Author'   
                        );
       $js = "id='user_type' ";
       echo form_dropdown('user_type',$options,set_value('user_type'),$js);
        ?>
       <!-- <select name="user_type">
            <option selected="selected" >===</option>
            <option value="user"> User</option>
            <option value="author"> Author</option>
        </select>-->
        
        
    </p>
    
    <p><?php echo form_submit("","Register"); ?></p>
<?php echo form_close(); ?>
            </center>