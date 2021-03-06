<?php

/* 
 * the view file to show login form
 * @author  allshore resources
 * @ver     1.0.0
 * @date    01-04-2015
 */

if( !defined('BASEPATH') ) exit('No direct access allowed to this file');
echo validation_errors(); 
echo form_open('admin/login/verify');

?>
<div>
    <p>
        <span class="label"><?php echo form_label('User Name') ?>: </span><span>
            <?php 
               echo form_input( $data   =   array(
                    'name'  => 'username',
                    'id'    => 'username',
                    'value' => ''
                ) );

            ?>
        </span>
    </p>
    <p>
        <span class="label"><?php echo form_label('Password') ?></span>
        <span>
            <?php 
               echo form_password( $data   =   array(
                    'name'  => 'password',
                    'id'    => 'password',
                    'value' => ''
                ) );

            ?>
        </span>
    </p>
    <p>
        <?php echo form_submit('submit', 'Login')?>
    </p>
</div>
<?php
echo form_close();