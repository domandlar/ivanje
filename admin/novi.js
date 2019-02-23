$(document).ready(function () {
    if (dohvatiParametar("mod") == "azuriranje") {
        id = dohvatiParametar("id");
        
    }
    var kolekcijaSlika = [];
    /*$("#slike").change(function(event){
        var slike = event.target.files;
        $.each(slike, function(i, slika){
            kolekcijaSlika.push(slika);
        });
    });*/
    /*$("form").submit(function () {
        var forma = $(this),
            url = forma.attr("action"),
            type = forma.attr("method"),
            data = new FormData();

        forma.find("[name]").each(function (index, value) {
            var input = $(this),
                name = input.attr("name");   
            var value = input.val();      
            if(name=="slike[]"){
                /*input.change(function() {
                    var names = [];
                    for (var i = 0; i < $(this).get(0).files.length; ++i) {
                        names.push($(this).get(0).files[i].name);
                    }
                    input.val(names);
                }) //
                //value = kolekcijaSlika;
            }
            
            data.append(name, value);
        });
        $.ajax({
            url: url,
            type: type,
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            success: function (response) {
                forma.find("input, select").val("");
                nicEditors.findEditor( "exampleFormControlTextarea1" ).setContent("");
                /*alert("Uspješno objavljeno.");
                window.location.href="uprCla.php";//
                console.log(response);
            },
            error: function(error){
                alert("Neuspjela objava. Pokušajte ponovno.");
                console.log(error);
            }
        });
        //return false;
    })*/
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
