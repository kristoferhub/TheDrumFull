class FormProdutos {

    constructor(controller, seletor){
        this.produtoController = controller;
        this.seletor = seletor;
    }

    montarForm(lojas,produto){
        if(!produto){
            produto = new Produto();
        }
        var str = `
        <section id="formulario">
            <h2 class="h2">Produtos</h2>
            <p>Cadastre os Produtos!</p>
            <hr>
            <!-- Parte do formular/onde vai ser enviado/maneira segura(post) -->
            <form>
                <!-- input para as partes do formulário -->
                <input type="hidden" id="idProduto" value="${produto.id}" />
                <label for="txtnome">Id da loja:</label>
                <input type="text" name="nome" class="input" placeholder="loja_id" id="txtidLoja" value="${produto.loja_id ?produto.loja_id :''}"  required>
                <br />
                <label for="txtnome">Nome:</label>
                <input type="text" class="input" id="txtnome" placeholder="nome" value="${produto.nome ?produto.nome :''}" required>
                <br />
                <label for="txtpreco">Preço:</label>
                <input type="text"  class="input" placeholder="preco" id="txtpreco" value="${produto.preco ?produto.preco :''}" required>
                <label for="txtpreco">Quantidade:</label>
                <input type="text"  class="input" placeholder="quantidade" id="txtquantidade" value="${produto.quantidade ?produto.quantidade :''}"  required>
                <!-- Botão de enviar-->
                <input type="submit" class="enviar" id="btnsalvar" value="Salvar">
                <input type="reset" class="enviar" value="Cancelar"> 
            </form>
        </section>
        `;

        // for(const loja of lojas){
        //     str+=`<option id="${loja.id}">${loja.nome}</option>`;
        // }

        // str+= `
        //     </select>
        //     <br />
        //     <br />
        //     <input type="submit" id="btnsalvar" value="Salvar">
        //     <input type="reset" value="Cancelar">
        //     <br />
        // </form>
        // `;

        let containerForm = document.querySelector(this.seletor);
        containerForm.innerHTML = str;

        if(produto.loja && produto.loja_id){
            document.getElementById(produto.loja_id.toString()).selected = true;    
        }

        var form = document.querySelector("#formulario");
        const self = this;
        form.onsubmit = function(event){
            if(!produto.id){
                self.produtoController.salvar(event);
            }
            else{
                self.produtoController.editar(produto.id,event);
            }
        }

        form.onreset = function(event){
            self.produtoController.limpar(event);
        }
    }

    limparFormulario(){
        document.querySelector("#txtidLoja").value="";
        document.querySelector("#txtnome").value="";
        document.querySelector("#txtpreco").value="";
        document.querySelector("#txtquantidade").value="";
    }

    getDataProduto(){
        let produto = new Produto();
        if(!document.querySelector("#idProduto").value)
            produto.id = document.querySelector("#idProduto").value;
        produto.loja_id = document.querySelector("#txtidLoja").value;  
        produto.nome = document.querySelector("#txtnome").value;
        produto.preco = document.querySelector("#txtpreco").value;
        produto.quantidade = document.querySelector("#txtquantidade").value;
        
        const sel = document.querySelector("#txtidLoja");
        const opt = sel.options[sel.selectedIndex];
        produto.loja = new Loja(opt.value);
        produto.loja_id = opt.id;
        return produto;     
    }

}