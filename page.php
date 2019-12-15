<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>


<?php getViews($this); ?>
<div class="page">
    <div class="page-header">
        <div class="page-heading"><h1><?php $this->title();?></h1></div>
    </div>

    <div class="page-content">
        <?php $this->content(); ?>
    </div>

</div>
