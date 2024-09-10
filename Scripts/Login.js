$(document).ready(() => {
    let loginPage = $(".login-page");

    const btnLogin = loginPage.find(".btn-login");
    const btnMostrarSenha = loginPage.find(".fas.fa-eye");

    btnMostrarSenha.on("click", () => {
        let inputSenha = loginPage.find(".senha");

        if(inputSenha.attr("type") === "password") {
            inputSenha.attr("type", "text");
        } else {
            inputSenha.attr("type", "password");
        }
    });

    btnLogin.off("click").on("click", (e) => { 
        e.preventDefault();
        const emailUsuarioValor = loginPage.find(".email").val();
        const senhaUsuarioValor = loginPage.find(".senha").val();

        const objetoUsuarioLogar = {
            Email: emailUsuarioValor,
            Senha: senhaUsuarioValor
        };

        $.ajax({
            url: "/tcc_site/api/logar-usuario",
            type: "POST",
            data: JSON.stringify(objetoUsuarioLogar),
            success: function (retorno) {
                if (retorno) {
                    window.location.href = "home";
                } else {
                    // Se o login falhar
                    $("#error-message").removeClass("d-none"); // Exibe a mensagem de erro
                }
            },
            error: function (error) {
                console.log(error);
                $("#error-message").removeClass("d-none"); // Exibe a mensagem de erro

            }
        });

        const lembrar = loginPage.find('input[name="lembrar"]').is(':checked');

        if (lembrar) {
            // Salvar email e senha em cookies
            document.cookie = "user_email=" + emailUsuarioValor + "; path=/; max-age=" + (60 * 60 * 24 * 30); // 30 dias
            document.cookie = "user_senha=" + senhaUsuarioValor + "; path=/; max-age=" + (60 * 60 * 24 * 30); // 30 dias
        } else {
            // Apagar cookies se 'Lembrar acesso' não estiver marcado
            document.cookie = "user_email=; path=/; max-age=0";
            document.cookie = "user_senha=; path=/; max-age=0";
        }
    });
});
