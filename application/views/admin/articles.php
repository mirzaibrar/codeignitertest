<h4><?php echo anchor('admin/articles/add','Add New Article'); ?></h4>

<?php 

$this->table->set_heading(array('ID', 'Title', 'Operation'));
foreach($articles as $article)
{
    $title  =   anchor('admin/articles/edit/'.$article['id'], $article['title']);   
    $this->table->add_row(
        $article['id'],
        $title,
        'Edit-Delete'
        );
}
echo $this->table->generate();
