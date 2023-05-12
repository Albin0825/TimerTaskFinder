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
 * if the string contains symbols and do not convert them automatically
 * @param {String} input
 * @returns {String}
==================================================**/
function funHtmlToSymbols(input) {
    var textArea = document.createElement('textarea');
    textArea.innerHTML = input;
    return textArea.value;
}