<?php
/**
 * Random Posts with Thumbnail widget.
 *
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class Daily_Random_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-daily-random posts-thumbnail-widget',
			'description' => __( 'Display random posts with thumbnails.', 'daily' )
		);

		// Create the widget.
		parent::__construct(
			'daily-random',                                   // $this->id_base
			__( '&raquo; Random Posts Thumbnails', 'daily' ), // $this->name
			$widget_options                                      // $this->widget_options
		);

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		// Posts query arguments.
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => (int) $instance['limit'],
			'orderby'        => 'rand'
		);

		// The post query
		$random = get_posts( $args );

		global $post;
		if ( $random ) {
			echo '<ul class="' . $instance['layout'] . '-style">';

				foreach ( $random as $post ) :
					setup_postdata( $post );

					$size = '';
					if ( $instance['layout'] === 'standard' ) {
						$size = 'daily-widget-thumb';
					} else {
						$size = 'daily-widget-thumb-big';
					}

					echo '<li>';
						if ( has_post_thumbnail() ) :
							echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . get_the_post_thumbnail( $post->ID, $size, array( 'class' => 'entry-thumb', 'alt' => esc_attr( get_the_title( $post->ID ) ) ) ) . '</a>';
						endif;
						echo '<a href="' . esc_url( get_permalink( $post->ID ) ) . '" rel="bookmark">' . esc_attr( get_the_title( $post->ID ) ) . '</a>';
						if ( $instance['show_date'] ) :
							echo '<time class="entry-date" datetime="' . get_the_date( 'c' ) . '">' . get_the_date() . '</time>';
						endif;
					echo '</li>';

				endforeach;

			echo '</ul>';
		}

		// Reset the query.
		wp_reset_postdata();
		
		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['limit']     = (int) $new_instance['limit'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['layout']    = $new_instance['layout'];

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'     => esc_html__( 'Random Posts', 'daily' ),
			'limit'     => 5,
			'show_date' => false,
			'layout'    => 'standard'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title', 'daily' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php _e( 'Number of posts to show', 'daily' ); ?>
			</label>
			<input type="text" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" value="<?php echo absint( $instance['limit'] ); ?>" size="3" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'] ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">
				<?php _e( 'Display post date?', 'daily' ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'layout' ); ?>">
				<?php _e( 'Layout', 'daily' ); ?>
			</label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'layout' ); ?>" name="<?php echo $this->get_field_name( 'layout' ); ?>" style="width:100%;">
				<option value="standard" <?php selected( $instance['layout'], 'standard' ); ?>><?php _e( 'Standard', 'daily' ) ?></option>
				<option value="classic" <?php selected( $instance['layout'], 'classic' ); ?>><?php _e( 'Classic', 'daily' ) ?></option>
			</select>
		</p>

	<?php

	}

}