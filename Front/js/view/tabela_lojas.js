class TabelaLojas {
    constructor(controller, seletor){
        this.lojaController = controller;
        this.seletor = seletor;
    }


    montarTabela(lojas){
        var str=`
        <section id = "tabela2">
        <h2>Tabela de Lojas</h2>
        <a class="enviar2" id="novo" href="#">Nova Loja</a>
        <br></br>
        <div id="tabela">
        <table>
            <tr>
                <th>Id</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Endereco</th>
                <th colspan="2">Ação</th>
            </tr>`;
    
        for(var i in lojas){
            str+=`<tr id=${lojas[i].id}>
                    <td>${lojas[i].id}</td>
                    <td>${lojas[i].nome}</td>
                    <td>${lojas[i].telefone}</td>
                    <td>${lojas[i].endereco}</td>
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
            self.lojaController.carregarFormulario(event);
        }

        const linksDelete = document.querySelectorAll(".delete");
        for(let linkDelete of linksDelete)
        {
            const id = linkDelete.parentNode.parentNode.id;
            linkDelete.onclick = function(event){
                self.lojaController.deletarLoja(id);
            }
        }

        const linksEdit = document.querySelectorAll(".edit");
        for(let linkEdit of linksEdit)
        {
            const id = linkEdit.parentNode.parentNode.id;
            //Outra forma de tratar o evento (click) - nesse caso deve ter bind
            linkEdit.addEventListener("click",this.lojaController.carregaFormularioComLoja.bind(this.lojaController,id));
        }

    }

}