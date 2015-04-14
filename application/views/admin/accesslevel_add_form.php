<h3>Add New Access Level</h3>
<br>
<?php
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
<?php echo form_open('admin/accesslevel/add') ?>
<p>
    <span> <?php echo form_label('Level Name'); ?> </span>
    <span>
        <?php 
            echo form_input(array(
                        'id'    =>  'name',
                        'name'  =>  'name',
                        'value' =>  ''
                    )); 
        ?>
    </span>
</p>    
<div>
    <p>
        <h3><?php echo form_label('Select user groups for access level'); ?></h3>
    
    <div>
        <?php 
            foreach($groupar as $group)
            {
                foreach($group as $key=>$value)
                {
                    
                
        ?>
        <p>
            <span>
        <?php
                echo form_checkbox(
                        array(
                            'id'    =>  'usergroups',
                            'name'  =>  'usergroups[]',
                            'value' =>  $key
                        )
                        );
        ?>
            </span><span>&nbsp;&nbsp;<?php echo $value; ?></span>
        </p>
        <?php 
                }
            }
        ?>
        <p>
            <span><?php echo form_submit('submit', 'Save'); ?></span>
        </p>
            
    </div>
</div>
<?php echo form_close(); ?>