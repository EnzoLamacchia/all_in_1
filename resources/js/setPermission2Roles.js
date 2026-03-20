
document.addEventListener('DOMContentLoaded', function() {

    var azioni = document.getElementById('ruoli');
    // var idUser = document.getElementById('userid').value;
    var idRuolo = document.getElementById('idRuolo').value;
    var tableDisponibili = document.getElementById('sxTable');
    var tableAssegnati = document.getElementById('dxTable');
    var tBodyD = tableDisponibili.getElementsByTagName('tbody')[0];
    var tBodyA = tableAssegnati.getElementsByTagName('tbody')[0];
    var lastRowA = tBodyA.lastElementChild

    //catturo l'evento 'onclick' col costrutto addEventListener
    azioni.addEventListener('click', function(ev) {
        ev.preventDefault();
        var whereclick = ev.target.parentNode.type;
        // var whereclick = ev.target;
        if (whereclick == undefined){  // contains path or line
            var a = ev.target.parentNode.parentNode;
        }else{  // NOT contains path or line but svg
            var a = ev.target.parentNode;
        }
        // console.log(a);

        if (a.attributes.hasOwnProperty('action')) {
            ev.preventDefault();
            var actTo2 = a.attributes.action.value;
            // console.log(a.attributes.action);

            var tr = a.parentNode.parentNode;
            var idUser = tr.childNodes[1].innerText;
            var userName = tr.childNodes[3].innerText;
        // var urlMethod = a.attributes.title.value;
        //if (a.hasAttribute('_method')) urlMethod = a.attributes._method.value;
        //     var urlAction = "http://dircrp.test/gestione/ruoli/"+idUser+"/"+idRole+"/"+actTo2;
            var urlAction = location.protocol+"//"+location.host +"/gestione/ruoli/"+idRuolo+"/"+idUser+"/"+actTo2;

        gestisciruolo();
    }

        function gestisciruolo(){
            var tokn = document.getElementsByTagName('meta').namedItem('csrf-token').content;
            console.log(tokn);
            var ajaxCall = new XMLHttpRequest();
            var metodo = 'POST';

            ajaxCall.open(metodo, urlAction);
            ajaxCall.setRequestHeader("x-csrf-token", tokn);
            ajaxCall.send();
            ajaxCall.onreadystatechange = function () {
                if (ajaxCall.readyState == 4 && ajaxCall.status == 200) {
                    // console.log('INIZIO CHIAMATA AJAX');
                    var resp = ajaxCall.responseText;
                    var newTR = document.createElement('tr');
                    newTR.className = 'border-b';
                    var newTD00 = document.createTextNode('');
                    var newTD0 = document.createElement('td');
                    var newTD01 = document.createTextNode('');
                    var newTD1 = document.createElement('td');
                    var newTD02 = document.createTextNode('');
                    var newTD2 = document.createElement('td');
                    var newAnewline = document.createElement('a');
                    newAnewline.type = 'button';
                    if (actTo2 == 'setpermission2role') {
                        newAnewline.className = 'rounded-md text-white tracking-normal cursor-pointer px-2 py-2 my-2 bg-red-500 hover:bg-red-600'
                        newAnewline.title = 'rimuovi';
                        newAnewline.setAttribute ('action', 'delpermissionfromrole');
                        newAnewline.innerHTML = "<svg class=\"h-6 w-6 text-white\"  fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"> <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M10 19l-7-7m0 0l7-7m-7 7h18\"/></svg>"
                    } else if (actTo2 == 'delpermissionfromrole') {
                        newAnewline.className = 'rounded-md text-white tracking-normal cursor-pointer px-2 py-2 my-2 bg-green-500 hover:bg-green-600'
                        newAnewline.title = 'assegna';
                        newAnewline.setAttribute ('action', 'setpermission2role');
                        newAnewline.innerHTML = "<svg class=\"h-6 w-6 text-white\"  fill=\"none\" viewBox=\"0 0 24 24\" stroke=\"currentColor\"> <path stroke-linecap=\"round\" stroke-linejoin=\"round\" stroke-width=\"2\" d=\"M14 5l7 7m0 0l-7 7m7-7H3\"/></svg>"
                    }
                    newTD0.innerHTML = idUser;
                    newTD0.className = 'text-sm text-gray-900 px-6 py-2 whitespace-nowrap text-left font-medium';
                    newTD1.innerHTML = userName;
                    newTD1.className = 'text-sm text-gray-900 px-6 py-2 whitespace-nowrap text-left font-medium';
                    newTD2.appendChild(newAnewline);
                    newTR.appendChild(newTD00);
                    newTR.appendChild(newTD0);
                    newTR.appendChild(newTD01);
                    newTR.appendChild(newTD1);
                    newTR.appendChild(newTD02);
                    newTR.appendChild(newTD2);
                    if (actTo2 == 'setpermission2role') {
                        tableAssegnati.append(newTR);
                    } else if (actTo2 == 'delpermissionfromrole') {
                        tableDisponibili.append(newTR);
                    }
                    tr.parentNode.removeChild(tr);
                }
            }
        }

});


})



