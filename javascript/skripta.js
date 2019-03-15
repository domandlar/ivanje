var br = 0;
var stranica;
function novaStranica(stranica) {
    br = 0;
    this.stranica = stranica;
    ucitavanje();
}
function ucitavanje() {
    $.ajax({
        type: "get",
        dataType: "json",
        url: "php/index.php?br=" + br + "&stranica=" + stranica,
        success: function (clanci) {
            $.each(clanci, function (i, clanak) {
                naslovnaSlika = clanak.naslovna_slika;
                uvodniTekst = clanak.uvodni_tekst;
                tekst = clanak.tekst;
                if (naslovnaSlika == null || naslovnaSlika == "") {
                    test = new RegExp(/<img[^>]*>/g)
                    if (test.test(uvodniTekst)) {
                        slika = uvodniTekst.substring(uvodniTekst.indexOf("<img"));
                        putanjaSlike = slika.substring(slika.indexOf("src=")+5, slika.indexOf(".jpg")+4);
                        if(putanjaSlike.indexOf("/Vijesti") != -1)
                            putanjaSlike = putanjaSlike.substring(putanjaSlike.indexOf("/Vijesti"));
                        else if(putanjaSlike.indexOf("images/") != -1)
                            putanjaSlike = putanjaSlike.substring(putanjaSlike.indexOf("images/")+6);
                        naslovnaSlika = "slike" + putanjaSlike;
                    } else if (test.test(tekst)) {
                        slika = tekst.substring(tekst.indexOf("<img"));
                        putanjaSlike = slika.substring(slika.indexOf("src=")+5, slika.indexOf(".jpg")+4);
                        if(putanjaSlike.indexOf("/Vijesti") != -1)
                            putanjaSlike = putanjaSlike.substring(putanjaSlike.indexOf("/Vijesti"));
                        else if(putanjaSlike.indexOf("images/") != -1)
                            putanjaSlike = putanjaSlike.substring(putanjaSlike.indexOf("images/")+6);
                        naslovnaSlika = "slike" + putanjaSlike;
                    } else if (clanak.slika != "") {
                        naslovnaSlika = clanak.slika;
                    }
                }
                
                uvodniTekst = uvodniTekst.replace(/<img[^>]*>/g, "");
                uvodniTekst = uvodniTekst.replace(/{gallery stories\/Vijesti(\/\w*)*}/g, "");
                uvodniTekst = uvodniTekst.replace(/<div[^>]*>[A-ZČĆĐŠŽa-zčćđšž\s]*/g, "")
                uvodniTekst = $("<p>" + uvodniTekst + "</p>").text();


                tekst = clanak.tekst.replace(/<img[^>]*>/g, "");
                tekst = tekst.replace(/{gallery stories\/Vijesti(\/\w*)*}/g, "");
                tekst = tekst.replace(/<div[^>]*>[A-ZČĆĐŠŽa-zčćđšž\s]*/g, "")
                tekst = $("<p>" + tekst + "</p>").text();
                $("section").append(kreirajElement(clanak.id, clanak.kreirano, clanak.autor, clanak.autor_alias, clanak.ime, clanak.prezime, naslovnaSlika, clanak.naslov, uvodniTekst, tekst));
            })
        }
    })
    br++;
}
window.onscroll = function (ev) {
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {        
        ucitavanje()
    }
};/*
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() == $(document).height()) {
        ucitavanje();
    }
    //FIXME: popravit učitavanje na mobitelima
});*/



function kreirajElement(id, vrijeme, autor, alias, ime, prezime, slika, naslov, uvodniTekst, tekst) {
    autor = (alias == null || alias == '') ? ime + ' ' + prezime : alias;
    tekst = tekst.replace(/{mosimage}/g, "")
    uvodniTekst = uvodniTekst.replace(/{mosimage}/g, "")
    tekst = uvodniTekst == "" ? tekst : uvodniTekst;
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
        element += '<img src="' + slika + '" class="img-fluid" alt="' + naslov + '" style="border-radius:10px; max-width:100%; width:350px; height:220px; object-fit:cover;">';
    element += '<a href="clanak.php?clanak=' + id + '">';
    element += '<div class="mask rgba-white-slight"></div>';
    element += '</a>';
    element += '</div>';
    element += '</div>';
    element += '<div class="col-lg-7 col-xl-7 ml-xl-4 mb-4">';
    element += '<h3 class="mb-3 font-weight-bold dark-grey-text">';
    element += '<a href="clanak.php?clanak=' + id + '" style="color:#009688;">';
    element += '<strong>' + naslov + '</strong>';
    element += '</a>';
    element += '</h3>';
    element += '<p class="grey-text text-truncate">' + tekst + '</p>';
    element += '<p>Napisao/la';
    element += '<a class="font-weight-bold dark-grey-text"> ' + autor + '</a>, ' + datum + '</p>';
    element += '<a class="btn gumb btn-md" href="clanak.php?clanak=' + id + '">Opširnije</a>';
    element += '</div>';
    element += '</div>';

    return element;
}