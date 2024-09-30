<?php

/**
 * Template Name: Análise de Crédito
 * Template Post Type: page
 *
 * @package UAU
 * @since 1.0.0
 */
get_header();
?>
<main>
    <section class="formulario">
        <aside>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/logo.svg" alt=""></figure>
            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/imovel.webp" alt=""></figure>
        </aside>
        <div class="formulario__container">
            <div class="formulario__content formulario__content--active">
                <article>
                    <span>Análise de Crédito</span>
                    <p>Vamos dar início a nossa jornada, atente-se em não deixar de preencher nenhum campo.</p>
                </article>
                <button class="formulario__btn">Continuar</button>
            </div>

            <div class="formulario__content formulario__content--form">
                <span class="formulario__heading">Formulário Para Compra - Análise de Crédito</span>

                <form method="POST" enctype="multipart/form-data">
                    <div class="formulario__fieldset">
                        <label for="nome-completo">
                            <span>Nome Completo <strong>*</strong></span>
                            <input type="text" name="nome_completo" id="nome-completo" placeholder="Ex. Maria Silva"
                                required />
                        </label>
                        <label for="cpf">
                            <span>CPF <strong>*</strong></span>
                            <input type="tel" name="cpf" id="cpf" placeholder="Ex. 000.000.000-00" required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="rg">
                            <span>RG <strong>*</strong></span>
                            <input type="tel" name="rg" id="rg" placeholder="Ex. 00.000.000-0" required />
                        </label>
                        <label for="doc-rg">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar RG"></figure>
                            <span>
                                Anexar Documento <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_rg" id="doc-rg" accept=".png, .jpeg, .jpg, .pdf" hidden />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="orgao-emissor">
                            <span>Órgão Emissor do RG <strong>*</strong></span>
                            <input type="text" name="orgao_emissor" id="orgao-emissor" placeholder="Ex. SSP"
                                required maxlength="3" />
                        </label>
                        <label for="data-emissao">
                            <span>Data de Expedição do RG <strong>*</strong></span>
                            <input type="tel" name="data_emissao" id="data-emissao" placeholder="DD/MM/AAAA"
                                required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="titulo-eleitor">
                            <span>Título de Eleitor <strong>*</strong></span>
                            <input type="tel" name="titulo_eleitor" id="titulo-eleitor"
                                placeholder="Ex. 0000 0000 0000" required />
                        </label>
                        <label for="doc-titulo-eleitor">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Título de Eleitor"></figure>
                            <span>
                                Anexar Título de Eleitor <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_titulo_eleitor" id="doc-titulo-eleitor"
                                accept=".png, .jpeg, .jpg, .pdf" hidden />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="nome-completo-mae">
                            <span>Nome Completo da Mãe <strong>*</strong></span>
                            <input type="text" name="nome_completo_mae" id="nome-completo-mae"
                                placeholder="Ex. Maria Margarida da Silva" required />
                        </label>
                        <label for="estado-civil">
                            <span>Estado Civil <strong>*</strong></span>
                            <input type="text" name="estado_civil" id="estado-civil"
                                placeholder="Ex. Solteiro, Casado etc." required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="doc-nascimento">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento <strong>*</strong>
                                <i>Certidão de Casamento ou Certidão de Nascimento. O Documento precisa estar no
                                    formato PNG, JPEG ou PDF. Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_nascimento" id="doc-nascimento"
                                accept=".png, .jpeg, .jpg, .pdf" hidden />
                        </label>
                        <label for="data-nascimento">
                            <span>Data de Nascimento <strong>*</strong></span>
                            <input type="tel" name="data_nascimento" id="data-nascimento" placeholder="DD/MM/AAAA"
                                required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="profissao">
                            <span>Profissão <strong>*</strong></span>
                            <input type="text" name="profissao" id="profissao"
                                placeholder="Ex. Professor, Médico etc." required />
                        </label>
                        <label for="cargo">
                            <span>Cargo <strong>*</strong></span>
                            <input type="text" name="cargo" id="cargo" placeholder="Ex. Gerente etc." required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="nome-empresa">
                            <span>Nome da Empresa em que Trabalha</span>
                            <input type="text" name="nome_empresa" id="nome-empresa"
                                placeholder="Ex. Professor, Médico etc." />
                        </label>
                        <label for="cnpj-empresa">
                            <span>CNPJ da Empresa</span>
                            <input type="tel" name="cnpj_empresa" id="cnpj-empresa"
                                placeholder="Ex. 99.999.999/9999-99" />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="data-admissao">
                            <span>Data de Admissão <strong>*</strong></span>
                            <input type="tel" name="data_admissao" id="data-admissao" placeholder="DD/MM/AAAA"
                                required />
                        </label>
                        <label for="pis">
                            <span>PIS nº <strong>*</strong></span>
                            <input type="tel" name="pis" id="pis" placeholder="Ex. 999.99999.99-9" required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="renda-bruta">
                            <span>Renda Bruta <strong>*</strong></span>
                            <input type="text" name="renda_bruta" id="renda-bruta" placeholder="Ex. R$5.000,00"
                                required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <span>Comprovação de Renda será através de Holerite ou Impostos de Renda?
                            <strong>*</strong></span>

                        <label for="comprovacao-renda-holerite">
                            <div class="formulario__radio">
                                <input type="radio" id="comprovacao-renda-holerite" name="comprovacao_renda"
                                    value="Holerite" checked hidden required>
                                <span>Holerite</span>
                            </div>
                        </label>
                        <label for="comprovacao-renda-ir">
                            <div class="formulario__radio">
                                <input type="radio" id="comprovacao-renda-ir" name="comprovacao_renda" value="ir"
                                    hidden required>
                                <span>Declaração de IR</span>
                            </div>
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="doc-comprovacao-renda">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Documento"></figure>
                            <span>
                                Anexar Documento <strong>*</strong>
                                <i>3 Últimos holerites ou IR e Recibo. O Documento precisa estar no formato PNG,
                                    JPEG ou PDF. Atente-se das imagens estarem legíveis.</i>
                            </span>
                            <input type="file" name="doc_comprovacao_renda" id="doc-comprovacao-renda"
                                accept=".png, .jpeg, .jpg, .pdf" hidden />
                        </label>
                        <label for="endereco">
                            <span>Endereço Residencial <strong>*</strong></span>
                            <input type="text" name="endereco" id="endereco"
                                placeholder="Ex. Av Itaberaba 1247, SP, São Paulo" required />
                        </label>
                    </div>
                    <div class="formulario__fieldset">
                        <label for="comprovante-endereco-residencial">
                            <figure><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/img/anexo.svg" alt="Anexar Comprovante de Endereço"></figure>
                            <span>
                                Anexar Comprovante de Endereço <strong>*</strong>
                                <i>O Documento precisa estar no formato PNG, JPEG ou PDF. Atente-se das imagens
                                    estarem legíveis.</i>
                            </span>
                            <input type="file" name="comprovante_endereco_residencial"
                                id="comprovante-endereco-residencial" accept=".png, .jpeg, .jpg, .pdf" hidden />
                        </label>
                    </div>

                    <div class="formulario__fieldset">
                        <label for="numero-celular">
                            <span>Número do Celular <strong>*</strong></span>
                            <input type="tel" name="numero_celular" id="numero-celular"
                                placeholder="Ex. (DDD) 9-9999 9999" required />
                        </label>
                        <label for="email">
                            <span>E-mail <strong>*</strong></span>
                            <input type="email" name="email" id="email" placeholder="Ex. mariasilva@email.com "
                                required />
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
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                    <path fill="currentColor" fill-rule="evenodd" d="M21 12a9 9 0 1 1-18 0a9 9 0 0 1 18 0M6.586 16l.707-.707L10.586 12L7.293 8.707L6.586 8L8 6.586l.707.707L12 10.586l3.293-3.293l.707-.707L17.414 8l-.707.707L13.414 12l3.293 3.293l.707.707L16 17.414l-.707-.707L12 13.414l-3.293 3.293l-.707.707z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>
    </section>
</main>
<?php
get_footer();
