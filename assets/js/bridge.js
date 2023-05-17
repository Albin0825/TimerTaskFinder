/**==================================================
 * 
 * @param {number} inputID - what task you are on
 * @returns {Boolean}
==================================================**/
async function funsaveUpdate(inputID) {
    method = isNaN(inputID) ? 'insert'                            : 'update'
    text   = isNaN(inputID) ? 'title, text and priority is empty' : 'you did not change anything'

    const date = new Date();
    standardizedDate = date.toISOString() //formats date to YYYY-MM-DDTHH:mm:ss.sssZ

    //positions
    let data = await funData('priority')
    topPriority = parseInt(data[0].priority)
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

    //send or update data

	//request
	//* if update {
	//      ID
	//* }
	// title
	// description
	// eta
	// time
	// updateDate
	// priority
	//* if insert {
	//      moduleID
	//      secModuleID
	//* }
    result = await funData(method, inputID, $('#title').val(), CKEDITOR.instances['description'].getData(), standardizedDate, priority)
    if(result == false) {
        alert(`Failed to send.\n\nEther ${text} or it did not come through.`)
    }
	return result
}



/**==================================================
 * 
 * @param {Object} btn         - what btn you pressed on
 * @param {String} moduleID    - taskID or projectID
 * @param {String} secModuleID - projectID or userID
 * @param {Number} id          - used if you want to get one/update/delete a task
 * @param {String} title       - ┐
 * @param {String} description - ┤
 * @param {String} eta         - ┤
 * @param {String} time        - ┤
 * @param {Number} updateDate  - ┤
 * @param {Number} priority    - ┴ used if you want to insert/update a task
 * @returns {Boolean|Object}   - boolean: insert, update and delete. object: select.
==================================================**/
async function funData(whatfun, moduleID, secModuleID, id, title, description, eta, time, updateDate, priority) {
    if(title && description) {
        title       = await funSymbolsToSwitch(title)
        description = await funSymbolsToSwitch(description)
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${funBaseUrl()}${whatfun}`,
            type: 'POST',
            data: {
                moduleID    : moduleID,
                secModuleID : secModuleID,
                id          : id,
                title       : title,
                description : description,
                eta         : eta,
                time        : time,
                updateDate  : updateDate,
                priority    : priority
            },
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
    data = await funData('get')
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
                <td>${funToSymbolsSwitch(element.description.replace(/<\/?(p|ul|li)>/g, '').replace(/\n/g, '...'))}</td>
                <td>${element.eta}</td>
                <td>${element.time}</td>
                <td>${element.updateDate}</td>
            </tr>
        `)
    });
}