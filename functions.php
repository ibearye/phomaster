<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

function themeConfig($form) {
    $siteUrl = Helper::options()->siteUrl;

    //favicon图标
    $favicon = new Typecho_Widget_Helper_Form_Element_Text('favicon', NULL, $siteUrl.'usr/themes/phomaster/static/img/logo.png', _t('Favicon图标'), _t('显示在浏览器标签上'));
    $form->addInput($favicon);

    //logo
    $logo = new Typecho_Widget_Helper_Form_Element_Text('logo', NULL, $siteUrl.'usr/themes/phomaster/static/img/logo.png', _t('Logo'));
    $form->addInput($logo);

    //home banner
    $bannerDescription = new Typecho_Widget_Helper_Form_Element_Text('bannerDescription', NULL, 'This is a wonderful theme for photography. Now is the time to show your life.', _t('首页描述'), _t('首页大图上显示的描述文字'));
    $form->addInput($bannerDescription);

    //home banner
    $banner = new Typecho_Widget_Helper_Form_Element_Text('banner', NULL, $siteUrl.'usr/themes/phomaster/static/img/banner.jpg', _t('首页图'), _t('请输入首页要显示的图片URL地址'));
    $form->addInput($banner);

    //banner info
    $bannerInfo = new Typecho_Widget_Helper_Form_Element_Text('bannerInfo', NULL, 'Oct 27, 2018, <a href="https://nooooe.cn">Bearye</a> shot this photo and published on <a href="https://photos.nooooe.cn">Phomaster</a>', _t('首页图信息'), _t('首页图的相关信息，支持html文本'));
    $form->addInput($bannerInfo);

    //Copyright
    $copyright = new Typecho_Widget_Helper_Form_Element_Text('copyright', NULL, '', _t('版权信息'), _t('版权信息，支持html文本'));
    $form->addInput($copyright);

    //Social Github
    $socialGithub = new Typecho_Widget_Helper_Form_Element_Text('socialGithub', NULL, '', _t('社交 >> Github'), '输入Github URL（为空则不显示）');
    $form->addInput($socialGithub);

    //Social QQ
    $socialQQ = new Typecho_Widget_Helper_Form_Element_Text('socialQQ', NULL, '', _t('社交 >> QQ'), '输入QQ URL 地址（为空则不显示）');
    $form->addInput($socialQQ);

    //Social Wechat
    $socialWechat = new Typecho_Widget_Helper_Form_Element_Text('socialWechat', NULL, '', _t('社交 >> 微信'), '微信 URL 地址（为空则不显示）');
    $form->addInput($socialWechat);

    //Social Sina
    $socialSina = new Typecho_Widget_Helper_Form_Element_Text('socialSina', NULL, '', _t('社交 >> Sina微博'), 'Sina微博个人主页URL（为空则不显示）');
    $form->addInput($socialSina);

    //Social Douban
    $socialDouban = new Typecho_Widget_Helper_Form_Element_Text('socialDouban', NULL, '', _t('社交 >> 豆瓣'), '豆瓣个人主页URL（为空则不显示）');
    $form->addInput($socialDouban);

    //Social Zhihu
    $socialZhihu = new Typecho_Widget_Helper_Form_Element_Text('socialZhihu', NULL, '', _t('社交 >> 知乎'), '知乎URL（为空则不显示）');
    $form->addInput($socialZhihu);
}

function getSocials(){

    $Github=Helper::options()->socialGithub;
    $QQ=Helper::options()->socialQQ;
    $Wechat=Helper::options()->socialWechat;
    $Sina=Helper::options()->socialSina;
    $Douban=Helper::options()->socialDouban;
    $Zhihu=Helper::options()->socialZhihu;

    $socials=Array();

    if (!empty($Github)){
        $socials['github']=$Github;
    }
    if (!empty($QQ)){
        $socials['qq']=$QQ;
    }
    if (!empty($Wechat)){
        $socials['wechat']=$Wechat;
    }
    if (!empty($Sina)){
        $socials['sina']=$Sina;
    }
    if (!empty($Douban)){
        $socials['douban']=$Douban;
    }
    if (!empty($Zhihu)){
        $socials['zhihu']=$Zhihu;
    }

    return $socials;
}

//给文章添加自定义字段
function themeFields($layout) {
    $thumb = new Typecho_Widget_Helper_Form_Element_Text('thumb', NULL, NULL, _t('特色图片'), _t('在这里填上特色图片的url'));
    $layout->addItem($thumb);


    $storyDescription = new Typecho_Widget_Helper_Form_Element_Text('storyDescription', NULL, NULL, _t('故事描述'), _t('这个故事的描述'));
    $layout->addItem($storyDescription);

}

//custom tags function
function getCategoriesCount(){
    $db = Typecho_Db::get();
    $res = $db->fetchAll($db->select()
        ->from('table.metas')
        ->where('table.metas.type= ?', 'category'));
    $count = count($res);
    return $count;
}



//get count (posts/tags/categories)
function getCount(){
    $db = Typecho_Db::get();
    $posts = $db->fetchAll($db->select()->from('table.contents')->where('table.contents.type= ?', 'post'));
    $tags = $db->fetchAll($db->select()->from('table.metas')->where('table.metas.type= ?', 'tag'));
    $categories = $db->fetchAll($db->select()->from('table.metas')->where('table.metas.type= ?', 'category'));
    $count['posts']=count($posts);
    $count['tags']=count($tags);
    $count['categories']=count($categories);
    return $count;
}

//view count
function getViews($archive)
{
    $cid    = $archive->cid;
    $db     = Typecho_Db::get();
    $prefix = $db->getPrefix();
    if (!array_key_exists('views', $db->fetchRow($db->select()->from('table.contents')))) {
        $db->query('ALTER TABLE `' . $prefix . 'contents` ADD `views` INT(10) DEFAULT 0;');
        echo 0;
        return;
    }
    $row = $db->fetchRow($db->select('views')->from('table.contents')->where('cid = ?', $cid));
    if ($archive->is('single')) {
        $views = Typecho_Cookie::get('extend_contents_views');
        if(empty($views)){
            $views = array();
        }else{
            $views = explode(',', $views);
        }
        if(!in_array($cid,$views)){
            $db->query($db->update('table.contents')->rows(array('views' => (int) $row['views'] + 1))->where('cid = ?', $cid));
            array_push($views, $cid);
            $views = implode(',', $views);
            Typecho_Cookie::set('extend_contents_views', $views); //记录查看cookie
        }
    }
    return $row['views'];
}

//posts views count
function getPostsViews(){
    $db = Typecho_Db::get();
    $res = $db->fetchAll($db->select('table.contents.views')
        ->from('table.contents')
        ->where('table.contents.type= ?', 'post'));
    $views=0;
    foreach ($res as $key => $value){
       $views+=$value['views'];
    }
    return $views;
}

function getCateRecentThumbs($mid){
    $db = Typecho_Db::get();
    $res = $db->fetchAll($db->select('table.relationships.cid')
        ->from('table.relationships')
        ->where('table.relationships.mid= ?', $mid)
        ->limit(3));

    $thumbs=[];

    foreach ($res as $value){
        $thumb=$db->fetchAll($db->select('table.fields.str_value')
            ->from('table.fields')
            ->where('table.fields.cid= ?', $value)
            ->where('table.fields.name= ?', 'thumb')
            ->limit(1));
        array_push($thumbs,$thumb);
    }
    return $thumbs;
}

//most popular
function getPopulars(){
    $db = Typecho_Db::get();

    $posts = $db->fetchAll($db->select()
        ->from('table.contents')
        ->where('table.contents.type = ?', 'post')
        ->order('table.contents.views', Typecho_Db::SORT_DESC)
        ->limit(6));

    $populars = [];
    foreach ($posts as $post) {
        $populars[] = Typecho_Widget::widget('Widget_Abstract_Contents')
            ->push($post);
    }
    return $populars;
}

//custom thumb
function getThumb($cid){
    $db = Typecho_Db::get();
    $thumb=$db->fetchAll($db->select('table.fields.str_value')
        ->from('table.fields')
        ->where('table.fields.cid= ?', $cid)
        ->where('table.fields.name= ?', 'thumb')
        ->limit(1));
    return $thumb[0]['str_value'];
}

function getPicsCount($post) {
    preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $post->content, $matches );  //通过正则式获取图片地址
    return count($matches[1]);
}

