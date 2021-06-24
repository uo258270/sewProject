class GestorHistorial {


    constructor(){
        $('#inicio').click(this.indice.bind(this));
        $('#atras').click(this.atras.bind(this));
    }
    

    indice(){
        history.go(-2);
    }

    atras(){
        history.go(-1);
    }
}

$(function () {
    var gestor = new GestorHistorial();
})