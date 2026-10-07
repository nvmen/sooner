<div class="col-inner">
    <a href="<?php the_permalink(); ?>" class="plain">
        <div class="box box-search-card has-hover no-divider" style="background-color: #fff; border: 1px solid #ececec; border-radius: 8px; overflow: hidden; height: 100%; display: flex; flex-direction: column;">
            
            <div class="box-image" style="position: relative; overflow: hidden;">
                <div class="image-cover" style="padding-top: 60%;"> <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail('medium', array('style' => 'position: absolute; top:0; left:0; width:100%; height:100%; object-fit: cover; transition: transform .3s;')); ?>
                    <?php else : ?>
                        <img src="https://via.placeholder.com/600x400?text=No+Image" style="position: absolute; top:0; left:0; width:100%; height:100%; object-fit: cover;" />
                    <?php endif; ?>
                </div>
            </div>

            <div class="box-text text-left" style="padding: 20px; flex-grow: 1; display: flex; flex-direction: column;">
                <div class="box-text-inner" style="display: flex; flex-direction: column; height: 100%;">
                    
                    <p class="is-xsmall uppercase op-5 m-bottom-5" style="font-size: 10px; color: #cb2027; font-weight: bold;">
                        <?php echo get_post_type(); ?>
                    </p>

                    <h5 class="post-title m-top-0 m-bottom-10" style="font-size: 16px; line-height: 1.4; font-weight: 700; color: #333;">
                        <?php the_title(); ?>
                    </h5>

                    <div class="is-divider small m-bottom-10 m-top-10" style="background-color: rgba(0,0,0,.05); height: 1px;"></div>
                    <p class="from_the_blog_excerpt op-8" style="font-size: 13px; line-height: 1.6; color: #666;">
                        <?php echo wp_trim_words( get_the_excerpt(), 20, '...' ); ?>
                    </p>
                    
                    <div style="margin-top: auto; padding-top: 15px;">
                        <span class="button is-outline is-smaller uppercase fw-bold" style="border-radius: 4px;">Xem chi tiết</span>
                    </div>

                </div>
            </div>
        </div>
    </a>
</div>