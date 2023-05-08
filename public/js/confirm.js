 function confirm(form, title ="¿Desea eliminar el elemento?", icon='question' ) {
    Swal
    .fire({
        text: title,
        icon: icon,
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "Cancelar",
    })
    .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
            
            $('#'+form).submit();
          
        } else {
           // 
           console.log("*no se elimina la venta*");
        }
    });
}
