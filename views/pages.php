<?php
/* View para las paginas en general. */
include_once('config.php');
include_once('class/class.database.php');
include_once('class/class.sitio.php');

$site = new sitio();

$page = $site->getPage($_GET['pid']);
?>
<div class="container pages">
    <div class="page-header">
        <h1><?php echo $page[0]->page_title;?></h1>
    </div>
    <div>
        <?php echo $page[0]->page_content;?>
    </div>
    <br>
    <?php
if($page[0]->page_view != '' && file_exists('views/'.$page[0]->page_view))
        require_once('views/'.$page[0]->page_view);
    ?>
</div>