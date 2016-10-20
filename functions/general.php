<?php
/*--------------------------------------------------------------
	MODIFY UPDATE MESSAGES
--------------------------------------------------------------*/
add_filter('post_updated_messages', 'btwp_updated_messages');

function btwp_updated_messages ($messages){
	global $post_ID;

	$messages['produtos'] = array(
		0 => '',
		1 => 'Produto Atualizado. <a href="'. esc_url( get_permalink( $post_ID ) ) .'">Visualizar Produto</a>',
		4 => 'Produto Atualizado.',
		6 => 'Produto Publicado. <a href="'. esc_url( get_permalink( $post_ID ) ) .'">Visualizar Produto</a>',
		7 => 'Produto Salvo.'
	);

	return $messages;
}