<div class="post-header-custom">

    <!-- Title -->
    <h1 class="post-title details-post-title">
        <?php the_title(); ?>
    </h1>
 <!-- Category -->
    <div class="post-categories" style="display:none">
        <?php the_category('  '); ?>
    </div>

    <!-- Meta -->
    <div class="post-meta">
        <span class="post-author">
            Tác giả: <?php the_author(); ?>
        </span>

        <span class="post-date- custom">
            | Ngày đăng: <?php echo get_the_date(); ?>
        </span>
    </div>

</div>
<div class="entry-content single-page">

	<?php the_content(); ?>

	<?php
	wp_link_pages();
	?>	
	
</div>
