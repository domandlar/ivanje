$(document).ready(function(){
    $.ajax({
        type: "get",
        dataType: "json",
        url: "./korisniciApi.php?akcija=sve",
        success: function(korisnici){
            $("tbody").html("");
            $.each(korisnici, function(i, korisnik){
                ucitaj(korisnik);
                stranicenje();
            })
        }
    })
    $("#brisanje").click(function () {
        korisniciID = [];
        $("tbody input:checkbox:checked").map(function () {
            korisniciID.push(parseInt($(this).attr("id")));
        });
        if (clanciID.length != 0) {
            $.ajax({
                type: "get",
                dataType: "json",
                url: "korisniciApi.php?akcija=brisi&korisnici=" + korisniciID,
                success: function () {
                    alert("Obrisano");
                    $("tbody").html("");
                    dohvati("sve");
                }

            })
        }
        else {
            alert("Nema odabranih članaka za brisanje.");
        }

    })
    $("#novi").click(function(){
        window.location.href = "profil.php?mod=novi";
    })
});
function ucitaj(korisnik){
    red = "<tr>";
    red += "<td><div class='custom-control custom-checkbox'>"
    red += "<input type='checkbox' class='custom-control-input' id='" + korisnik.id + "'>"
    red += "<label class='custom-control-label' for='" + korisnik.id + "'></label>"
    red += "</div></td>";
    red += "<td class='font-weight-bold'><a href='" + "uprKor.php" + "'>" + korisnik.ime + " " + korisnik.prezime + "</a></td>";
    red += "<td>" + korisnik.korisnicko_ime + "</td>"
    red += "<td>" + korisnik.email + "</td>"
    red += "</tr>";
    $("tbody").append(red);
}