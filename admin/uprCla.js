$(document).ready(function () {
    dohvati("sve");
    
    $("#brisanje").click(function () {
        clanciID = [];
        $("tbody input:checkbox:checked").map(function () {
            clanciID.push(parseInt($(this).attr("id").slice(3)));
        });

        if (clanciID.length != 0) {
            $.ajax({
                type: "get",
                dataType: "json",
                url: "clanciApi.php?akcija=brisi&clanci=" + clanciID,
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
    $("#azuriranje").click(function () {
        clanakID = [];
        $("tbody input:checkbox:checked").map(function () {
            clanakID.push(parseInt($(this).attr("id").slice(3)));
        });
        if (clanakID.length == 0)
            alert("Nije odabran članak za ažuriranje");
        else if (clanakID.length > 1)
            alert("Odabrano previše članaka za ažuriranje. Moguće je ažurirati samo jedan po jedan članak.");
        else {
            window.location.href = "novi.php?mod=azuriranje&id=" + clanakID[0];
        }
    })

    $("thead input").change(function () {
        $("tbody input:checkbox").each(function () {
            if ($("thead input").prop("checked"))
                $(this).prop("checked", true);
            else
                $(this).prop("checked", false);
        })
    })

    $("#soflow").change(function(){
        filtriraj();
    })
    $("#pocetak").change(function(){
        filtriraj();
    })
    $("#kraj").change(function(){
        filtriraj();
    })
});

function dohvati(tip) {
    $.ajax({
        type: "get",
        dataType: "json",
        url: "clanciApi.php?akcija=" + tip,
        success: function (clanci) {
            $("tbody").html("");
            $.each(clanci, function (i, clanak) {
                ucitaj(clanak);
                stranicenje();
            })
        }
    })
    url= "clanciApi.php?akcija=" + tip;
}
function ucitaj(clanak) {
    red = "<tr>";
    red += "<td>";
    red += "<div class='custom-control custom-checkbox'>";
    red += "<input name='clk[]' value='" + clanak.naslov + "' type='checkbox' class='custom-control-input' id='cla" + clanak.id + "'>";
    red += "<label class='custom-control-label' for='cla" + clanak.id + "'></label>";
    red += "</div>";
    red += "</td>";
    red += "<td class='font-weight-bold'><a href='#'>" + clanak.naslov + "</a></td>";
    red += "<td>" + clanak.kategorija + "</td>";
    red += "<td>" + clanak.ime + " " + clanak.prezime + "</td>";
    red += "<td>" + clanak.kreirano + "</td>";
    red += "<td>" + clanak.broj_pregleda + "</td>";
    red += "</tr>";

    $("tbody").append(red);
}
function filtriraj(){
    kategorija = $("#soflow").val();
    pocetak = $("#pocetak").val();
    kraj = $("#kraj").val();
    tip = "filtriraj";
    if(kategorija != "")
        tip += "&kategorija=" + kategorija;
    if(pocetak != "")
        tip += "&pocetak=" + pocetak;
    if(kraj != "")
        tip += "&kraj=" + kraj;
    dohvati(tip);
}