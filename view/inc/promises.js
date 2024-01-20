
function ajaxPromise(sUrl, sType, sTData, sData = undefined) {
    return new Promise((resolve, reject) => {        
        // console.log(sUrl);
        // console.log(sType);
        // console.log(sTData);
        // console.log(sData); //NO ESTA PASANDO ESTE CAMPO UNDEFINED  
        // alert('Has ENTRADO al ajaxprimomise');
        
        $.ajax({
            url: sUrl,
            type: sType,
            dataType: sTData,
            data: sData,

        }).done((data) => {
            // console.log('done' . data);
            // alert('Has salido del done');
            resolve(data);
        }).fail((jqXHR, textStatus, errorThrow) => {
            // console.log('fail' . textStatus);
            reject(errorThrow);
        }); 
    });
};


