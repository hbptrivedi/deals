<?php
// Return early if no widget found.
if ( ! is_active_sidebar( 'secondary' ) ) {
	return;
}

// Return early if user uses 1 column and 2 columns layout.
if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c', '2c-l', '2c-r' ) ) ) {
	return;
}
?>

<div class="widget-area sidebar2 column" role="complementary" aria-label="<?php echo esc_attr_x( 'Secondary Sidebar', 'Sidebar aria label', 'daily' ); ?>" <?php hybrid_attr( 'sidebar', 'secondary' ); ?>>
	<?php dynamic_sidebar( 'secondary' ); ?>
</div><!-- #secondary -->