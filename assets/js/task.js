window.addEventListener("load", async (event) => {
    id          = await parseInt(getHashQuery('id'))
    title       = ''
    description = ''
    if(!isNaN(id)) {
        data        = (await funData('getOne', null, null, id))[0]
        title       = data.title
        description = data.description
        eta         = data.eta
        time        = data.time
        priority    = data.priority
    } else {
        $('#saveAndClose').text('Create And Close')
        $('#save').text('Create')
    }

	if(await funBaseUrl().split('/')[6] == 'project_controllers') {
		$('#projectID').prop('disabled', 'true')
		$('#projectID').css('filter', 'brightness(0.75)')
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

    //time priority
    $('#time').val(time)

    //eta priority
    $('#eta').val(eta)
    
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