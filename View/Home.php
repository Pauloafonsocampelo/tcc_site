<?php
if (!Sessao::obter("Autenticado")) {
    header("Location: http://localhost/tcc_site/login");
    exit();
}
$id = Sessao::obter("User_id");
if (!$id) {
    header("Location: http://localhost/tcc_site/login");
    exit();
}

// cRIA UM CONTROLLER e model pra cartao e segue o mesmo padrao que ta o user:

// CardController
// CardModel
// Para recuperar o id do usuario é so fazer isso que retorna o id: $id = Sessao::obter("User_id"), $id vai ta com o id da sessao 

$usuarioController = new UsuarioController();
$dadosUsuario = $usuarioController->getUser($id);

if (!$dadosUsuario?->Dados) {
    header("Location: http://localhost/tcc_site/login");
    exit();
}
?>

<div class="home-page">
    <header class="top-home">
        <div class="left d-flex align-items-center">
            <div class="icon mr-4" style="filter: invert(1);">
                <img src="src/Assets/user.svg" alt="">
            </div>
            <h1 class="mb-0"><?= $dadosUsuario->Dados["Nome"] ?></h1>
        </div>
        <div class="right">

        </div>
    </header>

<div id="content-area">
    <!-- O conteúdo carregado dinamicamente aparecerá aqui -->
</div>

    <div class="sidebar">

        <!-- Barra de Pesquisa -->
        <div class="search-bar">
            <input type="text" placeholder="Pesquisar..." />
            <i class="fa fa-search"></i>
        </div>

        <nav>
            <div class="opcao" style="padding-right: 90px;">
            <a href="#" id="meu-cartao-link">Meu Cartão</a>
            </div>
            <div class="divider"></div>
            <div class="opcao" style="padding-right: 117px;">
            <a href="#" id="recarga-link">Recarga</a>
            </div>
            <div class="divider"></div>
            <div class="opcao" style="padding-right: 108px;">
            <a href="#" id="historico-link">Histórico</a>
            </div>
            <div class="divider"></div>
            <div class="opcao" style="padding-right: 116px;">
            <a href="#" id="suporte-link">Suporte</a>
            </div>
            <div class="divider"></div>
            <div class="opcao" style="padding-right: 146px;">
                <a href="http://localhost/TCC_site/">Sair</a>
            </div>
        </nav>
        <div class="logo" style="width: 180.47px; height: 14.48px;">
            <img src="src/Assets/logo_fronteira.svg" alt="">
        </div>
    </div>
</div>