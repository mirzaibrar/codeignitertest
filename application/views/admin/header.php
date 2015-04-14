<!DOCTYPE html>
<html>
    <head>
        <title>Welcome Admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.0.0.min.js"></script>
    </head>
        <?php //echo link_tag('css/style.css'); ?> 
    <body>
        <div style="text-align: right;"><div><?php echo anchor('/admin/dashboard', 'Dashboard');?> - <?php echo anchor('/admin/logout', 'Logout');?></div></div>