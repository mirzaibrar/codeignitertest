<h3> Edit News </h3>
<?php
//if( isset( $message ) )
//{
//    switch ( $message )
//    {
//        case "success":
//            echo "Thank you, your news has been added successfully <a href='../news'>Click Here</a> to go back";
//            break;
//        case "failed":
//            echo "Sorry, There is some error while inserting, please contact web master";
//            break;
//        default:
//            echo "";
//            break;
//    }
//}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    $hidden =   array('id'  =>  $news_item['id']);
    echo form_open('news/update_news','', $hidden);
    
?>
<p>
    <span><?php echo form_label('News Heading') ?>: </span><span>
        <?php 
           echo form_input( $data   =   array(
                'name'  => 'heading',
                'id'    => 'newshead',
                'value' => strip_slashes($news_item['title'])
            ) );
            
        ?>
    </span>
</p>    
<p>
    <span><?php echo form_label('News Detail') ?>: </span><span>
        <?php 
           echo form_textarea( $data   =   array(
                'name'  => 'body',
                'id'    => 'newsbody',
                'value' => strip_slashes($news_item['detail']),
                'rows'  =>  '10',
                'cols'  =>  '50'
            ) );
            
        ?>
    </span>
</p>    

<?php
    echo form_submit('mysubmit', 'Update News');
    echo form_close();
?>