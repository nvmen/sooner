<div class="col-inner">
    <div class="box box-text-bottom box-blog-post has-hover">
        <div class="box-image">
            <div class="image-cover" style="padding-top:56%;">
                <?php the_post_thumbnail('medium'); ?>
            </div>
        </div>
        <div class="box-text text-left">
            <div class="box-text-inner">
                <h5 class="post-title uppercase"><?php the_title(); ?></h5>
                <div class="is-divider small"></div>
                <p class="from_the_blog_excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <a href="<?php the_permalink(); ?>" class="button is-outline is-small">Xem thêm</a>
            </div>
        </div>
    </div>
</div>