function formCheck(formArray,form = null) {
    //serialize data function
    var result = false;
    for (var i = 0; i < formArray.length; i++){
        // returnArray[formArray[i]['name']] = formArray[i]['value'];
        if(formArray[i]['name'] != 'password'){
            if(formArray[i]['value'] == '' || formArray[i]['value'] == null){
                $('input[name="'+formArray[i]['name']+'"]').addClass('input-danger');
                $('input[name="'+formArray[i]['name']+'"]').siblings("small").remove();
                $('input[name="'+formArray[i]['name']+'"]').after('<small class="text-danger">Mohon ini di isi </small>');
                result = false;
            }else{
                $('input[name="'+formArray[i]['name']+'"]').removeClass('input-danger');
                $('input[name="'+formArray[i]['name']+'"]').siblings("small").remove();
                result = true;
            }
        }
        
        
    }
    if(form != null){
        var select = form.find("select");
        var textarea = form.find("textarea");
        for (var i = 0; i < select.length; i++){
            if(select[i].value == 'default'){
                $('select[name="'+select[i].name+'"]').addClass('input-danger');
                $('select[name="'+select[i].name+'"]').siblings().remove();
                $('select[name="'+select[i].name+'"]').after('<small class="text-danger">Mohon ini di isi </small>');
                result = false;
            }else{
                $('select[name="'+select[i].name+'"]').removeClass('input-danger');
                $('select[name="'+select[i].name+'"]').siblings().remove();
                result = true;
            }
        }
        for (var j = 0; j < textarea.length; j++){
            if(textarea[i]['value'] == '' || textarea[i]['value'] == null){
                $('textarea[name="'+textarea[j]['name']+'"]').addClass('input-danger');
                $('textarea[name="'+textarea[j]['name']+'"]').siblings("small").remove();
                $('textarea[name="'+textarea[j]['name']+'"]').after('<small class="text-danger">Mohon ini di isi </small>');
                result = false;
            }else{
                $('textarea[name="'+textarea[j]['name']+'"]').removeClass('input-danger');
                $('textarea[name="'+textarea[j]['name']+'"]').siblings("small").remove();
                result = true;
            }
        }

    }
    return result;
}

function generateKey(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}


// $('#inputFile1').click(function(event) {

//     $('#inputFileImport').click();
// });
// $('#inputFile1').on('input', function(event) {

//     $('#inputFileImport').click();

// });
// $('#inputFile2').click(function(event) {
//     $('#inputFileImport').click();
// });
// $('#inputFileImport').change(function(event) {
//     var file = $(this);
//     var files_obj = file[0].files;
//     var file_name = files_obj[0].name;
//     $('#inputFile1').val(file_name);
// });



  