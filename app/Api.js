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
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text(); // Get the raw response text
    })
    .then(text => {
        try {
            const data = JSON.parse(text); // Attempt to parse the JSON
            console.log(data);
        } catch (error) {
            console.error('Error parsing JSON:', error);
            console.error('Raw response text:', text); // Log the raw response text
        }
    })
    .catch(error => {
        console.error('There was a problem with the fetch operation:', error);
    });
}
