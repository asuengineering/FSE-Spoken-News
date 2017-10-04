<?php
/* Carbon Fields Customizations for Spoken Word Theme */
/* Requires Carbon Fields.
/* Carbon Fields installed in the theme via Composer. */

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options', 'asufse_spokenword' ) )
        ->add_fields( array(
        	Field::make( 'textarea', 'asufse_spokenword_openingtext', 'Opening Text' )->set_rows( 4 ),
        	Field::make( 'html', 'asufse_spokenword_information_text' )
    			->set_html( '<p><strong style="color:red;">Note: </strong>HTML tags like <code>&lt;phone&gt;</code> embedded within the options above will not be visible when viewing the human readable output for the skill. But any embedded code is still there when the skill is consumed by the end user.</p>' ),
        	Field::make( 'textarea', 'asufse_spokenword_closingtext', 'Closing Text' )->set_rows( 4 ),
        ) );
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}