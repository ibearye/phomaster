<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<!DOCTYPE HTML>
<html  lang="zh-CN">
<head>
    <meta http-equiv="Content-Type" charset="<?php $this->options->charset(); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?php if($this->is('index')):?>
        <title><?php $this->options->title() ?></title>
    <?php else:?>
        <title><?php $this->archiveTitle(array('category' => _t('%s'), 'search' => _t('Search Results for "%s"'), 'tag' => _t('%s'), 'author' => _t('%s的文章')), '', ' - '); ?><?php $this->options->title(); ?></title>
    <?php endif;?>
    <link rel="stylesheet" href="<?php $this->options->themeUrl('style.css'); ?>">
    <link type="image/vnd.microsoft.icon" href="<?php echo $this->options->favicon(); ?>" rel="shortcut icon">
    <script src="<?php $this->options->themeUrl('static/js/jquery.min.js'); ?>"></script>


    <!-- 通过自有函数输出HTML头部信息 -->
    <?php $this->header(); ?>
</head>
<body>

<header>
    <div class="header-top">
        <div class="logo">
            <a href="<?php $this->options->siteUrl(); ?>">
                <img src="<?php $this->options->logo() ?>" alt="">
                <div class="site-name"><?php $this->options->title() ?></div>
            </a>
        </div>
        <div class="nav">
            <ul>
                <?php $this->widget('Widget_Contents_Page_List')->parse('<a class="subnav-item" href="{permalink}"><li  class="subnav-li">{title}</li></a>'); ?>
            </ul>

            <?php if ($socials=getSocials()){?>
                <ul class="socials">
                    <div class="slide"></div>
                    <?php foreach ($socials as $key => $value){?>
                        <li>
                            <a href="<?php echo $value ?>" target="_blank">
                                <img class="social-icon" src="<?php $this->options->themeUrl('static/img/'.$key.'.svg'); ?>">
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php }?>
        </div>
    </div>
    <?php if ($this->is('index') || $this->is('category')){?>
        <div class="header-bottom">
            <div class="categories-container">
                <div class="categories">
                    <?php $this->widget('Widget_Metas_Category_List')->to($categorys); ?>
                    <?php if ($categorys->have()): ?>
                        <ul class="categories-list">
                            <?php if ($this->is('category')){ ?>
                                <li><a href="/"><div class="categories-single">All Stories</div></a></li>
                            <?php }else{?>
                                <li><a href="/"><div class="categories-single category-current">All Stories</div></a></li>
                            <?php } ?>
                            <li class="slide"></li>
                            <?php while($categorys->next()): ?>
                                <?php if ($this->is('category', $categorys->slug)){ ?>
                                    <li>
                                        <a href="<?php $categorys->permalink();?>" title="<?php $categorys->count(); ?> 个话题">
                                            <div class="categories-single category-current">
                                                <?php $categorys->name();?>
                                            </div>
                                        </a>
                                    </li>
                                <?php }else{ ?>
                                    <li>

                                        <a href="<?php $categorys->permalink();?>"><div class="categories-single"><?php $categorys->name();?></div></a>

                                    </li>
                                <?php }?>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif;?>
                </div>
            </div>
        </div>
    <?php }?>
</header>
