<div style="float:left;width:600px;">
<?php
    foreach($contentlist as $article)
    {
?>
<p>
    <img src="<?php echo base_url()?>/uploads/<?php echo $article['image'] ?>" align="left" width="100">
<?php
        echo anchor('front/detail', $article['title'])."<BR>";
        echo $article['excerpt'];
    }
?>
</p>
</div>
<div style="float:right;width:300px;">
<?php
    $this->load->view('right');
?>
</div>