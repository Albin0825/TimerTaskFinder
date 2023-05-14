/**==================================================
 * 
 * @returns {String}
==================================================**/
function funBaseUrl(assets) {
    urlArray = window.location.pathname.split( '/' )
    indexOfSegment = urlArray.indexOf('index.php')+1
    return window.location.origin + urlArray.slice(0, indexOfSegment + (!assets ? 1 : -1)).join('/') + '/'
}



/**==================================================
 * 
 * @param {String} input 
 * @returns {String}
==================================================**/
function funSymbolsToSwitch(input) {
    converterType = 'Html'
    result = ''

    if(converterType == 'Html') {
        result = funSymbolsToHtml(input)
    } else {
        result = funSymbolsToUnicode(input)
    }

    return result
}

function funToSymbolsSwitch(input) {
    converterType = 'Html'
    result = ''

    if(converterType == 'Html') {
        result = funHtmlToSymbols(input)
    } else {
        result = funUnicodeToSymbols(input)
    }

    return result
}



/**==================================================
 * Html entries
==================================================**/
/**==================================================
 * if the string contains symbols they get convert to html entries
 * @param {String} input 
 * @returns {String}
==================================================**/
function funSymbolsToHtml(input) {
    return input.replace(/([\u{1F600}-\u{1F64F}\u{1F300}-\u{1F5FF}\u{1F680}-\u{1F6FF}\u{2600}-\u{26FF}\u{2700}-\u{27BF}\u{1F900}-\u{1F9FF}\u{1F1E0}-\u{1F1FF}])/gu, (match) => {
        const entity = `&#${match.codePointAt(0)};`;
        return entity;
    });
}

/**==================================================
 * if the string contains html entries they get convert to symbols
 * @param {String} input
 * @returns {String}
==================================================**/
function funHtmlToSymbols(input) {
    var textArea = document.createElement('textarea');
    textArea.innerHTML = input;
    return textArea.value;
}



/**==================================================
 * Unicode
==================================================**/
/**==================================================
 * if the string contains symbols they get convert to unicode characters
 * @param {String} input 
 * @returns {String}
==================================================**/
function funSymbolsToUnicode(input) {
    return input.replace(/([\u{1F600}-\u{1F64F}\u{1F300}-\u{1F5FF}\u{1F680}-\u{1F6FF}\u{2600}-\u{26FF}\u{2700}-\u{27BF}\u{1F900}-\u{1F9FF}\u{1F1E0}-\u{1F1FF}])/gu, (match) => {
        const unicode = `\\u{${match.codePointAt(0).toString(16)}}`;
        return unicode;
    });
}

/**==================================================
 * if the string contains unicode characters they get convert to symbols
 * @param {String} input 
 * @returns {String}
==================================================**/
function funUnicodeToSymbols(input) {
    return input.replace(/\\u\{([0-9A-Fa-f]+)\}/g, (match, group1) => {
        const symbol = String.fromCodePoint(parseInt(group1, 16));
        return symbol;
    });
}