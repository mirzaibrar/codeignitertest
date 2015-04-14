<h2>Edit User</h2>
<?php
if(isset($etype))
{
switch ($etype)
            {
                case "passfailed":
                    echo "Passwords doesn't match, please try again";
                    break;
                case "emailfailed":
                    echo "You have provided an invalid email address, Please provide a valid email address";
                    break;
                case "userexist":
                    echo "Username already exists please try different username";
                    break;
                default :
                    echo "";
                    break;
            }
}            
$this->load->helper('form');
$hidden =   array('id' => $id);
   echo form_open('admin/user/update_user','', $hidden);
?>
<p>
    <span><?php echo form_label('First Name'); ?>: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><?php echo form_input(
                    $data   =   array(
                        'name'  =>  'firstname',
                        'id'    =>  'firstname',
                        'value' =>  $firstname
                    )
                ); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_label('Last Name'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><?php echo form_input(
                    $data   =   array(
                        'name'  =>  'lastname',
                        'id'    =>  'lastname',
                        'value' =>  $lastname
                    )
                ); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_label('Login Name'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><?php echo form_input(
                    $data   =   array(
                        'name'  =>  'username',
                        'id'    =>  'username',
                        'value'  =>  $username
                    )
                ); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_label('Password'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><?php echo form_password(
                    $data   =   array(
                        'name'  =>  'password',
                        'id'    =>  'password'
                    )
                ); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_label('Confirm Password'); ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><?php echo form_password(
                    $data   =   array(
                        'name'  =>  'cpassword',
                        'id'    =>  'cpassword'
                    )
                ); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_label('Email'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
    <span><?php echo form_input(
                    $data   =   array(
                        'name'  =>  'email',
                        'id'    =>  'email',
                        'value' =>  $email
                    )
                ); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_label('Activae'); ?></span>
    
    <?php 
    $checked    =   "";
    $data   =   array('name'  =>  'activate', 'value'  =>  '0' );
    
    if($status){
        $data['checked']=TRUE;
    } 
    ?>
    <span><?php echo form_checkbox(
                    $data
                ); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_label('User Group'); ?></span>
    <?php
    $options    =   array();
        foreach($groups as $group)
        {
            
            $id =   $group['id'];
              $options[$id]  = $group['groupname'];
            
        }
    ?>
    <span><?php echo form_dropdown('group', $options, $groupid); 
            ?>
    </span>
</p>
<p>
    <span><?php echo form_submit('submit', 'Submit'); 
            ?>
    </span>
</p>
<?php
    echo form_close();
?>    