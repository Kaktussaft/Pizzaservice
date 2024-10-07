const API_BASE_URL = 'http://localhost/Pizzaservice';

async function request(url, options) {
    const token = localStorage.getItem('token');
    const headers = {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${token}`,
        ...options.headers,
    };

    const response = await fetch(`${API_BASE_URL}${url}`, {
        ...options,
        headers,
    });

    if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || 'Something went wrong');
    }

    return response.json();
}

export function get(url) {
    return request(url, {
        method: 'GET',
    });
}

export function post(url, data) {
    return request(url, {
        method: 'POST',
        body: JSON.stringify(data),
    });
}

export function put(url, data) {
    return request(url, {
        method: 'PUT',
        body: JSON.stringify(data),
    });
}

export function del(url) {
    return request(url, {
        method: 'DELETE',
    });
}


import { get, post, put, del } from './api';

// Example GET request
get('/endpoint')
    .then(data => console.log(data))
    .catch(error => console.error(error));

// Example POST request
post('/endpoint', { key: 'value' })
    .then(data => console.log(data))
    .catch(error => console.error(error));

// Example PUT request
put('/endpoint', { key: 'newValue' })
    .then(data => console.log(data))
    .catch(error => console.error(error));

// Example DELETE request
del('/endpoint')
    .then(data => console.log(data))
    .catch(error => console.error(error));