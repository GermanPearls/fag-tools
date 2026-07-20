<?php
/**
 * Define cemetary export form, sub-class of Form_Renderer
 * @Since Version 1.0.0
 *
 * Developed with assistance from AI tools.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

namespace Logically_Tech\FAG_Tools\Public\Forms;

/**
 * Check if class exists
 * @since 1.0.0
 * 
 */
if ( ! class_exists('Cemetary_Export_Form') ) {

    /**
     * Define Cemetary export form
     * @since 1.0.0
     */
    class Cemetary_Export_Form extends Form_Renderer {

      /**
      * Constructor
      * @since 1.0.0
      **/
      public function __construct() {
        // Call the parent class's constructor first
        parent::__construct();
        $this->define_form();
      }

      /**
      * Define the form
      * @since 1.0.0
      **/
      public function define_form() {
        $this->set_form_id();
        $this->set_form_name();
        $this->set_form_fields();
        $this->set_submit_buttons();
      }

      /**
      * Render form using parent function
      * @since 1.0.0
      **/
      public function render() {
        // Call the parent class's constructor first
        return parent::render_form();
      }
      
      /**
      * Define Form ID
      * @since 1.0.0
      **/
      protected function set_form_id() {
        parent::form-id = "cemetary-export";
      }

      /**
      * Define Form Name
      * @since 1.0.0
      **/
      protected function set_form_name() {
        parent::form-id = "cemetary-export";
      }

      /**
      * Define Form Fields
      * @since 1.0.0
      **/
      protected function set_form_fields() {
        $fields = [];

        //cemetary id
        $fld = parent::get_default_field();
        $fld['id'] = "cemetary_id";
        $fld['name'] = "cemetary_id";
        $fld['pretty-name'] = "Cemetary ID";
        array_push($fields, $fld);
        
        parent::form-fields = $fields;
      }

      /**
      * Define submit buttons
      * @since 1.0.0
      **/
      protected function set_submit_buttons() {
        $buttons = [];

        //open in find a grave
        $btn = parent::get_default_submit_button();
        $btn['text']="Open in Find A Grave";
        $btn['action']="do-this";
        array_push($buttons, $btn);

        //export data
        $btn = parent::get_default_submit_button();
        $btn['text']="Export Data";
        $btn['action']="do-that";
        array_push($buttons, $btn);
        
        parent::submit-buttons = $buttons;
      }
      

      
      
    }  //close class
}  //close if not class exists

$cemetary-export-form = New Logically_Tech\FAG_Tools\Public\Forms\Cemetary_Export_Form();
add_shortcode( 'cemetary_export_form', $cemetary-export-form->render() );
