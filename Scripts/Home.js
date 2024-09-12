$(document).ready(() => {
    // Gerenciamento de seleção na sidebar
    let sidebar = $(".sidebar");

    sidebar.find(".opcao").on("click", function () {
        sidebar.find(".opcao").removeClass("ativo");
        $(this).addClass("ativo");
    });

    // Carregar "Meu Cartão" por padrão
    $('#content-area').load('View/My_card.php');

    // Carregar o conteúdo das outras seções quando os links são clicados
    $('#meu-cartao-link').click(function () {
        $('#content-area').load('View/My_card.php');
        return false; // Evita o redirecionamento da página
    });

    $('#recarga-link').click(function () {
        $('#content-area').load('View/Recharge.php', function(response, status, xhr) {
            if (status == "error") {
                console.log("Erro: " + xhr.status + " " + xhr.statusText);
            } else {
                // Após o carregamento da página de recarga, inicializar as funcionalidades de incremento/decremento
                initializeRechargeFunctionality();
            }
        });
        return false; // Evita o redirecionamento da página
    });

    function initializeRechargeFunctionality() {
        let passagensInput = $('#numero-passagens');
        let totalLabel = $('#total');
        let passagemValor = 7.25;

        passagensInput.on('input', function () {
            let numeroPassagens = parseInt($(this).val()) || 0; // Garantir que sempre seja um número
            let total = numeroPassagens * passagemValor;
            totalLabel.text('R$ ' + total.toFixed(2).replace('.', ','));
        });

        let selectButton = $('#select-button');
        let selectDropdown = $('#select-dropdown');
        let options = $('.select-option'); // Define options by selecting elements with the class 'select-option'

        options.each(function() {
            $(this).on('click', function() {
                // Extrair o ícone e o texto do método de pagamento
                let iconHtml = $(this).find('i').prop('outerHTML');
                let methodText = $(this).contents().filter(function() {
                    return this.nodeType === 3; // Texto
                }).text().trim();
                
                // Atualiza o texto do botão com ícone e método de pagamento
                selectButton.html(iconHtml + ' ' + methodText + ' <i class="fas fa-angle-down"></i>');
                selectDropdown.removeClass('show');

                if ($(this).data('value') === 'credito' || $(this).data('value') === 'debito') {
                    $('#content-area');
                }
            });
        });

        selectButton.on('click', function () {
            selectDropdown.toggleClass('show');
        });

        $(document).on('click', function(event) {
            if (!selectButton.is(event.target) && selectButton.has(event.target).length === 0 && 
                !selectDropdown.is(event.target) && selectDropdown.has(event.target).length === 0) {
                selectDropdown.removeClass('show');
            }
        });

        // Máscaras para os campos
        $('#cardNumber').mask('0000 0000 0000 0000');
        $('#expiryDate').mask('00/00');
        $('#cvv').mask('000');

        // Mostrar ou esconder o botão "Adicionar Cartão" baseado no método de pagamento selecionado
        $('.select-option').click(function() {
            var selectedMethod = $(this).data('value');
            $('#select-button').html($(this).find('i').prop('outerHTML') + ' ' + $(this).contents().filter(function() {
                return this.nodeType === 3; // Texto
            }).text().trim() + ' <i class="fas fa-angle-down"></i>');
            $('#select-dropdown').removeClass('show');

            if (selectedMethod === 'Crédito' || selectedMethod === 'Débito') {
                $('#addCardBtn').show();
            } else {
                $('#addCardBtn').hide();
            }
        });

        // Abrir overlay de registro de cartão
        $('#addCardBtn').click(function() {
            $('#cardOverlay').fadeIn();
            $("#cardOverlay").css("display", "flex");
        });

        // Fechar overlay
        $('#closeOverlayBtn').click(function() {
            $('#cardOverlay').fadeOut();
        });

        // Validação do formulário de cartão
        $('#cardForm').submit(function(event) {
            event.preventDefault();
            var isValid = true;
        
            // Validação do número do cartão
            var cardNumber = $('#cardNumber').val().replace(/\s+/g, '');
            if (cardNumber.length !== 16 || isNaN(cardNumber)) {
                $('#cardNumberError').show();
                isValid = false;
            } else {
                $('#cardNumberError').hide();
            }
        
            // Validação do nome do titular
            var cardHolderName = $('#cardHolderName').val().trim();
            if (cardHolderName === '') {
                $('#cardHolderNameError').show();
                isValid = false;
            } else {
                $('#cardHolderNameError').hide();
            }
        
            // Validação da data de validade
            var expiryDate = $('#expiryDate').val().trim();
            var expiryRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
            if (!expiryRegex.test(expiryDate)) {
                $('#expiryDateError').show();
                isValid = false;
            } else {
                $('#expiryDateError').hide();
            }
        
            // Validação do CVV
            var cvv = $('#cvv').val().trim();
            if (cvv.length !== 3 || isNaN(cvv)) {
                $('#cvvError').show();
                isValid = false;
            } else {
                $('#cvvError').hide();
            }
        
            // Se todos os campos forem válidos, submeter o formulário
            if (isValid) {
                const formData = new FormData(this);

                fetch('Controllers/CardController.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        // Se a resposta não for OK, trate o erro
                        return response.text().then(text => {
                            throw new Error(text || 'Erro desconhecido');
                        });
                    }
                    return response.text(); // Retorna como texto
                })
                .then(text => {
                    console.log('Texto recebido:', text); // Mostre o texto recebido para depuração
                
                    // Aqui você pode fazer uma simples verificação da resposta
                    if (text.includes("Cartão cadastrado com sucesso")) {
                        $('body').append(`
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                ${text}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                    } else {
                        $('body').append(`
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                ${text}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `);
                    }

                    // Inicializar tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
                
                    // Fechar o overlay de cadastro de cartão
                    $('#cardOverlay').fadeOut();
                })
                .catch(error => {
                    console.error('Erro ao enviar dados:', error);
                });                               
                
            }
        });
    }
});
