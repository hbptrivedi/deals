<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="canonical" href="http://www.deals.ncrmart.com/" />
<link rel="canonical" href="http://www.ncrmart.com/" />
<link rel="canonical" href="http://ncrmart.com/" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> <?php hybrid_attr( 'body' ); ?>>

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header container clearfix" role="banner" <?php hybrid_attr( 'header' ); ?>>

		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>

		<?php daily_site_branding(); ?>

		<?php if ( of_get_option( 'daily_header_ads' ) ) : ?>
			<div class="header-ad">
				<?php echo stripslashes( of_get_option( 'daily_header_ads' ) ); ?>
			</div>
		<?php endif; ?>

		<div class="clearfix"></div>

		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

	</header><!-- #masthead -->

		<span class="header-date"><?php echo apply_filters( 'daily_today_date', date_i18n( 'l, j F Y' ) ); ?></span>

		<?php if(is_single()) : ?>
			<?php get_template_part( 'breadcrumbs' ); ?>
		<?php endif; ?>

	<div id="content" class="site-content column">
