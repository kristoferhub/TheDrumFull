class LoginVisual {

    constructor(controller, seletor){
        this.loginController = controller;
        this.seletor = seletor;
    }

    montarLogin(){
        var str = `
        <!-- Section para formulário de LOGIN -->
            <section id="login">
                <div class="fundo">
                <div>
                    <h2>LOGIN</h2>
                    <p>Logar!</p>
                    <hr>
                    <!-- Parte do formular/onde vai ser enviado/maneira segura(post) -->
                    <form action=".php" method="post">
                        <!-- input para as partes do formulário -->
                        <input type="text" name="user" class="input" placeholder="Usuário" required>
                        <input type="password" id="pass" class="input" name="password" placeholder="Senha" minlength="8" required>
                        <input type="email" name="email" class="input" placeholder="Email de contato" required>
                        <input type="date" name="data" class="input" required>
                        <!-- Botão de enviar-->
                        <input type="submit" name="acao" class="enviar" value="Enviar"> 
                    </form>
                </div>
                </div>  
            </section>
            `;
            var login = document.querySelector(this.seletor);
            login.innerHTML = str;
    
            const self = this;
            const linkNovo = document.querySelector("#novo");
            linkNovo.onclick = function(event) {
                self.lojaController.carregarLogin(event);
            }
        }
    }