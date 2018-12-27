var br = 0;
var stranica;
function novaStranica(stranica){
    br = 0;
    this.stranica = stranica;
    ucitavanje();
}
function ucitavanje() {
    $.ajax({
        type:"get",
        dataType:"json",
        url:"php/index.php?br=" + br + "&stranica=" + stranica,
        success:function(clanci){
            $.each(clanci, function(i, clanak){
                tekst = clanak.tekst;
                tekst = clanak.tekst.replace(/<img[^>]*>/g,"");
                tekst = tekst.replace(/<div[^>]*>[A-ZČĆĐŠŽa-zčćđšž\s]*/g,"")
                tekst = $("<p>"+tekst+"</p>").text();
                $("section").append(kreirajElement(clanak.id, clanak.kreirano, clanak.autor, clanak.autor_alias, clanak.ime, clanak.prezime, clanak.slika, clanak.naslov, tekst));
            })
        }
    })
    br++;
}

window.onscroll = function (ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
        this.setTimeout(
        ucitavanje()
        , 5000);
    }
};



function kreirajElement(id, vrijeme, autor, alias, ime, prezime, slika, naslov, tekst) {
    autor = (alias == null || alias == '')? ime + ' ' + prezime : alias;
    if (!tekst.replace(/\s/g, '').length) {
        tekst = 'Fotogalerija';
    }
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