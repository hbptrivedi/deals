<?php
/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php // You can start editing here -- including this comment! ?>

	<?php if ( have_comments() ) : ?>
		<header>
			<h2 class="comments-title">
				<strong><?php
					printf( _nx( 'One Response', '%1$s Responses', get_comments_number(), 'comments title', 'daily' ),
						number_format_i18n( get_comments_number() ) );
				?></strong>
				<?php _e( 'to', 'daily' ); ?> "<?php the_title(); ?>"
			</h2>
		</header>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'daily' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'daily' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'daily' ) ); ?></div>
			</nav><!-- #comment-nav-above -->
			<div class="clearfix"></div>
		<?php endif; // check for comment navigation ?>

		<ol class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'daily_comment', 'style' => 'ol' ) ); ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below" class="comment-navigation" role="navigation">
				<h1 class="screen-reader-text"><?php _e( 'Comment navigation', 'daily' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'daily' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'daily' ) ); ?></div>
			</nav><!-- #comment-nav-below -->
			<div class="clearfix"></div>
		<?php endif; // check for comment navigation ?>

	<?php endif; // have_comments() ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'daily' ); ?></p>
	<?php endif; ?>

	<?php comment_form(
		array( 
			'comment_notes_after'  => false,
			'comment_notes_before' => false,
			'title_reply'          => __( 'Post Comment', 'daily' )
		)
	); ?>

</div><!-- #comments -->