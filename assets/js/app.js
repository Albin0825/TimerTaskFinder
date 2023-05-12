window.addEventListener("load", (event) => { //sends a request to get all posts on load
    funShowData()
});

$('header input[type="submit"]').click(function(e) {
    e.preventDefault();

    window.location.pathname = `${funBaseUrl()}index.php/main_controllers/task`
});

$('body').on('click', 'td', async function(e) { //sends a request to show a post
    //does not show the post and sends a request to remove the post
    if($(e.target).hasClass('deleteBtn')) {
        result = await funData('delete', parseInt($(this).parent().attr('data-id')))
        if(result) {
            funShowData()
        }
        return;
    }
    
    window.location.replace(`${funBaseUrl()}index.php/main_controllers/task#${parseInt($(this).parent().attr('data-id'))}`)
})



/**==================================================
 * 
 * @returns {String}
==================================================**/
function funBaseUrl() {
    segment = 'index.php'
    pathArray = window.location.pathname.split( '/' )
    indexOfSegment = pathArray.lastIndexOf(segment)
    return window.location.origin + pathArray.slice(0,indexOfSegment).join('/') + '/'
}



/**==================================================
 * 
 * @param {Object} btn   - what btn you pressed on
 * @param {Number} id    - if you want to delete or update a element
 * @param {String} title - if you want to add a element
 * @param {String} text  - if you want to add a element
 * @returns {Boolean|Object}
==================================================**/
async function funData(whatfun, id, title, text, updateDate, priority) {
    if(title && text) {
        title = await funSymbolsToHtml(title)
        text  = await funSymbolsToHtml(text)
    }
    return new Promise((resolve, reject) => {
        $.ajax({
            url: `${funBaseUrl()}index.php/main_controllers/${whatfun}Task`,
            type: 'POST',
            data: {
                id:    id,
                title: title,
                text:  text,
                updateDate: updateDate,
                priority: priority
            },
            success: function (data) {
                if(typeof JSON.parse(data) == 'boolean') {
                    resolve(JSON.parse(data))
                } else if(typeof JSON.parse(data) == 'object') {
                    resolve(JSON.parse(data))
                } else {
                    alert('Not type of object or true')
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
                <td>${element.text.replace(/<\/?(p|ul|li)>/g, '').replace(/\n/g, '...')}</td>
                <td>${element.updateDate}</td>
                <td style="position:relative;"><img src="${funBaseUrl()}assets/img/x.svg" alt="" class="deleteBtn"></td>
            </tr>
        `)
    });
}



/**==================================================
 * 
 * @param {String} input 
 * @returns {String}
==================================================**/
function funSymbolsToHtml(input) {
    return input.replace(/([\u{1F600}-\u{1F64F}\u{1F300}-\u{1F5FF}\u{1F680}-\u{1F6FF}\u{2600}-\u{26FF}\u{2700}-\u{27BF}\u{1F900}-\u{1F9FF}\u{1F1E0}-\u{1F1FF}])+/gu, (match) => {
        const entity = `&#${match.codePointAt(0)};`;
        return entity;
    });
}



/**==================================================
 * 
==================================================**/
async function funsaveUpdate() {
    method = isNaN(id) ? 'send'                    : 'update'
    id     = isNaN(id) ?  null                     : id
    text   = isNaN(id) ? 'title and text is empty' : 'you did not change anything'

    const date = new Date();
    standardizedDate = date.toISOString() //formats date to YYYY-MM-DDTHH:mm:ss.sssZ

    result = await funData(method, id, $('#title').val(), CKEDITOR.instances['text'].getData(), standardizedDate, $('#priority').val())
    if(result == false) {
        alert(`Failed to send.\n\nEther ${text} or it did not come through.`)
    }
}



/**==================================================
 * 
 * @param {String} html 
 * @returns {String}
==================================================**/
function funDecodeHtml(html) {
    var textArea = document.createElement('textarea');
    textArea.innerHTML = html;
    return textArea.value;
}