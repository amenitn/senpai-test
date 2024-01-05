<?php

/**
 * The core theme class.
 * 
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this theme as well as the current
 * version of the theme.
 *
 * @since      1.0.0
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/includes
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Senpai_Wp_Test_Loader    $loader    Maintains and registers all hooks for the theme.
	 */
	protected $loader;

	/**
	 * The unique identifier of this theme.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var string $senpai_wp_test    The string used to uniquely identify this theme.
	 */
	protected $senpai_wp_test;

	/**
	 * The current version of the theme.
	 *
	 * @since  1.0.0
	 * @access protected
	 * @var string $version The current version of the theme.
	 */
	protected $version;

	/**
	 * Define the core functionality of the theme.
	 *
	 * Set the theme name and the theme version that can be used throughout the theme.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public function __construct()
	{
		if (defined('SENPAI_WP_TEST_VERSION')) {
			$this->version = SENPAI_WP_TEST_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->senpai_wp_test = 'senpai-wp-test';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_theme_features();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this theme.
	 *
	 * Include the following files that make up the theme:
	 *
	 * - Senpai_Wp_Test_Loader. Orchestrates the hooks of the theme.
	 * - Senpai_Wp_Test_i18n. Defines internationalization functionality.
	 * - Senpai_Wp_Test_Admin. Defines all hooks for the admin area.
	 * - Senpai_Wp_Test_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for JSON handler of the theme.
		 * 
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-json.php';

		/**
		 * The class responsible for Random String Generator handler of the theme.
		 * 
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-rsg.php';

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-i18n.php';

		/**
		 * The class responsible for defining features
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-features.php';

		/**
		 * The class responsible for defining custom Nav Walker
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-nav-walker.php';

		/**
		 * The class responsible for defining custom Comment Walker
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-comment-walker.php';

		/**
		 * The class responsible for defining dashboard widgets
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-widgets.php';

		/**
		 * The class responsible for defining dashboard widgets
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-shortcodes.php';

		/**
		 * The class responsible for defining dashboard Notices
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-notices.php';

		/**
		 * The class responsible for defining APIs endpoints
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-api.php';

		/**
		 * The class responsible for defining MetaBoxes endpoints
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-metaboxes.php';

		/**
		 * The class responsible for defining Blocks
		 * of the theme.
		 */
		//require_once THEME_DIR . '/includes/class-senpai-wp-test-blocks.php';


		/**
		 * The class responsible for defining Customizer
		 * of the theme.
		 */
		require_once THEME_DIR . '/includes/class-senpai-wp-test-customizer.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once THEME_DIR . '/admin/class-senpai-wp-test-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once THEME_DIR . '/public/class-senpai-wp-test-public.php';

		$this->loader = new Senpai_Wp_Test_Loader();
	}

	/**
	 * Define the locale for this theme for internationalization.
	 *
	 * Uses the Senpai_Wp_Test_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function set_locale()
	{

		$theme_i18n = new Senpai_Wp_Test_i18n();

		$this->loader->add_action('themes_loaded', $theme_i18n, 'load_theme_textdomain');
	}

	/**
	 * Register all of the hooks related to the features functionality
	 * of the theme.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_theme_features()
	{

		$features = new Senpai_Wp_Test_Features();
		$features->addNavMenus(['primary-menu' => 'Primary', 'footer-menu' => 'Footer']);
		$features->addWidget('primary-widget', 'Primary Widget');
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the theme.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_admin_hooks()
	{

		$theme_admin = new Senpai_Wp_Test_Admin($this->get_senpai_wp_test(), $this->get_version());
		$theme_widgets = new Senpai_Wp_Test_Widgets();
		$theme_metaboxes = new Senpai_Wp_Test_MetaBoxes();
		//$theme_blocks = new Senpai_Wp_Test_Blocks();
		$theme_customizer = new Senpai_Wp_Test_Customizer();

		$theme_notices = new Senpai_Wp_Test_Notices();

		$this->loader->add_action('admin_enqueue_scripts', $theme_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $theme_admin, 'enqueue_scripts');
		$this->loader->add_action('wp_dashboard_setup', $theme_widgets, 'load_widgets');

		$this->loader->add_action('add_meta_boxes', $theme_metaboxes, 'register_metaboxes');

		//$this->loader->add_action( 'init', $theme_blocks, 'load_blocks' );
		//$this->loader->add_filter( 'block_categories', $theme_blocks, 'custom_blocks_cat', 10, 2 );

		$this->loader->add_action('customize_register', $theme_customizer, 'load_customizer');


		$this->loader->add_action('admin_notices', $theme_notices, 'get_all');
		$this->loader->add_action('wp_ajax_dashboard_notice_senpai', $theme_notices, 'dissmiss');
		$this->loader->add_action('admin_menu', $theme_admin, 'senpai_admin_pages_handler', 10);
		//$this->loader->add_action( 'wp_ajax_senpai_admin_text_ajax', $theme_admin, 'senpai_admin_text_ajax_handler');
		$this->loader->add_action('wp_ajax_edit_item', $theme_admin, 'edit_item_handler');
		$this->loader->add_action('wp_ajax_delete_item', $theme_admin, 'delete_item_handler');
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the theme.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function define_public_hooks()
	{

		$theme_public = new Senpai_Wp_Test_Public($this->get_senpai_wp_test(), $this->get_version());
		$theme_shortcodes = new Senpai_Wp_Test_ShortCodes();
		$theme_apis = new Senpai_Wp_Test_API();

		$this->loader->add_action('wp_enqueue_scripts', $theme_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $theme_public, 'enqueue_scripts');
		$this->loader->add_action('init', $theme_shortcodes, 'load_shortcodes');
		$this->loader->add_action('rest_api_init', $theme_apis, 'register_endpoints');
		$this->loader->add_action('wp_ajax_senpai_public_form_ajax', $theme_public, 'senpai_public_form_ajax_handler');
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since 1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the theme used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since 1.0.0
	 * @return string The name of the theme.
	 */
	public function get_senpai_wp_test()
	{
		return $this->senpai_wp_test;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the theme.
	 *
	 * @since 1.0.0
	 * @return Senpai_Wp_Test_Loader Orchestrates the hooks of the theme.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the theme.
	 *
	 * @since 1.0.0
	 * @return string The version number of the theme.
	 */
	public function get_version()
	{
		return $this->version;
	}
}
