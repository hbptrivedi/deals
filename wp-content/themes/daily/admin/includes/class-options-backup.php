<?php
/**
 * Options Framework Theme - Options Backup
 *
 * Backup your "Theme Options" to a downloadable text file.
 *
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2015, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 *
 * This code is a fork from:
 * - https://github.com/vauvarin/options-framework-theme/blob/master/admin/options-backup.php
 * - https://pippinsplugins.com/building-settings-import-export-feature/
 *
 * ----------------------------------------------------------------------------------- */
class Options_Framework_Backup {
	
	var $admin_page;
	var $token;
	
	/**
	 * Construct.
	 */
	public function __construct() {
		$this->admin_page = '';
		$this->token      = 'options-backup';
	}
	
	/**
	 * Initialize the class.
	 */
	public function init() {
		add_action( 'admin_menu', array( &$this, 'register_admin_screen' ), 20 );
	}
	
	/**
	 * register_admin_screen()
	 *
	 * Register the admin screen within WordPress.
	 */
	function register_admin_screen () {
		
		// Add a subpage called "Theme Options Backup" to the appearance menu.
		$this->admin_page = add_theme_page( 
			__( 'Import / Export Theme Options', 'flatline' ),
			__( 'Options Backup', 'flatline' ), 
			'manage_options', 
			$this->token, 
			array( &$this, 'admin_screen' ) 
		);
			
		// Export function.
		add_action( 'admin_init', array( &$this, 'export' ) );

		// Import function.
		add_action( 'admin_init', array( &$this, 'import' ) );
		
		// Admin notices.
		add_action( 'admin_notices', array( &$this, 'admin_notices' ), 10 );
	
	}
	
	/**
	 * admin_screen()
	 *
	 * Load the admin screen.
	 */
	function admin_screen() {
	?>
		<div class="wrap">
			<h2><?php _e( 'Import / Export Theme Options', 'flatline' ); ?><a class="add-new-h2" href="<?php echo esc_url( admin_url( 'admin.php?page=options-framework' ) ); ?>" class="button"><?php _e( 'Back to Theme Options', 'flatline' ); ?></a></h2>
			
			<div id="poststuff" class="postbox">
				<h3 class="hndle"><?php _e( 'Import Settings', 'flatline' ); ?></h3>
				
				<div class="inside">
					
					<p><?php _e( 'Import the plugin settings from a .json file. This file can be obtained by exporting the settings on another site using the form above.', 'flatline' ); ?></p>

					<form enctype="multipart/form-data" method="post">
						<p><input type="file" name="import_file" /></p>
						<input type="hidden" name="of-import-export" value="import_settings" />
						<?php wp_nonce_field( 'of-import', 'of-import' ); ?>
						<?php submit_button( __( 'Upload and Import', 'flatline' ), 'secondary', 'submit', false ); ?>
					</form>

				</div>

			</div>
			
			<div id="poststuff" class="postbox">
				<h3 class="hndle"><span><?php _e( 'Export Settings', 'flatline' ); ?></span></h3>
				
				<div class="inside">
					<p><?php _e( 'Export the theme options for this site as a .json file. This allows you to easily import the configuration into another site.', 'flatline' ); ?></p>
						
					<form method="post">
						<input type="hidden" name="of-import-export" value="export_settings" />
						<?php wp_nonce_field( 'of-export', 'of-export' ); ?>
						<?php submit_button( __( 'Download Export File', 'flatline' ), 'secondary', 'submit', false ); ?>
					</form>
				</div>
			</div>
			
		</div><!--/.wrap-->
	<?php
	
	}
	
	/**
	 * admin_notices()
	 *
	 * Display admin notices when performing backup/restore.
	 */
	function admin_notices () {
	
		if ( ! isset( $_GET['page'] ) || ( $_GET['page'] != $this->token ) ) { 
			return; 
		}
	
		echo '<div id="import-notice" class="updated"><p>' . sprintf( __( 'Please note that this backup manager backs up only your theme options and not your content. To backup your content, please use the %sWordPress Export Tool%s.', 'flatline' ), '<a href="' . esc_url( admin_url( 'export.php' ) ) . '">', '</a>' ) . '</p></div>' . "\n";
			
		if ( isset( $_GET['imported'] ) && $_GET['imported'] == 'true' ) {  
			echo '<div id="message" class="updated"><p>' . sprintf( __( 'Settings successfully imported. | Return to %sTheme Options%s', 'flatline' ), '<a href="' . esc_url( admin_url( 'admin.php?page=options-framework' ) ) . '">', '</a>' ) . '</p></div>';
		} // End IF Statement
		
	} // End admin_notices()
	
	/**
	 * import()
	 *
	 * Import settings from a backup file.
	 */
	function import() {
		
		if ( empty( $_POST['of-import-export'] ) || 'import_settings' != $_POST['of-import-export'] ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['of-import'], 'of-import' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		$file = explode( '.', $_FILES['import_file']['name'] );
		$extension = end( $file );

		if ( $extension != 'json' ) {
			wp_die( __( 'Please upload a valid .json file', 'flatline' ) );
		}

		$import_file = $_FILES['import_file']['tmp_name'];

		if ( empty( $import_file ) ) {
			wp_die( __( 'Please upload a file to import', 'flatline' ) );
		}

		// Retrieve the settings from the file and convert the json object to an array.
		$settings = json_decode( file_get_contents( $import_file ), true );

		// Get the options name.
		$options_framework = new Options_Framework;
	    $options_name = $options_framework->get_option_name();

		update_option( $options_name, $settings );

		wp_safe_redirect( admin_url( 'admin.php?page=' . $this->token . '&imported=true' ) ); 
		exit;
		
	} // End import()

	/**
	 * export()
	 *
	 * Export settings to a backup file.
	 */
	function export() {

		if ( empty( $_POST['of-import-export'] ) || 'export_settings' != $_POST['of-import-export'] ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['of-export'], 'of-export' ) ) {
			return;
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}

		// Get the theme name.
		$theme = wp_get_theme();
		$name  = $theme->get( 'Name' );
		
		// Get the options name.
		$options_framework = new Options_Framework;
		$options_name      = $options_framework->get_option_name();
		$settings          = get_option( $options_name );

		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=' . esc_attr( $name ) . '-options-export-' . date( 'm-d-Y' ) . '.json' );
		header( "Expires: 0" );

		echo json_encode( $settings );
		exit;
			
	}

}