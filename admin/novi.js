$(document).ready(function () {
    if (dohvatiParametar("mod") == "azuriranje") {
        id = dohvatiParametar("id");
        
    }
    var kolekcijaSlika = [];
    
});
function dohvatiParametar(parametar) {
    var sPageURL = window.location.href;
    var sURLVariables = sPageURL.split('?');
    var sURLParameters = sURLVariables[1].split('&');
    for (var i = 0; i < sURLParameters.length; i++) {
        var sParameterName = sURLParameters[i].split('=');

        if (sParameterName[0] == parametar) {
            return sParameterName[1];
        }
    }
};

$('#naslovnaSlika').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);

    $("#prikazNaslovneSlike").html("<ul><li><input type='checkbox' id='ns' /><label for='ns'><img src='" + URL.createObjectURL(event.target.files[0]) + "' /></label></li></ul>")
    $("#promjenaNaslovneSlike").prop('checked', true);
});
$('#slike').change( function(event) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("#prikazNovihSlika").html("<ul></ul>")
    for(i=0;i<event.target.files.length;i++){
        $("#prikazNovihSlika ul").append("<li><input type='checkbox' id=s" + i + " /><label for=s" + i+"><img src='" + URL.createObjectURL(event.target.files[i]) + "' /></label></li>")
    }
});
$('#obrisiSlike').click(function(event){
    event.preventDefault();
    var odabraneSlike = $('input[type=checkbox]:checked').map(function(){
        return this.id;
    }).get().join(",");
    clanak = dohvatiParametar("id")
    $.ajax({
        type: "get",
        dataType: "json",
        url: "clanciApi.php?akcija=azurirajSlike&slike="+odabraneSlike+"&clanak="+clanak,
        success: function(slike){
            $("#prikazStarihSlika ul").html("")
            $.each(slike, function(i, slika){
                $("#prikazStarihSlika ul").append("<li><input type='checkbox' id=" + slika.id + " /><label for=" + slika.id + "><img src='../" + slika.link + "'/></label></li>")
            })
        }
    })
});
$('form').submit(function(event){
    greska = "";
    if($('#name').val() == "")
        greska += "Morate unijeti naziv.\n";
    if($('#soflow').val() == "")
        greska += "Morate odabrati kategoriju.";
    if(greska != ""){
        alert(greska);
        event.preventDefault();
    }
})