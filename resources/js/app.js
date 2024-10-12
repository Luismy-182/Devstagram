import Dropzone from "dropzone";

Dropzone.autoDiscover =false;


const dropzone=new Dropzone("#dropzone",{
    dictDefaultMessage: "Sube tu imagen aquí",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Eliminar Imagen",
    maxFiles: 1,
    uploadMultiple:false,

    init:function(){
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada={};
            imagenPublicada.size=1234; //el valor no importa, solo es obligatorio para usar la funcion
            imagenPublicada.name=document.querySelector('[name="imagen"]').value;


            this.options.addedfile.call(this, imagenPublicada); //algo mas de dropzone
            this.options.thumbnail.call(this, imagenPublicada, `/uploads/${imagenPublicada.name}`);


            imagenPublicada.previewElement.classList.add(
                "dz-sucess",
                "dz-complete"
            );

        }
    }


});

//funciones de dropzone

dropzone.on("sending", function (file, xhr, formData){
    console.log(formData);
});

dropzone.on("success", function(file, response){
    console.log(response);
    document.querySelector('[name="imagen"]').value=response.imagen;
});

dropzone.on("error", function(file, message){
    console.log(message);
});

dropzone.on("removedfile", function(){
    document.querySelector('[name="imagen"]').value='';
});