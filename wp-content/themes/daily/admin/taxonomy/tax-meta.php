<?php
/**
 * Custom taxonomies custom fields.
 *
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2014, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if ( is_admin() ) {

	/* 
	 * Configure your meta box.
	 */
	$config = array(
		'id'             => 'daily_cat_metabox',
		'title'          => __( 'Daily Category Metabox', 'daily' ),
		'pages'          => array( 'category' ),
		'context'        => 'normal',
		'fields'         => array(),
		'local_images'   => false,
		'use_with_theme' => get_template_directory_uri() . '/admin/taxonomy'
	);

	/*
	 * Initiate your meta box.
	 */
	$my_meta =  new Tax_Meta_Class( $config );

	// Pull all tags into an array.
	$tags = array();
	$tags_obj = get_tags();
	$tags[''] = __( 'All Tags', 'daily' );
	foreach ( $tags_obj as $tag ) {
		$tags[$tag->term_id] = esc_html( $tag->name );
	}
		
	/**
	 * Taxonomy field.
	 */
	$my_meta->addSelect( 'daily_cat_layout',
		array( 
			'standard' => __( 'blog', 'daily' ),
			'classic'  => __( 'magazine', 'daily' ),
			'grid'   => __( 'grid', 'daily' ),
		),
		array( 'name'=> __( 'Category Layout Style', 'daily' ), 'std' => array( 'standard' ) )
	);

	$my_meta->addSelect( 'daily_featured_tag',
		$tags,
		array( 'name'=> __( 'Featured Posts Tag', 'daily' ) )
	);

	$my_meta->addSelect( 'daily_featured_layout',
		array( 
			'classic' => __( 'Classic', 'daily' ),
			'slider'  => __( 'Slider', 'daily' ),
		),
		array( 'name'=> __( 'Featured Posts Style', 'daily' ), 'std' => array( 'classic' ) )
	);

	/**
	 * Finish.
	 */
	$my_meta->Finish();

}