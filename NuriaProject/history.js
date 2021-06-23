class GestorHistorial {


    constructor(){
        $('#inicio').click(this.indice.bind(this));
        $('#restaurantes').click(this.atras.bind(this));
    }
    atras(){
        history.go(-1);
    }

    indice(){
        history.go(-2);
    }

   
}

$(function () {
    var gestor = new GestorHistorial();
})