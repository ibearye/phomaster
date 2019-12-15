<?php
/**
 * 归档
 *
 * @package custom
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>


<div class="page">
    <div class="page-header">
        <div class="page-heading align-center"><h1>Popular</h1></div>
        <div class="page-sub align-center">Here are the 6 most popular photos.<br>All articles are viewed <?php echo getPostsViews(); ?> times</div>
    </div>

    <div class="archive-populars">
        <?php $populars=getPopulars();foreach ($populars as $popular){ ?>
            <div class="archive-popular-single" style="background: url(<?php echo getThumb($popular['cid']);?>)">
                <a href="<?php echo $popular['permalink']; ?>">
                </a>
            </div>
        <?php }?>
    </div>



    <div class="page-header">
        <div class="page-heading align-center"><h1>Categories</h1></div>
        <?php $count=getCount();{ ?>
            <div class="page-sub align-center">There are <?php echo $count['posts']; ?> stories, <?php echo $count['categories']; ?> categories.</div>
        <?php }?>
    </div>
    <div class="archive-categories">
        <?php $this->widget('Widget_Metas_Category_List')->to($categories); ?>
        <?php while($categories->next()): ?>
            <div class="archive-category">
                <?php $thumbs=getCateRecentThumbs($categories->mid);if (count($thumbs)>=3){?>

                    <a href="<?php $categories->permalink(); ?>"><div class="archive-category-cover">
                        <div class="column-left" style="background: url(<?php echo $thumbs[0][0]['str_value']; ?>);"></div>
                        <div class="column-right">
                            <div class="column-top" style="background: url(<?php echo $thumbs[1][0]['str_value']; ?>);"></div>
                            <div class="column-bottom" style="background: url(<?php echo $thumbs[2][0]['str_value']; ?>);"></div>
                        </div>
                    </div></a>
                <?php }else{ ?>
                    <a href="<?php $categories->permalink(); ?>"><div class="archive-category-cover" style="background: url(<?php echo $thumbs[0][0]['str_value']; ?>);">
                    </div></a>
                <?php } ?>
                    <div class="archive-category-info">
                        <div class="archive-category-title"><a href="<?php $categories->permalink(); ?>"><?php $categories->name(); ?></a></div>
                        <p class="archive-category-meta"><?php echo $categories->count; ?> stories</p>
                    </div>

            </div>
        <?php endwhile; ?>
    </div>

</div>
