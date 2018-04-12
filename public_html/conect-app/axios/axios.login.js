$(function() {
    axios.defaults.baseURL = localStorageService.baseURL;
    axios.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded';
    console.log(AUTH_TOKEN);
    $('form[name="logar"').submit(function(e) {
        axios.post($(this).attr('action'), $(this).serialize()).then(function(response) {
            localStorageService.set(localStorageService.USER_KEY, response.data.user);
            localStorageService.set(localStorageService.USER_TOKEN, response.data.token);
            console.log(response.data);
            console.log(response.status);
            console.log(response.headers);
            window.location.href = "http://localhost:8080/empresa.php";
        }).catch(function(error) {
            if (error.response) {
                // The request was made and the server responded with a status code
                // that falls out of the range of 2xx
                console.log(error.response.data);
                console.log(error.response.status);
                console.log(error.response.headers);
            } else if (error.request) {
                // The request was made but no response was received
                // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                // http.ClientRequest in node.js
                console.log(error.request);
            } else {
                // Something happened in setting up the request that triggered an Error
                console.log('Error', error.message);
            }
            console.log(error.config);
        });
        return false;
    })
})