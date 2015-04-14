<?php
echo anchor('admin/groups/add', 'Add New Group');
?>
<p></p>
<p></p>
<?php
if(!defined('BASEPATH')) die('Direct access to this file is not allowed');


/*foreach($groups as $group)
{    $groupname =   anchor('admin/groups/edit/'.$group['id'], $group['groupname']);
    $this->table->add_row(array($groupname, $group['id']));
}*/
echo $groupstr;

