window.addEventListener("load", async (event) => {
    id   = await parseInt(getHashQuery('id'))
    var data = {
		title: '',
		description: ''
	}
    if(!isNaN(id)) {
		/**==================================================
		 * gets project/task information
		==================================================**/
		data = (await funData('getOne', null, id))[0]
		
		/**==================================================
		 * gets parent information (project/user)
		==================================================**/
		if(await funBaseUrl().split('/').find(element => element.includes('controllers')) == 'project_controllers') {
			result = (await funData('getUserByProject', null, id))[0]
			data['connection'] = result.userID
		} else {
			result = (await funData('getProjectByTask', null, id))[0]
			data['connection'] = result.projectID
		}
    } else {
        $('#saveAndClose').text('Create And Close')
        $('#save').text('Create')
    }

	if(await funBaseUrl().split('/').find(element => element.includes('controllers')) == 'task_controllers') {
		$('#connection').attr("placeholder", "ProjectID")
	}
	console.log(data)
	/**==================================================
	 * changes the color and width of the progress bar
	==================================================**/
	timePutIn = data['time']/data['eta']*100
	timePutIn = (timePutIn < 100) ? timePutIn : 100
	if(timePutIn >= 75) {
		$(':root').css('--clr-progressBar', '#FF6861')
	} else if(timePutIn >= 50) {
		$(':root').css('--clr-progressBar', '#FFB33F')
	} else if(timePutIn >= 25) {
		$(':root').css('--clr-progressBar', '#FFD426')
	}
	$('#progressBar').css('width', `${timePutIn}%`)

/**====================================================================================================
 * editors
====================================================================================================**/
	/**==================================================
	 * editor connection (customarID or projectID)
	==================================================**/
    $('#connection').val(data['connection'])

	/**==================================================
	 * editor title
	==================================================**/
    $('#title').val(funToSymbolsSwitch(data['title']))
	
	/**==================================================
	 * editor time
	==================================================**/
	$('#time').val(data['time'])
	
	/**==================================================
	 * editor eta (estimated time of arrival)
	==================================================**/
	$('#eta').val(data['eta'])

	/**==================================================
	 * editor description
	==================================================**/
    CKEDITOR.replace('description', {
		toolbar: [
			{ name: 'clipboard', items: [ 'Undo', 'Redo' ] },
            { name: 'basicstyles', items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript' ] },
            { name: 'paragraph', groups: [ 'list', 'indent' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent' ] }
        ]
    });
    CKEDITOR.instances['description'].setData(funToSymbolsSwitch(data['description']));
	
	/**==================================================
	 * editor priority
	==================================================**/
    $('#priority').val('')
    
	document.querySelector('dialog').showModal()
});



/**==================================================
 * Buttons
==================================================**/
$('dialog button#delete').click(async function() {
	CloseResult(await funData('delete', null, id))
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