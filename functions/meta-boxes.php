<?php 
/*--------------------------------------------------------------
	INSERE METABOX
--------------------------------------------------------------*/
add_action('add_meta_boxes', 'btwp_produtos_link_box');

function btwp_produtos_link_box(){
	
	add_meta_box(
		'produtos_link_box',
		'Link do Job',
		'btwp_produtos_link_content',
		'produtos',
		'side',
		'low'
	);	
}

// INSERE METABOX CAMPOS DE FORMULÁRIO
function btwp_produtos_link_content(){

	// INSERE NONCES
	wp_nonce_field('produtos_metabox_form_save', 'produtos_link_box_content_nonce');	

	$link = get_post_meta( get_the_ID(), '_produtos_link', true )

	?>
	<label for="produtos_link"></label>
	<input type="text" id="produtos_link" name="produtos_link" placeholder="Insira o link" value="<?php echo esc_attr($link); ?>" style="width: 100%; height: 2.5em; margin: 5px 0;"/>
	<?php
}

// TRATAMENTO DE DADOS AO SALVAR 
add_action('save_post', 'btwp_produtos_link_save');

function btwp_produtos_link_save( $post_id ){

	// VERIFICA  CONSTANTES
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
		return;

	// VERIFICA SE O POST TYPE ESTÁ CORRETO
	if ( 'produtos' != get_post_type() || !current_user_can('edit_post', $post_id) )
		return;

	// VERIFICA SE ESTÁ RECEBENDO O NONCE E SE OS DADOS ESTÃO VINDO DO WORDPRESS
	check_admin_referer('produtos_metabox_form_save', 'produtos_link_box_content_nonce');

	$portfolio_link = sanitize_text_field($_POST['produtos_link']);

	update_post_meta( $post_id, '_produtos_link', $portfolio_link );
}