<?php
/**
 * Functions to handle form submissions for FAG Tools Plugin
 * Description: Processes HTML frontend forms using the WordPress REST API.
 * @Since Version 1.0.0
 *
 * Developed with assistance from AI tools.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

namespace Logically_Tech\FAG_Tools\Public;

/**
 * Check if class exists
 * @since 1.0.0
 * 
 */
if ( ! class_exists('Form_Handler') ) {

    /**
     * Handle responses for FAG Tools forms
     * @since 1.0.0
     */
    class Form_Handler {

      private $form-data;
      private $required-fields;
      
      /**
      * Generic form endpoint
      *
      * @since 1.0.0
      **/
      public function register_form_endpoint() {
          register_rest_route( 'fag-tools-form/v1', '/submit', array(
              'methods'             => 'POST', // Only accept POST requests
              'callback'            => $this->handle_form_submission,
              'permission_callback' => $this->check_permission, // Ensure basic security/nonce checks
          ) );
      }

      private function check_permission( $request ) {
          // If you need strict public form submission, you can return true.
          // To strictly verify WordPress nonces via REST headers:
          // return check_ajax_referer( 'wp_rest', 'X-WP-Nonce', false );
          return true; 
      }
      
      /**
      * Core form processing logic
      * @since 1.0.0
      **/
      function handle_form_submission( $request ) {
          // Retrieve validated JSON or Form parameters safely
          //$name  = sanitize_text_field( $request->get_param( 'user_name' ) );
          //$email = sanitize_email( $request->get_param( 'user_email' ) );
          
          //Will sanitize in child class when we know expected fields and their types
          foreach ($request as $key => $value) {
            $form-data[$key]=$value;
          }

          $this->validate_required_fields();
          $resp = $this->process_form_response();
      
          return rest_ensure_response( array(
              'success' => true,
              'message' => 'Success, message: ' . $resp,
              'data'    => $form-data
          ), 200 );
      }

      /**
      * Validate each requried field is not empty
      * Die with 400 error if required field is empty
      * @since 1.0.0
      **/
      private function validate_required_fields() {
        foreach ($required-fields as $required-field) {
          if (empty($form-data[$required-field])) {
              return new WP_Error( 'missing_field', $required-field ' is a requried field.', array( 'status' => 400 ) );
          }
        }
      }

      /**
      * Process form response
      *@since 1.0.0
      **/
      private function process_form_response() {
        return "specific response message";  
      }
  

    }  //close class
}  //close if class exists

// Hook into rest_api_init to register our custom route
$form_handler = New Form_Handler();
add_action( 'rest_api_init', $form_handler->register_form_endpoint() );





