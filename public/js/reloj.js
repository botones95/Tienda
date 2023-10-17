
document.addEventListener('DOMContentLoaded', function () {
    function updateDigitalClock() {
        const dateElement = document.getElementById("date");
        const digitalClock = document.getElementById("digital-clock");
        const now = new Date();
        const hours = now.getHours().toString().padStart(2, "0");
        const minutes = now.getMinutes().toString().padStart(2, "0");
        const seconds = now.getSeconds().toString().padStart(2, "0");
        const dateString = `${now.getDate()}/${(now.getMonth() + 1).toString().padStart(2, "0")}/${now.getFullYear()}`;
        const timeString = `${hours}:${minutes}:${seconds}`;
        dateElement.textContent = dateString;
        digitalClock.textContent = timeString;
    }
    
    // Actualiza el reloj digital y la fecha cada segundo
    setInterval(updateDigitalClock, 1000);
    
    // Llama a la función para establecer el reloj digital y la fecha inicialmente
    updateDigitalClock();
});

