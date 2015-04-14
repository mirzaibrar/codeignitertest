<h4>Add Article Details</h4>
<?php
if(isset($error))
    echo $error['error'];
if(isset($message)){
    switch ($message)
    {
        case "success":
            echo "Article has been added successfully";
            break;
        case "db_fail":
            echo "There is some error while saving in to database, Please try again.";
            break;
        case "validate_fail":
            echo validation_errors();
            break;
        case "uploadfail":
            echo "There is some error uploading the file, please try again";
            break;
    }
}
?>
<?php echo $this->tinyMce;?>
<?php echo form_open_multipart('admin/articles/add')?>
<p>
    <span><?php echo form_label('News Title: '); ?></span><br>
    <span>
        <?php
            echo form_input( array(
                        'id'    =>   'title',
                        'name'  =>   'title',
                        'value' =>   $title    
                        )
                    );
        ?>
    </span>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span>
        <?php
            echo form_label('Access');
        ?>
    </span>
    &nbsp;&nbsp;<span>
        <?php
        
            foreach($acl as $level)
            {
                $id =   $level['id'];
                $option[$id]    =   $level['name'];
               
            } 
            echo form_dropdown('access', $option, 1);
        ?>
    </span>
</p>
<p>
    <span><?php echo form_label('News Excerpt: '); ?></span><br>
    <span>
        <?php
            echo form_textarea( array(
                        'id'    =>   'excerpt',
                        'name'  =>   'excerpt',
                        'value' =>   $excerpt    
                        )
                    );
        ?>
    </span>
</p>

<p style="width:700px;">
    <span><?php echo form_label('News detail: '); ?></span>
    <span>
        <?php
            echo form_textarea( array(
                        'id'    =>   'content',
                        'name'  =>   'content',
                        'class' => 'content_editor',
                        'value' =>   ''    
                        )
                    );
            // echo $this->load->view('wysiwyg', base_url(), true);
        ?>
    </span>
    
</p>
<p>
     <span><?php echo form_label('News Image: '); ?></span>
     <span>
         <input type="file" name="userfile">
     </span>
</p>
<p>
    <?php echo form_submit("submit", "Submit"); ?>
</p>
<?php    echo form_close() ?>