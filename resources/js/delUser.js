
document.addEventListener('DOMContentLoaded', function() {

    var azioni = document.getElementById('userTable');
    // console.log(azioni);
    azioni.addEventListener('dblclick', function(dc) {
        // console.log(dc.target);
        if (dc.target.parentNode.childNodes[0].innerHTML!=='ID') { //se non si è sulla riga delle intestazioni della tabella

        var idDet = dc.target.parentNode.childNodes[1].innerText;
        if (isNaN(idDet)) idDet = dc.target.parentNode.parentNode.childNodes[1].innerText;
        if (idDet=='') idDet = dc.target.parentNode.parentNode.parentNode.parentNode.childNodes[1].innerText;
        // window.location.href='http://dircrp.test/gestione/utenti/'+idDet+'/edit'
        window.location.href=location.pathname+'/'+idDet+'/edit'
    }
    });
    //catturo l'evento 'onclick' col costrutto addEventListener
    azioni.addEventListener('click', function(ev) {
        // ev.preventDefault();
        var whereclick = ev.target.parentNode.type;
        // var whereclick = ev.target;
        if (whereclick == undefined){
            // console.log('OK, contains path or line');
            var a = ev.target.parentNode.parentNode;
        }else{
            // console.log('NOT contains path or line but svg');
            var a = ev.target.parentNode;
        }
        // console.log(a);

        if (a.attributes.hasOwnProperty('title')) {
            ev.preventDefault();
            var actTo2 = a.attributes.title.value;
            // console.log(a.attributes.title);
            var tr = a.parentNode.parentNode;
            var idUser = tr.childNodes[1].innerText;
        // var urlMethod = a.attributes.title.value;
        //if (a.hasAttribute('_method')) urlMethod = a.attributes._method.value;
        //     var urlAction = "http://dircrp.test/gestione/utenti/"+idUser+"/"+actTo2;
            var urlAction = location.pathname+"/"+idUser+"/"+actTo2;
        // console.dir(tr, idUser);
        // console.log(urlAction);

        if (actTo2 == 'delete') {
            // ev.preventDefault();
            // console.log(urlMethod);
            let JSalert = new Promise(function (resolve, reject) {
                swal({
                        title: "CANCELLAZIONE!",
                        text: "Intendi eseguire la cancellazione dell'utente?",
                        type: "warning",
                        showCancelButton: true,
                        //confirmButtonColor: "#DD6B55",
                        confirmButtonColor: "purple",
                        confirmButtonText: "SI, rimuovi utente!",
                        cancelButtonText: "NO, non sono sicuro!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Fatto!", "L'utente è stato rimosso definitivamente!", "success");
                            eseguiCancellazione()
                        } else {
                            swal("No action!", "L'utente non è stato rimosso!", "error");
                            return false;
                        }
                    });
            });

            // let exec = function(){
            //     JSalert().then(function(){
            //         alert(result)
            //     });
            // }
        } else if (actTo2 == 'onoff') {
            // alert ('cambio stato richiesto');
            eseguiCambioStato();
        }
    }
        function eseguiCancellazione (){
            var tokn = document.getElementsByTagName('meta').namedItem('csrf-token').content;
            // console.log(tokn);
            var ajaxCall = new XMLHttpRequest();
            var metodo = 'DELETE';

            ajaxCall.open(metodo, urlAction);
            ajaxCall.setRequestHeader("x-csrf-token", tokn);
            ajaxCall.send();
            ajaxCall.onreadystatechange = function () {
                if (ajaxCall.readyState == 4 && ajaxCall.status == 200) {
                    // console.log('INIZIO CHIAMATA AJAX');
                    var resp = ajaxCall.responseText;
                    // console.log(resp);
                    if(resp == 1){
                        tr.parentNode.removeChild(tr); //rimuove il nodo TR contenente il pulsante Cancella pigiato dall'utente
                    } else {
                        alert('Problem contacting server');
                    }
                }
            }
        }

        function eseguiCambioStato (){
            var tokn = document.getElementsByTagName('meta').namedItem('csrf-token').content;
            // console.log(tokn);
            var ajaxCall = new XMLHttpRequest();
            var metodo = 'GET';

            ajaxCall.open(metodo, urlAction);
            ajaxCall.setRequestHeader("x-csrf-token", tokn);
            ajaxCall.send();
            ajaxCall.onreadystatechange = function () {
                if (ajaxCall.readyState == 4 && ajaxCall.status == 200) {
                    var resp = ajaxCall.responseText;
                    if(resp == 1){
                        var statoUtente = tr.childNodes[7].innerText;
                        if (statoUtente == "attivo") {
                            tr.childNodes[7].innerText = "disattivo";
                            a.innerHTML = "<svg class=\"h-6 w-6 text-white\"  viewBox=\"0 0 24 24\"  fill=\"none\"  stroke=\"currentColor\"  stroke-width=\"2\"  stroke-linecap=\"round\"  stroke-linejoin=\"round\">  <rect x=\"1\" y=\"5\" width=\"22\" height=\"14\" rx=\"7\" ry=\"7\" />  <circle cx=\"16\" cy=\"12\" r=\"3\" /></svg>"
                        }else{
                            tr.childNodes[7].innerText = "attivo";
                            a.innerHTML = "<svg class=\"h-6 w-6 text-black\"  viewBox=\"0 0 24 24\"  fill=\"none\"  stroke=\"currentColor\"  stroke-width=\"2\"  stroke-linecap=\"round\"  stroke-linejoin=\"round\">  <rect x=\"1\" y=\"5\" width=\"22\" height=\"14\" rx=\"7\" ry=\"7\" />  <circle cx=\"8\" cy=\"12\" r=\"3\" /></svg>";
                        }
                    } else {
                        alert('Problem contacting server');
                    }
                }
            }
        }

});


})



