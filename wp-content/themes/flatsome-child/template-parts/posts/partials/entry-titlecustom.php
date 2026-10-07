<?php
/**
 * Post-entry title.
 *
 * @package          Flatsome\Templates
 * @flatsome-version 3.16.0
 */


?>

<?php
$single_post = is_singular( 'post' );
if ( $single_post ) : ?>
	<div class="entry-meta is-xsmall rx-0">

	</div>
<?php elseif ( ! $single_post && 'post' == get_post_type() ) : ?>
	<div class="entry-meta uppercase is-xsmall rx-1">
		<?php flatsome_posted_on(); ?>
	</div>
<?php endif; ?>
