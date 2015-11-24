jQuery(document).foundation();

Pizza.init();

jQuery(".registergearitembrand").minimalect({ theme: "default", placeholder: "Hersteller auswählen" });


//jQuery(".editgearmodalbutton").click(function() {

	jQuery(".updategearbrand").minimalect({ theme: "default", placeholder: "Hersteller auswählen" });

//})
/*
var run = function(){
  var req = new XMLHttpRequest();
  req.timeout = 5000;
  req.open('GET', 'http://julian-weiland.de/gearlist/readme.html', true);
  req.send();
}
setInterval(run, 3000);*/

$(function(){

    var 
        $online = $('.online'),
        $offline = $('.offline');

    Offline.on('confirmed-down', function () {
        $online.fadeOut(function () {
            $offline.fadeIn();
        });
    });

    Offline.on('confirmed-up', function () {
        $offline.fadeOut(function () {
            $online.fadeIn();
        });
    });

});