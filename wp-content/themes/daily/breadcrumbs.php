<div id="breadcrumbs">

	<?php if ( function_exists( 'breadcrumb_trail' ) ) : // Check for breadcrumb support. ?>
		<?php breadcrumb_trail(
			array(
				'separator'     => '<i class="fa fa-caret-right"></i>',
				'before'        => __( 'You are here:', 'daily' ),
				'show_browse'   => false,
				'show_on_front' => false,
			) 
		); ?>
	<?php endif; // End check for breadcrumb support. ?>

</div>