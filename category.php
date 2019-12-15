<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="container">
    <div class="category-header">
        <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
            <?php while($categorys->next()): ?>
                <?php if ($this->is('category', $categorys->slug)){ ?>
                    <div class="category-heading"><h1><?php $categorys->name();?></h1></div>
                    <div class="category-description"><?php $categorys->description(); ?></div>
                    <div class="category-count">
                        <img src="<?php $this->options->themeUrl('static/img/story.svg'); ?>">
                        <div class="category-info">
                            <?php $categorys->count(); ?> Stories
                        </div>
                    </div>
                <?php }?>
            <?php endwhile; ?>
    </div>
    <div class="articles" id="grid">
        <?php while ($this->next()): $this->need('content.php');?>
        <?php endwhile; ?>
    </div>
    <div class="lists-navigator clearfix">
        <?php $this->pageLink('Load More','next'); ?>
    </div>
    <script src="<?php $this->options->themeUrl('static/js/grids.js'); ?>"></script>
    <script src="<?php $this->options->themeUrl('static/js/loading.js'); ?>"></script>

    <script>
        var macy = Macy({
            container: '#grid',
            trueOrder: false,
            waitForImages: false,
            margin: 20,
            columns: 3,
            breakAt: {
                920: 2,
                620: 1
            }
        });
    </script>
</div>


<?php $this->need('footer.php');?>
