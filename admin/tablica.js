var brojRedaka;
var limitPoStranici;
var brojStranica;
function stranicenje() {
    brojRedaka = $("table tbody tr").length;
    limitPoStranici = $("#brRedova").val();
    $("tbody tr:gt(" + (limitPoStranici - 1) + ")").hide();
    brojStranica = Math.ceil(brojRedaka / limitPoStranici);
    $("#tab-nav ul").html("");
    $("#tab-nav ul").append("<li onclick='prethodnaStranica()'><a href='#'><span>&laquo;</span></a></li>");
    $("#tab-nav ul").append("<li id='1' class='aktivno' onclick='azurirajStranicu(this.id)'><a href='#'>" + 1 + "</a></li>");

    for (var i = 2; i <= brojStranica; i++) {
        if (i <= 5)
            $("#tab-nav ul").append("<li id='" + i + "' onclick='azurirajStranicu(this.id)'> <a href='#'>" + i + "</a></li > ");
        else {
            $("#tab-nav ul").append("<li id='" + i + "' onclick='azurirajStranicu(this.id)' class='skriveno'> <a href='#'>" + i + "</a></li > ");
            $("#" + i).hide();
        }
    }
    $("#tab-nav ul").append("<li onclick='sljedecaStranica()'><a href='#'><span>&raquo;</span></a></li>");
}
function azurirajStranicu(id) {
    stranica = $("#" + id);
    if (stranica.hasClass("aktivno")) {
        event.preventDefault();
        return false;
    }
    else {
        var trenutnaStranica = stranica.index();
        azurirajNavigaciju(trenutnaStranica, "stranica");
        $("#tab-nav ul li").removeClass("aktivno");
        stranica.addClass("aktivno");
        $("tbody tr").hide();

        var grandTotal = limitPoStranici * trenutnaStranica;
        for (var i = grandTotal - limitPoStranici; i < grandTotal; i++) {
            $("tbody tr:eq(" + i + ")").show();
        }
    }
}
function sljedecaStranica() {
    var trenutnaStranica = $("#tab-nav ul li.aktivno").index();
    if (trenutnaStranica == brojStranica) {
        event.preventDefault();
        return false;
    } else {
        trenutnaStranica++;
        azurirajNavigaciju(trenutnaStranica, "povecanje");
        $("#tab-nav ul li").removeClass("aktivno");
        $("tbody tr").hide();
        var grandTotal = limitPoStranici * trenutnaStranica;
        for (var i = grandTotal - limitPoStranici; i < grandTotal; i++) {
            $("tbody tr:eq(" + i + ")").show();
        }
        $("#tab-nav ul li:eq(" + trenutnaStranica + ")").addClass("aktivno");
    }
}
function prethodnaStranica() {
    var trenutnaStranica = $("#tab-nav ul li.aktivno").index();
    if (trenutnaStranica == 1) {
        event.preventDefault();
        return false;
    } else {
        trenutnaStranica--;
        azurirajNavigaciju(trenutnaStranica, "smanjenje");
        $("#tab-nav ul li").removeClass("aktivno");
        $("tbody tr").hide();
        var grandTotal = limitPoStranici * trenutnaStranica;
        for (var i = grandTotal - limitPoStranici; i < grandTotal; i++) {
            $("tbody tr:eq(" + i + ")").show();
        }
        $("#tab-nav ul li:eq(" + trenutnaStranica + ")").addClass("aktivno");
    }
}
function azurirajNavigaciju(trenutnaStranica, akcija) {
    switch (akcija) {
        case "povecanje":
            for (i = trenutnaStranica - 2; i < trenutnaStranica + 3; i++) {
                if (trenutnaStranica > 3) {
                    if (i == trenutnaStranica - 1 && brojStranica - trenutnaStranica > 1) {
                        stranica = i - 2;
                        $("#" + stranica).hide();
                    }
                    else if (i == trenutnaStranica + 2) {
                        $("#" + i).show();
                    }
                }

            }
            break;
        case "smanjenje":
            for (i = trenutnaStranica + 2; i > trenutnaStranica - 3; i--) {
                if (trenutnaStranica > 2) {
                    if (i == trenutnaStranica + 1) {
                        stranica = i + 2;
                        $("#" + stranica).hide();
                    }
                    else if (i == trenutnaStranica - 2) {
                        $("#" + i).show();
                    }
                }

            }
            break;
        case "stranica":
            for (i = trenutnaStranica - 5; i < trenutnaStranica + 5; i++) {              
                if(brojStranica-trenutnaStranica<3 && i > brojStranica-5){
                    $("#" + i).show();
                }
                else if(trenutnaStranica<3 && i<=5){
                    $("#" + i).show();
                }   
                else if(i > trenutnaStranica - 3 && i < trenutnaStranica + 3){ 
                    $("#" + i).show();
                } 
                else
                    $("#" + i).hide();          
            }
            break;
    }

}
$(document).ready(function () {
    $('.zaglavlje-kolene').click(function () {
        var tablica = $(this).parents('table').eq(0)
        var redovi = tablica.find('tr:gt(0)').toArray().sort(usperedjivac($(this).index()))
        this.asc = !this.asc
        if (!this.asc) { redovi = redovi.reverse() }
        for (var i = 0; i < redovi.length; i++) { tablica.append(redovi[i]) }
        azurirajStranicu(2);
        azurirajStranicu(1);
    })
    function usperedjivac(index) {
        return function (a, b) {
            var valA = dohvatiVrijednostCelije(a, index), valB = dohvatiVrijednostCelije(b, index)
            return $.isNumeric(valA) && $.isNumeric(valB) ? valA - valB : valA.toString().localeCompare(valB)
        }
    }
    function dohvatiVrijednostCelije(row, index) { return $(row).children('td').eq(index).text() }
    $("#brRedova").change(function () {
        stranicenje();
        stranica = $("#1");
        var trenutnaStranica = stranica.index();
        $("#tab-nav ul li").removeClass("aktivno");
        stranica.addClass("aktivno");
        $("tbody tr").hide();

        var grandTotal = limitPoStranici * trenutnaStranica;
        for (var i = grandTotal - limitPoStranici; i < grandTotal; i++) {
            $("tbody tr:eq(" + i + ")").show();
        }
    })
});
