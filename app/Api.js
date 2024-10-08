function backendCall(controller, method, data) {
    const payload = {
        controller: controller,
        method: method,
    };

    if (data !== null) {
        payload.data = data;
    }

    fetch("ApiController", {
        method: "POST",
        headers: {
            "Content-Type": "application/json; charset=utf-8",
        },
        body: JSON.stringify(payload)
    })
    .then(response => {
        if (response.redirected) {
            window.location.href = response.url;
            return;
        }
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); 
    })
    .then(text => {
        try {
            const data = JSON.parse(text); 
            return data; 
        } catch (error) {
            console.error('Error parsing JSON:', error);
            console.error('Raw response text:', text); 
            throw error; 
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
        throw error;
    });
}

