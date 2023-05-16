/**==================================================
 * 
 * @param {number} inputID - what task you are on
 * @returns {Boolean}
==================================================**/
async function funsaveUpdate(inputID) {
    method = isNaN(inputID) ? 'send'                              : 'update'
    id     = isNaN(inputID) ?  null                               :  inputID
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
    result = await funData(method, id, $('#title').val(), CKEDITOR.instances['description'].getData(), standardizedDate, priority)
    if(result == false) {
        alert(`Failed to send.\n\nEther ${text} or it did not come through.`)
    }
	return result
}



/**==================================================
 * 
 * @param {Object} btn         - what btn you pressed on
 * @param {Number} id          - if you want to delete or update a element
 * @param {String} title       - if you want to add/update a element
 * @param {String} description - if you want to add/update a element
 * @param {Number} priority    - if you want to add/update a element
 * @returns {Boolean|Object}   - boolean: insert, update and delete. object: select.
==================================================**/
async function funData(whatfun, id, title, description, updateDate, priority) {
    if(title && description) {
        title       = await funSymbolsToSwitch(title)
        description = await funSymbolsToSwitch(description)
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${funBaseUrl()}${whatfun}Task`,
            type: 'POST',
            data: {
                id          : id,
                title       : title,
                description : description,
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