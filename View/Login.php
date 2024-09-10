<?php
Sessao::excluir("Autenticado");

// Verifica se os cookies existem e define as variáveis com seus valores
$email_salvo = isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '';
$senha_salva = isset($_COOKIE['user_senha']) ? $_COOKIE['user_senha'] : '';
?>

<div class="wrapper">
    <div class="container02 login-page">
        <div class="login-box">
            <div class="alert alert-danger d-none erro" id="error-message" role="alert" style="
            color: #ff2d2d; 
            font-weight: bold; 
            position: relative;
            margin-bottom: 1rem;
            background-color: transparent; 
            border: none">
                Email ou Senha incorreto!
            </div>
            <div class="avatar">
                <i class="fas fa-user"></i>
            </div>
            <form id="loginForm">
                <div class="input-group">
                    <i class="fas fa-envelope"></i>
                    <input class="email" type="email" name="email" placeholder="Email" required value="<?php echo $email_salvo; ?>">
                </div>
                <div class="input-group">
                    <i class="fas fa-lock"></i>
                    <input class="senha" type="password" name="senha" id="senha" placeholder="Senha" required value="<?php echo $senha_salva; ?>">
                    <i class="fas fa-eye" id="toggleSenha"></i>
                </div>
                <button class="btn-login" style="border-radius: 8px;" type="submit">
                    Entrar
                </button>
                <div class="options">
                    <label>
                        <input type="checkbox" name="lembrar" <?php echo isset($_COOKIE['user_email']) ? 'checked' : ''; ?>>
                        Lembrar acesso
                    </label>
                    <a href="#">Esqueci minha senha</a>
                </div>
                <div class="back-button">
                    <a href="http://localhost/tcc_site/">
                        <i class="fa fa-arrow-left"></i>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
