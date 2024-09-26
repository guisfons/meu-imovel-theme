<?php

/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package itmidia
 * @since 1.0.0
 */

if (in_array(session_status(), [PHP_SESSION_NONE, 1])) {
	session_start();
}

/**
 * Composer autoload
 */
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once (__DIR__ . '/vendor/autoload.php');
}

/**
 * @todo improve to use namespaces and Helpers be a class
 */
require_once (__DIR__ . '/src/Helpers.php');
require_once(__DIR__ . '/inc/post-types.php');
#require_once(__DIR__ . '/inc/shortcodes/galleries.php');
#require_once(__DIR__ . '/inc/shortcodes/special-posts-videos.php');

/**
 * @info Security Tip
 * Remove version info from head and feeds
 */
add_filter('the_generator', 'wp_version_removal');

function wp_version_removal() {
    return false;
}

/**
 * @info Security Tip
 * Disable oEmbed Discovery Links and wp-embed.min.js
 */
remove_action( 'wp_head', 'wp_oembed_add_discovery_links', 10 );
remove_action( 'wp_head', 'wp_oembed_add_host_js' );
remove_action('rest_api_init', 'wp_oembed_register_route');
remove_filter('oembed_dataparse', 'wp_filter_oembed_result', 10);

/**
 * @bugfix Yoast fix wrong canonical url in production
 *
 * Set canonical URLs on non-production sites to the production URL
 */
#add_filter( 'wpseo_canonical', function( $canonical ) {
#	$canonical = preg_replace('#//[^/]*/#U', '//itmorum365.com.br/', trailingslashit( $canonical ) );
#	return $canonical;
#});

/**
 * Filter except length to 35 words.
 *
 * @param integer $length
 * @return integer
 */
function custom_excerpt_length( $length ) {
    return 40;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Add excerpt support for pages
 */
add_post_type_support( 'page', 'excerpt' );

/**
 * Remove Admin Bar from front-end
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Disables block editor "Gutenberg"
 */
add_filter("use_block_editor_for_post_type", "use_gutenberg_editor");
function use_gutenberg_editor() {
    return false;
}

/**
 * Add support to thumbnails
 */
add_theme_support('post-thumbnails');

/**
 * @info this theme doesn't have custom thumbnails dimensions
 *
 * define the size of thumbnails
 * To enable featured images, the current theme must include
 * add_theme_support( 'post-thumbnails' ) and they will show the metabox 'featured image'
 */
add_image_size('company-size', 162, 81, false );
add_image_size('event-gallery', 490, 568, false );
/*add_image_size('slide-large', 1366, 400, true );
add_image_size('slide-extra-large', 2560, 749, true );*/


/**
 * Páginas Especiais
 */

if( function_exists('acf_add_options_page') ) {

   /* @info disabled by unused*/
    acf_add_options_page(array(
        'page_title' => 'Opções Gerais',
        'menu_title' => 'Opções Gerais',
        'menu_slug'  => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-admin-settings',
        'position'   => 2

    ));

    acf_add_options_page(array(
        'page_title' => 'Destaques',
        'menu_title' => 'Destaques',
        'menu_slug'  => 'uau-slides',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'icon_url'   => 'dashicons-excerpt-view',
        'position'   => 3
	));

}


/**
 * Registering Locations of Navigation Menus
 */

function navigation_menus(){
    /* this function register a array of locations */
    register_nav_menus(
        array(
			'header-menu' => 'Menu Header',
        )
    );
}

add_action('init', 'navigation_menus');

/**
 * ACF Improvements
 * Order results by descendent date in relational fields
 *
 * @param array $args
 * @param array $field
 * @param integer $post_id
 * @return array
 */
function relational_fields_order( $args, $field, $post_id ) {
    $args['orderby'] = 'date';
	$args['order'] = 'DESC';
	return $args;
}
add_filter('acf/fields/relationship/query', 'relational_fields_order', 10, 3);

/**
 * ACF Improvements
 * Order results by descendent date in post object fields
 *
 * @param array $args
 * @param array $field
 * @param integer $post_id
 * @return array
 */
function post_objects_fields_order( $args, $field, $post_id ) {
    $args['orderby'] = 'date';
	$args['order'] = 'DESC';
	return $args;
}
add_filter('acf/fields/post_object/query', 'post_objects_fields_order', 10, 3);

/**
 * Declaring the JS files for the site
 */

function scripts() {
    wp_deregister_script("jquery");
}
add_action('wp_enqueue_scripts','scripts', 10); // priority 10


/**
 * Applying custom logo at WP login form
 */
function login_logo() {
?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url("<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg");
            width:260px;
            height:55px;
            background-size: contain;
            background-repeat: no-repeat;
        }
    </style>
<?php
}
add_action( 'login_enqueue_scripts', 'login_logo' );

function login_logo_url() {
    return home_url();
}

add_filter( 'login_headerurl', 'login_logo_url' );

function login_logo_url_title() {
    return 'IT Mídia';
}

add_filter( 'login_headertext', 'login_logo_url_title' );


/**
 * Declaring the JS files for the site
 */
add_action('wp_enqueue_scripts','scripts', 10); // priority 10

REQUIRE_ONCE('inc/style-scripts.php');


/**
 * Pagination of posts in pages
 */
function pagination($pages = '', $range = 4) {
   $showitems = ($range * 2) + 1;

   global $paged;
   if (empty($paged)) $paged = 1;

   if ($pages == '') {
      global $wp_query;
      $pages = $wp_query->max_num_pages;
      if (!$pages) {
         $pages = 1;
      }
   }

   if (1 != $pages) {
      echo "<div class=\"pagination__arrow\">";
      if ($paged > 1 && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged - 1) . "'><svg width=\"10\" height=\"17\"><use xlink:href=\"" . get_template_directory_uri() . "/assets/img/SVG/sprite.svg#p-arrow-left\"></use></svg>Anterior</a>";
      echo "</div>";

      echo '<div class="pagination__numbers">';
      for ($i = 1; $i <= $pages; $i++) {
         if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
            echo ($paged == $i) ? "<a href=\"\" class=\"active\">" . $i . "</a>" : "<a href='" . get_pagenum_link($i) . "'>" . $i . "</a>";
         } elseif ($i == $paged) {
            echo '<a href=\"\" class=\"active\">' . $i . '</a>';
         }
      }
      echo '</div>';

      echo "<div class=\"pagination__arrow pagination__arrow--right\">";         
      if ($paged < $pages && $showitems < $pages) echo "<a href='" . get_pagenum_link($paged + 1) . "'>Próxima<svg width=\"10\" height=\"17\"><use xlink:href=\"" . get_template_directory_uri() .  "/assets/img/SVG/sprite.svg#p-arrow-right\"></use></svg></a>";
      echo "</div>";
   }
}

// Allow SVG
add_filter( 'wp_check_filetype_and_ext', function($data, $file, $filename, $mimes) {
    global $wp_version;
    if ( $wp_version !== '4.7.1' ) {
        return $data;
    }

    $filetype = wp_check_filetype( $filename, $mimes );
    return [
        'ext'             => $filetype['ext'],
        'type'            => $filetype['type'],
        'proper_filename' => $data['proper_filename']
    ];
}, 10, 4 );
  
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );
  
function fix_svg() {
    echo '<style type="text/css">
            .attachment-266x266, .thumbnail img {
                width: 100% !important;
                height: auto !important;
            }
        </style>';
}
add_action( 'admin_head', 'fix_svg' );

// Functions for form

add_action('wp_ajax_submit_form_pessoa_juridica', 'handle_form_locacao_pessoa_juridica');
add_action('wp_ajax_nopriv_submit_form_pessoa_juridica', 'handle_form_locacao_pessoa_juridica');
function handle_form_locacao_pessoa_juridica() {
    // Sanitizando os campos recebidos
    $razao_social = sanitize_text_field($_POST['razao-social']);
    $cnpj = sanitize_text_field($_POST['cnpj']);
    $inscricao_estadual = sanitize_text_field($_POST['inscricao-estadual']);
    $nome_representante = sanitize_text_field($_POST['nome-representante']);
    $cpf_representante = sanitize_text_field($_POST['cpf-representante']);
    $email = sanitize_email($_POST['email']);
    $telefone = sanitize_text_field($_POST['telefone']);
    $endereco = sanitize_text_field($_POST['endereco']);
    $cep = sanitize_text_field($_POST['cep']);
    $finalidade_locacao = sanitize_text_field($_POST['finalidade_locacao']);
    $endereco_imovel = sanitize_text_field($_POST['endereco_imovel']);
    $valor_locacao = sanitize_text_field($_POST['valor_locacao']);
    $garantia_escolhida = sanitize_text_field($_POST['garantia_escolhida']);
    $contrato_social = $_FILES['contrato_social'];
    $comprovante_endereco = $_FILES['comprovante_endereco'];
    $imposto_renda = sanitize_text_field($_POST['imposto_renda']);
    $faturamento = sanitize_text_field($_POST['faturamento']);
    
    // Informações dos sócios
    $rg1 = sanitize_text_field($_POST['rg1']);
    $cpf1 = sanitize_text_field($_POST['cpf1']);
    $doc_socio1 = $_FILES['doc_socio1'];
    
    $rg2 = sanitize_text_field($_POST['rg2']);
    $cpf2 = sanitize_text_field($_POST['cpf2']);
    $doc_socio2 = $_FILES['doc_socio2'];
    
    // Informações do cônjuge
    $estado_civil = sanitize_text_field($_POST['estado_civil']);
    $doc_estado_civil_juridico = $_FILES['doc_estado_civil_juridico'];
    $nome_conjuge = sanitize_text_field($_POST['nome_conjuge']);
    $cpf_conjuge = sanitize_text_field($_POST['cpf_conjuge']);
    $celular = sanitize_text_field($_POST['celular']);
    $nacionalidade = sanitize_text_field($_POST['nacionalidade']);
    $profissao = sanitize_text_field($_POST['profissao']);
    
    // Outros campos
    $valor_aluguel = sanitize_text_field($_POST['valor_aluguel']);
    $locador = sanitize_text_field($_POST['locador']);
    $motivo_mudanca = sanitize_text_field($_POST['motivo_mudanca']);
    
    // Preparando os cabeçalhos do e-mail
    $to = 'guilhermesfonsecaa@gmail.com';
    $subject = 'Formulário Para Locação - Pessoa Jurídica';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // Montando o corpo do e-mail
    $body = "Razão Social: $razao_social<br>
             CNPJ: $cnpj<br>
             Inscrição Estadual: $inscricao_estadual<br>
             Nome do Representante: $nome_representante<br>
             CPF do Representante: $cpf_representante<br>
             E-mail: $email<br>
             Telefone: $telefone<br>
             Endereço: $endereco<br>
             CEP: $cep<br>
             Finalidade da Locação: $finalidade_locacao<br>
             Endereço do Imóvel: $endereco_imovel<br>
             Valor da Locação: $valor_locacao<br>
             Garantia Escolhida: $garantia_escolhida<br>
             Imposto de Renda: $imposto_renda<br>
             Faturamento: $faturamento<br>
             RG do Sócio 1: $rg1<br>
             CPF do Sócio 1: $cpf1<br>
             RG do Sócio 2: $rg2<br>
             CPF do Sócio 2: $cpf2<br>
             Estado Civil: $estado_civil<br>
             Nome do Cônjuge: $nome_conjuge<br>
             CPF do Cônjuge: $cpf_conjuge<br>
             Celular: $celular<br>
             Nacionalidade: $nacionalidade<br>
             Profissão: $profissao<br>
             Valor do Aluguel: $valor_aluguel<br>
             Locador: $locador<br>
             Motivo da Mudança: $motivo_mudanca<br>";
    
    // Validando e enviando os documentos
    $attachments = array();

    // Comprovante de Endereço
    if (!empty($comprovante_endereco['name'])) {
        if ($comprovante_endereco['size'] <= 2097152 && in_array($comprovante_endereco['type'], array('image/jpeg', 'image/png', 'application/pdf'))) {
            $uploaded_file = wp_handle_upload($comprovante_endereco, array('test_form' => false));
            if ($uploaded_file && !isset($uploaded_file['error'])) {
                $attachments[] = $uploaded_file['file'];
            } else {
                wp_send_json_error('Erro ao fazer upload do comprovante de endereço.');
                wp_die();
            }
        } else {
            wp_send_json_error('Tipo ou tamanho do arquivo inválido para o comprovante de endereço.');
            wp_die();
        }
    }

    // Contrato Social
    if (!empty($contrato_social['name'])) {
        if ($contrato_social['size'] <= 2097152 && in_array($contrato_social['type'], array('image/jpeg', 'image/png', 'application/pdf'))) {
            $uploaded_file = wp_handle_upload($contrato_social, array('test_form' => false));
            if ($uploaded_file && !isset($uploaded_file['error'])) {
                $attachments[] = $uploaded_file['file'];
            } else {
                wp_send_json_error('Erro ao fazer upload do contrato social.');
                wp_die();
            }
        } else {
            wp_send_json_error('Tipo ou tamanho do arquivo inválido para o contrato social.');
            wp_die();
        }
    }

    // Documentos dos Sócios
    foreach (array($doc_socio1, $doc_socio2) as $key => $doc) {
        if (!empty($doc['name'])) {
            if ($doc['size'] <= 2097152 && in_array($doc['type'], array('image/jpeg', 'image/png', 'application/pdf'))) {
                $uploaded_file = wp_handle_upload($doc, array('test_form' => false));
                if ($uploaded_file && !isset($uploaded_file['error'])) {
                    $attachments[] = $uploaded_file['file'];
                } else {
                    wp_send_json_error("Erro ao fazer upload do documento do sócio " . ($key + 1) . ".");
                    wp_die();
                }
            } else {
                wp_send_json_error("Tipo ou tamanho do arquivo inválido para o documento do sócio " . ($key + 1) . ".");
                wp_die();
            }
        }
    }

    // Documento do Cônjuge
    if (!empty($doc_estado_civil_juridico['name'])) {
        if ($doc_estado_civil_juridico['size'] <= 2097152 && in_array($doc_estado_civil_juridico['type'], array('image/jpeg', 'image/png', 'application/pdf'))) {
            $uploaded_file = wp_handle_upload($doc_estado_civil_juridico, array('test_form' => false));
            if ($uploaded_file && !isset($uploaded_file['error'])) {
                $attachments[] = $uploaded_file['file'];
            } else {
                wp_send_json_error('Erro ao fazer upload do documento de estado civil do cônjuge.');
                wp_die();
            }
        } else {
            wp_send_json_error('Tipo ou tamanho do arquivo inválido para o documento de estado civil do cônjuge.');
            wp_die();
        }
    }

    // Enviando o e-mail com os anexos
    send_email_with_attachment($to, $subject, $body, $headers, $attachments);
    wp_send_json_success('Formulário enviado com sucesso.');

    wp_die(); // Termina a execução
}

function send_email_with_attachment($to, $subject, $body, $headers, $attachments) {
    wp_mail($to, $subject, $body, $headers, $attachments);
}