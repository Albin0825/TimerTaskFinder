window.addEventListener("load", async (event) => {
    id    = parseInt(window.location.hash.substr(1, window.location.hash.length))
    title = ''
    description  = ''
    if(!isNaN(id)) {
        data        = await funData('show', id)
        title       = data[0].title
        description = data[0].description
        priority    = data[0].priority
    }
    document.querySelector('dialog').showModal()
    
    //editor title
    $('#title').val(funToSymbolsSwitch(title))

    //editor description
    CKEDITOR.replace('description', {
        toolbar: [
            { name: 'clipboard', items: [ 'Undo', 'Redo' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
            { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] }
        ]
    });
    CKEDITOR.instances['description'].setData(funToSymbolsSwitch(description));

    //editor priority
    $('#priority').val(priority)
});

$('dialog button#close, dialog button#saveAndClose').click(function() {
    window.location.hash = '!'
    window.location.pathname = window.location.pathname.substr(0, window.location.pathname.lastIndexOf('/'))
})

$('dialog button#save, dialog button#saveAndClose').click(function() {
    funsaveUpdate(id)
})