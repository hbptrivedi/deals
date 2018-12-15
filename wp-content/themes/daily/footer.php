	</div><!-- #content -->

	<div class="clearfix"></div>

	<footer id="footer" class="container clearfix" role="contentinfo" <?php hybrid_attr( 'footer' ); ?>>

		<div class="footer-column footer-column-1">
			<?php dynamic_sidebar( 'footer-1' ); ?>
		</div>

		<div class="footer-column footer-column-2">
			<?php dynamic_sidebar( 'footer-2' ); ?>
		</div>

		<div class="footer-column footer-column-3">
			<?php dynamic_sidebar( 'footer-3' ); ?>
		</div>

		<div class="footer-column footer-column-4">
			<?php dynamic_sidebar( 'footer-4' ); ?>
		</div>

		<div id="site-bottom" class="container clearfix">

			<div class="copyright"><?php echo stripslashes( of_get_option( 'daily_footer_text', of_get_default( 'daily_footer_text' ) ) ); ?></div><!-- .copyright -->

		</div>
		
	</footer><!-- #colophon -->
	
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
