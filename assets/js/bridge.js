/**==================================================
 * 
 * @param {number} inputID - what task you are on
 * @returns {Boolean}
==================================================**/
async function funsaveUpdate(inputID, time) {
	method = isNaN(inputID) ? 'insert'                            : 'update'
    text   = isNaN(inputID) ? 'title, text and priority is empty' : 'you did not change anything'
	
    const date = new Date();
    standardizedDate = date.toISOString() //formats date to YYYY-MM-DDTHH:mm:ss.sssZ
	
    //positions
    var data = (await funData('priority'))[0]
    topPriority = parseInt(data.priority) + (parseInt(data.priority) == 0 ? 10 : 0)
    switch ($('#priority').val()) {
        case 'top':
            priority = topPriority + 10
            break;
        case 'high':
            priority = topPriority / 4 * 3
            break;
        case 'medium':
            priority = topPriority / 4 * 2
            break;
        case 'low':
            priority = topPriority / 4 * 1
            break;
        default:
            priority = 0
            break;
    }

	/**==================================================
	 * verify if user or project exist
	==================================================**/
	if(await funBaseUrl().split('/').find(element => element.includes('controllers')) == 'project_controllers') {
		connectionType = 'verifyUser';
	} else {
		connectionType = 'getOne';
	}

	formatedData = {
		id: parseInt($('#connection').val()) // project: userID | task: projectID
	}

	connection = await funData(connectionType, formatedData)
	if(connection == false) {
		return false
	}
	
    /**==================================================
	 * inserts or updates data
	==================================================**/
	formatedData = {
		moduleID    : parseInt($('#connection').val()), // project: userID | task: projectID
		id          : inputID, //projectID or taskID
		title       : $('#title').val(),
		description : CKEDITOR.instances['description'].getData(),
		eta         : $('#eta').val(),
		time        : $('#time').val(),
		updateDate  : standardizedDate,
		priority    : priority,
		addedHours  : parseInt($('#time').val()) - time
	}
    result = await funData(method, formatedData)
    if(result == false) {
        alert(`Failed to send.\n\nEther ${text} or it did not come through.`)
    }
	return result
}



/**==================================================
 * 
 * @param {String} whatfun      - witch function you want to go to for example, get, getOne, insert
 * @param {Object} formatedData - all elemets that is needed to do the task
 * @returns {Boolean|Object}   - boolean: insert, update and delete. object: select.
==================================================**/
async function funData(whatfun, formatedData = {}) {
	formatedData['module'] = await funBaseUrl().split('/').find(element => element.includes('controllers')).split('_')[0]
    if(formatedData && formatedData['title'] && formatedData['description']) {
        formatedData['title']       = await funSymbolsToSwitch(formatedData['title'])
        formatedData['description'] = await funSymbolsToSwitch(formatedData['description'])
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${funBaseUrl()}${whatfun}`,
            type: 'POST',
            data: {formatedData},
            success: function (data) {
                if(typeof JSON.parse(data) == 'boolean') {
                    if(JSON.parse(data) == true) {
                        funShowData()
                    }
                    resolve(JSON.parse(data))
                } else if(typeof JSON.parse(data) == 'object') {
                    resolve(JSON.parse(data))
                } else {
                    alert('Not type of object or boolean')
                    reject()
                }
            },
            error: function () {
                alert('Something when wrong trying to do the request')
                reject()
            }
        })
    })
}



/**==================================================
 * 
==================================================**/
async function funShowData() {
    var data = await funData('get')
    //resets the table so there are only a header
    tableTitle = $('table').find('tr').eq(0)
    $('table').children().empty()
    $('table').children().append(tableTitle)
    
    //adds the rows
    data.forEach(element => {
        $('table').children().append(`
            <tr data-id="${element.id}">
                <td>${element.id}</td>
                <td>${funToSymbolsSwitch(element.title)}</td>
                <td>${funToSymbolsSwitch(element.description.replace(/<\/?\w+(\s[^>]*)?>/g, ''))}</td>
                <td>${element.time}</td>
                <td>${element.eta}</td>
                <td>${element.updateDate}</td>
            </tr>
        `)
    });
}