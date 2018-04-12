let localStorageService = {
    USER_KEY: "user",
    USER_TOKEN: "token",
    baseURL: 'https://app.gerencia.pet/api/',
    set(key, value) {
        window.localStorage[key] = value;
    },
    get(key, defaultValue = null) {
        return window.localStorage[key] || defaultValue;
    },
    setObject(key, value) {
        window.localStorage[key] = JSON.stringify(value);
    },
    getObject(key) {
        return JSON.parse(window.localStorage.getItem(key));
    },
    remove(key) {
        window.localStorage.removeItem(key);
    }
}