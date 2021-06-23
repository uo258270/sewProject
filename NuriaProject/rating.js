class Rating {
    constructor(tdRating) {
        this.tdRating = $(tdRating);
        this.places = this.tdRating.attr('data-places');
        this.peticion();
    }

    peticion() {

        $.getJSON('proxy.php?get=' + encodeURIComponent('https://maps.googleapis.com/maps/api/place/details/json?place_id='+this.places+'&fields=rating&key=AIzaSyCQlDrcjaOHjcrHW_NlxdigzKNZVb57M_s')).then(this.mostrar.bind(this));

       
    }

    
    mostrar(response) {
        console.log(response);
        var ratings = response.result.rating;
        this.tdRating.text(ratings);
    }
};

$(function () {
    $('.rating').each(function () {
        new Rating(this);
    });
});