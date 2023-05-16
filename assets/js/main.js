window.addEventListener("load", async (event) => { //sends a request to get all posts on load
    funShowData()
});

$('body').on('click', 'td', async function(e) { //sends a request to show a post
    window.location.replace(`${await funBaseUrl()}task#id=${parseInt($(this).parent().attr('data-id'))}`)
})