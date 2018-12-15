<form method="get" class="searchform" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search">
	<div>
		<input type="search" class="search-field field" placeholder="<?php echo esc_attr_x( 'Press enter to search &hellip;', 'placeholder', 'daily' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'daily' ) ?>" />
	</div>
</form>