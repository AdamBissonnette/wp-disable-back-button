<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = DBB__OPTIONS;

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => $opt_name,
        'use_cdn' => FALSE,
        'display_name' => 'DBB Options',
        'display_version' => FALSE,
        'page_slug' => 'dbb_options',
        'page_title' => 'DBB Options',
        'update_notice' => TRUE,
        'intro_text' => '',
        'footer_text' => '',
        'admin_bar' => TRUE,
        'menu_type' => 'submenu',
        'menu_title' => 'DBB Options',
        'allow_sub_menu' => TRUE,
        'page_parent' => 'options-general.php',
        'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'default_mark' => '*',
        'hints' => array(
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => FALSE,
        'show_import_export' => FALSE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );

    Redux::setArgs( $opt_name, $args );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Settings', DBB__DOMAIN ),
        'id'     => 'basic',
        'desc'   => __( '', DBB__DOMAIN ),
        'icon'   => 'el el-home',
        'fields' => array(
            array(
                'id'       => 'shortcode-info',
                'type'     => 'info',
                'title'    => __( 'Disable Back Button', DBB__DOMAIN ),
                'desc'     => __( 'To use this plugin on a single page simply drop this shortcode onto the page/post: [dbb /]', DBB__DOMAIN )
            ),
            array(
                'id'       => 'disable_sitewide',
                'type'     => 'checkbox',
                'title'    => __( 'Disable Sitewide', DBB__DOMAIN ),
                'subtitle'     => __( 'Disabled the back button on every page', DBB__DOMAIN ),
                'default' => false
            ),
            array(
                'id'       => 'never_disable_for_user',
                'type'     => 'checkbox',
                'title'    => __( 'Exclude Users', DBB__DOMAIN ),
                'subtitle'     => __( 'Don\'t disable for logged in users', DBB__DOMAIN ),
                'default' => false
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'General', DBB__DOMAIN ),
        'id'    => 'basic',
        'desc'  => __( 'Info and settings', DBB__DOMAIN ),
        'icon'  => 'el el-home'
    ) );

    /*
     * <--- END SECTIONS
     */
