<div class="banner" style="background: url(<?php echo $this->options->banner; ?>)">
    <div class="banner-content">
        <div class="banner-heading"><?php $this->options->title() ?></div>
        <div class="banner-description"><?php echo $this->options->bannerDescription; ?></div>
        <?php $count=getCount();{ ?>
        <div class="site-data">
            <div class="banner-column banner-column-left"><?php echo $count['posts']; ?><p>Stories</p></div>
            <div class="banner-column banner-column-center"><?php echo $count['categories']; ?><p>Categories</p></div>
            <div class="banner-column banner-column-right"><?php echo getPostsViews(); ?><p>Views</p></div>
        </div>
        <?php }?>
    </div>
    <div class="banner-info">
        <div class="week"><?php echo $this->options->bannerInfo; ?></div>
    </div>
</div>