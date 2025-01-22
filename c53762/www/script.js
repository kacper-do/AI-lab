const API_KEY = "7e0c56570acb6c1c1cfccbf535349272";
const weatherUrlBase = "https://api.openweathermap.org/data/2.5/weather?";
const forecastUrlBase = "https://api.openweathermap.org/data/2.5/forecast?";

document.getElementById("get-weather").addEventListener("click", function () {
    const city = document.getElementById("city-input").value;
    if (city) {
        getCurrentWeather(city);
        getWeatherForecast(city);
    } else {
        alert("Proszę wpisać nazwę miejscowości.");
    }
});

function getCurrentWeather(city) {
    const url = `${weatherUrlBase}q=${city}&appid=${API_KEY}&units=metric&lang=pl`;
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = () => {
        if (xhr.status === 200) {
            const data = JSON.parse(xhr.responseText);
            console.log(data);
            displayCurrentWeather(data);
        } else {
            console.log("Błąd podczas ładowania pogody:", xhr.status);
            document.getElementById("weather-result").innerHTML = "Błąd wczytanie pogody.";
        }
    };
    xhr.onerror = () => {
        console.log("Błąd połączenie API");
        document.getElementById("weather-result").innerHTML = "Błąd podczas żądania.";
    };
    xhr.send();
}


function getWeatherForecast(city) {
    const url = `${forecastUrlBase}q=${city}&appid=${API_KEY}&units=metric&lang=pl`;

    fetch(url)
        .then(response => {
            if (!response.ok) {
                throw new Error("Błąd w pogodzie 5 dni.");
            }
            return response.json();
        })
        .then(data => {
            console.log("Odpowiedź prognozy pogody:", data);
            displayForecast(data);
        })
        .catch(error => {
            document.getElementById("weather-result").innerHTML += "<p>Błąd w pobieraniu pogody.</p>";
        });
}


function displayCurrentWeather(data) {
    const weatherResult = document.getElementById("weather-result");
    const temperature = data.main.temp;
    const description = data.weather[0].description;
    const cityName = data.name;

    const now = new Date();
    const date = now.toLocaleDateString('pl-PL', { year: 'numeric', month: 'long', day: 'numeric' });
    const time = now.toLocaleTimeString('pl-PL', { hour: '2-digit', minute: '2-digit' });

    weatherResult.innerHTML = `
        <div class="date-time">
            ${date} | ${time}
        </div>
        <p><strong>Miejscowość:</strong> ${cityName}</p>
        <p><strong>Temperatura:</strong> ${temperature}°C</p>
        <p><strong>Opis:</strong> ${description}</p>
    `;
}

function displayForecast(data) {
    const weatherResult = document.getElementById("weather-result");
    const forecastList = data.list.filter(item => item.dt_txt.includes("12:00:00"));

    let forecastHtml = `<h2>Prognoza 5-dniowa:</h2><div class="forecast-container">`;

    forecastList.forEach(forecast => {
        const date = new Date(forecast.dt * 1000).toLocaleDateString('pl-PL', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        const temp = forecast.main.temp;
        const description = forecast.weather[0].description;
        const icon = `https://openweathermap.org/img/wn/${forecast.weather[0].icon}.png`;

        forecastHtml += `
            <div class="forecast-item">
                <p><strong>${date}</strong></p>
                <img src="${icon}" alt="${description}" />
                <p>Temperatura: ${temp}°C</p>
                <p>${description}</p>
            </div>
        `;
    });

    forecastHtml += "</div>";
    weatherResult.innerHTML += forecastHtml;
}
