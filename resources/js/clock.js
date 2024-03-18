// Calling showTime function at every second
setInterval(showTime, 1000);

// Defining showTime function
export function showTime() {
    // Getting current time and date
    let time = new Date();
    let hour = time.getHours(); // No change needed for 24-hour format
    let min = time.getMinutes();
    let sec = time.getSeconds();
    
    // Ensuring two-digit format for hour, minute, and second
    hour = hour < 10 ? "0" + hour : hour;
    min = min < 10 ? "0" + min : min;
    sec = sec < 10 ? "0" + sec : sec;

    // Creating currentTime string for 24-hour format
    let currentTime = hour + ":" + min + ":" + sec;

    // Displaying the time
    document.getElementById("clock").innerHTML = currentTime;
}

showTime();