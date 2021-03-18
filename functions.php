<?php
define( 'TEMPPATH', get_stylesheet_directory_uri());
define( 'IMAGES', TEMPPATH . "/images");

function custom_login_css() {

	echo '<link rel="stylesheet" type="text/css" href ="'.get_stylesheet_directory_uri().'/login/login-style.css" />';
}
add_action('login_head', 'custom_login_css');

function wpb_add_google_fonts() {
	wp_enqueue_style( 'kaeordic-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:100,300,400,700,900', false ); 
}
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );

function wp_enqueue_css_styles(){

	$parent_style = 'themify-music';

	wp_enqueue_style($parent_style, get_stylesheet_directory_uri(). '/includes/fonts/fonts.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/media-queries.min.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/mobile-menu.min.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/rtl.min.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/base.min.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/themify.common.min.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/themify-ui.min.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/lightbox.min.css', false);
	wp_enqueue_style($parent_style, get_template_directory_uri() . '/themify/css/themify-ui-rtl.min.css', false);

}

add_action('wp_enqueue_scripts', 'wp_enqueue_css_styles');

function register_menus() {
  register_nav_menu( 'copyright', __( 'Copyright Menu', 'copyright-menu' ) );
}

function child_theme_txtdomain(){

	load_child_theme_textdomain('themify-child', get_stylesheet_directory_uri() . '/languages');

}
add_action('after_setup_theme', 'child_theme_txtdomain');

add_action( 'after_setup_theme', 'register_menus' );

add_action( 'widgets_init', 'child_register_sidebar' );

function child_register_sidebar(){

	if ( function_exists( 'register_sidebar' ) ) 
		{ 
		register_sidebar( array(
			'name' => 'Contact Us',
			'id' => 'contact-us',
			'description' => 'Widgets here are on the contact us page',
			'before_widget' => '<div id="contact-sidebar-%1$s" class="widget contact-widget">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="widgettitle">',
			'after_title'=> '</h4>'
		) );
	}

}

function custom_register_song_post_type() {
	register_post_type( 'album', array(
		'labels' => array(
			'name' => __('Albums', 'themify'),
			'singular_name' => __('Album', 'themify'),
		),
		'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'trackbacks', 'custom-fields', 'revisions', 'page-attributes' ),
		'has_archive' => true,
		'hierarchical' => false,
		'public' => true,
		'exclude_from_search' => false,
		'rewrite' => array(
			'slug' => 'songs',
			'with_front' => false,
		),
		'query_var' => true,
		'can_export' => true,
		'capability_type' => 'post',
		'menu_icon' => 'dashicons-images-alt2',
	));
}
add_action( 'init', 'custom_register_song_post_type', 20 );


add_action( 'add_meta_boxes', 'gp_add_meta_boxes' );
function gp_add_meta_boxes() {
    add_meta_box( 'song_link', 'Song Links', 'song_link_callback', 'album', 'advanced', 'high' );
}

function song_link_callback( $post ) {
    $itunes = get_post_meta( $post->ID, 'itunes', true );
    $spotify = get_post_meta( $post->ID, 'spotify', true );
    $amazon = get_post_meta( $post->ID, 'amazon', true );
    $gplay = get_post_meta( $post->ID, 'gplay', true );
    $cdbaby = get_post_meta( $post->ID, 'cdbaby', true );
    $sndcld = get_post_meta( $post->ID, 'sndcld', true );
    $bandcamp = get_post_meta( $post->ID, 'bandcamp', true );
    $pandora = get_post_meta( $post->ID, 'pandora', true );

    ?>
    <p>iTunes Link: <input type="text" name="itunes" value="<?php echo $itunes; ?>" style="width:100%;" /></p>
    <p>Spotify Link: <input type="text" name="spotify" value="<?php echo $spotify; ?>" style="width:100%;" /></p>
    <p>Amazon Link: <input type="text" name="amazon" value="<?php echo $amazon; ?>" style="width:100%;" /></p>
    <p>Google Play Link: <input type="text" name="gplay" value="<?php echo $gplay; ?>" style="width:100%;" /></p>
    <p>CD Baby Link: <input type="text" name="cdbaby" value="<?php echo $cdbaby; ?>" style="width:100%;" /></p>
    <p>SoundCloud Link: <input type="text" name="sndcld" value="<?php echo $sndcld; ?>" style="width:100%;" /></p>
    <p>BandCamp Link: <input type="text" name="bandcamp" value="<?php echo $bandcamp; ?>" style="width:100%;" /></p>
    <p>Pandora Link: <input type="text" name="pandora" value="<?php echo $pandora; ?>" style="width:100%;" /></p>
    <?php
}

function wpdocs_save_meta_box( $post_id, $post, $update ) {
    	global $post;

    	$post_type = get_post_type( $post_id );

    	if( "album" != $post_type ) return;


				if ( isset($_POST['itunes']) ) {
					update_post_meta($post_id, "itunes", esc_attr($_POST["itunes"]));
				}
				if ( isset($_POST['spotify']) ) {
					update_post_meta($post_id, "spotify", esc_attr($_POST["spotify"]));
				}
				if ( isset($_POST['amazon']) ) {
					update_post_meta($post_id, "amazon", esc_attr($_POST["amazon"]));
				}
				if ( isset($_POST['gplay']) ) {
					update_post_meta($post_id, "gplay", esc_attr($_POST["gplay"]));
				}
				if ( isset($_POST['cdbaby']) ) {
					update_post_meta($post_id, "cdbaby", esc_attr($_POST["cdbaby"]));
				}
				if ( isset($_POST['sndcld']) ) {
					update_post_meta($post_id, "sndcld", esc_attr($_POST["sndcld"]));
				}
				if ( isset($_POST['bandcamp']) ) {
					update_post_meta($post_id, "bandcamp", esc_attr($_POST["bandcamp"]));
				}
				if ( isset($_POST['pandora']) ) {
					update_post_meta($post_id, "pandora", esc_attr($_POST["pandora"]));
				}


 }
add_action( 'save_post', 'wpdocs_save_meta_box', 10, 3 );


?>