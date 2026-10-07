<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */

?>
<section class="no-results not-found">
	<header class="page-title">
		<h1 class="page-title"><?php esc_html_e( 'Không tìm thấy', 'flatsome' ); ?></h1>
	</header>

	<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'flatsome' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Xin lỗi, không có gì phù hợp với từ khóa tìm kiếm của bạn. Vui lòng thử lại với một số từ khóa khác.', 'flatsome' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php esc_html_e( 'Xin lỗi, dường như chúng tôi không thể tìm thấy điều bạn đang tìm kiếm.', 'flatsome' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
</section>
