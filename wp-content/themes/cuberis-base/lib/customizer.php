<?php

/* Customizer */

function theme_customizer($wp_customize){

  /* Theme Customizer Sections */

  $wp_customize->add_section('main_logo_settings', array(
    'title'    => __('Site Logo', 'site_main'),
    'priority' => 10,
  ));

  $wp_customize->add_section('main_social_settings', array(
    'title'    => __('Social Links', 'site_main'),
    'priority' => 15,
  ));

  /* Custom Logo */

  $wp_customize->add_setting( 'main_logo' );

  $wp_customize->add_control(
    new WP_Customize_Image_Control(
      $wp_customize,
      'main_logo',
      array(
        'label' => 'Logo Upload',
        'section' => 'main_logo_settings',
        'settings' => 'main_logo'
      )
    )
  );

  /* Social Link Settings */

  $wp_customize->add_setting('main_twitter', array(
      'default'        => '',
  ));

  $wp_customize->add_control('main_twitter', array(
    'label'      => 'Twitter URL',
    'section'    => 'main_social_settings',
    'settings'   => 'main_twitter',
    'priority' => 1,
  ));

  $wp_customize->add_setting('main_facebook', array(
    'default'        => '',
  ));

  $wp_customize->add_control('main_facebook', array(
    'label'      => 'Facebook URL',
    'section'    => 'main_social_settings',
    'settings'   => 'main_facebook',
    'priority' => 2,
  ));

  $wp_customize->add_setting('main_youtube', array(
    'default'        => '',
  ));

  $wp_customize->add_control('main_youtube', array(
    'label'      => 'YouTube URL',
    'section'    => 'main_social_settings',
    'settings'   => 'main_youtube',
    'priority' => 3,
  ));

}
add_action('customize_register', 'theme_customizer');
