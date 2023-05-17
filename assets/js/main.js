window.addEventListener("load", async (event) => { //sends a request to get all tasks when the page loads in
    funShowData()
});

$('body').on('click', 'td', async function(e) { //sends a request to show one task
    window.location.replace(`${await funBaseUrl()}task#id=${parseInt($(this).parent().attr('data-id'))}`)
})