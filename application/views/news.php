<style>
    p{
        font-family: arial, sans-serif;
        font-size: 12px;
    }
    a{
        text-decoration: none;
    }
    p span a strong{
        color:#990000;
    }
</style>
<p><a href="news/add_news">Add News</a></p>
<script>
// assumes you're using jQuery
$(document).ready(function() {
    
$('.confirm-div').hide();
<?php if($this->session->flashdata('msg')){ ?>
$('.confirm-div').html("<?php echo $this->session->flashdata('msg'); ?>").show();
});
<?php } ?>
</script>
<div class="confirm-div"></div>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//if( isset( $message ) )
//{
//    switch ( $message )
//    {
//        case "success":
//            echo "<div class='confirm-div'>News has been deleted successfully</div>";
//            break;
//        case "failed":
//            echo "<div class='confirm-div'>Sorry, There is some error while deleting, please contact web master</div>";
//            break;
//        default:
//            echo "";
//            break;
//    }
//}
//echo "<pre>";print_r($news);
    foreach($news as $newsrow){
?>
<P><span><a href="news/<?php echo $newsrow['slug']; ?>"> <strong><?php echo $newsrow['title']; ?></strong></a> </span>&nbsp;&nbsp;<span><a href="news/edit_news/<?php echo $newsrow['id']; ?>">Edit</a> - <a href="news/delete_news/<?php echo $newsrow['id'] ?>">Delete</a></span></p>

<?php } ?>
