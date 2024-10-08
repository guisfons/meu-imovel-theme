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
    $finalidade_locacao = sanitize_text_field($_POST['finalidade_locacao']);
    $endereco_imovel = sanitize_text_field($_POST['endereco_imovel']);
    $valor_locacao = sanitize_text_field($_POST['valor_locacao']);
    $garantia_escolhida = sanitize_text_field($_POST['garantia_escolhida']);
    $cnpj = $_FILES['cnpj'];
    $contrato_social = $_FILES['contrato_social'];
    $comprovante_endereco = $_FILES['comprovante_endereco'];
    $imposto_renda = $_FILES['imposto_renda'];
    $faturamento = $_FILES['faturamento'];
    
    // Informações dos sócios
    $rg1 = sanitize_text_field($_POST['rg1']);
    $cpf1 = sanitize_text_field($_POST['cpf1']);
    $doc_socio1 = $_FILES['doc_socio1'];
    
    $rg2 = sanitize_text_field($_POST['rg2']);
    $cpf2 = sanitize_text_field($_POST['cpf2']);
    $doc_socio2 = $_FILES['doc_socio2'];
    
    // Informações do cônjuge
    $estado_civil = sanitize_text_field($_POST['estado_civil']);
    $doc_estado_civil = $_FILES['doc_estado_civil'];
    $nome_conjuge = sanitize_text_field($_POST['nome_conjuge']);
    $cpf_conjuge = sanitize_text_field($_POST['cpf_conjuge']);
    $celular = sanitize_text_field($_POST['celular']);
    $email = sanitize_email($_POST['email']);
    $nacionalidade = sanitize_text_field($_POST['nacionalidade']);
    $profissao = sanitize_text_field($_POST['profissao']);
    
    // Outros campos
    $valor_aluguel = sanitize_text_field($_POST['valor_aluguel']);
    $locador = sanitize_text_field($_POST['locador']);
    $motivo_mudanca = sanitize_text_field($_POST['motivo_mudanca']);
    
    $to = array(
        'guilhermesfonsecaa@gmail.com',
        'analise@meuimovel.imb.br',
        'contato@meuimovel.imb.br'
    );

    $to_string = implode(',', $to);

    $subject = 'Formulário Para Locação - Pessoa Jurídica';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // Montando o corpo do e-mail
    $body = "<strong>Finalidade da Locação:</strong> $finalidade_locacao<br>
             <strong>Endereço do Imóvel:</strong> $endereco_imovel<br>
             <strong>Valor da Locação:</strong> $valor_locacao<br>
             <strong>Garantia Escolhida:</strong> $garantia_escolhida<br>
             <strong>CNPJ:</strong> $cnpj<br>
             <strong>Imposto de Renda:</strong> $imposto_renda<br>
             <strong>Faturamento:</strong> $faturamento<br>
             <strong>RG do Sócio 1:</strong> $rg1<br>
             <strong>CPF do Sócio 1:</strong> $cpf1<br>
             <strong>RG do Sócio 2:</strong> $rg2<br>
             <strong>CPF do Sócio 2:</strong> $cpf2<br>
             <strong>Estado Civil:</strong> $estado_civil<br>
             <strong>Nome do Cônjuge:</strong> $nome_conjuge<br>
             <strong>CPF do Cônjuge:</strong> $cpf_conjuge<br>
             <strong>Celular:</strong> $celular<br>
             <strong>E-mail:</strong> $email<br>
             <strong>Nacionalidade:</strong> $nacionalidade<br>
             <strong>Profissão:</strong> $profissao<br>
             <strong>Valor do Aluguel:</strong> $valor_aluguel<br>
             <strong>Locador:</strong> $locador<br>
             <strong>Motivo da Mudança:</strong> $motivo_mudanca<br>";
    
    // Validando e enviando os documentos
    $attachments = array();

    // Função para fazer upload e adicionar ao array de anexos
    function add_attachment($file, &$attachments) {
        if (!empty($file['name'])) {
            // if ($file['size'] <= 2097152 && in_array($file['type'], array('image/jpeg', 'image/png', 'application/pdf'))) {
                $uploaded_file = wp_handle_upload($file, array('test_form' => false));
                if ($uploaded_file && !isset($uploaded_file['error'])) {
                    $attachments[] = $uploaded_file['file'];
                } else {
                    return "Erro ao fazer upload do arquivo: " . $file['name'];
                }
            // } else {
            //     return "Tipo ou tamanho do arquivo inválido: " . $file['name'];
            // }
        }
        return null; // Se tudo ocorreu bem
    }

    // Adicionando todos os documentos ao array de anexos
    $errors = array();
    $errors[] = add_attachment($comprovante_endereco, $attachments);
    $errors[] = add_attachment($contrato_social, $attachments);
    $errors[] = add_attachment($doc_socio1, $attachments);
    $errors[] = add_attachment($doc_socio2, $attachments);
    $errors[] = add_attachment($doc_estado_civil, $attachments);

    // Verificando se houve erros
    foreach ($errors as $error) {
        if ($error) {
            wp_send_json_error($error);
            wp_die();
        }
    }

    send_email_with_attachment($to_string, $subject, $body, $headers, $attachments);
    wp_send_json_success('Formulário enviado com sucesso.');

    wp_die();
}

add_action('wp_ajax_submit_form_pessoa_fisica', 'handle_form_locacao_pessoa_fisica');
add_action('wp_ajax_nopriv_submit_form_pessoa_fisica', 'handle_form_locacao_pessoa_fisica');
function handle_form_locacao_pessoa_fisica() {
    $finalidade_locacao = sanitize_text_field($_POST['finalidade_locacao']);
    $endereco_imovel = sanitize_text_field($_POST['endereco_imovel']);
    $valor_locacao = sanitize_text_field($_POST['valor_locacao']);
    $garantia_escolhida = sanitize_text_field($_POST['garantia_escolhida']);

    $nome_completo = sanitize_text_field($_POST['nome_completo']);
    $celular = sanitize_text_field($_POST['celular']);
    $email = sanitize_email($_POST['email']);
    $nacionalidade = sanitize_text_field($_POST['nacionalidade']);
    $profissao = sanitize_text_field($_POST['profissao']);
    $atuacao = sanitize_text_field($_POST['atuacao']);
    $renda_bruta = sanitize_text_field($_POST['renda_bruta']);
    $rg = sanitize_text_field($_POST['rg']);
    $cpf = sanitize_text_field($_POST['cpf']);
    $doc_rg = $_FILES['doc_rg'];
    $doc_comprovante_residencia = $_FILES['doc_comprovante_residencia_fisico'];
    $estado_civil = sanitize_text_field($_POST['estado_civil']);
    $doc_estado_civil = $_FILES['doc_estado_civil'];

    // Informações cônjuge
    $nome_conjuge = sanitize_text_field($_POST['nome_conjuge']);
    $cpf_conjuge = sanitize_text_field($_POST['cpf_conjuge']);
    $celular_conjuge = sanitize_text_field($_POST['celular_conjuge']);
    $email_conjuge = sanitize_email($_POST['email_conjuge']);
    $nacionalidade_conjuge = sanitize_text_field($_POST['nacionalidade_conjuge']);
    $profissao_conjuge = sanitize_text_field($_POST['profissao_conjuge']);

    // Outros campos
    $comprovante_renda = $_FILES['comprovante_renda'];
    $valor_aluguel = sanitize_text_field($_POST['valor_aluguel']);
    $locador = sanitize_text_field($_POST['locador']);
    $motivo_mudanca = sanitize_text_field($_POST['motivo_mudanca']);
    
    $to = array(
        'guilhermesfonsecaa@gmail.com',
        'analise@meuimovel.imb.br',
        'contato@meuimovel.imb.br'
    );

    $to_string = implode(',', $to);

    $subject = 'Formulário Para Locação - Pessoa Física';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // Montando o corpo do e-mail
    $body = "<strong>Finalidade da Locação:</strong> $finalidade_locacao<br>
            <strong>Endereço do Imóvel:</strong> $endereco_imovel<br>
            <strong>Valor da Locação:</strong> $valor_locacao<br>
            <strong>Garantia Escolhida:</strong> $garantia_escolhida<br>
            <strong>Nome Completo:</strong> $nome_completo<br>
            <strong>Celular:</strong> $celular<br>
            <strong>E-mail:</strong> $email<br>
            <strong>Nacionalidade:</strong> $nacionalidade<br>
            <strong>Profissão:</strong> $profissao<br>
            <strong>Área de Atuação:</strong> $atuacao<br>
            <strong>Renda Bruta:</strong> $renda_bruta<br>
            <strong>RG:</strong> $rg<br>
            <strong>CPF:</strong> $cpf<br>
            <strong>Estado Civil:</strong> $estado_civil<br>
            <strong>Nome do Cônjuge:</strong> $nome_conjuge<br>
            <strong>CPF do Cônjuge:</strong> $cpf_conjuge<br>
            <strong>Celular do Cônjuge:</strong> $celular_conjuge<br>
            <strong>E-mail do Cônjuge:</strong> $email_conjuge<br>
            <strong>Nacionalidade do Cônjuge:</strong> $nacionalidade_conjuge<br>
            <strong>Profissão do Cônjuge:</strong> $profissao_conjuge<br>";

    // Processar dinamicamente os moradores
    $moradores = [];
    for ($i = 1; isset($_POST["morador_rg_$i"]); $i++) {
        $morador_rg = sanitize_text_field($_POST["morador_rg_$i"]);
        $morador_cpf = sanitize_text_field($_POST["morador_cpf_$i"]);
        $doc_morador = isset($_FILES["doc_morador_$i"]) ? $_FILES["doc_morador_$i"] : null;

        // Adiciona o morador ao array
        $moradores[] = [
            'rg' => $morador_rg,
            'cpf' => $morador_cpf,
            'doc' => $doc_morador
        ];

        // Adiciona as informações do morador ao corpo do e-mail
        $body .= "<strong>RG do Morador $i:</strong> $morador_rg<br>
                  <strong>CPF do Morador $i:</strong> $morador_cpf<br>";
    }

    // Outros campos
    $body .= "<strong>Comprovante de Renda:</strong> Comprovante enviado.<br>
              <strong>Valor do Aluguel:</strong> $valor_aluguel<br>
              <strong>Locador:</strong> $locador<br>
              <strong>Motivo da Mudança:</strong> $motivo_mudanca<br>";
    
    // Função para fazer upload e adicionar ao array de anexos
    function add_attachment($file, &$attachments) {
        if (!empty($file['name'])) {
            $uploaded_file = wp_handle_upload($file, array('test_form' => false));
            if ($uploaded_file && !isset($uploaded_file['error'])) {
                $attachments[] = $uploaded_file['file'];
            } else {
                return "Erro ao fazer upload do arquivo: " . $file['name'];
            }
        }
        return null; // Se tudo ocorreu bem
    }

    // Array de anexos
    $attachments = array();

    // Adicionando todos os documentos ao array de anexos
    $errors = array();
    $errors[] = add_attachment($doc_rg, $attachments);
    $errors[] = add_attachment($doc_comprovante_residencia, $attachments);
    $errors[] = add_attachment($doc_estado_civil, $attachments);
    $errors[] = add_attachment($comprovante_renda, $attachments);

    // Adicionar os documentos dos moradores
    foreach ($moradores as $index => $morador) {
        if ($morador['doc']) {
            $errors[] = add_attachment($morador['doc'], $attachments);
        }
    }

    // Verificando se houve algum erro
    $errors = array_filter($errors); // Remove valores nulos
    if (!empty($errors)) {
        wp_send_json_error($errors);
    }

    // Enviar o email com os anexos (se houver)
    send_email_with_attachment($to_string, $subject, $body, $headers, $attachments);

    wp_send_json_success('Formulário enviado com sucesso.');
    wp_die();
}

add_action('wp_ajax_submit_form_fiador', 'handle_form_locacao_fiador');
add_action('wp_ajax_nopriv_submit_form_fiador', 'handle_form_locacao_fiador');
function handle_form_locacao_fiador() {
    $finalidade_locacao = sanitize_text_field($_POST['finalidade_locacao']);
    $endereco_imovel = sanitize_text_field($_POST['endereco_imovel']);
    $valor_locacao = sanitize_text_field($_POST['valor_locacao']);
    $garantia_escolhida = sanitize_text_field($_POST['garantia_escolhida']);

    $nome_completo = sanitize_text_field($_POST['nome_completo']);
    $celular = sanitize_text_field($_POST['celular']);
    $email = sanitize_email($_POST['email']);
    $nacionalidade = sanitize_text_field($_POST['nacionalidade']);
    $profissao = sanitize_text_field($_POST['profissao']);
    $atuacao = sanitize_text_field($_POST['atuacao']);
    $renda_bruta = sanitize_text_field($_POST['renda_bruta']);
    $rg = sanitize_text_field($_POST['rg']);
    $cpf = sanitize_text_field($_POST['cpf']);
    $doc_rg = $_FILES['doc_rg'];
    $doc_comprovante_residencia = $_FILES['doc_comprovante_residencia'];
    $estado_civil = sanitize_text_field($_POST['estado_civil']);
    $doc_estado_civil = $_FILES['doc_estado_civil'];

    // Informações cônjuge
    $nome_conjuge = sanitize_text_field($_POST['nome_conjuge']);
    $cpf_conjuge = sanitize_text_field($_POST['cpf_conjuge']);
    $celular_conjuge = sanitize_text_field($_POST['celular_conjuge']);
    $email_conjuge = sanitize_email($_POST['email_conjuge']);
    $nacionalidade_conjuge = sanitize_text_field($_POST['nacionalidade_conjuge']);
    $profissao_conjuge = sanitize_text_field($_POST['profissao_conjuge']);

    // Outros campos
    $comprovante_renda = $_FILES['comprovante_renda'];
    $valor_aluguel = sanitize_text_field($_POST['valor_aluguel']);
    $locador = sanitize_text_field($_POST['locador']);
    $motivo_mudanca = sanitize_text_field($_POST['motivo_mudanca']);
    
    $to = array(
        'guilhermesfonsecaa@gmail.com',
        'analise@meuimovel.imb.br',
        'contato@meuimovel.imb.br'
    );

    $to_string = implode(',', $to);

    $subject = 'Formulário Para Locação - Pessoa Física';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // Montando o corpo do e-mail
    $body = "<strong>Finalidade da Locação:</strong> $finalidade_locacao<br>
            <strong>Endereço do Imóvel:</strong> $endereco_imovel<br>
            <strong>Valor da Locação:</strong> $valor_locacao<br>
            <strong>Garantia Escolhida:</strong> $garantia_escolhida<br>
            <strong>Nome Completo:</strong> $nome_completo<br>
            <strong>Celular:</strong> $celular<br>
            <strong>E-mail:</strong> $email<br>
            <strong>Nacionalidade:</strong> $nacionalidade<br>
            <strong>Profissão:</strong> $profissao<br>
            <strong>Área de Atuação:</strong> $atuacao<br>
            <strong>Renda Bruta:</strong> $renda_bruta<br>
            <strong>RG:</strong> $rg<br>
            <strong>CPF:</strong> $cpf<br>
            <strong>Estado Civil:</strong> $estado_civil<br>
            <strong>Nome do Cônjuge:</strong> $nome_conjuge<br>
            <strong>CPF do Cônjuge:</strong> $cpf_conjuge<br>
            <strong>Celular do Cônjuge:</strong> $celular_conjuge<br>
            <strong>E-mail do Cônjuge:</strong> $email_conjuge<br>
            <strong>Nacionalidade do Cônjuge:</strong> $nacionalidade_conjuge<br>
            <strong>Profissão do Cônjuge:</strong> $profissao_conjuge<br>";

    // Processar dinamicamente os moradores
    $moradores = [];
    for ($i = 1; isset($_POST["morador_rg_$i"]); $i++) {
        $morador_rg = sanitize_text_field($_POST["morador_rg_$i"]);
        $morador_cpf = sanitize_text_field($_POST["morador_cpf_$i"]);
        $doc_morador = isset($_FILES["doc_morador_$i"]) ? $_FILES["doc_morador_$i"] : null;

        // Adiciona o morador ao array
        $moradores[] = [
            'rg' => $morador_rg,
            'cpf' => $morador_cpf,
            'doc' => $doc_morador
        ];

        // Adiciona as informações do morador ao corpo do e-mail
        $body .= "<strong>RG do Morador $i:</strong> $morador_rg<br>
                  <strong>CPF do Morador $i:</strong> $morador_cpf<br>";
    }

    // Outros campos
    $body .= "<strong>Comprovante de Renda:</strong> Comprovante enviado.<br>
              <strong>Valor do Aluguel:</strong> $valor_aluguel<br>
              <strong>Locador:</strong> $locador<br>
              <strong>Motivo da Mudança:</strong> $motivo_mudanca<br>";
    
    // Função para fazer upload e adicionar ao array de anexos
    function add_attachment($file, &$attachments) {
        if (!empty($file['name'])) {
            $uploaded_file = wp_handle_upload($file, array('test_form' => false));
            if ($uploaded_file && !isset($uploaded_file['error'])) {
                $attachments[] = $uploaded_file['file'];
            } else {
                return "Erro ao fazer upload do arquivo: " . $file['name'];
            }
        }
        return null; // Se tudo ocorreu bem
    }

    // Array de anexos
    $attachments = array();

    // Adicionando todos os documentos ao array de anexos
    $errors = array();
    $errors[] = add_attachment($doc_rg, $attachments);
    $errors[] = add_attachment($doc_comprovante_residencia, $attachments);
    $errors[] = add_attachment($doc_estado_civil, $attachments);
    $errors[] = add_attachment($comprovante_renda, $attachments);

    // Adicionar os documentos dos moradores
    foreach ($moradores as $index => $morador) {
        if ($morador['doc']) {
            $errors[] = add_attachment($morador['doc'], $attachments);
        }
    }

    // Verificando se houve algum erro
    $errors = array_filter($errors); // Remove valores nulos
    if (!empty($errors)) {
        wp_send_json_error($errors);
    }

    // Enviar o email com os anexos (se houver)
    send_email_with_attachment($to_string, $subject, $body, $headers, $attachments);

    wp_send_json_success('Formulário enviado com sucesso.');
    wp_die();
}

add_action('wp_ajax_submit_form_analise_credito', 'handle_form_analise_credito');
add_action('wp_ajax_nopriv_submit_form_analise_credito', 'handle_form_analise_credito');
function handle_form_analise_credito() {
    $nome_completo = sanitize_text_field($_POST['nome_completo']);
    $cpf = sanitize_text_field($_POST['cpf']);
    $rg = sanitize_text_field($_POST['rg']);
    $doc_rg = $_FILES['doc_rg'];
    $orgao_emissor = sanitize_text_field($_POST['orgao_emissor']);
    
    $data_emissao = sanitize_text_field($_POST['data_emissao']);
    $titulo_eleitor = sanitize_text_field($_POST['titulo_eleitor']);
    $doc_titulo_eleitor = $_FILES['doc_titulo_eleitor'];

    $nome_completo_mae = sanitize_text_field($_POST['nome_completo_mae']);
    $estado_civil = sanitize_text_field($_POST['estado_civil']);
    $doc_nascimento = $_FILES['doc_nascimento'];
    $data_nascimento = sanitize_text_field($_POST['data_nascimento']);
    $profissao = sanitize_text_field($_POST['profissao']);
    $cargo = sanitize_text_field($_POST['cargo']);
    $nome_empresa = sanitize_text_field($_POST['nome_empresa']);
    $cnpj_empresa = sanitize_text_field($_POST['cnpj_empresa']);
    $data_admissao = sanitize_text_field($_POST['data_admissao']);
    $pis = sanitize_text_field($_POST['pis']);
    $renda_bruta = sanitize_text_field($_POST['renda_bruta']);
    $comprovacao_renda = sanitize_text_field($_POST['comprovacao_renda']);
    $doc_comprovacao_renda = $_FILES['doc_comprovacao_renda'];
    $endereco = sanitize_text_field($_POST['endereco']);
    $comprovante_endereco_residencial = $_FILES['comprovante_endereco_residencial'];
    $numero_celular = sanitize_text_field($_POST['numero_celular']);
    $email = sanitize_email($_POST['email']);
    
    $to = array(
        'guilhermesfonsecaa@gmail.com',
        'analise@meuimovel.imb.br',
        'contato@meuimovel.imb.br'
    );

    $to_string = implode(',', $to);

    $subject = 'Formulário Para Locação - Pessoa Física';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    
    // Montando o corpo do e-mail
    $body = "<strong>Nome Completo:</strong> $nome_completo<br>
        <strong>CPF:</strong> $cpf<br>
        <strong>RG:</strong> $rg<br>
        <strong>Órgão Emissor:</strong> $orgao_emissor<br>
        <strong>Data de Emissão:</strong> $data_emissao<br>
        <strong>Título de Eleitor:</strong> $titulo_eleitor<br>
        <strong>Nome Completo da Mãe:</strong> $nome_completo_mae<br>
        <strong>Estado Civil:</strong> $estado_civil<br>
        <strong>Data de Nascimento:</strong> $data_nascimento<br>
        <strong>Profissão:</strong> $profissao<br>
        <strong>Cargo:</strong> $cargo<br>
        <strong>Nome da Empresa:</strong> $nome_empresa<br>
        <strong>CNPJ da Empresa:</strong> $cnpj_empresa<br>
        <strong>Data de Admissão:</strong> $data_admissao<br>
        <strong>PIS:</strong> $pis<br>
        <strong>Renda Bruta:</strong> $renda_bruta<br>
        <strong>Comprovação de Renda:</strong> $comprovacao_renda<br>
        <strong>Endereço Residencial:</strong> $endereco<br>
        <strong>Número de Celular:</strong> $numero_celular<br>
        <strong>Email:</strong> $email<br>

        <strong>Documentos Anexados:</strong><br>
        - RG: " . (!empty($doc_rg['name']) ? 'Anexado' : 'Não Anexado') . "<br>
        - Título de Eleitor: " . (!empty($doc_titulo_eleitor['name']) ? 'Anexado' : 'Não Anexado') . "<br>
        - Certidão de Nascimento: " . (!empty($doc_nascimento['name']) ? 'Anexado' : 'Não Anexado') . "<br>
        - Comprovação de Renda: " . (!empty($doc_comprovacao_renda['name']) ? 'Anexado' : 'Não Anexado') . "<br>
        - Comprovante de Endereço Residencial: " . (!empty($comprovante_endereco_residencial['name']) ? 'Anexado' : 'Não Anexado') . "<br>";
    
    // Função para fazer upload e adicionar ao array de anexos
    function add_attachment($file, &$attachments) {
        if (!empty($file['name'])) {
            $uploaded_file = wp_handle_upload($file, array('test_form' => false));
            if ($uploaded_file && !isset($uploaded_file['error'])) {
                $attachments[] = $uploaded_file['file'];
            } else {
                return "Erro ao fazer upload do arquivo: " . $file['name'];
            }
        }
        return null; // Se tudo ocorreu bem
    }

    // Array de anexos
    $attachments = array();

    // Adicionando todos os documentos ao array de anexos
    $errors = array();
    $errors[] = add_attachment($doc_rg, $attachments);
    $errors[] = add_attachment($doc_titulo_eleitor, $attachments);
    $errors[] = add_attachment($doc_nascimento, $attachments);
    $errors[] = add_attachment($doc_comprovacao_renda, $attachments);
    $errors[] = add_attachment($comprovante_endereco_residencial, $attachments);

    // Verificando se houve algum erro
    $errors = array_filter($errors); // Remove valores nulos
    if (!empty($errors)) {
        wp_send_json_error($errors);
    }

    // Enviar o email com os anexos (se houver)
    send_email_with_attachment($to_string, $subject, $body, $headers, $attachments);

    wp_send_json_success('Formulário enviado com sucesso.');
    wp_die();
}

function send_email_with_attachment($to, $subject, $body, $headers, $attachments) {
    wp_mail($to, $subject, $body, $headers, $attachments);
}