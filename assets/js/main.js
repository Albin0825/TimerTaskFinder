window.addEventListener("load", async (event) => { //sends a request to get all posts on load
    funShowData()
});

$('body').on('click', 'td', async function(e) { //sends a request to show a post
    //does not show the post and sends a request to remove the post
    if($(e.target).hasClass('deleteBtn')) {
        await funData('delete', parseInt($(this).parent().attr('data-id')))
        return;
    }
    
    window.location.replace(`${await funBaseUrl()}task#${parseInt($(this).parent().attr('data-id'))}`)
})