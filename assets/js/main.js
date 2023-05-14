window.addEventListener("load", (event) => { //sends a request to get all posts on load
    funShowData()
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