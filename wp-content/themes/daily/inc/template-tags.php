<?php
/**
 * Custom template tags for this theme.
 * Eventually, some of the functionality here could be replaced by core features.
 * 
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( ! function_exists( 'daily_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since 1.0.0
 */
function daily_posted_on() {
	$time_string = '<time class="entry-date published" datetime="%1$s" ' . hybrid_get_attr( 'entry-published' ) . '>%2$s</time>';

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);

	printf( __( '<span class="posted-on">Posted on ' .get_the_date(). '</span><span class="byline"> by %2$s</span>', 'daily' ),
		sprintf( '<a href="%1$s" rel="bookmark">%2$s</a>',
			esc_url( get_permalink() ),
			$time_string
		),
		sprintf( '<span class="author vcard" ' . hybrid_get_attr( 'entry-author' ) . '><a class="url fn n" href="%1$s" itemprop="url"><span itemprop="name">%2$s</span></a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_html( get_the_author() )
		)
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @since  1.0.0
 * @return bool
 */
function daily_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'daily_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'daily_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so tj_basic_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so tj_basic_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in tj_basic_categorized_blog.
 *
 * @since 1.0.0
 */
function daily_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'daily_categories' );
}
add_action( 'edit_category', 'daily_category_transient_flusher' );
add_action( 'save_post',     'daily_category_transient_flusher' );

if ( ! function_exists( 'daily_site_branding' ) ) :
/**
 * Site branding for the site.
 * 
 * Display site title by default, but user can change it with their custom logo.
 * They can upload it on Customizer page.
 * 
 * @since  1.0.0
 */
function daily_site_branding() {

	$logo = of_get_option( 'daily_logo' );

	// Check if logo available, then display it.
	if ( $logo ) :
		echo '<div id="logo" itemscope itemtype="http://schema.org/Brand">' . "\n";
			echo '<a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home">' . "\n";
				echo '<img itemprop="logo" src="' . esc_url( $logo ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" />' . "\n";
			echo '</a>' . "\n";
		echo '</div>' . "\n";

	// If not, then display the Site Title and Site Description.
	else :
			echo '<div id="logo">'. "\n";
				echo '<h1 class="site-title" ' . hybrid_get_attr( 'site-title' ) . '><a href="' . esc_url( get_home_url() ) . '" itemprop="url" rel="home"><span itemprop="headline">' . esc_attr( get_bloginfo( 'name' ) ) . '</span></a></h1>'. "\n";
				if ( of_get_option( 'daily_description', 'on' ) == 'on' ) :
					echo '<h2 class="site-description" ' . hybrid_get_attr( 'site-description' ) . '>' . esc_attr( get_bloginfo( 'description' ) ) . '</h2>';
				endif;
			echo '</div>'. "\n";
		endif;

}
endif;

if ( ! function_exists( 'daily_header_social' ) ) {
	/**
	 * Social icons in header.
	 *
	 * @since  1.0.0
	 */
	function daily_header_social() {

		// Get the social url.
		$enable     = of_get_option( 'daily_enable_social_header', 'on' );
		$twitter    = of_get_option( 'daily_twitter_url' );
		$facebook   = of_get_option( 'daily_fb_url' );
		$gplus      = of_get_option( 'daily_gplus_url' );
		$feed       = of_get_option( 'daily_feed_url', of_get_default( 'daily_feed_url' ) );

		// Check if social links option enabled.
		if ( $enable == 'on' ) {

			echo '<div class="header-social">';

				if ( ! empty( $facebook ) ) {
					echo '<a href="' . esc_url( $facebook ) . '" title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>';
				}
				if ( ! empty( $twitter ) ) {
					echo '<a href="' . esc_url( $twitter ) . '" title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>';
				}
				if ( ! empty( $gplus ) ) {
					echo '<a href="' . esc_url( $gplus ) . '" title="GooglePlus"><i class="fa fa-google-plus"></i><span>Google+</span></a>';
				}
				if ( ! empty( $feed ) ) {
					echo '<a href="' . esc_url( $feed ) . '" title="RSS"><i class="fa fa-rss"></i><span>RSS</span></a>';
				}

			echo  '</div>';

		}

	}
}

if ( ! function_exists( 'daily_featured_slider' ) ) :
/**
 * Featured posts carousel
 *
 * @since  1.0.0
 */
function daily_featured_slider() {

	$tag    = of_get_option( 'daily_featured_tag' );         // Get the user selected tag for the featured posts.

		// Posts query arguments.
		$query = array(
			'post_type'      => 'post',
			'posts_per_page' => of_get_option( 'daily_featured_num' ),
		);

		// Add the tag selected by user to the query.
		if ( ! empty( $tag ) ) {
			$query['tag_id'] = $tag;
		}

		// Allow dev to filter the query.
		$args = apply_filters( 'daily_featured_posts_args', $query );

		// The post query
		$featured = new WP_Query( $args );

	if ( $featured->have_posts() ) : ?>

		<div id="featured-content" class="category-box clearfix">
				<h3 class="widget-title"><strong><?php echo of_get_option( 'daily_featured_title'); ?></strong></h3>
				<div id="carousel-0" class="jcarousel">
					<ul>
						<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>
							<li>
								<article <?php post_class(); ?>>
									<?php if ( has_post_thumbnail() ) : ?>
										<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'daily-big-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
									<?php endif; ?>
									<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									<?php if ( 'post' == get_post_type() ) : ?>
										<div class="entry-meta">
				<?php daily_posted_on(); ?>
				<span class="meta-sep">|</span>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'daily' ), __( '1 Comment', 'daily' ), __( '% Comments', 'daily' ) ); ?></span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
									<?php endif; ?>

									<div class="entry-summary">
										<?php echo wp_trim_words( get_the_excerpt(), 64 ); ?><div class="more-link"><a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'daily' ); ?></a></div>
									</div><!-- .entry-content -->
  
								</article>
							</li>
						<?php endwhile; ?>
					</ul>
					<p class="jcarousel-pagination-0"></p>
					<a href="#" class="jcarousel-control-prev"><i class="fa fa-chevron-left"></i></a>
					<a href="#" class="jcarousel-control-next"><i class="fa fa-chevron-right"></i></a>
				</div>
			</div>
	
	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'daily_featured_posts' ) ) :
/**
 * Featured posts
 *
 * @since  1.0.0
 */
function daily_featured_posts() {

	$tag    = of_get_option( 'daily_featured_tag' );         // Get the user selected tag for the featured posts.

		// Posts query arguments.
		$query = array(
			'post_type'      => 'post',
			'posts_per_page' => 3,
		);

		// Add the tag selected by user to the query.
		if ( ! empty( $tag ) ) {
			$query['tag_id'] = $tag;
		}

		// Allow dev to filter the query.
		$args = apply_filters( 'daily_featured_posts_args', $query );

		// The post query
		$featured = new WP_Query( $args );

	if ( $featured->have_posts() ) : ?>

		<div id="featured-content-2" class="category-box clearfix">
				<h3 class="widget-title"><strong><?php echo of_get_option( 'daily_featured_title'); ?></strong></h3>

				<?php $i = 0; ?>

				<?php while ( $featured->have_posts() ) : $featured->the_post(); ?>

					<?php if ( ++$i == 1 ) :  ?>

						<div class="featured-big">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'daily-big-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
							<?php endif; ?>
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<?php if ( 'post' == get_post_type() ) : ?>
								<div class="entry-meta">
				<?php daily_posted_on(); ?>
				<span class="meta-sep">|</span>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( '0 comments', 'daily' ), __( '1 Comment', 'daily' ), __( '% Comments', 'daily' ) ); ?></span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
							<?php endif; ?>

							<div class="entry-summary">
								<?php echo wp_trim_words( get_the_excerpt(), 64 ); ?><div class="more-link"><a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'daily' ); ?></a></div>
							</div><!-- .entry-content -->
 
						</div>

					<?php else : ?>

						<?php
							$class = '';
							if ( $i == 3 ) { $class = 'last'; }
						?>

						<div class="featured-small <?php echo $class; ?>">
							<?php if ( has_post_thumbnail() ) : ?>
								<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'daily-grid-thumb', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?></a>
							<?php endif; ?>
							<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
							<?php if ( 'post' == get_post_type() ) : ?>
								<div class="entry-meta">
				<?php daily_posted_on(); ?>
				<span class="meta-sep">|</span>
				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span class="comments-link"><?php comments_popup_link( __( '0 Comments', 'daily' ), __( '1 Comment', 'daily' ), __( '% Comments', 'daily' ) ); ?></span>
				<?php endif; ?>
			</div><!-- .entry-meta -->
							<?php endif; ?>

							<div class="entry-summary">
								<?php echo wp_trim_words( get_the_excerpt(), 10 ); ?><div class="more-link"><a href="<?php the_permalink(); ?>"><?php _e( 'Read more &raquo;', 'daily' ); ?></a></div>
							</div><!-- .entry-content -->

						</div>

					<?php endif; ?>

				<?php endwhile; ?>

			</div>
	
	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();

}
endif;

if ( ! function_exists( 'daily_post_author' ) ) {
	/**
	 * Author post informations.
	 *
	 * @since  1.0.0
	 */
	function daily_post_author() {

		// Bail if user don't want to display the author info via theme settings.
		if ( of_get_option( 'daily_post_author', 'on' ) != 'on' ) {
			return;
		}

		// Bail if not on the single post.
		if ( ! is_single() ) {
			return;
		}

		// Bail if user hasn't fill the Biographical Info field.
		if ( ! get_the_author_meta( 'description' ) ) {
			return;
		}
	?>

		<div class="author-bio clearfix" <?php hybrid_attr( 'entry-author' ) ?>>
			<?php echo get_avatar( is_email( get_the_author_meta( 'user_email' ) ), apply_filters( 'daily_author_bio_avatar_size', 75 ), '', strip_tags( get_the_author() ) ); ?>
			<div class="description">
				<h3 class="author-title name">
					<a class="author-name url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author" itemprop="url"><span itemprop="name"><?php echo strip_tags( get_the_author() ); ?></span></a>
				</h3>
				<p class="bio" itemprop="description"><?php echo stripslashes( get_the_author_meta( 'description' ) ); ?></p>
			</div>
		</div><!-- .author-bio -->

	<?php
	}
}

if ( ! function_exists( 'daily_newsletter_form' ) ) :
/**
 * Newsletter form.
 *
 * @since  1.0.0
 */
function daily_newsletter_form() {
	$form = of_get_option( 'daily_newsletter' );

	if ( $form ) {
		echo '<div class="newsletter-form">';
			echo '<h3>' . __( 'Get Updates', 'daily' ) . '</h3>';
			echo stripslashes( $form );
		echo '</div>';
	}

}
endif;

if ( ! function_exists( 'daily_social_share' ) ) :
/**
 * Social share.
 *
 * @since  1.0.0
 */
function daily_social_share() {
	global $post;

	// Bail if user don't want to display the share buttons via theme settings.
	if ( of_get_option( 'daily_post_share', 'on' ) != 'on' ) {
		return;
	}
?>
	<div class="entry-share">
		<h3><?php _e( 'Share This Post', 'daily' ); ?></h3>
		<ul>
			<li><a href="https://twitter.com/intent/tweet?text=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-twitter"></i></a></li>
			<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-facebook"></i></a></li>
			<li><a href="https://plus.google.com/share?url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>"><i class="fa fa-google-plus"></i></a></li>
			<li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode( get_permalink( $post->ID ) ); ?>&title=<?php echo esc_attr( get_the_title( $post->ID ) ); ?>&summary=<?php echo get_the_excerpt(); ?>&source=<?php echo esc_attr( get_bloginfo( 'name' ) ) ?>"><i class="fa fa-linkedin"></i></a></li>
			<li><a href="javascript:window.print()"><i class="fa fa-print"></i></a></li>
		</ul>
	</div>
<?php
}
endif;

if ( ! function_exists( 'daily_related_posts' ) ) {
	/**
	 * Related posts.
	 *
	 * @since  1.0.0
	 */
	function daily_related_posts() {
		global $post;

		// Bail if user don't want to display the related posts via theme settings.
		if ( of_get_option( 'daily_related_posts', 'on' ) != 'on' ) {
			return;
		}

		// Get the taxonomy terms of the current page for the specified taxonomy.
		$terms = wp_get_post_terms( $post->ID, 'category', array( 'fields' => 'ids' ) );

		// Bail if the term empty.
		if ( empty( $terms ) ) {
			return;
		}
		
		// Posts query arguments.
		$query = array(
			'post__not_in' => array( $post->ID ),
			'tax_query'    => array(
				array(
					'taxonomy' => 'category',
					'field'    => 'id',
					'terms'    => $terms,
					'operator' => 'IN'
				)
			),
			'posts_per_page' => 4,
			'post_type'      => 'post',
		);

		// Allow dev to filter the query.
		$args = apply_filters( 'daily_related_posts_args', $query );

		// The post query
		$related = new WP_Query( $args );

		if ( $related->have_posts() ) : ?>

			<div class="related-posts">
				<h3><?php _e( 'Related Posts', 'daily' ); ?></h3>
				<ul class="clearfix">
					<?php while ( $related->have_posts() ) : $related->the_post(); ?>
						<li>
							<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'daily-widget-thumb-big', array( 'alt' => esc_attr( get_the_title() ) ) ); ?>
								<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
							</a>
						</li>
					<?php endwhile; ?>
				</ul>
			</div>
		
		<?php endif;

		// Restore original Post Data.
		wp_reset_postdata();

	}
}

if ( ! function_exists( 'daily_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since  1.0.0
 */
function daily_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">
			<p <?php hybrid_attr( 'comment-content' ); ?>><?php _e( 'Pingback:', 'daily' ); ?> <span <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php comment_author_link(); ?></span></span> <?php edit_comment_link( __( '(Edit)', 'daily' ), '<span class="edit-link">', '</span>' ); ?></p>
		</article>
	<?php
			break;
		default :
		// Proceed with normal comments.
		global $post;
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>" <?php hybrid_attr( 'comment' ); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="comment-container">

			<?php echo get_avatar( $comment, apply_filters( 'daily_comment_avatar_size', 60 ) ); ?>

			<div class="comment-head">
				<span class="name" <?php hybrid_attr( 'comment-author' ); ?>><span itemprop="name"><?php echo get_comment_author_link(); ?></span></span>
				<?php
					printf( '<span class="date"><a href="%1$s" ' . hybrid_get_attr( 'comment-permalink' ) . '><time datetime="%2$s" ' . hybrid_get_attr( 'comment-published' ) . '>%3$s</time></a> %4$s</span>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'daily' ), get_comment_date(), get_comment_time() ),
						sprintf( __( '%1$s&middot; Edit%2$s', 'daily' ), '<a href="' . get_edit_comment_link() . '" title="' . esc_attr__( 'Edit Comment', 'daily' ) . '">', '</a>' )
					);
				?>
			</div><!-- comment-head -->
			
			<div class="comment-content comment-entry comment" <?php hybrid_attr( 'comment-content' ); ?>>
				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'daily' ); ?></p>
				<?php endif; ?>
				<?php comment_text(); ?>
				<span class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'daily' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</span><!-- .reply -->
			</div><!-- .comment-content -->

		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;