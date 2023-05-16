window.addEventListener("load", async (event) => {
    id          = await parseInt(getHashQuery('id'))
    title       = ''
    description = ''
    if(!isNaN(id)) {
        data        = (await funData('show', id))[0]
        title       = data.title
        description = data.description
        priority    = data.priority
    } else {
        $('#saveAndClose').text('Create And Close')
        $('#save').text('Create')
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



/**==================================================
 * Buttons
==================================================**/
$('dialog button#delete').click(async function() {
	CloseResult(await funData('delete', id))
})

$('dialog button#close').click(function() {
	CloseResult(true)
})

$('dialog button#saveAndClose').click(async function() {
	CloseResult(await funsaveUpdate(id))
})

$('dialog button#save').click(function() {
	funsaveUpdate(id)
})



/**==================================================
 * Buttons
 * @param {Boolean} result - if the save/creation of the task/project did go through
==================================================**/
async function CloseResult(result) {
	if(result) {
        window.location.replace(await funBaseUrl())
    }
}