<?php if ( has_nav_menu( 'primary' ) ) : // Check if there's a menu assigned to the 'primary' location. ?>
	
	<div id="primary-bar">
		<div class="container">

			<nav id="primary-nav" class="main-navigation" role="navigation" <?php hybrid_attr( 'menu' ); ?>>

				<?php wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_id'        => 'primary-menu',
						'menu_class'     => 'primary-menu sf-menu',
						'walker'         => new Daily_Custom_Nav_Walker
					)
				); ?>

			</nav><!-- #primary-nav -->

			<?php daily_header_social(); // Social icons. ?>

		</div>
	</div>

<?php endif; // End check for menu. ?>