
    <div class="grid-item">
        <img src="<?php echo $this->fields->thumb ?>" alt="">
        <a href="<?php $this->permalink() ?>" target="_blank">
            <div class="item-info">
                <div class="views"><img src="<?php $this->options->themeUrl('static/img/views.svg'); ?>"><div><?php echo getViews($this); ?> Views</div></div>
                <div class="pics-count"><img src="<?php $this->options->themeUrl('static/img/count.svg'); ?>"><div><?php echo getPicsCount($this); ?> Pics</div></div>
                <div class="title"><img src="<?php $this->options->themeUrl('static/img/story-white.svg'); ?>"><div><?php $this->title(); ?></div></div>

            </div>
        </a>
    </div>