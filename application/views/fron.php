<?php
    foreach($contentlist as $article)
    {
        echo anchor('front/detail', $article['title'])."<BR>";
    }
?>
