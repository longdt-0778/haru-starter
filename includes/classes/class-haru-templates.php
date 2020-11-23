<?php

// Reference: https://jeroensormani.com/how-to-add-template-files-in-your-plugin/
/**
 * Locate template.
 *
 * Locate the called template.
 * Search Order:
 * 1. /themes/theme/your-plugin-name/$template_name
 * 2. /themes/theme/$template_name
 * 3. /plugins/your-plugin-name/templates/$template_name.
 *
 * @since 1.0.0
 *
 * @param 	string 	$template_name			Template to load.
 * @param 	string 	$string $template_path	Path to templates.
 * @param 	string	$default_path			Default path to template files.
 * @return 	string 							Path to the template file.
 */

function haru_locate_template( $template_name, $template_path = '', $default_path = '' ) {

	// Set variable to search in woocommerce-plugin-templates folder of theme.
	if ( ! $template_path ) :
		$template_path = HARU_STARTER_CORE_NAME . '/';
	endif;

	// Set default plugin templates path.
	if ( ! $default_path ) :
		$default_path = HARU_STARTER_CORE_DIR . 'templates/'; // Path to the template folder
	endif;

	// Search template file in theme folder.
	$template = locate_template( array(
		$template_path . $template_name,
		$template_name
	) );

	// Get plugins template file.
	if ( ! $template ) :
		$template = $default_path . $template_name;
	endif;

	return apply_filters( 'haru_locate_template', $template, $template_name, $template_path, $default_path );

}

/**
 * Get template.
 *
 * Search for the template and include the file.
 *
 * @since 1.0.0
 *
 * @see haru_locate_template()
 *
 * @param string 	$template_name			Template to load.
 * @param array 	$settings				Args passed for the template file. ($args)
 * @param string 	$string $template_path	Path to templates.
 * @param string	$default_path			Default path to template files.
 */

function haru_get_template( $template_name, $settings = array(), $tempate_path = '', $default_path = '' ) {

	// if ( is_array( $settings ) && isset( $settings ) ) :
	// 	extract( $settings );
	// endif;

	$template_file = haru_locate_template( $template_name, $tempate_path, $default_path );

	if ( ! file_exists( $template_file ) ) :
		_doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $template_file ), '1.0.0' );
		return;
	endif;

	include $template_file;

}

