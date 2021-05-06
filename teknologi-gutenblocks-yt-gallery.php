<?php

/**
* Plugin Name: Tekno.dk Youtube Gallery Gutenberg block
* Description: requires ACF
* Version: 0.0.4
* Author: Hans Czajkowski Jørgensen
* Text Domain: teknogbytgal
* Domain Path: /languages
*/

namespace Teknologi_Gutenblocks_Ytgallery;

if (!defined('ABSPATH'))
exit;

/**
* Load paths need to be set in this file to work
*/
add_filter('acf/settings/load_json', function ($paths) {
    $paths[] = plugin_dir_path(__FILE__) . 'acf-json';
    return $paths;
});


/**
*
*/
class Teknologi_Gutenblocks_Ytgallery
{
    /**
     * load dependent files
     *
     * @return void
     */
    public function load()
    {
        include_once plugin_dir_path(__FILE__) . 'acf_block_registration.php';
    }

    /**
    * Check if requirements are met
    * - ACF at minimum version 5.9.5 is installed and active
    *
    * @return bool or null if invalid version strings are given
    */
    public static function requirements_are_met()
    {
        if (!version_compare(\get_option('acf_version', '0.0.0'), '5.9.5', '>=')) {
            return false;
        } elseif (!class_exists('ACF')) {
            return false;
        } else {
            return true;
        }
    }

    public function teknologi_gutenblocks_ytgallery_load_plugin_textdomain()
    {
        load_plugin_textdomain('teknogbytgal', FALSE, basename(dirname(__FILE__)) . '/languages/');
    }
}


function teknologi_gutenblocks_ytgallery_load()
{

    $instance = new \Teknologi_Gutenblocks_Ytgallery\Teknologi_Gutenblocks_Ytgallery();
    if ($instance->requirements_are_met()) {
        $instance->teknologi_gutenblocks_ytgallery_load_plugin_textdomain();
        $instance->load();
    }
}

add_action('plugins_loaded', '\Teknologi_Gutenblocks_Ytgallery\teknologi_gutenblocks_ytgallery_load');
