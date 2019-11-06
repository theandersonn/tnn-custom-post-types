<?php
/*--------------------------------------------------------------
	MODIFY UPDATE MESSAGES
--------------------------------------------------------------*/
add_filter('post_updated_messages', 'thepress_updated_messages');

function thepress_updated_messages ($messages){
	global $post_ID;

	$messages['clientes'] = array(
		0 => '',
		1 => 'Cliente Atualizado. <a href="'. esc_url( get_permalink( $post_ID ) ) .'">Visualizar Cliente</a>',
		4 => 'Cliente Atualizado.',
		6 => 'Cliente Publicado. <a href="'. esc_url( get_permalink( $post_ID ) ) .'">Visualizar Cliente</a>',
		7 => 'Cliente Salvo.'
	);

	return $messages;
}