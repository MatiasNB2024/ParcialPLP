document.addEventListener('DOMContentLoaded', function() {
    const wordInput = document.getElementById('word-to-guess');
    const startButton = document.getElementById('start-game');
    const wordDisplay = document.getElementById('word-display');
    const lettersContainer = document.getElementById('letters');

    // Generar letras del alfabeto al cargar la página
    const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    alphabet.split('').forEach(letter => {
        const button = document.createElement('button');
        button.textContent = letter;
        button.addEventListener('click', function() {
            // Aquí puedes manejar la lógica de seleccionar una letra
            // elegirLetra(letter);
        });
        lettersContainer.appendChild(button);
    });

    startButton.addEventListener('click', function() {
        const word = wordInput.value.trim(); // Mantener la palabra tal como se ingresa
        
        if (word) {
            // Mostrar la palabra en guiones bajos
            const hiddenWord = word.split('').map(letter => '_').join(' ');
            wordDisplay.textContent = hiddenWord;

            // Aquí puedes llamar a una función para iniciar el juego con la palabra ingresada
            // iniciarJuego(word);
        } else {
            alert("Por favor, escribe una palabra válida.");
        }
    });
});
