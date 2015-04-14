<h3> Add News </h3>
<?php
if( isset( $message ) )
{
    switch ( $message )
    {
        case "success":
            echo "Thank you, your news has been added successfully <a href='../news'>Click Here</a> to go back";
            break;
        case "failed":
            echo "Sorry, There is some error while inserting, please contact web master";
            break;
        case "uploaderror":
            if( $file_error )
            {
                
                foreach($file_error as $error)
                {
                    echo $error." <br> ";
                }    
            }    
        default:
            echo "";
            break;
    }
}

    echo form_open_multipart('news/insert_news');
?>
<p>
    <span><?php echo form_label('News Heading') ?>: </span><span>
        <?php 
           echo form_input( $data   =   array(
                'name'  => 'heading',
                'id'    => 'newshead',
                'value' => 'News heading here...'
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
                'value' => 'News body here...',
                'rows'  =>  '10',
                'cols'  =>  '50'
            ) );
            
        ?>
    </span>
</p>    
<p> <span><?php echo form_label('News Image') ?>: </span>
    <span><input type="file" name="userfile"></span>
</p>    
<?php
    echo form_submit('mysubmit', 'Insert News');
    echo form_close();
?>