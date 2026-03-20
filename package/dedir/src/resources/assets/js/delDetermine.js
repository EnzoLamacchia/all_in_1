
document.addEventListener('DOMContentLoaded', function() {
    var azioni = document.getElementById('dd-table');

    azioni.addEventListener('dblclick', function(dc) {
        //console.log(dc);
        if (dc.target.parentNode.childNodes[0].innerHTML!=='ID') {
        //console.dir(dc.target.parentNode);
        var idDet = dc.target.parentNode.childNodes[1].innerHTML;
        //console.dir(idDet);
        window.location.href=location.pathname+"/"+idDet+'/edit'
            // console.dir(location.host+"/detdir/determinazioni/");
    }
    });
    //catturo l'evento 'onclick' col costrutto addEventListener
    azioni.addEventListener('click', function(ev) {
        //ev.preventDefault();
        //console.log(ev);
        var a = ev.target.parentNode.parentNode;
        var tr = a.parentNode.parentNode.parentNode;
        if (a.attributes.hasOwnProperty('title')) {

            //console.log(a.attributes.title);
        var urlMethod = a.attributes.title.value;
        //if (a.hasAttribute('_method')) urlMethod = a.attributes._method.value;
        var urlAction = a.href;
        //console.dir(tr);
        //console.log(urlAction);

        if (urlMethod == 'delete') {
            ev.preventDefault();

            let JSalert = new Promise(function (resolve, reject) {
                swal({
                        title: "CANCELLAZIONE!",
                        text: "Intendi eseguire la cancellazione della determinazione?",
                        type: "warning",
                        showCancelButton: true,
                        //confirmButtonColor: "#DD6B55",
                        confirmButtonColor: "purple",
                        confirmButtonText: "SI, rimuovi determinazione!",
                        cancelButtonText: "NO, non sono sicuro!",
                        closeOnConfirm: false,
                        closeOnCancel: false
                    },
                    function (isConfirm) {
                        if (isConfirm) {
                            swal("Fatto!", "La determina è stata rimossa definitivamente!", "success");
                            eseguiCancellazione()
                        } else {
                            swal("No action!", "La determina non è stata rimossa!", "error");
                            return false;
                        }
                    });
            });

            // let exec = function(){
            //     JSalert().then(function(){
            //         alert(result)
            //     });
            // }
        }
    }
        function eseguiCancellazione (){
            var tokn = document.getElementsByTagName('meta').namedItem('_token').content;
            var ajaxCall = new XMLHttpRequest();
            var metodo = 'DELETE';

            ajaxCall.open(metodo, urlAction);
            ajaxCall.setRequestHeader("x-csrf-token", tokn);
            ajaxCall.send();
            ajaxCall.onreadystatechange = function () {
                if (ajaxCall.readyState == 4 && ajaxCall.status == 200) {
                    //console.log('INIZIO CHIAMATA AJAX');
                    var resp = ajaxCall.responseText;
                    //console.log(resp);
                    if(resp == 1){
                        if(urlMethod == 'delete')
                        {
                            tr.parentNode.removeChild(tr); //rimuove il nodo TR contenente il pulsante Cancella pigiato dall'utente
                        }
                    } else {
                        alert('Problem contacting server');
                    }
                }
            }
        }

});


})



