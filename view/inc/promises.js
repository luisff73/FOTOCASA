
function ajaxPromise(sUrl, sType, sTData, sData = undefined) {

    return new Promise((resolve, reject) => {        
         //console.log(sUrl);
         //console.log(sType);
         //console.log(sTData);
         //console.log(sData); //NO ESTA PASANDO ESTE CAMPO UNDEFINED  
<<<<<<< HEAD
         //alert('Has ENTRADO al ajaxprimomise');
=======
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
        
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData,
            

        }).done((data) => {
<<<<<<< HEAD
            //alert('Has salido del done en el resolve');
            console.log("Luis respuesta del servidor en el promise: ", data);
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            //console.log(data)
            //console.log("Respuesta del servidor en el promise: ", jqXHR.responseText);
            //console.log("Respuesta del servidor en el promise: ", jqXHR.log);
            //alert('Error en la promesa ajax, en el resolve ' + jqXHR.responseText);
            // console.log('fail' . textStatus);
=======
            //console.log('AJAX call successful');
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            //console.log('AJAX call failed');
>>>>>>> d3de0469915f3e9ceeacbce45fd4b95057494b57
            reject(errorThrow);
        });
    });



};


