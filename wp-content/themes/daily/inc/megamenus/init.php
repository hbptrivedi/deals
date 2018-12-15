<?php
/**
 * Initial functions for the mega menus.
 *
 * @package    Daily
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Filters the original Walker.
 *
 * @since  1.0.0
 */
function daily_megamenus_init() {

	// Add custom megamenu field to menu
	add_filter( 'wp_setup_nav_menu_item', 'daily_add_megamenu_field_meta' );
	add_action( 'wp_nav_menu_item_custom_fields', 'daily_add_megamenu_field', 10, 4 );

	// Save menu custom fields
	add_action( 'wp_update_nav_menu_item', 'daily_update_custom_nav_fields', 10, 3 );
	
	// Edit menu walker
	add_filter( 'wp_edit_nav_menu_walker', 'daily_edit_walker', 10, 2 );

}
add_action( 'after_setup_theme', 'daily_megamenus_init', 10 );

/**
 * Add custom fields to $item nav object
 * in order to be used in custom Walker.
 *
 * @since  1.0.0
 */
function daily_add_megamenu_field_meta( $menu_item ) {
	$menu_item->megamenu = empty( $menu_item->megamenu ) ? get_post_meta( $menu_item->ID, '_menu_item_megamenu', true ) : $menu_item->megamenu;

	return $menu_item;
}

/**
 * Add custom megamenu field.
 *
 * @since  1.0.0
 */
function daily_add_megamenu_field( $id, $item, $depth, $args ) {
?>
	<?php if ( ! $depth > 0 ) : ?>
		<div style="clear: both;"></div>
		<p class="field-megamenu description">
			<label for="edit-menu-item-megamenu-<?php echo $item->ID; ?>">
				<input type="checkbox" id="edit-menu-item-megamenu-<?php echo $item->ID; ?>" value="false" name="menu-item-megamenu[<?php echo $item->ID; ?>]"<?php checked( $item->megamenu, 'false' ); ?> />
				<?php _e( 'Mega Menus?', 'daily' ); ?>
			</label>
		</p>
	<?php endif; ?>
<?php
}

/**
 * Save menu custom fields.
 *
 * @since  1.0.0
 */
function daily_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {

	if ( ! empty( $_POST['menu-item-megamenu'][ $menu_item_db_id ] ) ) {
		$value = $_POST['menu-item-megamenu'][ $menu_item_db_id ];
	} else {
		$value = array();
	}

	if ( ! empty( $value ) ) {
		update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $value );
	} else {
		delete_post_meta( $menu_item_db_id, '_menu_item_megamenu' );
	}
	
}

/**
 * Define new Walker edit.
 *
 * @since  1.0.0
 */
function daily_edit_walker( $walker, $menu_id ) {
	require_once trailingslashit( get_template_directory() ) . 'inc/megamenus/class-walker-edit-custom.php';
	return 'Walker_Nav_Menu_Edit_Custom';
}