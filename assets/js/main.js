$(document).ready(function() {
    form()
    masks()
    maisMoradores()
    fileInputs()
    salvarInformacoes()
})

function form() {
    $('.formulario').css('opacity', '1')

    $('.formulario__btn').on('click', function() {
        if ($(this).closest('.formulario__content ').hasClass('formulario__content--active')) {
            $(this).closest('.formulario__content ').removeClass('formulario__content--active')

            if($(this).hasClass('formulario__btn--juridica')) {
                $(this).closest('.formulario__container').find('[data-categ="juridico"]').addClass('formulario__content--active')
                return
            }

            if($(this).hasClass('formulario__btn--fisica')) {
                $(this).closest('.formulario__container').find('[data-categ="fisica"]').addClass('formulario__content--active')
                return
            }

            if($(this).hasClass('formulario__btn--fiacao')) {
                $(this).closest('.formulario__container').find('[data-categ="fiacao"]').addClass('formulario__content--active')
                return
            }
            
            $(this).closest('.formulario__container').find('.formulario__content--form').addClass('formulario__content--active')
        }
    })

    envioForm()
}

function masks() {
    $('input[placeholder="Ex. 000.000.000-00"]').mask('000.000.000-00')
    $('input[placeholder="Ex. 00.000.000-0"]').mask('00.000.000-0')
    $('input[placeholder="DD/MM/AAAA"]').mask('00/00/0000')
    $('input[placeholder="Ex. 0000 0000 0000"]').mask('0000 0000 0000')
    $('input[placeholder="Ex. 999.99999.99-9"]').mask('000.00000.00-0')
    $('input[placeholder="Ex. 99.999.999/9999-99"]').mask('00.000.000/0000-00')
    $('input[placeholder="Ex. (DDD) 9-9999 9999"]').mask('(00) 0-0000 0000')
    $('input[placeholder="Ex. R$5.000,00"], input[placeholder="Ex. R$1000,00"]').mask('R$ 0.000,00')
}

function fileInputs() {
    $('input[type=file]').on('change', function() {
        if($(this).val() === '') {
            $(this).removeClass('valid')
            console.log($(this));
            console.log($(this).val());
            
            return
        }

        if($(this).val() !== '') {
            $(this).addClass('valid')
            return
        }
    })
}

function maisMoradores() {
    $('.formulario__moradores').on('input', function() {
        let inputs = $(this).find('input:not([type="file"])')
        let allFilled = true

        inputs.each(function() {
            if (!$(this).val()) {
                allFilled = false
                return false
            }
        })

        if (allFilled) {
            $('.formulario__mais-moradores').removeAttr('disabled')
        } else {
            $('.formulario__mais-moradores').attr('disabled', 'disabled')
        }
    })

    $('.formulario__mais-moradores').on('click', function() {
        let novoMorador = ($(this).parent().find('.formulario__fieldset').length / 2) + 1

        $(this).before(`
            <div class="formulario__fieldset">
                <span>Morador ${novoMorador} <strong>*</strong></span>
                <label for="morador-rg${novoMorador}">
                    <span>RG/CNH <strong>*</strong></span>
                    <input type="text" id="morador-rg${novoMorador}" name="morador-rg${novoMorador}" placeholder="Ex. 00.000.000-0" required>
                </label>

                <label for="morador-cpf${novoMorador}">
                    <span>CPF <strong>*</strong></span>
                    <input type="text" id="morador-cpf${novoMorador}" name="morador-cpf${novoMorador}" placeholder="Ex. 000.000.000-00" required>
                </label>
            </div>

            <div class="formulario__fieldset">
                <label for="doc-morador-${novoMorador}">
                    <figure><img src="./assets/img/anexo.svg" alt="Anexar Documento"></figure>
                    <span>
                        Anexar Documento Caso Necessário
                        <i>O Documento precisa estar no formato PNG, JPEG ou PDF. 
                            Atente-se das imagens estarem legíveis.</i>
                    </span>
                    <input type="file" name="doc-morador-${novoMorador}" id="doc-morador-${novoMorador}"
                        accept=".png, .jpeg, .jpg, .pdf" hidden />
                </label>
            </div>
        `)
    })
}

function salvarInformacoes() {
    $('.formulario form').each(function() {
        $(this).find('input').each(function() {
            var inputName = $(this).attr('name')
            var savedValue = localStorage.getItem(inputName)
            if (savedValue) {
                $(this).val(savedValue)
            }
        })
    })

    $('.formulario form').on('input', function() {
        $(this).find('input:not([type="file"])').each(function() {
            var inputName = $(this).attr('name')
            var inputValue = $(this).val()
            localStorage.setItem(inputName, inputValue)
        })
    })
}

function envioForm() {
    $('.formulario__submit').on('click', function(e) {
        e.preventDefault()
        erroForm()

        var formData = new FormData(this)
        
        $.ajax({
            url: myAjax.ajaxurl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                $('.formulario__modal').addClass('formulario__modal--active formulario__modal--success')
            },
            error: function(xhr, status, error) {
                $('.formulario__modal').addClass('formulario__modal--active formulario__modal--error')
                $('.formulario__modal-error').append('<span>Ops! Parece que algo deu errado</span><p>Ocorreu um erro ao enviar o formulário.</p>')
                console.error(error);
            }
        });
    })

    $('.formulario__modal button').on('click', function() {
        $(this).closest('.formulario__modal').removeClass('formulario__modal--active formulario__modal--error')
        $(this).parent().find('span, p').remove()
    })
}

function erroForm() {
    let invalidFileInputs = $(this).parent().find('input[type="file"][required]:not(.valid)')
    if (invalidFileInputs.length > 0) {
        $('.formulario__modal').addClass('formulario__modal--active formulario__modal--error')
        $('.formulario__modal-error').append('<span>Ops! Parece que algo deu errado</span><p>Um ou mais documentos não foram anexados!</p>')

        return
    }

    let invalidInputs = $(this).parent().find('input:not(:valid), textarea:not(:valid)')
    if (invalidInputs.length > 0) {
        invalidInputs.each(function() {
            $(this).attr('style', 'border-color: red !important')

            if($(this).is('[type=checkbox]')) {
                $(this).parent().attr('style', 'border: .1rem solid red !important')
            }
        })

        $('.formulario__modal').addClass('formulario__modal--active formulario__modal--error')
        $('.formulario__modal-error').append('<span>Ops! Parece que algo deu errado</span><p>Um ou mais campos não foram preenchidos!</p>')

        return
    }
}