<center>
<h3> Your file was successfully uploaded !!</h3>

<ul>
        <?php foreach($upload_data as $key=>$value) {?>
        <li><?=$key?> : <?=$value?> </li>
     <?php } ?>
</ul>

<img src="<?=base_url()?>uploads/<? echo $upload_data['file_name']?>" width="150" height="150"/>
<p>You also can
<a href="<?=base_url()?>upload">Upload another file</a>
OR
<a href="<?=base_url()?>">Go on home page</a>
</p>

</center>