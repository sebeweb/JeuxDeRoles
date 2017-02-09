
//qunad le document est pret 
$(document).ready(function () {
    centrerButton();
    centrerForm();
    $("body").css("visibility", "visible");
});

$(window).resize(function () {
    centrerButton();
    centrerForm();
});

$("button").click(function () {
    $(this).fadeOut(1000, function () {
        $("#selection").fadeIn(1000);
    });
});

function centrerButton() {
    // on recupere les dimension de la fenetre
    var w = $(window).width();
    var h = $(window).height();

    // on calcul la position du boutton afin qu'il soit centré
    var top = (h - $("button").height()) / 2;
    var left = (w - $("button").width()) / 2;
    //on affecte les nouvelles position calcule
    $("button").css({
        "left": left + "px",
        "top": top + "px"
    });

}
function centrerForm() {
    // on recupere les dimension de la fenetre
    var w = $(window).width();
    var h = $(window).height();

    // on calcul la position du boutton afin qu'il soit centré
    var top = (h - $("#selection").height()) / 2;
    var left = (w - $("#selection").width()) / 2;
    //on affecte les nouvelles position calcule
    $("#selection").css({
        "left": left + "px",
        "top": top + "px"
    });

}