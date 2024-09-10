





<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400&display=swap" rel="stylesheet">

<div class="recarga-container" id="recarga-container">
    <div class="recarga-header">
        <h2 class="Vale">Vale Transporte</h2>
    </div>
    <div class="recarga-content">
        <div class="recarga-instructions">
            <h3>Realize sua <span class="recarga-highlight">RECARGA</span> agora mesmo! <i class="fas fa-thumbs-up"></i> </h3>
            <p><span class="passagem-highlight">Passagem: R$ 7,25</span></p>
        </div>
        <div class="recarga-form">
            <label class="texto" for="numero-passagens">Digite o número de passagens:</label>
            <div class="input-group-passagem">
                <input type="number" id="numero-passagens" class="numero-passagens" value="0" min="0">
            </div>
            <p class="total"><span class="texto-total">Total:</span> <span id="total">R$ 0,00</span></p>

            <label class="pagamento" for="metodo-pagamento">Selecione o método de pagamento:</label>
            <div class="custom-select-container">
                <button id="select-button" class="select-btn">Método de pagamento <i class="fas fa-angle-down"></i></button>
                <div id="select-dropdown" class="select-dropdown">
                    <div class="select-option" data-value="pix">
                        <i class="fas fa-coins"></i> Pix
                        <span class="aprovacao-pix">Aprovação imediata</span>
                    </div>
                    <div class="select-option" data-value="Débito">
                        <i class="fas fa-credit-card"></i> Cartão de Débito
                        <span class="aprovacao-debito">Aprovação imediata</span>
                    </div>
                    <div class="select-option" data-value="Crédito">
                        <i class="fas fa-credit-card"></i> Cartão de Crédito
                        <span class="aprovacao-credito">Aprovação imediata</span>
                    </div>
                    <div class="select-option" data-value="boleto">
                        <i class="fas fa-barcode"></i> Boleto
                        <span class="aprovacao-boleto">2 a 3 dias úteis</span>
                    </div>
                </div>

                <!-- Botão "Adicionar Cartão" -->
                <button id="addCardBtn" class="btn btn-primary" style="display: none;
                        position: fixed;
                        margin-left: 227px;
                        width: 163px;
                        margin-top: 60px;
                        z-index: 10;">Adicionar Cartão</button>

                <!-- Dropdown para cartões registrados -->
                <select id="registeredCardsDropdown" class="form-control" style="display: none; margin-top: 10px;">
                    <!-- Cartões serão carregados aqui -->
                </select>

                <button class="btn-pagamento" type="submit">
                    Finalizar pagamento <i class="fas fa-check"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Overlay para registro de cartão -->

<div class="overlay" id="cardOverlay" style="display: none;">
    <div class="overlay-content">
        <h3 class="registro-cartao">Registrar Cartão</h3>
        <form id="cardForm">
            <div class="form-group">
                <label for="cardNumber" class="numero">Número do Cartão</label>
                <input type="text" class="form-control" id="cardNumber" placeholder="Digite o número do cartão">
                <div class="invalid-feedback" id="cardNumberError">Número do cartão inválido</div>
            </div>
            <div class="form-group">
                <label for="cardHolderName" class="nome">Nome do Titular</label>
                <input type="text" class="form-control" id="cardHolderName" placeholder="Digite o nome do titular do cartão">
                <div class="invalid-feedback" id="cardHolderNameError">Nome do titular é obrigatório</div>
            </div>
            <div class="form-group">
                <label for="expiryDate" class="data">Data de Validade</label>
                <input type="text" class="form-control" id="expiryDate" placeholder="MM/AA">
                <div class="invalid-feedback" id="expiryDateError">Data de validade inválida</div>
            </div>
            <div class="form-group">
                <label for="cvv" class="cvv">CVV</label>
                <input type="text" class="form-control" id="cvv" placeholder="Digite o CVV">
                <i class="fas fa-question-circle" id="cvvInfoIcon" style="margin-left: 8px; cursor: pointer;" data-bs-toggle="tooltip" data-toggle="modal" data-target="#cvvModal" title="Localização do CVV"></i>
                <div class="invalid-feedback" id="cvvError">CVV inválido</div>
            </div>
            <div class="button-container">
            <button type="button" class="btn btn-fechar" id="closeOverlayBtn">Fechar</button>
            <button type="submit" class="btn btn-salvar">Salvar Cartão</button>
        </div>
        </form>
    </div>
</div>

<!-- Modal para mostrar a localização do CVV -->
<div class="modal fade" id="cvvModal" tabindex="-1" aria-labelledby="cvvModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <img src="src/Assets/cvv-cartao-credito-removebg.png" alt="Localização do CVV" class="img-fluid">
                    <p class="description">O CVV é um número de 3 ou 4 dígitos localizado na parte de trás do seu cartão de crédito ou débito.</p>
                </div>
            </div>
        </div>
    </div> 
    <script>
        // Inicializar tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>