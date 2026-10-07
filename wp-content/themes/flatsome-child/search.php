<?php get_header(); ?>

<div id="content" class="blog-wrapper blog-archive page-wrapper amen-123">
    
    <header class="archive-header m-bottom-20 p-top-20">
        <div class="row">
            <div class="col large-12 text-center">
                <h1 class="page-title is-large uppercase fw-bold">
                    <?php printf( __( 'Kết quả tìm kiếm cho: %s', 'flatsome' ), '<span>' . get_search_query() . '</span>' ); ?>
                </h1>
                <div class="is-divider medium center"></div>
            </div>
        </div>
    </header>

    <div class="row">
        <div class="col large-12">
            <?php if ( have_posts() ) : ?>
                
                <div class="row large-columns-3 medium-columns-2 small-columns-1 search-grid row-small row-divider">
                    
                    <?php while ( have_posts() ) : the_post(); ?>
                        <div class="col">
                            <?php get_template_part( 'template-parts/posts/content', 'search-card' ); ?>
                        </div>
                    <?php endwhile; ?>
                    
                </div>
                
                <div class="p-top-20 m-bottom-20 text-center">
                    <?php flatsome_posts_pagination(); ?>
                </div>

            <?php else : ?>
                <div class="text-center p-top-20 m-bottom-20">
                    <h3>Không tìm thấy nội dung phù hợp.</h3>
                    <p>Vui lòng thử lại với từ khóa khác.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>