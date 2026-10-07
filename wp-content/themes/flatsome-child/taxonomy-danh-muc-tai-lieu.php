<?php get_header(); ?>

<div class="container tai-lieu-category">

    <h1 class="page-title">
        <?php single_term_title(); ?>
    </h1>

    <div class="tai-lieu-grid">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

                <div class="tai-lieu-item">
                    <a href="<?php the_permalink(); ?>">
                        
                        <div class="thumb">
                            <?php the_post_thumbnail('medium'); ?>
                        </div>

                        <h3><?php the_title(); ?></h3>

                    </a>
                </div>

            <?php endwhile; ?>
        <?php else : ?>
            <p>Không có tài liệu nào.</p>
        <?php endif; ?>
    </div>

    <div class="pagination">
        <?php the_posts_pagination(); ?>
    </div>

</div>

<?php get_footer(); ?>