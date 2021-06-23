class Mapa {
    constructor() {
        this.getCoordinates();
        this.googleMapa = new google.maps.Map(document.getElementById('mapa'), {
            center: {
                lat: 43.361914,
                lng: -5.849397
            },
            zoom: 10
        });
    }

    getCoordinates() {
        navigator.geolocation.getCurrentPosition(this.centrarMapa.bind(this));
    }

    addRestaurante(restaurante) {
        restaurante.crearMarca(this.googleMapa);
    }

    centrarMapa(g) {
        this.googleMapa.setCenter({
            lat: g.coords.latitude,
            lng: g.coords.longitude
        });
    }
}

class Restaurante {

    constructor(nombre, latitud, longitud) {
        this.nombre = nombre;
        this.latitud = latitud;
        this.longitud = longitud;
    }

    crearMarca(googleMapa) {
        return new google.maps.Marker({
            position: {
                lat: this.latitud,
                lng: this.longitud
            },
            map: googleMapa,
            animation: google.maps.Animation.DROP,
            title: this.nombre
        });
    }
}

class Restaurantes {

    constructor(mapa) {
        this.mapa = mapa;
        console.log(mapa);
        $.get('restaurantes.xml', this.mostrarResultados.bind(this));
    }

    mostrarResultados(r) {
        console.log(r);
        $('restaurante', r).each((i, restaurante) => {
            console.log(restaurante);
            var nombre = $(restaurante).attr('name');
            var latitud = parseFloat($(restaurante).find('> location > latitude').text());
            var longitud = parseFloat($(restaurante).find('> location > longitude').text());
            this.mapa.addRestaurante(new Restaurante(nombre, latitud, longitud));
        });
    }
}

$(function () {
    var mapa = new Mapa();
    new Restaurantes(mapa);
})