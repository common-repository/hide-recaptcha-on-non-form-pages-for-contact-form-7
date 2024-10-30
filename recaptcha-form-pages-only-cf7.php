<?php

/**
 *
 * @link              https://abhi.world/
 * @since             1.0.0
 * @package           Rfpocf7
 *
 * @wordpress-plugin
 * Plugin Name:       Hide reCAPTCHA on Non-Form Pages for Contact Form 7
 * Plugin URI:        https://abhi.world/recaptcha-form-pages-only-cf7
 * Description:       Simple little plugin that hides reCAPTCHA on pages without Forms for Contact Form 7
 * Version:           1.0.2
 * Author:            Abhi C.
 * Author URI:        https://abhi.world/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rfpocf7
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Current plugin version.
 */
define('RFPOCF7_VERSION', '1.0.2');

/*----------------------------------------------------------------------------*/
// Load Contact Form 7 & Google Recaptcha only pages with cf7 forms and shortcode
/*----------------------------------------------------------------------------*/
add_action('wp_enqueue_scripts', 'rfpocf7_dequeue_cf7_non_form_pages', 99);
function rfpocf7_dequeue_cf7_non_form_pages()
{
	// if contact form 7 plugin is installed
	global $post;

	if (isset($post) && is_singular() && has_shortcode($post->post_content, 'contact-form-7')) {
		return;
	}

	// remove_action('wp_enqueue_scripts', 'wpcf7_do_enqueue_scripts');
	// remove_action('wp_enqueue_scripts', 'wpcf7_recaptcha_enqueue_scripts');
	wp_dequeue_script('google-recaptcha');
	wp_dequeue_script('wpcf7-recaptcha');
}

/*----------------------------------------------------------------------------*/
// On page css to hide recaptcha badge
/*----------------------------------------------------------------------------*/
// add_action('wp_head', 'rfpocf7_enqueue_cf7_non_form_pages_css', 100);
// function rfpocf7_enqueue_cf7_non_form_pages_css()
// {
// 	echo "<style>.grecaptcha-badge {display: none!important;}</style>";
// }
