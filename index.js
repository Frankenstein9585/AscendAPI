const url = 'http://calapi.inadiutorium.cz/api/v0/en/calendars/default/today'
async function getData() {
    try{
        const response = await fetch(url);
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}


getData()
.then(data => {
    // insert DOM manipulation here
    console.log(data);
})