<?php
/**
 *  Typecho 图片主题
 *
 * @package Phomaster
 * @author Bearye
 * @version 1.0
 * @link https://nooooe.cn
 */

if (!defined('__TYPECHO_ROOT_DIR__')) exit;
$this->need('header.php');
?>

<div class="container">
    <?php if (!$this->is('category')) $this->need('banner.php');?>
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
