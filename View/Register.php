<?php
    Sessao::excluir("Autenticado");
    Sessao::excluir("User_id");

    // fazer isso pro cara não conseguir entrar só colocando a url.
?>

<div class="wrapper">
    <div class="container">
        <div class="login">
            <div class="top">
                <h1>Bem-vindo de volta!</h1>
                <p>Acesse sua conta agora mesmo.</p>
            </div>
            <div class="bottom">
                <button>
                    <a href="<?="login"?>">Fazer login</a>
                </button>
            </div>
        </div>
        <div class="register">
            <h1>Criar conta</h1>
            <p>Preencha seus dados</p>
    
            <div class="alert alert-danger d-none" id="error-message" role="alert" 
            style="
            color: #ff0000; 
            font-weight: bold; 
            position: relative;
            margin-bottom: 1rem;
            background-color: transparent; 
            border: none">
                Por favor, preencha todos os campos!
            </div>
            <div class="alert alert-danger d-none" id="password-error-message" role="alert" 
            style="
            color: #ff0000; 
            font-weight: bold; 
            position: relative;
            margin-bottom: 1rem;
            background-color: transparent; 
            border: none">
                As senhas não coincidem.
            </div>
            <div class="alert alert-success d-none" id="success-message" role="alert" style="
            color: #0a00ff; 
            font-weight: bold; 
            position: relative;
            margin-bottom: 1rem;
            background-color: transparent; 
            border: none">
                Cadastro realizado com sucesso!
            </div>

            <!-- Mensagem de erro para dados duplicados -->
            <div class="alert alert-danger d-none" id="duplicate-error-message" role="alert" 
            style="
            color: #ff0000; 
            font-weight: bold; 
            position: relative;
            margin-bottom: 1rem;
            background-color: transparent; 
            border: none">
                CPF, email ou telefone já cadastrado!
            </div>
            <div class="inputs">
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-id-card"> </i></span>
                    </div>
                    <input type="text" class="form-control input-cpf" placeholder="CPF" aria-label="Small" aria-describedby="inputGroup-sizing-sm"> 
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" class="form-control input-nome" placeholder="Nome" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm"> <i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" class="form-control input-email" placeholder="Email" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-phone"></i></span>
                    </div>
                    <input type="text" class="form-control input-telefone" placeholder="Telefone" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                </div>
                <div class="senhas-bottom">
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-lock"></i></i></span>
                        </div>
                        <input type="password" class="form-control input-senha" placeholder="Senha" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                    <div class="input-group input-group-sm mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroup-sizing-sm"><i class="fas fa-lock"></i></i></span>
                        </div>
                        <input type="password" class="form-control input-senha_confirmar" placeholder="Repetir senha" aria-label="Small" aria-describedby="inputGroup-sizing-sm">
                    </div>
                </div>
            </div>
            <button class="btn-cadastro">Cadastrar</button>
        </div>
    </div>
</div>