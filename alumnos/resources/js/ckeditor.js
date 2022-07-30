window.addEventListener("load", function(event) {

    document.querySelectorAll(".ckeditor").forEach((ckeditorInput) => {
        ClassicEditor
            .create(ckeditorInput, {
                toolbar: [
                    'heading',
                    'bold',
                    'italic',
                    'undo',
                    'redo',
                    'numberedList',
                    'bulletedList',
                ]
            })
            .then( instance => {
                CKEDITOR = instance;
            } )
            .catch(error => {
                console.error(error);
            });
    })


});