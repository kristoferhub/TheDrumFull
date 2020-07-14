class LojaController{  
    constructor() {
        this.lojaService = new LojaAPIService(); 
        this.tabelaLojas = new TabelaLojas(this,"main");
        this.formLojas = new FormLojas(this,"main");
    } 

    inicializa(){
        this.carregarLojas();
    }

    carregarFormulario(){
        event.preventDefault();
        this.formLojas.montarForm();
    }

    carregarLojas(){
        const self = this;
        //definição da função que trata o buscar lojas com sucesso
        const sucesso = function(lojas){
            self.tabelaLojas.montarTabela(lojas);
        }

        //definição da função que trata o erro ao buscar os lojas
        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }

        this.lojaService.buscarLojas(sucesso, trataErro);
    }

    limpar(event){
        event.preventDefault();
        this.formLojas.limparFormulario();
        this.carregarLojas();
    }
    
    salvar(event){        
        event.preventDefault();
        var loja = this.formLojas.getDataLoja();        
        console.log("Loja", loja);

        this.salvarLoja(loja);

    }

    salvarLoja(loja){
        const self = this;

        const sucesso = function(lojaCriado) {
            console.log("Loja Criada",lojaCriado);
            self.carregarLojas();
            self.formLojas.limparFormulario();
        }

        const trataErro = function(statusCode) {
            console.log("Erro:",statusCode);
        }
                
        this.lojaService.enviarLoja(loja, sucesso, trataErro);    

    }

    deletarLoja(id, event){
        const self = this;
        this.lojaService.deletarLoja(id,
            function() {
                self.carregarLojas();
            },
            function(status) {
                console.log(status);
            }
        );
    }

    carregaFormularioComLoja(id, event){
        event.preventDefault();             
        
        const self = this;
        const ok = function(loja){
            self.formLojas.montarForm(loja);
        }
        const erro = function(status){
            console.log(status);
        }

        this.lojaService.buscarLoja(id,ok,erro);   
    }

    editar(id,event){
        event.preventDefault();

        let loja = this.formLojas.getDataLoja();

        const self = this;

        this.lojaService.atualizarLoja(id,loja,
            function() {
                self.formLojas.limparFormulario();
                self.carregarLojas();
            },
            function(status) {
                console.log(status);
            }
        );
    
    }

        
}