|<h4> <?php echo anchor('/admin/user/add_user', 'Add New User');?> </h4>
<script>
    $(document).ready(function(){
        $('#flashmsg').hide();
       
    <?php if($this->session->flashdata('msg'))    { ?>
            
            $('#flashmsg').html('<?php echo $this->session->flashdata('msg'); ?>');
            $('#flashmsg').fadeIn("slow", function(){
                setTimeout(function(){
                        $('#flashmsg').fadeOut("slow", function(){
                            $('#flashmsg').hide();
                        });
                }, 3000);
            });
    <?php } ?>    
    });
</script>
<div id="flashmsg"></div>
<?php

$this->table->set_heading(array('Name', 'username', 'email', '<a href="/cdign/admin/user/filter/status/1">Active</a>/<a href="/cdign/admin/user/filter/status/0">Inactive</a>', 'Group', 'ID','' ));

foreach($users as $user)
{
    $full_name   =   $user['firstname']." ".$user['lastname'];
    $status =   ($user['status']) ? "Active" : "Inactive" ;
    $group  =   $user['groupname'];
    $this->table->add_row(
                array(
                    '<a href="user/edit_user/'.$user['uid'].'">'.$full_name.'</a>',
                    $user['username'],
                    $user['email'],
                    $status,
                    $group,
                    $user['uid'],
                    '<a href="user/edit_user/'.$user['uid'].'">Edit</a>-<a href="user/delete_user/'.$user['uid'].'">Delete</a>'
                )
            );
}
echo $this->table->generate();