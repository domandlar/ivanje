function ucitavanje() {
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var jsonLista = JSON.parse(this.responseText);
            for (i in jsonLista) {
                var konjtenjer = document.getElementById("sekcija");
                konjtenjer.innerHTML += kreirajElement(jsonLista[i].id, jsonLista[i].kreirano, jsonLista[i].autor_alias, jsonLista[i].ime, jsonLista[i].prezime, jsonLista[i].slika, jsonLista[i].naslov, jsonLista[i].tekst);
            }
        }
    };
    xmlhttp.open("GET", "php/index.php", true);
    xmlhttp.send();
}


window.onscroll = function (ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        ucitavanje();
    }
};


function kreirajElement(id, vrijeme, autor, ime, prezime, slika, naslov, tekst) {
    if (autor == null)
        autor = ime + ' ' + prezime
    godina = vrijeme.substring(0, 4);
    mjesec = vrijeme.substring(5, 7);
    dan = vrijeme.substring(8, 10);
    datum = dan + '/' + mjesec + '/' + godina
    element = '<div class="row">';
    element += '<div class="col-lg-5 col-xl-4 mb-4">';
    element += '<div class="view overlay rounded z-depth-1-half">';
    if (slika != null)
        element += '<img src="' + slika + '" class="img-fluid" alt="' + naslov + '">';
    element += '<a>';
    element += '<div class="mask rgba-white-slight"></div>';
    element += '</a>';
    element += '</div>';
    element += '</div>';
    element += '<div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">';
    element += '<h3 class="mb-3 font-weight-bold dark-grey-text">';
    element += '<strong>' + naslov + '</strong>';
    element += '</h3>';
    element += '<p class="grey-text text-truncate">' + tekst + '</p>';
    element += '<p>Napisao/la';
    element += '<a class="font-weight-bold dark-grey-text"> ' + autor + '</a>, ' + datum + '</p>';
    element += '<a class="btn btn-primary btn-md" href="clanak.php?clanak=' + id + '">Opširnije</a>';
    element += '</div>';
    element += '</div>';

    return element;
}