<?php

/**
 * The admin-specific functionality of the theme.
 *
 * Defines the theme name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Senpai_Wp_Test
 * @subpackage Senpai_Wp_Test/admin
 * @author     Amine Safsafi <amine.safsafi@senpai.codes>
 */
class Senpai_Wp_Test_Admin
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
	 * @param      string    $senpai_wp_test       The name of this theme.
	 * @param      string    $version    The version of this theme.
	 */
	public function __construct($senpai_wp_test, $version)
	{

		$this->senpai_wp_test = $senpai_wp_test;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		wp_enqueue_style('senpai_wp_test_admin_loader_css', THEME_URI . '/admin/dist/main/senpai-wp-test-loader.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		wp_enqueue_script('senpai_wp_test_admin_loader_js', THEME_URI . '/admin/dist/main/senpai-wp-test-loader.js', array('wp-i18n', 'jquery'), $this->version, false);
		wp_enqueue_script('senpai_wp_test_admin_setting_js', THEME_URI . '/admin/dist/main/senpai-wp-test-setting.js', array('senpai_wp_test_admin_loader_js'), $this->version, false);

		wp_enqueue_script('senpai_notice_ajax', THEME_URI . '/admin/dist/main/senpai-wp-test-notice.js', array('senpai_wp_test_admin_loader_js'),	$this->version, false);
		wp_localize_script('senpai_notice_ajax', 'senpai_notice_ajax_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
			'nonce' => wp_create_nonce('senpai-ajax-notice-nonce')
		));

		//senpain form actions
		wp_enqueue_script('senpai-ajax-actions', THEME_URI . '/admin/dist/main/senpai-wp-form-actions.js', array('senpai_wp_test_admin_loader_js'), $this->version, false);
		wp_localize_script('senpai-ajax-actions', 'senpai_ajax_actions_params', array(
			'ajaxurl' => site_url() . '/wp-admin/admin-ajax.php',
			'nonce' => wp_create_nonce('senpai-ajax-actions-nonce')
		));
	}

	public function senpai_admin_pages_handler()
	{
		add_menu_page(
			'Administration',
			'New area',
			'manage_options',
			'form_page',
			array($this, 'form_page_render'),
			'dashicons-smiley',
			4
		);
	}
	public function form_page_render()
	{
		$dir = THEME_DIR . '/admin/partials/';
		include($dir . 'form-display.php');
	}

	public function senpai_admin_text_ajax_handler()
	{
		senpai_log($_POST);
	}


	//form UD functions
	///////// EDIT ACTION ///////

	public function edit_item_handler()
	{
		senpai_log($_POST);
		$nonce = (string)$_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'senpai-ajax-actions-nonce')) {
			senpai_log('entereddd');
			$response = array(
				'success' => 0,
				'code' => 403,
				'data' => array(),
				'error' => array('Something is going wrong')
			);
			wp_send_json($response);
		}

		$id = (string)$_POST['id'];
		$name = (string)$_POST['new_name'];
		$email = (string)$_POST['new_email'];
		$phone = (string)$_POST['new_phone'];
		$message = (string)$_POST['new_message'];
		senpai_log('preparing sql');

		global $wpdb;
		$table_name = $wpdb->prefix . "senpai_form_test";
		$success = $wpdb->update($table_name, array('name' => $name, 'email' => $email, 'phone' => $phone, 'message' => $message), array( 'ID' => $id ));
		senpai_log('rep', $success);

		$response = array(
			'success' => $success,
			'code' => 200,
			'data' => array(),
			'error' => array()
		);
		wp_send_json($response);
	}

	///////// DELETE ACTION ///////
	public function delete_item_handler()
	{
		senpai_log($_POST);
		$id = (string)$_POST['id'];
		$nonce = (string)$_POST['nonce'];

		if (!wp_verify_nonce($nonce, 'senpai-ajax-actions-nonce')) {
			$response = array(
				'success' => 0,
				'code' => 403,
				'data' => array(),
				'error' => array('Something is going wrong')
			);
			wp_send_json($response);
		}

		global $wpdb;
		$table_name = $wpdb->prefix . "senpai_form_test";
		$success = $wpdb->delete($table_name, array('id' => $id));
		senpai_log($success);

		$response = array(
			'success' => $success,
			'code' => 200,
			'data' => array(),
			'error' => array()
		);
		wp_send_json($response);
	}
}
