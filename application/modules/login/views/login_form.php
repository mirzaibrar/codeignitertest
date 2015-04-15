<?php

/* 
 * the view file to show login form
 * @author  allshore resources
 * @ver     1.0.0
 * @date    01-04-2015
 */

if( !defined('BASEPATH') ) exit('No direct access allowed to this file');
echo validation_errors(); 
echo form_open('login/verify');

?>
<div style="background-color:#f6f6f6; padding:20px 0 20px 10px; width: 300px;">
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
        <span class="label"><?php echo form_label('Password') ?>&nbsp;&nbsp;&nbsp;&nbsp;</span>
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
    <p style="float:right; margin-right:45px;">
        <?php echo form_submit('submit', 'Login')?>
    </p>
</div>
<?php
echo form_close();