<?php

/**
 * Generic cURL class to run curl command and output the html response.
 *
 * @since      1.0.0
 *
 * @package    Fag_Tools
 * @subpackage Fag_Tools/public
 */

namespace Logically_Tech\FAG_Tools\Public;

if ( ! class_exists('Curl') ) {
  
  class Curl {

    /** php curl **/
    private $ch;
  
  	public function __construct( $plugin_name, $version ) {
      $this->ch = curl_init();
  	}
  
    public function get_html( $url ) {
      return $this->run_curl_and_get_response($url);
    }
  
    private function run_curl_and_get_response($url) {
      $this->set_curl_url($url);
      $this->set_response_return_type(true);
      $resp = $this->get_curl_response();
      $this->close_curl;
      return $resp;
    }
  
    private function set_curl_url($url) {
      curl_setopt($this->ch, CURLOPT_URL, $url);
    }
  
    private function set_response_return_type($return_response) {
      curl_setopt($this->ch, CUROPT_RETURNTRANSFER, $return_response);
    }
  
    private function get_curl_response() {
      try {
        $out = curl_exec($this>ch);
      } catch (except $e) {
        $out = "Error XX during curl, message: " . $e->GetMessage();
      }
      return $out;
    }
  
    private function close_curl() {
      curl_close($this->ch);
    }
  }
}
