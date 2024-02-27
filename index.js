function dateToUnixTime() {
    const date = new Date();
    date.setHours(0);
    date.setMinutes(0);
    date.setSeconds(0);
    date.setMilliseconds(0);

    return Math.floor(date.getTime() / 1000) + 3600;
}

function getCurrentYear(timestamp) {
    const date = new Date(timestamp * 1000)

    return date.getFullYear();
}

const currentYear = getCurrentYear(dateToUnixTime());

const url = `https://litcal.johnromanodorazio.com/api/v3/LitCalEngine.php?year=${currentYear}&epiphany=SUNDAY_JAN2_JAN8&ascension=SUNDAY&corpusChristi=SUNDAY&locale=en_NG&returntype=JSON`;

async function getData() {
    try{
        const response = await fetch(url);
        const data = await response.json();
        return data.LitCal;
    } catch (error) {
        console.error(error);
    }
}


getData()
.then(data => {
    const todaysDate = dateToUnixTime();
    let todaysLiturgy = [];
    Object.keys(data).forEach((key => {
       if (data[key].date === todaysDate) {
           todaysLiturgy.push(data[key]);
       }
    }));
    console.log(todaysLiturgy);
})