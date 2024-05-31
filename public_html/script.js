console.log("działa?");

// Pobranie tekstu
const spnText = document.querySelector(".textTyping");
// Pobranie kursora
const spnCursor = document.querySelector(".cursor");
const txt = ["Lista Twoich ulubionych przepisów kulinarnych!"];

// Ustawienie pomocniczych zmiennych do skryptu
let activeLetter = 0;
let activeText = 0;

// Fukncja wyświetlająca litery w stylu "symulacji pisanego tekstu"
const addLetter = () => {
  spnText.textContent += txt[activeText][activeLetter++];
  if (activeLetter === txt[activeText].length) {
    activeText++;
    if (activeText === txt.length) return;

    return setTimeout(() => {
      activeLetter = 0;
      spnText.textContent = "";
      addLetter();
    }, 2000);
  }

  setTimeout(addLetter, 30);
};

const cursorAnimation = () => {
  spnCursor.classList.toggle("active");
};

addLetter();
setInterval(cursorAnimation, 400);
