<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

echo '<h2>'.strip_slashes($news['title']).'</h2>';
?>

<p> <img src="<?php  echo base_url()."uploads/".$news['image'] ?>" align="right"><?php echo strip_slashes($news['detail']); ?></p>