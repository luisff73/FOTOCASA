
function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {        
         console.log(sUrl);
         console.log(sType);
         console.log(sTData);
         //console.log(sData); //NO ESTA PASANDO ESTE CAMPO UNDEFINED  
        
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData,

        }).done((data) => {
            console.log('AJAX call successful');
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            console.log('AJAX call failed');
            reject(errorThrow);
        });
    });
};


