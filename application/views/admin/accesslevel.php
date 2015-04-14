<h3><?php echo anchor('admin/accesslevel/add', 'Add New Level'); ?></h3>
<?php
    foreach($levels as $level)
    {
?>
<p>
<?php
        echo anchor('admin/accesslevel/edit/'.$level['id'], $level['name']);
    }
?>
</p>