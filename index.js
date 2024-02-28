const url = 'http://calapi.inadiutorium.cz/api/v0/en/calendars/default/today'
async function getData() {
    try {
        const response = await fetch(url);
        return await response.json();
    } catch (error) {
        console.error(error);
    }
}


getData()
    .then(data => {
        const litSeason = document.getElementById('lit_season');
        const litEventToday = document.getElementById('lit_event_today');
        const litColorToday = document.getElementById('lit_color_today');

        if (litSeason) {
            litSeason.innerText = `Liturgical Season: ${data.season}`;
        }
        if (litEventToday) {
            litEventToday.innerText = `${data.celebrations[0].title} [${data.date}]`;
        }
        if (litColorToday) {
            litColorToday.innerText = `Vestment Color: ${data.celebrations[0].colour}`;
            litColorToday.style.backgroundColor = data.celebrations[0].colour;
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });