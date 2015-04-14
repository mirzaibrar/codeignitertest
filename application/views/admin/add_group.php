<h3>User Group Details</h3>
<?php
if(isset($gerror)){
    switch ($gerror)
    {
        case "exist":
            echo "This user group already exists, please try different name";
            break;
        case "success":
            echo "User group is added successfully";
            break;
        case "failed":
            echo "There is some error while saving. Please try again";
            break;
        default :
            break;
           
    }
}
?>
<?php
    echo form_open('admin/groups/insert');
?>
<p>
    <span><?php echo form_label('Group Name'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
    <span>
        <?php
        echo form_input(
                array(
                    'name'  =>  'groupname',
                    'id'    =>  'groupname',
                    'value' =>  ''
                )
        );
        ?>
    </span>
</p>
<p>
    <span><?php echo form_label('Parent'); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;
    <span>
        <?php
            $options =  array();
            foreach($groups as $group)
            {
                $id =   $group['id'];
                $options[$id]    =   $group['groupname'];
            }
            echo form_dropdown('parent', $options);
        ?>
    </span>
</p>
<p>
    <span>
        <?php
               echo form_submit('submit',  'Submit');
        ?>
    </span>
</p>
<?php
    echo form_close();
?>
