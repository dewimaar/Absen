function updateDateTime() {
    var currentDateTimeElement = document.getElementById('currentDateTime');
    var currentDateTime = new Date().toLocaleString('id-ID', {
        weekday: 'long',
        day: 'numeric',
        month: 'long',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
    }).replace('pukul ', '');
    currentDateTimeElement.textContent = currentDateTime;
}

setInterval(updateDateTime, 1000);

updateDateTime();