
document.addEventListener('DOMContentLoaded', function() {
    var azioni = document.getElementById('dd-table');
    //catturo l'evento 'onclick' col costrutto addEventListener
    azioni.addEventListener('click', function(ev) {
        //ev.preventDefault();
        var a = ev.target.parentNode.parentNode;
        var tr = a.parentNode.parentNode.parentNode;
        var urlMethod = a.attributes.title.value;

        var urlAction = a.href;
        //console.dir(tr);
        //console.log(urlAction);
        //console.log(urlMethod);

        if (urlMethod == 'delete') {
            ev.preventDefault();

            let JSalert = new Promise(function(resolve, reject){
                swal({  title: "CANCELLAZIONE!",
                        text: "Intendi eseguire la cancellazione della competenza?",
                        type: "warning",
                        showCancelButton: true,
                        //confirmButtonColor: "#DD6B55",
                        confirmButtonColor: "purple",
                        confirmButtonText: "SI, rimuovi competenza!",
                        cancelButtonText: "NO, non sono sicuro!",
                        closeOnConfirm: false,
                        closeOnCancel: false },
                    function(isConfirm){
                        if (isConfirm)
                        {
                            swal("Fatto!", "La competenza è stata rimossa definitivamente!", "success");
                            eseguiCancellazione ();
                        }
                        else {
                            swal("No action!", "La competenza non è stata rimossa!", "error");
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
                        if(urlMethod == 'delete') tr.parentNode.removeChild(tr); //rimuove il nodo TR contenente il pulsante Cancella pigiato dall'utente
                    } else {
                        alert('Problem contacting server');
                    }
                }
            }
        }

});
})



