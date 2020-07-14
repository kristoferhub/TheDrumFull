class TabelaProdutos {
    constructor(controller, seletor){
        this.produtoController = controller;
        this.seletor = seletor;
    }


    montarTabela(produtos){
        var str=`
        <section id = "tabela2">
        <h2>Tabela de Produtos</h2>
        <a class="enviar2" id="novo" href="#">Novo Produto</a>
        <br></br>
        <div id="tabela">
        <table>
            <tr>
                <th>Id</th>
                <th>Loja</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th colspan="2">Ação</th>
            </tr>`;
    
        for(var i in produtos){
            str+=`<tr id=${produtos[i].id}>
                    <td>${produtos[i].id}</td>
                    <td>${produtos[i].loja_id}</td>
                    <td>${produtos[i].nome}</td>
                    <td>${produtos[i].preco}</td>
                    <td>${produtos[i].quantidade}</td>
                    <td><a class="edit" href="#">Editar</a></td>
                    <td><a class="delete" href="#">Deletar</a></td>    
                </tr>`;
                
        } 
        str+= `
        </table>
        </div>
        </section>`;
    
        var tabela = document.querySelector(this.seletor);
        tabela.innerHTML = str;

        const self = this;
        const linkNovo = document.querySelector("#novo");
        linkNovo.onclick = function(event) {
            self.produtoController.carregarFormulario(event);
        }

        const linksDelete = document.querySelectorAll(".delete");
        for(let linkDelete of linksDelete)
        {
            const id = linkDelete.parentNode.parentNode.id;
            linkDelete.onclick = function(event){
                self.produtoController.deletarProduto(id);
            }
        }

        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.produtoController.carregaFormularioComProduto.bind(this.produtoController,id));
        }

    }

}