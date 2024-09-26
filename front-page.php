<?php
get_header();

if (isset($_GET['tipo_de_locacao'])) {
    $tipo_locacao = $_GET['tipo_de_locacao'];
  } else {
    $tipo_locacao = '';
}
?>

<main>
    <section class="formulario">
        <aside>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg" alt=""></figure>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/imovel.webp" alt=""></figure>
        </aside>
        <!-- // (Condition)?(thing's to do if condition true):(thing's to do if condition false); -->
        <div class="formulario__container">
            <div class="formulario__content <?php echo ($tipo_locacao == '') ? 'formulario__content--active' : ''; ?> formulario__content--1" data-index="1">
                <article>
                    <span>Locação de Imóvel</span>
                    <p>Vamos dar início a nossa jornada, para começar qual é o tipo de locação?</p>
                </article>
                <div class="formulario__nav">
                    <button class="formulario__btn formulario__btn--juridica">Pessoa Jurídica</button>
                    <button class="formulario__btn formulario__btn--fisica">Pessoa Física</button>
                    <button class="formulario__btn formulario__btn--fiacao">Fiação</button>
                </div>
            </div>

            <div class="formulario__content formulario__content--form <?php echo ($tipo_locacao == 'juridico') ? 'formulario__content--active' : ''; ?>" data-categ="juridico">
                <span class="formulario__heading">Formulário Para Locação - Pessoa Jurídica</span>

                <form method="POST" enctype="multipart/form-data">
                    <div class="formulario__fieldset">
                        <span>Qual é a finalidade da locação?</span>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_residencial_juridica" name="finalidade_locacao"
                                    value="Residencial" checked hidden required>
                                <span>Residencial</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_comercial" name="finalidade_locacao"
                                    value="Comercial" hidden required>
                                <span>Comercial</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_locatario" name="finalidade_locacao"
                                    value="Locatário" hidden required>
                                <span>Locatário</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_fiador" name="finalidade_locacao"
                                    value="Fiador" hidden required>
                                <span>Fiador</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="endereco-imovel">
                            <span>Endereço do Imóvel <strong>*</strong></span>
                            <input type="text" id="endereco-imovel" name="endereco_imovel"
                                placeholder="Ex. Av. Itaberaba 1247, SP, São Paulo" required>
                        </label>

                        <label for="valor-locacao">
                            <span>Valor da Locação <strong>*</strong></span>
                            <input type="text" id="valor-locacao" name="valor_locacao" placeholder="Ex. R$1000,00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="garantia-escolhida">
                            <span>Qual a Garantia Escolhida?</span>
                            <input type="text" id="garantia-escolhida" name="garantia_escolhida"
                                placeholder="Ex. Bens" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="cnpj">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Cartão CNPJ <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="cnpj" id="cnpj" accept=".png, .jpeg, .jpg, .pdf" required
                                hidden />
                        </label>

                        <label for="contrato-social">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Contrato Social <strong>*</strong>
                                <i><strong>Anexar o Contrato e sua Última alteração.</strong> O Documento precisa
                                    estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="contrato_social" id="contrato-social"
                                accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="comprovante-endereco">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Comprovante de Endereço <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                    Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="comprovante_endereco" id="comprovante-endereco"
                                accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="imposto-renda">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Imposto de Renda (Último Exercício) <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                    Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="imposto_renda" id="imposto-renda"
                                accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="faturamento">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Faturamento dos Últimos 6 meses com Firma <strong>*</strong>
                                <i><strong>Com renda de no mínimo 4 Vezes o valor do aluguel mais encargos.</strong>
                                    O Documento precisa
                                    estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="faturamento" id="faturamento" accept=".png, .jpeg, .jpg, .pdf"
                                hidden required />
                        </label>
                    </div>

                    <hr />

                    <!-- Representante Sócio 1 -->
                    <span>Representante: Sócio 1 <strong>*</strong></span>

                    <div class="formulario__fieldset">
                        <label for="rg1-juridico">
                            <span>RG/CNH <strong>*</strong></span>
                            <input type="text" id="rg1-juridico" name="rg1" placeholder="Ex. 00.000.000-0" required>
                        </label>

                        <label for="cpf1-juridico">
                            <span>CPF <strong>*</strong></span>
                            <input type="text" id="cpf1-juridico" name="cpf1" placeholder="Ex. 000.000.000-00" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="doc-socio1">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento Caso Necessário
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                    Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_socio1" id="doc-socio1" accept=".png, .jpeg, .jpg, .pdf"
                                hidden required />
                        </label>
                    </div>

                    <!-- Representante Sócio 2 -->
                    <span>Representante: Sócio 2 <strong>*</strong></span>

                    <div class="formulario__fieldset">
                        <label for="rg2-juridico">
                            <span>RG/CNH <strong>*</strong></span>
                            <input type="text" id="rg2-juridico" name="rg2" placeholder="Ex. 00.000.000-0" required>
                        </label>

                        <label for="cpf2-juridico">
                            <span>CPF <strong>*</strong></span>
                            <input type="text" id="cpf2-juridico" name="cpf2" placeholder="Ex. 000.000.000-00" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="doc-socio2">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento Caso Necessário
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                    Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_socio2" id="doc-socio2" accept=".png, .jpeg, .jpg, .pdf"
                                hidden required />
                        </label>
                    </div>

                    <hr />

                    <!-- Informações adicionais -->
                    <div class="formulario__fieldset">
                        <label for="estado-civil-juridico">
                            <span>Estado Civil <strong>*</strong></span>
                            <input type="text" id="estado-civil-juridico" name="estado_civil" placeholder="Ex. João Souza"
                                required>
                        </label>

                        <label for="doc-estado-civil-juridico">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento <strong>*</strong>
                                <i><strong>Certidão de Casamento ou Certidão de Nascimento.</strong> O Documento
                                    precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem
                                    legíveis.</i>
                            </span>
                            <input type="file" name="doc_estado_civil_juridico" id="doc-estado-civil-juridico" accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="nome-conjuge-juridico">
                            <span>Nome Cônjuge</span>
                            <input type="text" id="nome-conjuge-juridico" name="nome_conjuge" placeholder="Ex. João Souza"
                                required>
                        </label>
                        <label for="cpf-conjuge-juridico">
                            <span>CPF <strong>*</strong></span>
                            <input type="text" id="cpf-conjuge-juridico" name="cpf_conjuge" placeholder="Ex. 000.000.000-00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="celular-juridico">
                            <span>Número de Celular <strong>*</strong></span>
                            <input type="text" id="celular-juridico" name="celular" placeholder="Ex. (DDD) 9-9999 9999"
                                required>
                        </label>
                        <label for="email-juridico">
                            <span>E-mail <strong>*</strong></span>
                            <input type="email" id="email-juridico" name="email" placeholder="Ex. mariasilva@email.com"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="nacionalidade-juridico">
                            <span>Nacionalidade <strong>*</strong></span>
                            <input type="text" id="nacionalidade-juridico" name="nacionalidade" placeholder="Ex. Brasileiro"
                                required>
                        </label>
                        <label for="profissao-juridico">
                            <span>Profissão <strong>*</strong></span>
                            <input type="text" id="profissao-juridico" name="profissao" placeholder="Ex. Cozinheiro"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="valor-aluguel-juridico">
                            <span>Você paga aluguel? Se sim, qual o valor?</span>
                            <input type="text" id="valor-aluguel-juridico" name="valor_aluguel" placeholder="Ex. R$5.000,00">
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="locador-juridico">
                            <span>Locador <strong>*</strong></span>
                            <input type="text" id="locador-juridico" name="locador" placeholder="Ex. Nome ou Empresa"
                                required>
                        </label>
                        <label for="telefone-locador-juridico">
                            <span>Telefone <strong>*</strong></span>
                            <input type="text" id="telefone-locador-juridico" name="telefone_locador"
                                placeholder="Ex. (DDD) 9-9999 9999" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="motivo-mudanca-juridico">
                            <span>Motivo da Mudança <strong>*</strong></span>
                            <textarea id="motivo-mudanca-juridico" name="motivo_mudanca" placeholder="Escreva aqui"
                                required></textarea>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="accept">
                            <input type="checkbox" name="accept" id="accept" hidden required>
                            <span class="formulario__accept">
                                <svg width="11" height="9" viewBox="0 0 11 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.32998 5.23699L2.98908 3.89609C2.8937 3.79829 2.78001 3.72019 2.65446 3.66626C2.52738 3.61167 2.39069 3.58293 2.25238 3.58173C2.11407 3.58053 1.9769 3.60689 1.84888 3.65926C1.72087 3.71164 1.60456 3.78899 1.50676 3.88679C1.40895 3.98459 1.33161 4.1009 1.27923 4.22892C1.22685 4.35693 1.2005 4.4941 1.2017 4.63241C1.2029 4.77072 1.23164 4.90741 1.28623 5.0345C1.34016 5.16004 1.41825 5.27373 1.51605 5.3691L3.59342 7.44647C3.59344 7.44649 3.59345 7.44651 3.59347 7.44653C3.78877 7.64186 4.05366 7.75162 4.32988 7.75168H4.33009C4.60633 7.75162 4.87124 7.64184 5.06655 7.44647L9.48649 3.02653L9.48655 3.02658L9.49259 3.02033C9.68233 2.82387 9.78733 2.56074 9.78495 2.28762C9.78258 2.0145 9.67303 1.75323 9.4799 1.5601C9.28676 1.36697 9.0255 1.25742 8.75238 1.25504C8.47926 1.25267 8.21613 1.35766 8.01967 1.54741L8.01962 1.54736L8.01347 1.5535L4.32998 5.23699ZM4.71294 7.09297C4.61138 7.19456 4.47363 7.25165 4.32998 7.25168C4.18634 7.25165 4.04858 7.19456 3.94702 7.09297L1.86702 5.01297C1.81529 4.96301 1.77402 4.90324 1.74564 4.83715C1.71725 4.77107 1.70231 4.69999 1.70168 4.62807C1.70106 4.55614 1.71476 4.48482 1.742 4.41825C1.76923 4.35168 1.80945 4.2912 1.86031 4.24034C1.91117 4.18948 1.97165 4.14926 2.03822 4.12203C2.10478 4.09479 2.17611 4.08109 2.24803 4.08171C2.31996 4.08234 2.39103 4.09728 2.45712 4.12567L4.71294 7.09297Z"
                                        fill="#C16800" stroke="#E0B37F" />
                                </svg>
                            </span>
                            <span>Declaro estar ciente e de acordo que meus dados pessoais serão coletados com a
                                finalidade de elaboração da Ficha Cadastral a fim de permitir a verificação e
                                pesquisas da idoneidade para locação do imóvel por mim pretendido e, que tais dados
                                serão armazenados, utilizados e descartados de com acordo com a legislação
                                vigente.</span>
                        </label>
                    </div>

                    <input type="submit" class="formulario__submit" value="Enviar Formulário">
                </form>
            </div>

            <div class="formulario__content formulario__content--form <?php echo ($tipo_locacao == 'fisica') ? 'formulario__content--active' : ''; ?>" data-categ="fisica">
                <span class="formulario__heading">Formulário Para Locação - Pessoa Física</span>

                <form method="POST" enctype="multipart/form-data">
                    <div class="formulario__fieldset">
                        <span>Qual é a finalidade da locação?</span>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_residencial_fisica" name="finalidade_locacao"
                                    value="Residencial" checked hidden required>
                                <span>Residencial</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_comercial" name="finalidade_locacao"
                                    value="Comercial" hidden required>
                                <span>Comercial</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_locatario" name="finalidade_locacao"
                                    value="Locatário" hidden required>
                                <span>Locatário</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_fiador" name="finalidade_locacao"
                                    value="Fiador" hidden required>
                                <span>Fiador</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="endereco-imovel">
                            <span>Endereço do Imóvel <strong>*</strong></span>
                            <input type="text" id="endereco-imovel" name="endereco_imovel"
                                placeholder="Ex. Av. Itaberaba 1247, SP, São Paulo" required>
                        </label>

                        <label for="valor-locacao">
                            <span>Valor da Locação <strong>*</strong></span>
                            <input type="text" id="valor-locacao" name="valor_locacao" placeholder="Ex. R$1000,00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="garantia-escolhida">
                            <span>Qual a Garantia Escolhida?</span>
                            <input type="text" id="garantia-escolhida" name="garantia_escolhida"
                                placeholder="Ex. Bens" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="nome-completo">
                            <span>Nome Completo <strong>*</strong></span>
                            <input type="text" id="nome-completo" name="nome_completo" placeholder="Ex. João Souza"
                                required>
                        </label>

                        <label for="celular">
                            <span>Número de Celular <strong>*</strong></span>
                            <input type="text" id="celular" name="celular" placeholder="Ex. (DDD) 9-9999 9999"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="email">
                            <span>E-mail <strong>*</strong></span>
                            <input type="email" id="email" name="email" placeholder="Ex. mariasilva@email.com"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="nacionalidade">
                            <span>Nacionalidade <strong>*</strong></span>
                            <input type="text" id="nacionalidade" name="nacionalidade" placeholder="Ex. Brasileiro"
                                required>
                        </label>
                        <label for="profissao">
                            <span>Profissão <strong>*</strong></span>
                            <input type="text" id="profissao" name="profissao" placeholder="Ex. Cozinheiro"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <span>Você atua como:</span>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="atuacao_clt" name="atuacao" value="CLT" checked hidden
                                    required>
                                <span>CLT</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="atuacao_autonomo" name="atuacao" value="Autonomo" hidden
                                    required>
                                <span>Autônomo(a)</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="renda-bruta">
                            <span>Renda Bruta <strong>*</strong></span>
                            <input type="text" id="renda-bruta" name="renda-bruta" placeholder="Ex. R$5.000,00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="rg">
                            <span>RG/CNH <strong>*</strong></span>
                            <input type="text" id="rg" name="rg" placeholder="Ex. 00.000.000-0" required>
                        </label>

                        <label for="cpf">
                            <span>CPF <strong>*</strong></span>
                            <input type="text" id="cpf" name="cpf" placeholder="Ex. 000.000.000-00" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="doc-rg">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar RG ou CNH <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_rg" id="doc-rg" accept=".png, .jpeg, .jpg, .pdf" hidden
                                required />
                        </label>
                        <label for="doc-comprovante-residencia-fisico">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Comprovante de Residência <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_comprovante_residencia_fisico" id="doc-comprovante-residencia-fisico"
                                accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>

                    <!-- Informações adicionais -->
                    <div class="formulario__fieldset">
                        <label for="estado-civil">
                            <span>Estado Civil <strong>*</strong></span>
                            <input type="text" id="estado-civil" name="estado_civil" placeholder="Ex. João Souza"
                                required>
                        </label>

                        <label for="doc-estado-civil-fisico">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento <strong>*</strong>
                                <i><strong>Certidão de Casamento ou Certidão de Nascimento.</strong> O Documento
                                    precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem
                                    legíveis.</i>
                            </span>
                            <input type="file" name="doc_estado_civil_fisico" id="doc-estado-civil-fisico"
                                accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="nome-conjuge">
                            <span>Nome Cônjuge</span>
                            <input type="text" id="nome-conjuge" name="nome_conjuge" placeholder="Ex. João Souza"
                                required>
                        </label>
                        <label for="cpf-conjuge">
                            <span>CPF <strong>*</strong></span>
                            <input type="text" id="cpf-conjuge" name="cpf_conjuge" placeholder="Ex. 000.000.000-00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="celular">
                            <span>Número de Celular <strong>*</strong></span>
                            <input type="text" id="celular" name="celular" placeholder="Ex. (DDD) 9-9999 9999"
                                required>
                        </label>
                        <label for="email">
                            <span>E-mail <strong>*</strong></span>
                            <input type="email" id="email" name="email" placeholder="Ex. mariasilva@email.com"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="nacionalidade">
                            <span>Nacionalidade <strong>*</strong></span>
                            <input type="text" id="nacionalidade" name="nacionalidade" placeholder="Ex. Brasileiro"
                                required>
                        </label>
                        <label for="profissao">
                            <span>Profissão <strong>*</strong></span>
                            <input type="text" id="profissao" name="profissao" placeholder="Ex. Cozinheiro"
                                required>
                        </label>
                    </div>

                    <hr />

                    <div class="formulario__moradores">
                        <div class="formulario__fieldset">
                            <span>Morador 1 <strong>*</strong></span>
                            <label for="morador-rg1">
                                <span>RG/CNH <strong>*</strong></span>
                                <input type="text" id="morador-rg1" name="morador-rg1"
                                    placeholder="Ex. 00.000.000-0" required>
                            </label>

                            <label for="morador-cpf1">
                                <span>CPF <strong>*</strong></span>
                                <input type="text" id="morador-cpf1" name="morador-cpf1"
                                    placeholder="Ex. 000.000.000-00" required>
                            </label>
                        </div>
                        <div class="formulario__fieldset">
                            <label for="doc-morador-1">
                                <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                                <span>
                                    Anexar Documento Caso Necessário
                                    <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                        Atente-se das imagens estarem legíveis.</i>
                                </span>
                                <input type="file" name="doc-morador-1" id="doc-morador-1"
                                    accept=".png, .jpeg, .jpg, .pdf" hidden />
                            </label>
                        </div>

                        <div class="formulario__fieldset">
                            <span>Morador 2 <strong>*</strong></span>
                            <label for="morador-rg2">
                                <span>RG/CNH <strong>*</strong></span>
                                <input type="text" id="morador-rg2" name="morador-rg2"
                                    placeholder="Ex. 00.000.000-0" required>
                            </label>

                            <label for="morador-cpf2">
                                <span>CPF <strong>*</strong></span>
                                <input type="text" id="morador-cpf2" name="morador-cpf2"
                                    placeholder="Ex. 000.000.000-00" required>
                            </label>
                        </div>

                        <div class="formulario__fieldset">
                            <label for="doc-morador-2">
                                <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                                <span>
                                    Anexar Documento Caso Necessário
                                    <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                        Atente-se das imagens estarem legíveis.</i>
                                </span>
                                <input type="file" name="doc-morador-2" id="doc-morador-2"
                                    accept=".png, .jpeg, .jpg, .pdf" hidden />
                            </label>
                        </div>

                        <button type="button" class="formulario__mais-moradores" disabled>Adicionar Mais
                            Moradores</button>
                    </div>

                    <hr />

                    <div class="formulario__fieldset">
                        <label for="comprovante-renda">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Comprovante de Renda 3 últimos extratos <br> bancários ou holerite <strong>
                                    *</strong>
                                <i><strong>Com renda de no mínimo 3 Vezes o valor do aluguel mais encargos.</strong>
                                    O Documento precisa
                                    estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="comprovante-renda" id="comprovante-renda"
                                accept=".png, .jpeg, .jpg, .pdf" multiple hidden required />
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="valor-aluguel">
                            <span>Você paga aluguel? Se sim, qual o valor?</span>
                            <input type="text" id="valor-aluguel" name="valor_aluguel" placeholder="Ex. R$5.000,00">
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="locador">
                            <span>Locador <strong>*</strong></span>
                            <input type="text" id="locador" name="locador" placeholder="Ex. Nome ou Empresa"
                                required>
                        </label>
                        <label for="telefone-locador-fisico">
                            <span>Telefone <strong>*</strong></span>
                            <input type="text" id="telefone-locador-fisico" name="telefone_locador"
                                placeholder="Ex. (DDD) 9-9999 9999" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="motivo-mudanca-fisico">
                            <span>Motivo da Mudança <strong>*</strong></span>
                            <textarea id="motivo-mudanca-fisico" name="motivo_mudanca" placeholder="Escreva aqui"
                                required></textarea>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="acceptance-fisico">
                            <input type="checkbox" name="acceptance" id="acceptance-fisico" hidden required>
                            <span class="formulario__accept">
                                <svg width="11" height="9" viewBox="0 0 11 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.32998 5.23699L2.98908 3.89609C2.8937 3.79829 2.78001 3.72019 2.65446 3.66626C2.52738 3.61167 2.39069 3.58293 2.25238 3.58173C2.11407 3.58053 1.9769 3.60689 1.84888 3.65926C1.72087 3.71164 1.60456 3.78899 1.50676 3.88679C1.40895 3.98459 1.33161 4.1009 1.27923 4.22892C1.22685 4.35693 1.2005 4.4941 1.2017 4.63241C1.2029 4.77072 1.23164 4.90741 1.28623 5.0345C1.34016 5.16004 1.41825 5.27373 1.51605 5.3691L3.59342 7.44647C3.59344 7.44649 3.59345 7.44651 3.59347 7.44653C3.78877 7.64186 4.05366 7.75162 4.32988 7.75168H4.33009C4.60633 7.75162 4.87124 7.64184 5.06655 7.44647L9.48649 3.02653L9.48655 3.02658L9.49259 3.02033C9.68233 2.82387 9.78733 2.56074 9.78495 2.28762C9.78258 2.0145 9.67303 1.75323 9.4799 1.5601C9.28676 1.36697 9.0255 1.25742 8.75238 1.25504C8.47926 1.25267 8.21613 1.35766 8.01967 1.54741L8.01962 1.54736L8.01347 1.5535L4.32998 5.23699ZM4.71294 7.09297C4.61138 7.19456 4.47363 7.25165 4.32998 7.25168C4.18634 7.25165 4.04858 7.19456 3.94702 7.09297L1.86702 5.01297C1.81529 4.96301 1.77402 4.90324 1.74564 4.83715C1.71725 4.77107 1.70231 4.69999 1.70168 4.62807C1.70106 4.55614 1.71476 4.48482 1.742 4.41825C1.76923 4.35168 1.80945 4.2912 1.86031 4.24034C1.91117 4.18948 1.97165 4.14926 2.03822 4.12203C2.10478 4.09479 2.17611 4.08109 2.24803 4.08171C2.31996 4.08234 2.39103 4.09728 2.45712 4.12567L4.71294 7.09297Z"
                                        fill="#C16800" stroke="#E0B37F" />
                                </svg>
                            </span>
                            <span>Declaro estar ciente e de acordo que meus dados pessoais serão coletados com a
                                finalidade de elaboração da Ficha Cadastral a fim de permitir a verificação e
                                pesquisas da idoneidade para locação do imóvel por mim pretendido e, que tais dados
                                serão armazenados, utilizados e descartados de com acordo com a legislação
                                vigente.</span>
                        </label>
                    </div>

                    <input type="submit" class="formulario__submit" value="Enviar Formulário">
                </form>
            </div>

            <div class="formulario__content formulario__content--form <?php echo ($tipo_locacao == 'fiacao') ? 'formulario__content--active' : ''; ?>" data-categ="fiacao">
                <span class="formulario__heading">Formulário Para Locação - Fiação</span>

                <form method="POST" enctype="multipart/form-data">
                    <div class="formulario__fieldset">
                        <span>Qual é a finalidade da locação?</span>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_residencial_fiacao" name="finalidade_locacao"
                                    value="Residencial" checked hidden required>
                                <span>Residencial</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_comercial" name="finalidade_locacao"
                                    value="Comercial" hidden required>
                                <span>Comercial</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_locatario" name="finalidade_locacao"
                                    value="Locatário" hidden required>
                                <span>Locatário</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="finalidade_locacao_fiador" name="finalidade_locacao"
                                    value="Fiador" hidden required>
                                <span>Fiador</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="endereco-imovel">
                            <span>Endereço do Imóvel <strong>*</strong></span>
                            <input type="text" id="endereco-imovel" name="endereco_imovel"
                                placeholder="Ex. Av. Itaberaba 1247, SP, São Paulo" required>
                        </label>

                        <label for="valor-locacao">
                            <span>Valor da Locação <strong>*</strong></span>
                            <input type="text" id="valor-locacao" name="valor_locacao" placeholder="Ex. R$1000,00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="garantia-escolhida">
                            <span>Qual a Garantia Escolhida?</span>
                            <input type="text" id="garantia-escolhida" name="garantia_escolhida"
                                placeholder="Ex. Bens" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="matricula-imovel">
                            <span>Matrícula do imóvel em nome do fiador</span>
                            <input type="tel" id="matricula-imovel" name="matricula_imovel"
                                placeholder="N° da matricula" required>
                        </label>
                        <label for="doc-matricula-imovel">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_matricula_imovel" id="doc-matricula-imovel"
                                accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="nome-completo">
                            <span>Nome Completo <strong>*</strong></span>
                            <input type="text" id="nome-completo" name="nome_completo" placeholder="Ex. João Souza"
                                required>
                        </label>

                        <label for="celular">
                            <span>Número de Celular <strong>*</strong></span>
                            <input type="text" id="celular" name="celular" placeholder="Ex. (DDD) 9-9999 9999"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="email">
                            <span>E-mail <strong>*</strong></span>
                            <input type="email" id="email" name="email" placeholder="Ex. mariasilva@email.com"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="nacionalidade">
                            <span>Nacionalidade <strong>*</strong></span>
                            <input type="text" id="nacionalidade" name="nacionalidade" placeholder="Ex. Brasileiro"
                                required>
                        </label>
                        <label for="profissao">
                            <span>Profissão <strong>*</strong></span>
                            <input type="text" id="profissao" name="profissao" placeholder="Ex. Cozinheiro"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <span>Você atua como:</span>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="atuacao_clt" name="atuacao" value="CLT" checked hidden
                                    required>
                                <span>CLT</span>
                            </div>
                        </label>

                        <label>
                            <div class="formulario__radio">
                                <input type="radio" id="atuacao_autonomo" name="atuacao" value="Autonomo" hidden
                                    required>
                                <span>Autônomo(a)</span>
                            </div>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="renda-bruta">
                            <span>Renda Bruta <strong>*</strong></span>
                            <input type="text" id="renda-bruta" name="renda-bruta" placeholder="Ex. R$5.000,00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="rg">
                            <span>RG/CNH <strong>*</strong></span>
                            <input type="text" id="rg" name="rg" placeholder="Ex. 00.000.000-0" required>
                        </label>

                        <label for="cpf">
                            <span>CPF <strong>*</strong></span>
                            <input type="text" id="cpf" name="cpf" placeholder="Ex. 000.000.000-00" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="doc-rg">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar RG ou CNH <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_rg" id="doc-rg" accept=".png, .jpeg, .jpg, .pdf" hidden
                                required />
                        </label>
                        <label for="doc-comprovante-residencia-fiacao">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Comprovante de Residência <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_comprovante_residencia_fiacao" id="doc-comprovante-residencia-fiacao"
                                accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>

                    <!-- Informações adicionais -->
                    <div class="formulario__fieldset">
                        <label for="estado-civil">
                            <span>Estado Civil <strong>*</strong></span>
                            <input type="text" id="estado-civil" name="estado_civil" placeholder="Ex. João Souza"
                                required>
                        </label>

                        <label for="doc-estado-civil-fiacao">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento <strong>*</strong>
                                <i><strong>Certidão de Casamento ou Certidão de Nascimento.</strong> O Documento
                                    precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem
                                    legíveis.</i>
                            </span>
                            <input type="file" name="doc_estado_civil_fiacao" id="doc-estado-civil-fiacao" accept=".png, .jpeg, .jpg, .pdf" hidden required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="nome-conjuge">
                            <span>Nome Cônjuge</span>
                            <input type="text" id="nome-conjuge" name="nome_conjuge" placeholder="Ex. João Souza"
                                required>
                        </label>
                        <label for="cpf-conjuge">
                            <span>CPF <strong>*</strong></span>
                            <input type="text" id="cpf-conjuge" name="cpf_conjuge" placeholder="Ex. 000.000.000-00"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="celular">
                            <span>Número de Celular <strong>*</strong></span>
                            <input type="text" id="celular" name="celular" placeholder="Ex. (DDD) 9-9999 9999"
                                required>
                        </label>
                        <label for="email">
                            <span>E-mail <strong>*</strong></span>
                            <input type="email" id="email" name="email" placeholder="Ex. mariasilva@email.com"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="nacionalidade">
                            <span>Nacionalidade <strong>*</strong></span>
                            <input type="text" id="nacionalidade" name="nacionalidade" placeholder="Ex. Brasileiro"
                                required>
                        </label>
                        <label for="profissao">
                            <span>Profissão <strong>*</strong></span>
                            <input type="text" id="profissao" name="profissao" placeholder="Ex. Cozinheiro"
                                required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="imposto-renda-fiacao">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Imposto de Renda Último Exercício (Anexar IR e Recibo) <strong> *</strong>
                                <i><strong>Anexar Imposto de Renda e Recibo.</strong> O Documento precisa
                                    estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="imposto_renda" id="imposto-renda-fiacao"
                                accept=".png, .jpeg, .jpg, .pdf" multiple hidden required />
                        </label>
                    </div>

                    <hr />

                    <div class="formulario__moradores">
                        <div class="formulario__fieldset">
                            <span>Morador 1 <strong>*</strong></span>
                            <label for="morador-rg1">
                                <span>RG/CNH <strong>*</strong></span>
                                <input type="text" id="morador-rg1" name="morador-rg1"
                                    placeholder="Ex. 00.000.000-0" required>
                            </label>

                            <label for="morador-cpf1">
                                <span>CPF <strong>*</strong></span>
                                <input type="text" id="morador-cpf1" name="morador-cpf1"
                                    placeholder="Ex. 000.000.000-00" required>
                            </label>
                        </div>
                        <div class="formulario__fieldset">
                            <label for="doc-morador-1">
                                <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                                <span>
                                    Anexar Documento Caso Necessário
                                    <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                        Atente-se das imagens estarem legíveis.</i>
                                </span>
                                <input type="file" name="doc-morador-1" id="doc-morador-1"
                                    accept=".png, .jpeg, .jpg, .pdf" hidden />
                            </label>
                        </div>

                        <div class="formulario__fieldset">
                            <span>Morador 2 <strong>*</strong></span>
                            <label for="morador-rg2">
                                <span>RG/CNH <strong>*</strong></span>
                                <input type="text" id="morador-rg2" name="morador-rg2"
                                    placeholder="Ex. 00.000.000-0" required>
                            </label>

                            <label for="morador-cpf2">
                                <span>CPF <strong>*</strong></span>
                                <input type="text" id="morador-cpf2" name="morador-cpf2"
                                    placeholder="Ex. 000.000.000-00" required>
                            </label>
                        </div>

                        <div class="formulario__fieldset">
                            <label for="doc-morador-2">
                                <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                                <span>
                                    Anexar Documento Caso Necessário
                                    <i>O Documento precisa estar no formato PNG, JPEG ou PDF.
                                        Atente-se das imagens estarem legíveis.</i>
                                </span>
                                <input type="file" name="doc-morador-2" id="doc-morador-2"
                                    accept=".png, .jpeg, .jpg, .pdf" hidden />
                            </label>
                        </div>

                        <button type="button" class="formulario__mais-moradores" disabled>Adicionar Mais
                            Moradores</button>
                    </div>

                    <hr />

                    <div class="formulario__fieldset">
                        <label for="comprovante-renda">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Comprovante de Renda 3 últimos extratos <br> bancários ou holerite <strong>
                                    *</strong>
                                <i><strong>Com renda de no mínimo 3 Vezes o valor do aluguel mais encargos.</strong>
                                    O Documento precisa
                                    estar no formato PNG, JPEG ou PDF. Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="comprovante-renda" id="comprovante-renda"
                                accept=".png, .jpeg, .jpg, .pdf" multiple hidden required />
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="valor-aluguel">
                            <span>Você paga aluguel? Se sim, qual o valor?</span>
                            <input type="text" id="valor-aluguel" name="valor_aluguel" placeholder="Ex. R$5.000,00">
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="locador">
                            <span>Locador <strong>*</strong></span>
                            <input type="text" id="locador" name="locador" placeholder="Ex. Nome ou Empresa"
                                required>
                        </label>
                        <label for="telefone-locador-fiacao">
                            <span>Telefone <strong>*</strong></span>
                            <input type="text" id="telefone-locador-fiacao" name="telefone_locador"
                                placeholder="Ex. (DDD) 9-9999 9999" required>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="motivo-mudanca-fiacao">
                            <span>Motivo da Mudança <strong>*</strong></span>
                            <textarea id="motivo-mudanca-fiacao" name="motivo_mudanca" placeholder="Escreva aqui"
                                required></textarea>
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="acceptance-fiacao">
                            <input type="checkbox" name="acceptance" id="acceptance-fiacao" hidden required>
                            <span class="formulario__accept">
                                <svg width="11" height="9" viewBox="0 0 11 9" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4.32998 5.23699L2.98908 3.89609C2.8937 3.79829 2.78001 3.72019 2.65446 3.66626C2.52738 3.61167 2.39069 3.58293 2.25238 3.58173C2.11407 3.58053 1.9769 3.60689 1.84888 3.65926C1.72087 3.71164 1.60456 3.78899 1.50676 3.88679C1.40895 3.98459 1.33161 4.1009 1.27923 4.22892C1.22685 4.35693 1.2005 4.4941 1.2017 4.63241C1.2029 4.77072 1.23164 4.90741 1.28623 5.0345C1.34016 5.16004 1.41825 5.27373 1.51605 5.3691L3.59342 7.44647C3.59344 7.44649 3.59345 7.44651 3.59347 7.44653C3.78877 7.64186 4.05366 7.75162 4.32988 7.75168H4.33009C4.60633 7.75162 4.87124 7.64184 5.06655 7.44647L9.48649 3.02653L9.48655 3.02658L9.49259 3.02033C9.68233 2.82387 9.78733 2.56074 9.78495 2.28762C9.78258 2.0145 9.67303 1.75323 9.4799 1.5601C9.28676 1.36697 9.0255 1.25742 8.75238 1.25504C8.47926 1.25267 8.21613 1.35766 8.01967 1.54741L8.01962 1.54736L8.01347 1.5535L4.32998 5.23699ZM4.71294 7.09297C4.61138 7.19456 4.47363 7.25165 4.32998 7.25168C4.18634 7.25165 4.04858 7.19456 3.94702 7.09297L1.86702 5.01297C1.81529 4.96301 1.77402 4.90324 1.74564 4.83715C1.71725 4.77107 1.70231 4.69999 1.70168 4.62807C1.70106 4.55614 1.71476 4.48482 1.742 4.41825C1.76923 4.35168 1.80945 4.2912 1.86031 4.24034C1.91117 4.18948 1.97165 4.14926 2.03822 4.12203C2.10478 4.09479 2.17611 4.08109 2.24803 4.08171C2.31996 4.08234 2.39103 4.09728 2.45712 4.12567L4.71294 7.09297Z"
                                        fill="#C16800" stroke="#E0B37F" />
                                </svg>
                            </span>
                            <span>Declaro estar ciente e de acordo que meus dados pessoais serão coletados com a
                                finalidade de elaboração da Ficha Cadastral a fim de permitir a verificação e
                                pesquisas da idoneidade para locação do imóvel por mim pretendido e, que tais dados
                                serão armazenados, utilizados e descartados de com acordo com a legislação
                                vigente.</span>
                        </label>
                    </div>

                    <input type="submit" class="formulario__submit" value="Enviar Formulário">
                </form>
            </div>
        </div>

        <div class="formulario__modal">
            <div class="formulario__modal-success">
                <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M36 72C40.7276 72 45.4089 71.0688 49.7766 69.2597C54.1443 67.4505 58.1129 64.7988 61.4558 61.4558C64.7988 58.1129 67.4505 54.1443 69.2597 49.7766C71.0688 45.4089 72 40.7276 72 36C72 31.2724 71.0688 26.5911 69.2597 22.2234C67.4505 17.8557 64.7988 13.8871 61.4558 10.5442C58.1129 7.20125 54.1443 4.54951 49.7766 2.74034C45.4089 0.931167 40.7276 -7.04465e-08 36 0C26.4522 1.42273e-07 17.2955 3.79285 10.5442 10.5442C3.79285 17.2955 0 26.4522 0 36C0 45.5478 3.79285 54.7045 10.5442 61.4558C17.2955 68.2072 26.4522 72 36 72ZM35.072 50.56L55.072 26.56L48.928 21.44L31.728 42.076L22.828 33.172L17.172 38.828L29.172 50.828L32.268 53.924L35.072 50.56Z" fill="white" />
                </svg>
                <span>Formulário enviado com sucesso!</span>
                <p>Em breve entraremos em contato.</p>
            </div>
            <div class="formulario__modal-error">
                <button type="button"><svg xmlns="http://www.w3.org/2000/svg" width="72px" height="72px" viewBox="0 0 24 24">
                        <path fill="white" fill-rule="evenodd" d="M21 12a9 9 0 1 1-18 0a9 9 0 0 1 18 0M6.586 16l.707-.707L10.586 12L7.293 8.707L6.586 8L8 6.586l.707.707L12 10.586l3.293-3.293l.707-.707L17.414 8l-.707.707L13.414 12l3.293 3.293l.707.707L16 17.414l-.707-.707L12 13.414l-3.293 3.293l-.707.707z" clip-rule="evenodd" />
                    </svg></button>
            </div>
        </div>
    </section>
</main>

<?php
get_footer();
