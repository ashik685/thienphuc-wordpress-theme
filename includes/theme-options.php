<?php  

/**
 * Initialize the options before anything else. 
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array(
    'contextual_help' => array(
      'content'       => array( 
        array(
          'id'        => 'general_help',
          'title'     => 'General',
          'content'   => '<p>Help content goes here!</p>'
          )
        ),
      'sidebar'       => '<p>Sidebar content goes here!</p>',
      ),
    'sections'        => array(
      array(
        'id'          => 'general',
        'title'       => 'General'
        ),
      array(
        'id'          => 'header',
        'title'       => 'Header'
        ),
      array(
        'id'          => 'footer',
        'title'       => 'Footer'
        )
      ),
    'settings'        => array(
      // section General
      array(
        'id'          => 'width_content',
        'label'       => 'Width Content',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'section'     => 'general',
        'class'       => ''
        ),
       array(
        'id'          => 'smooth_chrome',
        'label'       => 'Smooth Chrome Scrolling',
        'desc'        => '',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'general',
        'class'       => ''
        ),
      array(
        'id'          => 'custom_css',
        'label'       => 'Custom CSS',
        'type'        => 'CSS',
        'section'     => 'general',
        ),
      array(
        'id'          => 'custom_js',
        'label'       => 'Custom JavaScript',
        'type'        => 'textarea-simple',
        'section'     => 'general',
        'class'       => '',
        'rows'        => '4'
        ),
      // section header
      array(
        'id'          => 'logo',
        'label'       => 'Logo',
        'desc'        => '',
        'std'         => '',
        'type'        => 'Upload',
        'section'     => 'header',
        'class'       => ''
        ),
      array(
        'id'          => 'search_bar',
        'label'       => 'Search Bar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'on-off',
        'section'     => 'header',
        'class'       => ''
        ),
       array(
        'id'          => 'social_links',
        'label'       => __( 'Social Links', 'theme-text-domain' ),
        'desc'        => '',
        'std'         => '',
        'type'        => 'social-links',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
        array(
        'id'          => 'privacy_policy_1',
        'label'       => __( 'Privacy policy 1', 'theme-text-domain' ),
        'desc'        => __( 'The Page Select displays Privacy policy - Footer', 'theme-text-domain' ),
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
      array(
        'id'          => 'privacy_policy_2',
        'label'       => __( 'Privacy policy 2', 'theme-text-domain' ),
        'desc'        => __( 'The Page Select displays Privacy policy - Footer', 'theme-text-domain' ),
        'std'         => '',
        'type'        => 'page-select',
        'section'     => 'footer',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      ),
       array(
        'id'          => 'footer_copyright',
        'label'       => __( 'Footer Copyright', 'theme-text-domain' ),
        'desc'        => __( 'Area Text Footer Copyright ', 'theme-text-domain' ),
        'std'         => '',
        'type'        => 'textarea',
        'section'     => 'footer',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'min_max_step'=> '',
        'class'       => '',
        'condition'   => '',
        'operator'    => 'and'
      )

      )
    

    );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}

?>