jQuery(document).foundation();

Pizza.init();

jQuery(".registergearitembrand").minimalect({ theme: "default", placeholder: "Hersteller auswählen" });


//jQuery(".editgearmodalbutton").click(function() {

	jQuery(".updategearbrand").minimalect({ theme: "default", placeholder: "Hersteller auswählen" });

//})

var run = function(){
  var req = new XMLHttpRequest();
  req.timeout = 5000;
  req.open('GET', 'http://julian-weiland.de/gearlist', true);
  req.send();
}
setInterval(run, 3000);