<?php

namespace App;

use Roots\Sage\Container;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\Blade;
use Roots\Sage\Template\BladeProvider;

/**
 * Theme assets
 */
$assets_ver = '1.0.1';
add_action( 'wp_enqueue_scripts', function() use ( $assets_ver ) {
	wp_enqueue_style( 'theme/app.css', asset_path( 'styles/app.css' ), [], $assets_ver );
	wp_enqueue_script( 'theme/app.js', asset_path( 'scripts/app.js' ), [ 'jquery' ], $assets_ver, 'true' );

	if ( is_single() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}, 100 );

//add_action( 'enqueue_block_editor_assets', function() use ( $assets_ver ) {
//	wp_enqueue_style( 'theme/editor-styles', asset_path( 'styles/editor-styles.css' ), [], $assets_ver );
//} );
add_action( 'wp_head', function() {
	global $post;
	//
	$page_title       = get_bloginfo( 'name' );
	$page_type        = 'website';
	$page_description = get_bloginfo( 'description' );

	$page_url = get_permalink();
	$page_url = preg_match( '~/wp-json/~', $page_url ) ? null : $page_url;

	$og_image = file_exists( get_theme_file_path() . '/og-image.png' ) ? home_url( 'og-image.png' ) : null;
	if ( $og_image ) {
		$image_size      = getimagesize( get_theme_file_path() . '/og-image.png' );
		$og_image_width  = $image_size[0] ?? null;
		$og_image_height = $image_size[1] ?? null;
	}

	if ( !empty( $post->ID ) && !is_front_page() ) {
		if ( has_post_thumbnail( $post ) ) {
			$og_image = get_the_post_thumbnail_url( $post );
		}
		$page_title = get_bloginfo( 'name' ) . ' | ' . get_the_title( $post );
		if ( !empty( $post->post_excerpt ) ) {
			$page_description = get_the_excerpt( $post );
		}
	}

	if ( !empty( $page_url ) ):

		?>
        <meta name="description" content="<?php echo sanitize_text_field( $page_description ) ?>" />
		<?php /* <!--<meta property="fb:app_id" content="[app id goes here]" />--> */ ?>
        <meta property="og:url" content="<?php echo $page_url ?>" />
        <meta property="og:type" content="<?php echo $page_type ?>" />
        <meta property="og:title" content="<?php echo $page_title ?>" />

		<?php
		if ( !empty( $og_image ) ): ?>
            <meta property="og:image" content="<?php echo $og_image ?>" />
			<?php if ( !empty( $og_image_width ) && !empty( $og_image_height ) ): ?>
                <meta property="og:image:width" content="<?php echo $og_image_width ?>" />
                <meta property="og:image:height" content="<?php echo $og_image_height ?>" />
			<?php endif; ?>
		<?php endif; ?>

        <meta property="og:description" content="<?php echo sanitize_text_field( $page_description ) ?>" />
	<?php
	endif;

	if ( file_exists( get_template_directory() . '/favicon/favicon-16x16.png' ) ):
		?>
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo home_url( 'favicon/apple-icon-57x57.png' ) ?>">
        <link rel="apple-touch-icon" sizes="60x60" href="<?php echo home_url( 'favicon/apple-icon-60x60.png' ) ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo home_url( 'favicon/apple-icon-72x72.png' ) ?>">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo home_url( 'favicon/apple-icon-76x76.png' ) ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo home_url( 'favicon/apple-icon-114x114.png' ) ?>">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo home_url( 'favicon/apple-icon-120x120.png' ) ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo home_url( 'favicon/apple-icon-144x144.png' ) ?>">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo home_url( 'favicon/apple-icon-152x152.png' ) ?>">
        <link rel="apple-touch-icon" sizes="180x180" href="<?php echo home_url( 'favicon/apple-icon-180x180.png' ) ?>">
        <link rel="icon" type="image/png" sizes="192x192" href="<?php echo home_url( 'favicon/android-icon-192x192.png' ) ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?php echo home_url( 'favicon/favicon-32x32.png' ) ?>">
        <link rel="icon" type="image/png" sizes="96x96" href="<?php echo home_url( 'favicon/favicon-96x96.png' ) ?>">
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo home_url( 'favicon/favicon-16x16.png' ) ?>">
        <link rel="manifest" href="<?php echo home_url( 'favicon/manifest.json' ) ?>">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="<?php echo home_url( 'favicon/ms-icon-144x144.png' ) ?>">
        <meta name="theme-color" content="#ffffff">
	<?php
	endif;

	//$ga_id = 'UA-XXXXXXXXX-X';
	$ga_id = null;

	if ( empty( $ga_id ) || preg_match( '~\.test|/review/~', home_url() ) ) return;

	?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $ga_id ?>"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {dataLayer.push(arguments);}

        gtag('js', new Date());

        gtag('config', '<?php echo $ga_id ?>');
    </script>

	<?php
} );
/**
 * Theme setup
 */
add_action( 'after_setup_theme', function() {
	//if ( !class_exists( 'ACF' ) && !is_admin() && php_sapi_name() != 'cli' ) :
	//	wp_die( 'Advanced Custom Fields PRO plugin is required for theme to work' );
	//endif;
	/**
	 * Enable features from Soil when plugin is activated
	 *
	 * @link https://roots.io/plugins/soil/
	 */
	add_theme_support( 'soil-clean-up' );
	add_theme_support( 'soil-jquery-cdn' );
	add_theme_support( 'soil-nav-walker' );
	add_theme_support( 'soil-nice-search' );
	add_theme_support( 'soil-relative-urls' );

	/**
	 * Enable plugins to manage the document title
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Register navigation menus
	 *
	 * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
	 */
	register_nav_menus( [
		'primary' => __( 'Primary Navigation', 'sage' ),
	] );

	/**
	 * Enable post thumbnails
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * Enable HTML5 markup support
	 *
	 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
	 */
	add_theme_support( 'html5', [ 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ] );

	/**
	 * Enable selective refresh for widgets in customizer
	 *
	 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#theme-support-in-sidebars
	 */
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Use main stylesheet for visual editor
	 *
	 * @see resources/assets/styles/layouts/_tinymce.scss
	 */
	add_editor_style( asset_path( 'styles/editor-styles.css?v1.0.0.1' ) );

	/**
	 * WP Header Cleanup - remove all unnecessary code from header
	 */
	remove_action( 'wp_head', 'wlwmanifest_link' ); // remove wlwmanifest.xml (needed to support windows live writer)
	remove_action( 'wp_head', 'wp_generator' ); // remove wordpress version

	remove_action( 'wp_head', 'rsd_link' ); // remove really simple discovery link
	remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); // remove shortlink

	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );  // remove emojis
	remove_action( 'wp_print_styles', 'print_emoji_styles' );   // remove emojis

	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' ); // remove the / and previous post links

	remove_action( 'wp_head', 'feed_links', 2 ); // remove rss feed links
	remove_action( 'wp_head', 'feed_links_extra', 3 ); // removes all extra rss feed links

	remove_action( 'wp_head', 'rest_output_link_wp_head', 10 ); // remove the REST API link
	remove_action( 'wp_head', 'wp_oembed_add_discovery_links' ); // remove oEmbed discovery links
	remove_action( 'template_redirect', 'rest_output_link_header', 11, 0 ); // remove the REST API link from HTTP Headers

	remove_action( 'wp_head', 'wp_oembed_add_host_js' ); // remove oEmbed-specific javascript from front-end / back-end

	remove_action( 'rest_api_init', 'wp_oembed_register_route' ); // remove the oEmbed REST API route
	remove_filter( 'oembed_dataparse', 'wp_filter_oembed_result', 10 ); // don't filter oEmbed results

}, 20 );

/**
 * Register sidebars
 */
add_action( 'widgets_init', function() {
	$config = [
		'before_widget' => '<section class="widget %1$s %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	];
	register_sidebar( [
			'name' => __( 'Primary', 'sage' ),
			'id'   => 'sidebar-primary',
		] + $config );
	register_sidebar( [
			'name' => __( 'Footer', 'sage' ),
			'id'   => 'sidebar-footer',
		] + $config );
} );

/**
 * Updates the `$post` variable on each iteration of the loop.
 * Note: updated value is only available for subsequently loaded views, such as partials
 */
add_action( 'the_post', function( $post ) {
	sage( 'blade' )->share( 'post', $post );
} );

/**
 * Setup Sage options
 */
add_action( 'after_setup_theme', function() {
	/**
	 * Add JsonManifest to Sage container
	 */
	sage()->singleton( 'sage.assets', function() {
		return new JsonManifest( config( 'assets.manifest' ), config( 'assets.uri' ) );
	} );

	/**
	 * Add Blade to Sage container
	 */
	sage()->singleton( 'sage.blade', function( Container $app ) {
		$cachePath = config( 'view.compiled' );
		if ( !file_exists( $cachePath ) ) {
			wp_mkdir_p( $cachePath );
		}
		( new BladeProvider( $app ) )->register();

		return new Blade( $app['view'] );
	} );

	/**
	 * Create @asset() Blade directive
	 */
	sage( 'blade' )->compiler()->directive( 'asset', function( $asset ) {
		return "<?php echo " . __NAMESPACE__ . "\\asset_path({$asset}); ?>";
	} );

	/**
	 * Create @header() Blade directive
	 */
	sage( 'blade' )->compiler()->directive( 'head', function() {
		return "<?php wp_head(); ?>";
	} );

	/**
	 * Create @footer() Blade directive
	 */
	sage( 'blade' )->compiler()->directive( 'footer', function() {
		return "<?php wp_footer(); ?>";
	} );

	/**
	 * Create @do_action() Blade directive
	 */
	sage( 'blade' )->compiler()->directive( 'do_action', function( $action ) {
		return "<?php do_action({$action}); ?>";
	} );

	/**
	 * Create @menu() Blade directive
	 */
	sage( 'blade' )->compiler()->directive( 'menu', function( $params ) {
		return "<?php wp_nav_menu({$params}); ?>";
	} );

	/**
	 * Create @body_class() Blade directive
	 */
	sage( 'blade' )->compiler()->directive( 'body_class', function( $params = null ) {
		return "<?php body_class({$params}); ?>";
	} );
} );
