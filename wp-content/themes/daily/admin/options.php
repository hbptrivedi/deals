<?php
/**
 * Theme Options.
 *
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 *
 * @since  1.0.0
 */
function optionsframework_option_name() {
	return 'daily'; // Theme slug
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * @since  1.0.0
 */
function optionsframework_options() {

	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}

	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages( 'sort_column=post_parent,menu_order' );
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}

	$featured_array = array(
		'slider' => __( 'slider', 'daily' ),
		'classic' => __( 'classic', 'daily' ),
		'disable' => __( 'disable', 'daily' )
	);

	$layout_array = array(
		'standard' => __( 'blog', 'daily' ),
		'classic' => __( 'magazine', 'daily' ),
		'grid' => __( 'grid', 'daily' )
	);

	$layout2_array = array(
		'2c-l' => __( '2 Columns: Content / Sidebar 1', 'daily' ),
		'2c-r' => __( '2 Columns: Sidebar 1 / Content', 'daily' ),
		'3c-l' => __( '3 Columns: Content / Sidebar 2 / Sidebar 1', 'daily' ),
		'3c-r' => __( '3 Columns: Sidebar 1 / Sidebar 2 / Content', 'daily' ),
		'3c-1' => __( '3 Columns: Sidebar 1 / Content / Sidebar 2', 'daily' ),
		'3c-2' => __( '3 Columns: Sidebar 2 / Content / Sidebar 1', 'daily' )
	);

	// Image path
	$imagepath =  get_template_directory_uri() . '/assets/img/';

	// Set empty $options.
	$options = array();

	/**
	 * Defines array of options.
	 */
	
	// ============================ //
	// ===== General Settings ===== //
	// ============================ //
	$options[] = array(
		'name' => __( 'General', 'daily' ),
		'type' => 'heading'
	);

		$options['daily_favicon'] = array(
			'name' => __( 'Favicon', 'daily' ),
			'desc' => __( 'Your custom favicon. 32x32px recommended.', 'daily' ),
			'id'   => 'daily_favicon',
			'type' => 'upload'
		);

		$options['daily_mobile_icon'] = array(
			'name' => __( 'Mobile Icon', 'daily' ),
			'desc' => __( '144x144 recommended in PNG format. This icon will be used when users add your website as a shortcut on mobile devices like iPhone, iPad, Android etc.', 'daily' ),
			'id'   => 'daily_mobile_icon',
			'type' => 'upload'
		);

		$options[] = array(
			'name'  => __( 'FeedBurner URL', 'daily' ),
			'desc'  => __( 'Enter your full FeedBurner URL. If you wish to use FeedBurner over the standard WordPress feed.', 'daily' ),
			'id'    => 'daily_feedburner_url',
			'placeholder' => 'http://feeds.feedburner.com/ThemeJunkie',
			'type'  => 'text'
		);

		$options['daily_tracking'] = array(
			'name' => __( 'Tracking Code', 'daily' ),
			'desc' => __( 'Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'daily' ),
			'id'   => 'daily_tracking',
			'type' => 'textarea'
		);
		
	// ============================ //
	// ===== Header Settings ===== //
	// ============================ //
	$options[] = array(
		'name' => __( 'Header', 'daily' ),
		'type' => 'heading'
	);

		$options['daily_logo'] = array(
			'name' => __( 'Logo', 'daily' ),
			'desc' => __( 'Upload your custom logo, it will automatically replace the Site Title', 'daily' ),
			'id'   => 'daily_logo',
			'type' => 'upload'
		);

		$options[] = array(
			'name' => __( 'Site Description', 'daily' ),
			'desc' => __( 'Display the site description.', 'daily' ),
			'id'   => 'daily_description',
			'std'  => 'on',
			'type' => 'onoff'
		);			

		$options[] = array(
			'name' => __( 'Social Settings', 'daily' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options[] = array(
				'name' => __( 'Enable', 'daily' ),
				'desc' => __( 'Enable social icons in header.', 'daily' ),
				'id'   => 'daily_enable_social_header',
				'std'  => 'on',
				'type' => 'onoff'
			);

			$options[] = array(
				'name'        => __( 'Twitter URL', 'daily' ),
				'desc'        => __( 'Enter your twitter profile URL.', 'daily' ),
				'id'          => 'daily_twitter_url',
				'placeholder' => 'http://twitter.com/',
				'type'        => 'text'
			);

			$options[] = array(
				'name'        => __( 'Facebook URL', 'daily' ),
				'desc'        => __( 'Enter your facebook profile  URL.', 'daily' ),
				'id'          => 'daily_fb_url',
				'placeholder' => 'http://www.facebook.com/',
				'type'        => 'text'
			);

			$options[] = array(
				'name'        => __( 'Google Plus URL', 'daily' ),
				'desc'        => __( 'Enter your google plus profile  URL.', 'daily' ),
				'id'          => 'daily_gplus_url',
				'placeholder' => 'http://plus.google.com/',
				'type'        => 'text'
			);

			$options[] = array(
				'name'  => __( 'Feed URL', 'daily' ),
				'desc'  => __( 'Enter your website feed URL.', 'daily' ),
				'id'    => 'daily_feed_url',
				'std'   => esc_url( get_feed_link() ),
				'type'  => 'text'
			);		

	// ============================ //
	// ===== Home Settings ===== //
	// ============================ //
	$options[] = array(
		'name' => __( 'Home Page', 'daily' ),
		'type' => 'heading'
	);

		$options['daily_home_featured'] = array(
		'name' => __( 'Home featured', 'daily' ),
		'desc' => __( 'home featured layout', 'daily' ),
		'id' => 'daily_home_featured',
		'std' => 'slider',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $featured_array
	);

		if ( $options_tags ) {
		$options[] = array(
			'name' => __( 'Select a Tag', 'options_check' ),
			'desc' => __( 'home featured tag', 'options_check' ),
			'id' => 'daily_featured_tag',
			'type' => 'select',
			'options' => $options_tags
		);
	}

		$options[] = array(
		'name' => __( 'Number of posts', 'daily' ),
		'desc' => __( 'number of posts (only slider)', 'daily' ),
		'id' => 'daily_featured_num',
		'std' => '3',
		'class' => 'mini',
		'type' => 'text'
	);

		$options['daily_home_layout'] = array(
		'name' => __( 'Home layout', 'daily' ),
		'desc' => __( 'home page layout', 'daily' ),
		'id' => 'daily_home_layout',
		'std' => 'standard',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $layout_array
	);

		$options['daily_home_columns'] = array(
		'name' => __( 'Home columns', 'daily' ),
		'desc' => __( 'home page columns', 'daily' ),
		'id' => 'daily_home_columns',
		'std' => '3c-l',
		'type' => 'select',
		'options' => $layout2_array
	);

		$options[] = array(
		'name' => __( 'Featured Posts title', 'daily' ),
		'desc' => __( 'home featured title', 'daily' ),
		'id' => 'daily_featured_title',
		'std' => 'Featured Posts',
		'type' => 'text'
	);

		$options[] = array(
		'name' => __( 'Latest Posts title', 'daily' ),
		'desc' => __( 'home loop title', 'daily' ),
		'id' => 'daily_home_title',
		'std' => 'Latest Posts',
		'type' => 'text'
	);

	// ============================ //
	// ===== Archives Settings ===== //
	// ============================ //
	$options[] = array(
		'name' => __( 'Archives', 'daily' ),
		'type' => 'heading'
	);

		$options['daily_tag_layout'] = array(
		'name' => __( 'Tag layout', 'daily' ),
		'desc' => __( 'tags', 'daily' ),
		'id' => 'daily_tag_layout',
		'std' => 'standard',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $layout_array
	);

		$options['daily_author_layout'] = array(
		'name' => __( 'Author layout', 'daily' ),
		'desc' => __( 'authors', 'daily' ),
		'id' => 'daily_author_layout',
		'std' => 'standard',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $layout_array
	);

		$options['daily_search_layout'] = array(
		'name' => __( 'Search layout', 'daily' ),
		'desc' => __( 'search results', 'daily' ),
		'id' => 'daily_search_layout',
		'std' => 'standard',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $layout_array
	);

		$options['daily_archive_layout'] = array(
		'name' => __( 'Archive layout', 'daily' ),
		'desc' => __( 'dates', 'daily' ),
		'id' => 'daily_archive_layout',
		'std' => 'standard',
		'type' => 'select',
		'class' => 'mini', //mini, tiny, small
		'options' => $layout_array
	);	

	// ================================ //
	// ===== Single Post Settings ===== //
	// ================================ //
	$options[] = array(
		'name' => __( 'Single Post', 'daily' ),
		'type' => 'heading'
	);

		$options[] = array(
			'name' => __( 'Featured Image', 'daily' ),
			'desc' => __( 'Display the featured image.', 'daily' ),
			'id'   => 'daily_featured_image',
			'std'  => 'on',
			'type' => 'onoff'
		);

		$options[] = array(
			'name' => __( 'Author Bio', 'daily' ),
			'desc' => __( 'Display author bio.', 'daily' ),
			'id'   => 'daily_post_author',
			'std'  => 'on',
			'type' => 'onoff'
		);

		$options[] = array(
			'name'  => __( 'Newsletter Form', 'daily' ),
			'desc'  => __( 'If you want to display a newsletter form on single post. Please add the form here.', 'daily' ),
			'id'    => 'daily_newsletter',
			'std' => 'newsletter code',
			'type'  => 'textarea'
		);

		$options[] = array(
				'name' => __( 'Share Buttons', 'daily' ),
				'desc' => __( 'Display the social share buttons info.', 'daily' ),
				'id'   => 'daily_post_share',
				'std'  => 'on',
				'type' => 'onoff'
			);	

			$options[] = array(
				'name' => __( 'Related Posts', 'daily' ),
				'desc' => __( 'Display the related posts.', 'daily' ),
				'id'   => 'daily_related_posts',
				'std'  => 'on',
				'type' => 'onoff'
			);

		$options[] = array(
			'name' => __( 'Advertisement Settings', 'daily' ),
			'id'   => '',
			'type' => 'seperator'
		);

			$options['daily_ad_single_before'] = array(
				'name' => __( 'Before Content Advertisement', 'daily' ),
				'desc' => __( 'Your ad will appear on single post before content.', 'daily' ),
				'id'   => 'daily_ad_single_before',
				'type' => 'textarea'
			);

			$options['daily_ad_single_after'] = array(
				'name' => __( 'After Content Advertisement', 'daily' ),
				'desc' => __( 'Your ad will appear on single post after content.', 'daily' ),
				'id'   => 'daily_ad_single_after',
				'type' => 'textarea'
			);

	// =========================== //
	// ===== Footer Settings ===== //
	// =========================== //
	$options[] = array(
		'name' => __( 'Footer', 'daily' ),
		'type' => 'heading'
	);

		$options['daily_footer_text'] = array(
			'name' => __( 'Footer Text', 'daily' ),
			'desc' => __( 'You can customize the footer text here.', 'daily' ),
			'id'   => 'daily_footer_text',
			'std'  => '&copy; Copyright ' . date( 'Y' ) . ' <a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> &middot; Designed by <a href="http://www.theme-junkie.com/">Theme Junkie</a>',
			'type' => 'editor'
		);

	// ================================== //
	// ===== Advertisement Settings ===== //
	// ================================== //
	$options[] = array(
		'name' => __( 'Advertisement', 'daily' ),
		'type' => 'heading'
	);

		$options['daily_header_ads'] = array(
			'name' => __( 'Header Advertisement', 'daily' ),
			'desc' => __( 'The ad will appear at the top of your site. Recommended size 728x90', 'daily' ),
			'id'   => 'daily_header_ads',
			'type' => 'textarea'
		);

		$options['daily_archive_ads'] = array(
			'name' => __( 'Archive Advertisement', 'daily' ),
			'desc' => __( 'The ad will appear at the above loop. Recommended size 728x90', 'daily' ),
			'id'   => 'daily_archive_ads',
			'type' => 'textarea'
		);

	// ================================== //
	// ===== Custom Code Settings ======= //
	// ================================== //
	$options[] = array(
		'name' => __( 'Custom Code', 'daily' ),
		'type' => 'heading'
	);

		$options['daily_script_head'] = array(
			'name' => __( 'Header code', 'daily' ),
			'desc' => __( 'If you need to add custom scripts to your header (meta tag verification, google fonts url), you should enter them in the box. They will be added before &lt;/head&gt; tag', 'daily' ),
			'id'   => 'daily_script_head',
			'type' => 'textarea'
		);

		$options['daily_script_footer'] = array(
			'name' => __( 'Footer code', 'daily' ),
			'desc' => __( 'If you need to add custom scripts to your footer, you should enter them in the box. They will be added before &lt;/body&gt; tag', 'daily' ),
			'id'   => 'daily_script_footer',
			'type' => 'textarea'
		);
	
	// Allow dev to filter the theme options.
	return apply_filters( 'daily_theme_options', $options );
}

/*
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 *
 * You can delete it if you not using that option
 */
add_action( 'optionsframework_custom_scripts', 'optionsframework_custom_scripts' );

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});

	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}

});
</script>

<?php
}