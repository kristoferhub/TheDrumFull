class FormLojas {

    constructor(controller, seletor){
        this.lojaController = controller;
        this.seletor = seletor;
    }

    montarForm(loja){
        if(!loja){
            loja = new Loja();
        }
        var str = `
        <section id="formulario">
            <h2 class="h2">LOJAS</h2>
            <p>Cadastre as Lojas!</p>
            <hr>
            <!-- Parte do formular/onde vai ser enviado/maneira segura(post) -->
            <form action="aleatorio.php" method="post">
                <!-- input para as partes do formulário -->
                <input type="hidden" id="idLoja" value="${loja.id}" />
                <label for="txtnome">Nome:</label>
                <input type="text" class="input" id="txtnome" placeholder="loja01" value="${loja.nome ?loja.nome :''}">
                <label for="txttelefone">Telefone:</label>
                <input type="tel" class="input" id="txttelefone" placeholder="(00)0000-0000" value="${loja.telefone ?loja.telefone :''}">
                <label for="txtendereco">Endereço:</label>
                <input type="text" class="input" id="txtendereco" placeholder="Rua Travessa, 500" value="${loja.endereco ?loja.endereco :''}">
                <!-- Botão de enviar-->
                <input type="submit" class="enviar" id="btnsalvar" value="Salvar">
                <input type="reset" class="enviar" value="Cancelar"> 
            </form>
        </section>
        `;

        let containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str;

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!loja.id){
                self.lojaController.salvar(event);
            }
            else{
                self.lojaController.editar(loja.id,event);
            }
        }

        form.onreset = function(event){
            self.lojaController.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#txtnome").value="";
    }

    getDataLoja(){
        let loja = new Loja();
        if(!document.querySelector("#idLoja").value)
            loja.id = document.querySelector("#idLoja").value;
        loja.nome = document.querySelector("#txtnome").value;
        loja.telefone = document.querySelector("#txttelefone").value;
        loja.endereco = document.querySelector("#txtendereco").value;
        return loja;        
    }

}