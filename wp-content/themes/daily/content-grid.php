<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'daily-grid-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
	<?php endif; ?>

	<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
				<?php daily_posted_on(); ?>
				<span class="meta-sep">|</span>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'daily' ), __( '1 Comment', 'daily' ), __( '% Comments', 'daily' ) ); ?></span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
	<?php endif; ?>

	<div class="entry-content" <?php hybrid_attr( 'entry-summary' ); ?>>
		<?php echo wp_trim_words( get_the_excerpt(), 24 ); ?><div class="more-link"><a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'daily' ); ?></a></div>
	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
