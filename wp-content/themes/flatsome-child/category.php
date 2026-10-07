<?php get_header(); ?>

<div class="container category-page custom-page-cate">

<header class="category-header">
<h1 class="category-title"><?php single_cat_title(); ?></h1>
<p class="category-description"><?php echo category_description(); ?></p>
</header>

<?php if (have_posts()) : ?>

<div class="category-post-grid">

<?php while (have_posts()) : the_post(); ?>

<article class="category-card">

<a href="<?php the_permalink(); ?>">

<?php if(has_post_thumbnail()) : ?>
<div class="category-card-image">
<?php the_post_thumbnail('medium_large'); ?>
</div>
<?php endif; ?>

<div class="category-card-content">

<h2 class="category-card-title">
<?php the_title(); ?>
</h2>

<div class="category-card-meta">
<?php echo get_the_date(); ?>
</div>

</div>

</a>

</article>

<?php endwhile; ?>

</div>

<?php the_posts_pagination(); ?>

<?php endif; ?>

</div>

<?php get_footer(); ?>