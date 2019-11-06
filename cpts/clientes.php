<?php
/*--------------------------------------------------------------
	REGISTER CUSTOM POST TYPE -> CLIENTES
--------------------------------------------------------------*/
add_action('init', 'thepress_custom_post_clientes');
function thepress_custom_post_clientes(){
	$name 		 = 'Clientes';
	$sing_name = 'Cliente';
	
	$labels = array(
		'name' 								=> $name,
		'singular_name' 			=> $sing_name,
		'add_new' 						=> 'Adicionar novo',
		'add_new_item' 				=> 'Adicionar novo ' . $sing_name,
		'edit_item' 					=> 'Editar ' . $sing_name,
		'new_item' 						=> 'Novo ' . $sing_name,
		'all_items' 					=> 'Todos os ' . $name,
		'view_item' 					=> 'Visualizar ' . $sing_name,
		'search_items' 				=> 'Procurar ' . $sing_name,
		'not_found' 					=> 'Nenhum ' . $sing_name . ' encontrado',
		'not_found_in_trash' 	=> 'Nenhum ' . $sing_name . ' encontrado na lixeira',
		'parent_item_colom'		=> '',
		'menu_name'						=> $name
	);

	$args = array(
		'labels'						=> $labels,
		'public'						=> true,
		'has_archive' 			=> true,
		'show_in_rest'      => true,
		'menu_icon' 				=> 'dashicons-groups', // https://developer.wordpress.org/resource/dashicons/		
		'menu_position'			=> 5,
		'show_in_nav_menus' => true,
		'supports' 					=> array ('title', 'editor', 'thumbnail', 'excerpt', 'comments', 'author')
	);

	register_post_type('clientes', $args);
}

/*--------------------------------------------------------------
	REGISTER TAXONOMIES -> CLIENTES - CATEGORY
--------------------------------------------------------------*/
add_action('init', 'thepress_taxonomies_clientes_category');
function thepress_taxonomies_clientes_category(){

	$labels = array(
		'name' 								=> 'Clientes Categorias',
		'singular_name' 			=> 'Categoria',
		'add_new' 						=> 'Adicionar nova',
		'add_new_item' 				=> 'Adicionar nova Categoria',
		'edit_item' 					=> 'Editar Categoria',
		'new_item' 						=> 'Nova Categoria',
		'all_items' 					=> 'Todas as Categorias',
		'view_item' 					=> 'Visualizar Categoria',
		'search_items' 				=> 'Procurar Categoria',
		'not_found' 					=> 'Nenhuma Categoria encontrada',
		'not_found_in_trash' 	=> 'Nenhuma Categoria encontrada na lixeira',
		'parent_item_colom'		=> '',
		'menu_name'						=> 'Clientes Categorias'
	);

	$args = array(
		'labels'						=> $labels,
		'hierarchical'			=> true,
		'show_admin_column'	=> true
	);

	register_taxonomy('clientes-category', 'clientes', $args);
}

/*--------------------------------------------------------------
	DISPLAYS FILTER - CATEGORY
--------------------------------------------------------------*/
add_action( 'restrict_manage_posts', 'thepress_show_filter_clientes_category' );

function thepress_show_filter_clientes_category() {
	
	global $typenow;
	$taxonomy = 'clientes-category';

	if( $typenow == 'clientes' ){
		$filters = array($taxonomy);
		
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
		
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Todas as Categorias</option>";
		
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
		
			echo "</select>";
		}
	}
}

/*--------------------------------------------------------------
	REGISTER TAXONOMIES -> CLIENTES - TAG
--------------------------------------------------------------*/
add_action('init', 'thepress_taxonomies_clientes_tag');
function thepress_taxonomies_clientes_tag(){

	$labels = array(
		'name' 								=> 'Tags',
		'singular_name' 			=> 'Tag',
		'add_new' 						=> 'Adicionar nova',
		'add_new_item' 				=> 'Adicionar nova Tag',
		'edit_item' 					=> 'Editar Tag',
		'new_item' 						=> 'Nova Tag',
		'all_items' 					=> 'Todas as Tags',
		'view_item' 					=> 'Visualizar Tag',
		'search_items' 				=> 'Procurar Tag',
		'not_found' 					=> 'Nenhuma Tag encontrada',
		'not_found_in_trash' 	=> 'Nenhuma Tag encontrada na lixeira',
		'parent_item_colom'		=> '',
		'menu_name'						=> 'Tags'
	);

	$args = array(
		'labels'							=> $labels,
		'hierarchical'				=> false,
		'show_admin_column'		=> true,
	);

	register_taxonomy('clientes-tag', 'clientes', $args);
}

/*--------------------------------------------------------------
	DISPLAYS FILTER - TAG
--------------------------------------------------------------*/
add_action( 'restrict_manage_posts', 'thepress_show_filter_clientes_tag' );

function thepress_show_filter_clientes_tag() {
	
	global $typenow;
	$taxonomy = 'clientes-tag';

	if( $typenow == 'clientes' ){
		$filters = array($taxonomy);
		
		foreach ($filters as $tax_slug) {
			$tax_obj = get_taxonomy($tax_slug);
			$tax_name = $tax_obj->labels->name;
			$terms = get_terms($tax_slug);
		
			echo "<select name='$tax_slug' id='$tax_slug' class='postform'>";
			echo "<option value=''>Todas as Tags</option>";
		
				foreach ($terms as $term) { 
					echo '<option value='. $term->slug, $_GET[$tax_slug] == $term->slug ? ' selected="selected"' : '','>' . $term->name .' (' . $term->count .')</option>'; 
				}
		
			echo "</select>";
		}
	}
}