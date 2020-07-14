class LoginController{
    constructor() {
        this.login = new LoginVisual(this,"main");
    }

    inicializa(){
        this.carregarLogin();
    }

    carregarLogin(){
        event.preventDefault();
        this.login.montarLogin();
    }
}