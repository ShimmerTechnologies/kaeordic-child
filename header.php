<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php
/** Themify Default Variables
 *  @var object */
	global $themify; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>">

<!-- wp_header -->
<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
<?php themify_body_start(); // hook ?>
<div id="pagewrap" class="hfeed site">

		<?php themify_header_before(); // hook ?>

		<div id="header-top-menu" class="clearfix">	

		<div class="topwidth clearfix">

					

					<?php if(is_user_logged_in()){ ?>
						<ul class="login" style="max-width:68px;">
						<li><a href="<?php echo wp_logout_url(); ?>" title="Login">LOGOUT</a></li>	
					<?php } else { ?>
						<ul class="login" style="max-width:160px;">
						<li><a href="<?php echo wp_login_url(); ?>" title="Login">LOGIN</a></li>
						<li><span>&nbsp;|&nbsp;</span></li>
				        <li class="last"><a href="<?php echo wp_registration_url(); ?>">REGISTER</a></li>
				    <?php } ?>	
				    </ul> 

					<div class="social-widget">
							<?php dynamic_sidebar('social-widget'); ?>

							<?php if ( ! themify_check('setting-exclude_rss' ) ) : ?>
								<div class="rss"><a href="<?php themify_theme_feed_link(); ?>" class="hs-rss-link"></a></div>
							<?php endif; ?>
					</div>
						<!-- /.social-widget -->

			</div>

		</div>

		<?php themify_header_start(); // hook ?>

		<div id="headerwrap" class="clearfix">

		<?php if( is_singular( 'album' ) ) { ?>

		<div id="header-background">

		<?php } ?>

		<header id="header" class="pagewidth clearfix" itemscope="itemscope" itemtype="https://schema.org/WPHeader">

			<?php echo themify_logo_image( 'site_logo' ); ?>

			<?php if ( $site_desc = get_bloginfo( 'description' ) ) : ?>
				<?php global $themify_customizer; ?>
				<div id="site-description" class="site-description"><?php echo class_exists( 'Themify_Customizer' ) ? $themify_customizer->site_description( $site_desc ) : $site_desc; ?></div>
			<?php endif; ?>

			<div class="cart">
					<a href="<?php echo edd_get_checkout_uri(); ?>">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i><span class="header-cart edd-cart-quantity"><?php echo edd_get_cart_quantity(); ?></span>
					</a>
			</div>

			<a id="menu-icon" href="#"></a>

			<div id="mobile-menu" class="sidemenu sidemenu-off">

				<nav id="main-nav-wrap" class="clearfix" itemscope="itemscope" itemtype="https://schema.org/SiteNavigationElement">
					<?php themify_theme_menu_nav(); ?>
					<!-- /#main-nav -->
				</nav>

				<a id="menu-icon-close" href="#sidr"></a>

			</div>
			<!-- /#mobile-menu -->



			<?php themify_header_end(); // hook ?>

		</header>

		<?php if( is_singular( 'album' ) ) { ?>

		</div>

		<?php } ?>
		<!-- /#header -->

        <?php themify_header_after(); // hook ?>

	</div>
	<!-- /#headerwrap -->

	<div id="body" class="clearfix">
    <?php themify_layout_before(); //hook ?>
