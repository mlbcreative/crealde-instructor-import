<?php
/**
 * Plugin Name: Proclass Instructor Import
 * Plugin URI: http://mlbcreative.com
 * Description: This plugin remotely loads all of the instructors into the WP Backend
 * Version: 1.0.0
 * Author: Charles Rosenberger
 * Author URI: http://mlbcreative.com
 * License: GPL2
 */
 
 
require_once plugin_dir_path( __FILE__ ) . 'inc/pi-import-class.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/pi-register-instructor-post-type.php';
 
 function pii_admin_page() {
	 global $pii_settings;
	 //$pii_settings = add_options_page(__('Proclass Instructor Import', 'pii'), __('Proclass Instructor Import', 'pii'), 'manage_options', 'admin-proclass-instructor-import', 'pii_render_admin');
	 $pii_settings = add_submenu_page(
	 	'edit.php?post_type=instructor',
	 	'Import Instructors',
	 	'Import',
	 	'manage_options',
	 	'import_instructors',
	 	'pii_render_admin'
	 	);
	 
 }
 add_action('admin_menu', 'pii_admin_page');
 
 function pii_render_admin() {
	?>
	 	<div class="wrap">
		 	<h2><?php _e('ProClass Class / Workshop Importer', 'pci'); ?> </h2>
		 	<p><?php _e('This plugin allows you to import all current Crealdé Instructors into the Wordpress admin dashboard. Just click the button, sit back and let the magic happen.'); ?></p>
		 	<form id="pii-form" action="" method="POST">
			 	<div>
				 	<label for="class_id">Enter the Proclass Id<br />
				 		<input type="text" placeholder="Proclass Instructor Id" name="instructorid" id="instructor_id"/>
				 	</label><br />
				 	<br />
				 	<input type="submit" name="instructor-import" class="button-primary" value="<?php _e('Import Instructor' ,'pci') ?>"/>
				 	<div id="loadingMsg">Fetching class information from ProClass.</div>
			 	</div>
		 	</form>
		 	
	 	</div>
	 <?php
 }
 
 function pii_load_scripts($hook) {
	 global $pii_settings;
	 
	 if( $hook != $pii_settings)
	 	return;
	 wp_enqueue_style( 'pii-styles', plugin_dir_url(__FILE__) . 'css/pii-styles.css');
	 wp_enqueue_script('pii-ajax', plugin_dir_url(__FILE__) . 'js/pii-ajax.js', array('jquery'));
	 //wp_localize_script('pii-ajax', 'piImport', array ('url' => 'options-general.php?page=admin-proclass-instructor-import'));
	 
 }
add_action('admin_enqueue_scripts', 'pii_load_scripts'); 
 
 
 function getProClassInstructors() {
	 
	 
	 

	  if ( isset($_POST['instructorid'])) {
		 
		//echo $_POST['instructorid'];
		 
		 $instructorid = $_POST['instructorid'];
		 
		 $importer = new ProClassInstructorImport($_POST['instructorid']);
		 echo $importer->fetchInstructor();
	 } 
	 
	 die();
	 
 }
 add_action('wp_ajax_pii_get_results', 'getProClassInstructors');
