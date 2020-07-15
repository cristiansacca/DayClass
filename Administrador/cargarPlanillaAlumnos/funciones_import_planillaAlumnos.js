function comprobar(){
        if(document.addproduct.name.value ==""){
            alert("");
        }else{
            document.addproduct.importar.disabled=false;
        }
}

$('.custom-file-input').on('change', function() { 
    let fileName = $(this).val().split('\\').pop(); 
    $(this).next('.custom-file-label').addClass("selected").html(fileName); 
});