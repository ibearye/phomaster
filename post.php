<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>


<?php getViews($this); ?>
<div class="article">
    <div class="article-header">
        <div class="article-heading"><h1><?php $this->title();?></h1></div>
        <div class="article-description"><?php echo $this->fields->storyDescription; ?></div>
        <div class="article-cate"><?php $this->category(''); ?></div>
    </div>

    <div class="article-content">
        <?php $this->content(); ?>
    </div>

    <div class="article-meta">
        <div class="article-meta-author"><?php $this->author->gravatar('45') ?><div><?php $this->author(); ?></div></div>
        <div class="article-meta-date"><?php $this->date('M d, Y');?></div>

    </div>

</div>

<?php $this->need('footer.php');?>
