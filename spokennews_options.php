<?php
add_action( 'admin_menu', 'spokennews_add_admin_menu' );
add_action( 'admin_init', 'spokennews_settings_init' );


function spokennews_add_admin_menu(  ) { 

	add_options_page( 'FSE Spoken News Options', 'FSE Spoken News Options', 'manage_options', 'fse_spoken_news_options', 'spokennews_options_page' );

}

function spokennews_settings_init(  ) { 

	register_setting( 'pluginPage', 'spokennews_settings' );

	add_settings_section(
		'spokennews_pluginPage_section', 
		__( 'Opening and Closing Statements', 'wordpress' ), 
		'spokennews_settings_section_callback', 
		'pluginPage'
	);

	add_settings_field( 
		'spokennews_textarea_opening_statement', 
		__( 'Opening Statement', 'wordpress' ), 
		'spokennews_textarea_opening_statement_render', 
		'pluginPage', 
		'spokennews_pluginPage_section' 
	);	

	add_settings_field( 
		'spokennews_textarea_closing_statement', 
		__( 'Closing Statement', 'wordpress' ), 
		'spokennews_textarea_closing_statement_render', 
		'pluginPage', 
		'spokennews_pluginPage_section' 
	);

}


function spokennews_textarea_opening_statement_render(  ) { 

	$options = get_option( 'spokennews_settings' );
	?>
	<textarea cols='80' rows='2' name='spokennews_settings[spokennews_opening_statement]'> 
		<?php echo $options['spokennews_opening_statement']; ?>
 	</textarea>
	<?php

}

function spokennews_textarea_closing_statement_render(  ) { 

	$options = get_option( 'spokennews_settings' );
	?>
	<textarea cols='80' rows='2' name='spokennews_settings[spokennews_closing_statement]'> 
		<?php echo $options['spokennews_closing_statement']; ?>
 	</textarea>
	<?php

}


function spokennews_settings_section_callback(  ) { 
	$statement = '<p>These two text fields will "wrap" the news stream offered by our spoken news readers.</br>' .
				 'Think Twitter / Facebook Post for estimated length.</br>'  . 
				 '<strong>Please use plain text only. (No HTML.)</strong></p>' ;

	echo __( $statement, 'wordpress' );

}


function spokennews_options_page(  ) { 

	?>
	<form action='options.php' method='post'>

		<h2>FSE Spoken News Options</h2>

		<?php
		settings_fields( 'pluginPage' );
		do_settings_sections( 'pluginPage' );
		submit_button();
		?>

	</form>
	<?php

}

?>