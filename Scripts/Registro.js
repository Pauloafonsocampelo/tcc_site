$(document).ready(() => {

    // Aplicar máscara nos campos de CPF e Telefone
    $('.input-cpf').mask('000.000.000-00');
    $('.input-telefone').mask('(00) 00000-0000');

    let btnRegistrar = $(".btn-cadastro");

    const registrarUsuario = () => {
        const cpfUsuarioValor = $(".input-cpf").val();
        const nomeUsuarioValor = $(".input-nome").val();
        const emailUsuarioValor = $(".input-email").val();
        const telefoneUsuarioValor = $(".input-telefone").val();
        const senhaUsuarioValor = $(".input-senha").val();
        const senhaUsuarioConfirmarValor = $(".input-senha_confirmar").val();

        // Verificar se todos os campos estão preenchidos
        if (!cpfUsuarioValor || !nomeUsuarioValor || !emailUsuarioValor || !telefoneUsuarioValor || !senhaUsuarioValor || !senhaUsuarioConfirmarValor) {
            exibirMensagem(0); // Mensagem de campos vazios
            return;
        }

        // Verificar se as senhas coincidem
        if (senhaUsuarioValor !== senhaUsuarioConfirmarValor) {
            exibirMensagem(1); // Mensagem de senhas não coincidem
            return;
        }

        const objetoUsuarioCadastrar = {
            Nome: nomeUsuarioValor,
            Cpf: cpfUsuarioValor,
            Email: emailUsuarioValor,
            Telefone: telefoneUsuarioValor,
            Senha: senhaUsuarioValor
        }

        console.log("Objeto:", objetoUsuarioCadastrar);

        $.ajax({
            url: "/tcc_site/api/registrar-usuario",
            type: "POST",
            contentType: 'application/json',
            data: JSON.stringify(objetoUsuarioCadastrar),
            success: function(resposta) {
                console.log(resposta);
                if (resposta.success) {
                    exibirMensagem(2); // Mensagem de sucesso
                } else {
                    // Exibe a mensagem de erro com o motivo
                    $("#error-message").text(resposta.message).removeClass("d-none");
                }

                // Limpar os campos após o sucesso
                $(".input-cpf").val("");
                $(".input-nome").val("");
                $(".input-email").val("");
                $(".input-telefone").val("");
                $(".input-senha").val("");
                $(".input-senha_confirmar").val("");
            },
            error: function() {
                // Adicione um tratamento de erro se necessário
            }
        });
    }

    const exibirMensagem = (tipo) => {
        switch(tipo) {
            case 0:
                $("#error-message").removeClass("d-none"); // Mensagem de campos vazios
                $("#password-error-message").addClass("d-none");
                $("#success-message").addClass("d-none");
                break;
            case 1:
                $("#password-error-message").removeClass("d-none"); // Mensagem de senhas não coincidem
                $("#error-message").addClass("d-none");
                $("#success-message").addClass("d-none");
                break;
            case 2:
                $("#success-message").removeClass("d-none"); // Mensagem de sucesso
                $("#error-message").addClass("d-none");
                $("#password-error-message").addClass("d-none");
                break;
        }
    }

    btnRegistrar.on("click", () => {
        registrarUsuario();
    });
});
