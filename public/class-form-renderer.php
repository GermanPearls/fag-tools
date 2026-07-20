<?php
/**
 * Functions to render custom forms for the FAG Tools Plugin
 * Description: Creates Html and shortcodes for rendering forms
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
if ( ! class_exists('Form_Renderer') ) {

    /**
     * Render FAG Tools forms
     * @since 1.0.0
     */
    class Form_Renderer {

      protected $form-name;
      protected $form-id;
      protected $fields;
      protected $submit-buttons;
      protected $required-fields;
      
      /**
      * Constructor
      * @since 1.0.0
      **/
      public function __construct() {
      }

      /**
      * Generic form html
      * @since 1.0.0
      **/
      public function render_form($form-name, $form-id, $fields, $submit-buttons) {
        //define form
        $this->form-name = $form-name;
        $this->form-id = $form-id;
        $this->fields = $fields;
        $this->submit-buttons = $submit-buttons;
          
        $this->enqueue_script();
        $this->localize_script();
        return $this->render_html();
      }

      /**
      * Localize form script
      * @since 1.0.0
      **/
      public function localize_script() {
        // Pass API URL & Nonce locally into window.crfhSettings
        wp_localize_script( $this->form-id . '-js', $this->form-id . 'Settings', array(
            'root'  => esc_url_raw( rest_url() ),
            'nonce' => wp_create_nonce( 'wp_rest' ) // Essential for internal API authentication
        ) );
      }
  
      /**
      * Enqueue form script
      * @since 1.0.0
      **/
      public function enqueue_script() {
        // Enqueue scripts and pass variables safely
        wp_enqueue_script( $this->form-id . '-js', plugin_dir_url( __FILE__ ) . 'assets/form-submit.js', array(), '1.0', true );
      }
      
      /**
      * Core form rendering
      * @since 1.0.0
      **/
      function render_html() {
        ob_start(); ?>
          <form id="<?php echo $this->form-id; ?>" name="<?php echo $this->form-name; ?>">
          <div id="form-response-message"></div>

          <?php 
          //<label for="user_name">Name:</label>
          //<input type="text" id="user_name" name="user_name" required>
  
          //<label for="user_email">Email:</label>
          //<input type="email" id="user_email" name="user_email" required>
          echo $this->render_fields(); 
          ?>
  
          <?php
          //<button type="submit">Submit Form</button>
          echo $this->render_submit_buttons(); 
          ?>
          
          </form>
          <?php
          return ob_get_clean();
      }

      /**
      * Create array of required fields, for use with validation later
      * @since 1.0.0
      **/
      private function identify_required_fields() {
        foreach ($this->fields as $field) {
          if ($field['required']) {
              array_push($this->required-fields, $field['name']);
          }
        }
      }

      /**
      * Render all form fields and output html
      * @since 1.0.0
      **/
      private function render_fields() {
        $html = "";
        foreach ($this->fields as $field) {
          $html .= $this->render_field($field);
        }
        return $html;
      }

      /**
      * Render single form field
      * @since 1.0.0
      *
      * @input Key-Value array of properties for one field of a form, including:
      * id (html id), name (html name), pretty-name (display to user), required (boolean), type (ie: text, number)
      *
      * @output Html including label and input for one field of a form, sample below:
      * <label for="user_name">Name:</label>
      * <input type="text" id="user_name" name="user_name" required>
      **/
      private function render_field($field) {
        $html = "<label for=" . $field['id'] . ">" . $field['pretty-name'] . "</label>";
        $html .= "input type=" . $field['type'] . " id=" . $field['id'] . " name=" . $field['name'];
        if ($field['required']) {
          $html .= " required ";
        }
        $html .= ">";
        return $html;
      }

      /**
      * Render all submit buttons and return html
      * @since 1.0.0
      **/
      private function render_submit_buttons() {
        $html = "";
        foreach ($this->submit-buttons as $submit-button) {
          $html .= $this->render_field($submit-button);
        }
        return $html;
      }

      /**
      * Render single submit button
      * @since 1.0.0
      *
      * @input Key-Value array of properties for one submit button of form, including:
      * id (html id), name (html name), button-text (display to user), action
      *
      * @output Html including label and input for one field of a form, sample below:
      * <button type="submit">Submit Form</button>
      **/
      private function render_submit_button($submit-button) {
        $html = "<button type=submit>" . $submit-button['button-text'] . "</button>";
        return $html;
      }

      /**
      * Define default field and properties
      * For use in sub-clsases when defining forms
      * @since 1.0.0
      *
      **/
      protected get_default_field() {
        $fld = [];
        $fld['id']="";
        $fld['name']="";
        $fld['type']="string";
        $fld['pretty-name']="";
        $fld['class']="";
        return $fld;
      }

      /**
      * Define default button and properties
      * For use in sub-classes when defining forms
      * @since 1.0.0
      *
      **/
      protected get_default_submit_button() {
        $btn = [];
        $btn['type']="submit";
        $btn['text']="Submit";
        $btn['action']="";
        $btn['class']="";
        return $btn;
      }


  

    }  //close class
}  //close if class exists

// Example use to create a form:
// Register a shortcode to output the form markup
//$fag-tools-form = New Form_Renderer($form-name, $form-id, $fields, $submit-buttons);
//add_shortcode( 'rest_api_init', $fag-tools-form->render_form() );
