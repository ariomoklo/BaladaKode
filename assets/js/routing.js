var currentRoute = "dashboard";
var blueBot; var code; var error;

$("a[loadScene]").click(function(){
    var route = $(this).attr("loadScene");
    $(".data-page").hide();
    currentRoute = route;
    
    $(".data-page[data-route='"+route+"']").fadeIn();
//    
//    switch(route){
//        case "dashboard":
//            $(".data-page[data-route='dashboard']").fadeIn(); break;
//        case "fighter":
//            $(".data-page[data-route='fighter']").fadeIn(); break;
//        default:
//            $(".data-page[data-route='dashboard']").fadeIn(); break;
//    }
});

window.onload = function(){
    $('a[loadScene]').css( 'cursor', 'pointer' );
    $(".data-page").hide();
    $(".data-page[data-route='dashboard']").fadeIn(1500, function(){
       $(".loading-view").fadeOut();
    });
};