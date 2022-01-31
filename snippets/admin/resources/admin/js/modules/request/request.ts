
function request(url, options = {}) {
    const token = (<HTMLInputElement>document.querySelector('input[name="_token"]')).value;
    const headers = {
        "Content-Type": "application/json",
        "Accept": "application/json",
        "X-Requested-With": "XMLHttpRequest",
        "X-CSRF-TOKEN": token
    };

    return fetch(url, { headers, ...options });
}

const get = (url, options = {}) => request(url, { ...options, method: 'GET'});
const put = (url, options = {}) => request(url, { ...options, method: 'PUT'});
const post = (url, options = {}) => request(url, { ...options, method: 'POST'});
const del = (url, options = {}) => request(url, { ...options, method: 'DELETE'});

export { request, post, get, put, del };