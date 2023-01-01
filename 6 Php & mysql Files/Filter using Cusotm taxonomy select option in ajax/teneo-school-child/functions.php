<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION

add_filter( 'locale_stylesheet_uri', 'teneo_child_cfg_locale_css' );
if ( !function_exists( 'teneo_child_cfg_locale_css' ) ) {
    function teneo_child_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
}

require 'schools-functions.php';
require 'fees-functions.php';


add_action( 'wp_enqueue_scripts', 'teneo_child_cfg_parent_css', 10 );
if ( !function_exists( 'teneo_child_cfg_parent_css' ) ) {

    function teneo_child_cfg_parent_css() {
    wp_enqueue_script( 'jquery');
        wp_enqueue_style( 'teneo_child_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array(  ) );
		
		// schools  & fees
		if( is_page ('our-schools') || is_page (147) || is_page (1261) ) {
						
			wp_enqueue_style('teneo-bootstrap', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/bootstrap.min.css' , array(), '0.1.0', 'all');
			wp_enqueue_style('teneo-shools-fees', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/teneo-only-schools.css' , array(), '0.1.0', 'all');
			
			wp_enqueue_script( 'custom-script-schools', get_stylesheet_directory_uri() . '/assets/js/custom-script-schools.js', array(), time(), true );
   
		}
		
		
		if( is_page ('fees') || is_page (1205) ) {
						
			wp_enqueue_style('teneo-bootstrap', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/bootstrap.min.css' , array(), '0.1.0', 'all');
			wp_enqueue_style('teneo-only-fees', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/teneo-only-fees.css' , array(), '0.1.0', 'all');
			
			wp_enqueue_script( 'teneo-bootstrap-bundle', get_stylesheet_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array(), '0.1.0', true );
			wp_enqueue_script( 'custom-script-schools', get_stylesheet_directory_uri() . '/assets/js/custom-script-schools.js', array(), time(), true );
			
		}
		
		if( is_page ('fees-filters-func') || is_page (3584) ) {
						
			wp_enqueue_style('teneo-bootstrap', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/bootstrap.min.css' , array(), '0.1.0', 'all');
			wp_enqueue_style('teneo-only-fees', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/css/teneo-functionality-q-fees.css' , array(), '0.1.0', 'all');
			
		}
		
    }
	
	
}


// END ENQUEUE PARENT ACTION



add_shortcode( 'teneo-schools-filters','teneo_our_schools_filters'  );
function teneo_our_schools_filters(  ) {
	//echo get_stylesheet_directory().'/our-schools-filters.php';
	ob_start();
	require get_stylesheet_directory().'/includes/our-schools-filters.php';
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}


add_shortcode( 'functionality-teneo-schools-filters','functionality_teneo_our_schools_filters'  );
function functionality_teneo_our_schools_filters(  ) {
	//echo get_stylesheet_directory().'/our-schools-filters.php';
	ob_start();
	require get_stylesheet_directory().'/includes/test-dynamic-func-our-schools-filters.php';
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}


add_shortcode( 'teneo-fees-filters','teneo_only_fees_filters'  );
function teneo_only_fees_filters(  ) {
	//echo get_stylesheet_directory().'/our-schools-filters.php';
	ob_start();
	require get_stylesheet_directory().'/includes/fee-filters.php';
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

add_shortcode( 'teneo-fees-filters-func','teneo_only_fees_filters_functionality'  );
function teneo_only_fees_filters_functionality(  ) {
	//echo get_stylesheet_directory().'/our-schools-filters.php';
	ob_start();
	require get_stylesheet_directory().'/includes/functionality-fee-q-filters.php';
	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
}

//------------------ code by zee start--------------------------------------------------------//
add_action('wp_head', 'filter_ajaxurl');

function filter_ajaxurl() {

   echo '<script type="text/javascript">
           var custom_ajaxurl = "' . admin_url('admin-ajax.php') . '";
         </script>';
}
add_action("wp_ajax_school_search_filter_function", "school_search_filter_function");
add_action("wp_ajax_nopriv_school_search_filter_function", "school_search_filter_function");

function school_search_filter_function() {
 parse_str($_POST['all_data'], $filters_arr);
 // print_r($filters_arr); exit;
$html_content = get_schools_listing_html_data($filters_arr);	
$res_status = array();
$res_status['success'] = 'sent';
$res_status['schools_listing'] = $html_content;
echo json_encode($res_status);
exit;
}




add_action("wp_ajax_fees_search_filter_function", "fees_search_filter_function");
add_action("wp_ajax_nopriv_fees_search_filter_function", "fees_search_filter_function");

function fees_search_filter_function() {
 parse_str($_POST['all_data'], $filters_arr);
 // print_r($filters_arr); exit;
$html_content = get_fees_data_school_listing_html($filters_arr);	
$res_status = array();
$res_status['success'] = 'sent';
$res_status['schools_listing'] = $html_content;
echo json_encode($res_status);
exit;
}