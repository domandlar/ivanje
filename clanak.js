$(document).ready(function(){
    $.ajax({
        type:"get",
        dataType:"json",
        url:"php/clanak.php",
        success:function(clanak){
            $("#clanak").append(kreirajElement(clanak.id, clanak.kreirano, clanak.autor_alias, clanak.ime, clanak.prezime, clanak.slika, clanak.naslov, clanak.tekst));
        }
    })
});

function kreirajElement(id, vrijeme, autor, ime, prezime, slika, naslov, tekst) {
    if (autor == null)
        autor = ime + ' ' + prezime
    godina = vrijeme.substring(0, 4);
    mjesec = vrijeme.substring(5, 7);
    dan = vrijeme.substring(8, 10);
    datum = dan + '/' + mjesec + '/' + godina
    element = '<div class="row">';
    element += '<div class="col-md-12">';
    element += '<div class="card card-cascade wider reverse">';
    element += '<div class="view text-center ">';
    if(slika != null)
        element += '<img src="' + slika + '" alt="Wide sample post image" class="img-fluid">'
    element += '<a>';
    element += '<div class="mask rgba-white-slight"></div>';
    element += '</a>';
    element += '</div>';
    element += '<div class="card-body text-center">';
    element += '<h2>';
    element += '<a class="font-weight-bold">' + naslov + '</a>';
    element += '</h2>';
    element += '<p>Napisao/la <a>' + autor + '</a>, ' + datum + '</p>';
    element += '</div>';
    element += '</div>';
    element += '<div class="excerpt mt-5">';
    element += '<p>' + tekst + '</p>';
    element += '</div>';
    element += '</div>';
    element += '</div>';

    return element;
}