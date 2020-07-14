const loginController = new LoginController();
const produtoController =  new ProdutoController();
const lojaController =  new LojaController();

//Para o login
document.querySelector("#login2").onclick = function() {
    loginController.inicializa();
}
//Para as lojas
document.querySelector("#lojas").onclick = function() {
    lojaController.inicializa();
}

//Para os produtos
document.querySelector("#produtos").onclick = function() {
    produtoController.inicializa();
}







