/*změna barvy*/
const colorPicker = document.getElementById('colorPicker');
        const body = document.body;
        const textElements = document.querySelectorAll('h1, p');


        colorPicker.addEventListener('input', () => {
            const color = colorPicker.value;
            article.style.background = color;
           
            // Převod hex na RGB
            const r = parseInt(color.substr(1, 2), 16);
            const g = parseInt(color.substr(3, 2), 16);
            const b = parseInt(color.substr(5, 2), 16);
           
            // Výpočet světlosti (luminance) podle vnímání oka
            const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
           
            // Pokud je světlost vysoká, nastavíme černý text, jinak bílý
            //const textColor = luminance > 0.5 ? 'black' : 'white';
            //textElements.forEach(el => el.style.color = textColor);
        });
