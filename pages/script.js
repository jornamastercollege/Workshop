console.log("Jquery is loaded version:");

if (typeof jQuery != 'undefined') {  
    // jQuery is loaded => print the version
    console.log(jQuery.fn.jquery);
}

$( document ).ready(function() {
    

});

function checkWS(){
    console.log("U have changed the workshops");

    var ws1val = $("#workshopselect :selected").text();
    var ws2val = $("#workshopselect2 :selected").text();

    console.log("ws1: " + ws1val);
    console.log("ws2: " + ws2val);



    if (ws1val.substring(0,3) == ws2val.substring(0,3)){
        $("#submitid").hide();
        $("#pid").text("U heeft 2x dezelfde workshop geselecteerd");
    }
    else {
        $("#submitid").show();
        $("#pid").text("U kunt dit insturen");
    }


}