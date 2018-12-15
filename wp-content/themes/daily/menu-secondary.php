<?php if ( has_nav_menu( 'secondary' ) ) : // Check if there's a menu assigned to the 'secondary' location. ?>

	<div id="secondary-bar" class="clearfix">
		<div class="container">

			<nav id="secondary-nav" class="main-navigation" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

				<?php wp_nav_menu(
					array(
						'theme_location' => 'secondary',
						'container'      => false,
						'menu_id'        => 'secondary-menu',
						'menu_class'     => 'secondary-menu sf-menu',
						'walker'         => new Daily_Custom_Nav_Walker
					)
				); ?>

			</nav><!-- #secondary-nav -->

			<div class="search-form">
			<form action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
				<input type="search" class="search-field field" placeholder="<?php echo esc_attr_x( 'Press enter to search &hellip;', 'placeholder', 'daily' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'daily' ) ?>" />
				<button type="submit" name="submit"><i class="fa fa-search"></i></button>
			</form>
		</div>

		</div>
	</div>

<?php endif; // End check for menu. ?>