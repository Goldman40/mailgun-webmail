
$(document).ready(function(){$(".alert").addClass("in").fadeOut(4500);

/* swap open/close side menu icons */
$('[data-toggle=collapse]').click(function(){
  	// toggle icon
  	$(this).find("i").toggleClass("glyphicon-chevron-right glyphicon-chevron-down");
});
});
var counter = 1;
var limit = 20;
function addInput(divName){
    if (counter == limit)  {
        alert("You have reached the limit of adding " + counter + " files");
    }
    else {
        var newdiv = document.createElement('div');
        newdiv.innerHTML = "File " + (counter + 1) + " <br><input name=\"attachment[]\" type=\"file\" />";
        document.getElementById(divName).appendChild(newdiv);
        counter++;
    }
}

var xhr_object = null;


if(window.XMLHttpRequest) // Firefox
    xhr_object = new XMLHttpRequest();
else if(window.ActiveXObject) // Internet Explorer
    xhr_object = new ActiveXObject("Microsoft.XMLHTTP");
else { // XMLHttpRequest non supporté par le navigateur
    alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
}

var filename = "dump.php";
var data     = null;

xhr_object.open("POST", filename, true);

function viewmessage(id) {
    xhr_object.onreadystatechange = function() {
        if(this.readyState == 4) {
            var tmp = this.responseText.split(":");
            if(typeof(tmp[1]) != "undefined") {
                id = tmp[1];
            }
            alert(tmp[0]);
        }
    }
    xhr_object.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr_object.send(data);
}
function linkify(inputText) {
    var replacedText, replacePattern1, replacePattern2, replacePattern3;

    //URLs starting with http://, https://, or ftp://
    replacePattern1 = /(\b(https?|ftp):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gim;
    replacedText = inputText.replace(replacePattern1, '<a href="$1" target="_blank">$1</a>');

    //URLs starting with "www." (without // before it, or it'd re-link the ones done above).
    replacePattern2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
    replacedText = replacedText.replace(replacePattern2, '$1<a href="http://$2" target="_blank">$2</a>');

    //Change email addresses to mailto:: links.
    replacePattern3 = /(([a-zA-Z0-9\-\_\.])+@[a-zA-Z\_]+?(\.[a-zA-Z]{2,6})+)/gim;
    replacedText = replacedText.replace(replacePattern3, '<a href="mailto:$1">$1</a>');

    return replacedText;
}
