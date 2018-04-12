$(function() {
    let token = localStorageService.get(localStorageService.USER_TOKEN);
    axios.defaults.baseURL = localStorageService.baseURL;
    axios.defaults.headers.common['Authorization'] = "Bearer ";
    // axios.defaults.headers.common['Content-Type'] = 'application/json';
    if (token) {
        $("#user").text(localStorageService.get(localStorageService.USER_KEY));
        axios.get("empresa?token=" + token, $(this).serialize()).then(function(response) {
            console.log(response.data);
            console.log(response.status);
            console.log(response.headers);
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
    }
})