
document.addEventListener('DOMContentLoaded', function() {
    var pp = document.getElementById('perPage');
    pp.addEventListener('click', function(ppe) {
        ppe.preventDefault();
        var ppNumber = ppe.target.innerText;
        if (!isNaN(ppNumber)) {
            console.dir(ppNumber);
            var ajCall = new XMLHttpRequest();
            var urlAction = location.protocol+"//"+location.host +"/gestione/setperpage/"+ppNumber;
            ajCall.open('GET', urlAction);
            ajCall.send();
            ajCall.onreadystatechange = function () {
                if (ajCall.readyState == 4 && ajCall.status == 200) {
                    console.log('INIZIO CHIAMATA AJAX');
                    var resp = ajCall.responseText;
                    if(resp){
                        window.location.replace(location.pathname);
                    }else{
                        alert('Problem contacting server');
                    }
                }
            }
        }
    });
})



