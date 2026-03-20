
$('#filtri').submit(function(event){
    var str = $('#filtri').serialize();
    // console.log(str);
    var countSezioni = (str.match(/ddCompetenza/g) || []).length;
    var countAnno = (str.match(/ddAnno/g) || []).length;
    // console.log(countSezioni,countAnno );
    if (countSezioni > 1 && countAnno > 1) {    //se sono state selezionate NR_competenze>1 e NR_anni>1 non viene riprodotto il grafico
        let JSalert = new Promise(function (resolve, reject) {
            swal({
                title: "SELEZIONE NON CONSENTITA!",
                text: "Almeno una delle due scelte dev'essere singola",
                type: "warning",
                showCancelButton: false,
                //confirmButtonColor: "#DD6B55",
                confirmButtonColor: "purple",
                confirmButtonText: "OK, rimodulo la selezione",
                // cancelButtonText: "NO, non sono sicuro!",
                closeOnConfirm: true,
                // closeOnCancel: true
            });
        });
        return false;  //do not submit form the normal way
    }
});




