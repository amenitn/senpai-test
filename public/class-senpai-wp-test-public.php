<?php

/**
 * The public-facing functionality of the theme.
 *
 * Defines the theme name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/public
 * @author     Your Name <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_Public
{

	/**
	 * The ID of this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $senpai_wp_test    The ID of this theme.
	 */
	private $senpai_wp_test;

	/**
	 * The version of this theme.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this theme.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $senpai_wp_test       The name of the theme.
	 * @param      string    $version    The version of this theme.
	 */
	public function __construct($senpai_wp_test, $version)
	{

		$this->senpai_wp_test = $senpai_wp_test;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		wp_enqueue_style('senpai_wp_test_public_loader_css', THEME_URI . '/public/dist/main/senpai-wp-test-loader.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script('senpai_wp_test_public_loader_js', THEME_URI . '/public/dist/main/senpai-wp-test-loader.js', array('wp-i18n'), $this->version, false);
		wp_enqueue_script('senpai_wp_test_public_js', THEME_URI . '/public/dist/main/senpai-wp-test-public.js', array('senpai_wp_test_public_loader_js'), $this->version, false);
		wp_localize_script('senpai_wp_test_public_js', 'senpai_wp_test_public_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
			'nonce' => wp_create_nonce('senpai-ajax-public-nonce'),
		));

		//form localizer goes here
		wp_enqueue_script('senpai_form_ajax', THEME_URI . '/public/dist/main/senpai-wp-form-public.js', array('senpai_wp_test_public_loader_js'), $this->version, false);
		wp_localize_script('senpai_form_ajax', 'senpai_form_ajax_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
			'nonce' => wp_create_nonce('senpai-ajax-public-nonce'),
		));
	}
	public function form_page_render()
	{
		$dir = THEME_DIR . '/public/index.php/';
		include($dir . 'form-display.php');
	}
	public function senpai_public_form_ajax_handler()
	{
		senpai_log($_POST);
		$nonce = (string)$_POST['nonce'];
		if (!wp_verify_nonce($nonce,'senpai-ajax-public-nonce')) {
			$response = array(
				'success' => 0,
				'code' => 403,
				'data' => array(),
				'error' => array('Something is going wrong')
			);
			wp_send_json($response);
		} 

		//normal scénario  
		$name=(string)$_POST['name'];
		$email=(string)$_POST['email'];
		$phone=(string)$_POST['phone'];
		$message=(string)$_POST['message'];
		global $wpdb;
		$table_name = $wpdb->prefix . "senpai_form_test";
		$success=$wpdb->insert( $table_name, array(
			'name' => $name,
			'email'=> $email,
			'phone'=> $phone,
			'message'=> $message,
		));

		$response = array(
			'success' => $success,
			'code' => 200,
			'data' => array(),
			'error' => array()
		);
		wp_send_json($response);
	}
}
