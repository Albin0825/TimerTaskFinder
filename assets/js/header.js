window.addEventListener("load", async (event) => { //sends a request to get all posts on load
    aTags = Array.from($('header').find('a'));
    for(let aTag of aTags) {
        if($(aTag).attr('href').indexOf(await funBaseUrl()) != -1) {
            $(aTag).addClass('active')
        }
    }
});