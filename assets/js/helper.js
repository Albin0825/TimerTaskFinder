/**==================================================
 * 
 * @returns {String}
==================================================**/
function funBaseUrl(assets) {
    urlArray = window.location.pathname.split( '/' )
    indexOfSegment = urlArray.indexOf('index.php')+1

    //if you are not in a controller it forces you into a controller
    if(urlArray[urlArray.indexOf('index.php')+1] == '') {
        window.location.replace(window.location.origin + urlArray.slice(0, urlArray.indexOf('timertaskfinder')+1).join('/') + '/' + 'index.php/task_controllers')
    }

    return window.location.origin + urlArray.slice(0, indexOfSegment + (!assets ? 1 : -1)).join('/') + '/'
}



/**==================================================
 * 
 * @param {String} name - witch part of the hash you want to get
 * @returns {String}
==================================================**/
function getHashQuery(name) {
    return new URLSearchParams(window.location.hash.slice(1)).get(name)
}



/**==================================================
 * Switches between HTML entries and Unicode (encoding)
 * @param {String} input 
 * @returns {String}
==================================================**/
function funSymbolsToSwitch(input) {
    converterType = 'Html' // 'Html' / 'Unicode' / ''
    result = ''

    if(converterType == 'Html') {
        result = funSymbolsToHtml(input)
    } else if(converterType == 'Unicode') {
        result = funSymbolsToUnicode(input)
    } else {
        return input
    }

    return result
}

/**==================================================
 * Switches between HTML entries and Unicode (decoding)
 * @param {String} input 
 * @returns {String}
==================================================**/
function funToSymbolsSwitch(input) {
    converterType = 'Html' // 'Html' / 'Unicode' / ''
    result = ''

    if(converterType == 'Html') {
        result = funHtmlToSymbols(input)
    } else if(converterType == 'Unicode') {
        result = funUnicodeToSymbols(input)
    } else {
        return input
    }

    return result
}



/**==================================================
 * HTML entries
 ** kompatibla med alla webbläsare och enheter, även de som kanske inte fullt ut stöder unicode
 * \u{1F600}-\u{1F64F} 😃 😭
 * \u{1F300}-\u{1F5FF} 🌍 💡
 * \u{1F680}-\u{1F6FF} 🚗 🗺️
 * \u{2600}-\u{26FF}   ☀️ ☂️
 * \u{2700}-\u{27BF}   ✂️ ✉️
 * \u{1F900}-\u{1F9FF} 🦄 🦖
 * \u{1F1E0}-\u{1F1FF} 🇺🇸 🇬🇧
==================================================**/
/**==================================================
 * if the string contains symbols they get convert to HTML entries
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
 * if the string contains HTML entries they get convert to symbols
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
 ** Stöder alla språk och teck
 ** Tar upp mindre utrymme en HTML-entries
 * \u{1F600}-\u{1F64F} 😃 😭
 * \u{1F300}-\u{1F5FF} 🌍 💡
 * \u{1F680}-\u{1F6FF} 🚗 🗺️
 * \u{2600}-\u{26FF}   ☀️ ☂️
 * \u{2700}-\u{27BF}   ✂️ ✉️
 * \u{1F900}-\u{1F9FF} 🦄 🦖
 * \u{1F1E0}-\u{1F1FF} 🇺🇸 🇬🇧
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