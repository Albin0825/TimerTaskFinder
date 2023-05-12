/**==================================================
 * 
 * @param {number} inputID - what task you are on
==================================================**/
async function funsaveUpdate(inputID) {
    method = isNaN(inputID) ? 'send'                              : 'update'
    id     = isNaN(inputID) ?  null                               :  inputID
    text   = isNaN(inputID) ? 'title, text and priority is empty' : 'you did not change anything'

    const date = new Date();
    standardizedDate = date.toISOString() //formats date to YYYY-MM-DDTHH:mm:ss.sssZ

    result = await funData(method, id, $('#title').val(), CKEDITOR.instances['description'].getData(), standardizedDate, $('#priority').val())
    if(result == false) {
        alert(`Failed to send.\n\nEther ${text} or it did not come through.`)
    }
}



/**==================================================
 * 
 * @param {Object} btn         - what btn you pressed on
 * @param {Number} id          - if you want to delete or update a element
 * @param {String} title       - if you want to add a element
 * @param {String} description - if you want to add a element
 * @returns {Boolean|Object}
==================================================**/
async function funData(whatfun, id, title, description, updateDate, priority) {
    if(title && description) {
        title       = await funSymbolsToHtml(title)
        description = await funSymbolsToHtml(description)
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${funBaseUrl()}index.php/main_controllers/${whatfun}Task`,
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
                <td>${element.title}</td>
                <td>${element.description.replace(/<\/?(p|ul|li)>/g, '').replace(/\n/g, '...')}</td>
                <td>${element.updateDate}</td>
                <td style="position:relative;"><img src="${funBaseUrl()}assets/img/x.svg" alt="" class="deleteBtn"></td>
            </tr>
        `)
    });
}