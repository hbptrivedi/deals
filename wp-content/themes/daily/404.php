<?php get_header(); ?>

	<div id="primary" class="content-area column">
		<main id="main" class="site-main column" role="main" <?php hybrid_attr( 'content' ); ?>>

				<header class="entry-header">
				<h1 class="entry-title"><?php _e( '404 - Page Not found', 'daily' ); ?></h1>
			</header><!-- .entry-header -->

				<div class="entry-content">
					<p><?php _e( 'We\'re sorry, but we can\'t find the page you were looking for. It\'s probably some thing we\'ve done wrong but now we know about it and we\'ll try to fix it.', 'daily' ); ?></p>
					<ul>
						<li><a href="javascript: history.go(-1);"><?php _e( 'Go to Previous Page', 'daily' ); ?></a></li>
						<li><a href="<?php echo esc_url( home_url() ); ?>"><?php _e( 'Go to Homepage', 'daily' ); ?></a></li>
					</ul>
				</div><!-- .page-content -->

		</main><!-- #main -->
		
	<?php get_sidebar( 'secondary' ); ?>	
		
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>