<?php

/**
 * Fired during plugin activation
 *
 * @link       www.iamdavidabayomi.me
 * @since      1.0.0
 *
 * @package    Castrex
 * @subpackage Castrex/includes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Castrex_Database 
{
	
  /**
   * Castrex database version.
   * 
   * @since   1.0.0
   * @access  private
   */
  private $ca_db_version;

  public function __construct()
  {
    /** */
    $this->ca_db_version = 1.0;
  }

  /**
   * Get castrex database version.
   * 
   * @since   1.0.0
   * @access  public
   */
  public static function get_ca_db_version()
  {
    return string( __CLass__, $ca_db_version );
  }
}