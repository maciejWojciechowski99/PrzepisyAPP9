const addElement = document.getElementById("addElement-toDoList");
const counter = document.querySelector(
  ".container__items--toDoList--title-counter"
);
const ul = document.querySelector(
  ".container__items--toDoList--mainElement--list"
);

const toDoList = JSON.parse(localStorage.getItem("toDoList")) || [];

const renderToDoList = () => {
  ul.textContent = "";
  counterToDoList = "";

  toDoList.forEach((toDoElement, index) => {
    const newLi = document.createElement("li");
    const newRadio = document.createElement("input");
    newRadio.type = "radio";
    newRadio.classList.add(
      "container__items--toDoList--mainElement--list-radio"
    );
    newRadio.addEventListener("click", () => {
      counterToDoList++;
      counter.innerHTML = counterToDoList;
      if (toDoList.length < counterToDoList) {
        counterToDoList = toDoList.length;
        counter.innerHTML = toDoList.length;
      }

      // Usuń kliknięty element z listy
      toDoList.splice(index, 1);
      localStorage.setItem("toDoList", JSON.stringify(toDoList));
      renderToDoList();
    });

    newLi.classList.add("container__items--toDoList--mainElement--list-item");
    newLi.appendChild(newRadio);
    newLi.appendChild(document.createTextNode(toDoElement));
    ul.appendChild(newLi);
  });

  counter.innerHTML = counterToDoList;
};

renderToDoList();

const addElementToList = (e) => {
  if (e.keyCode === 13) {
    const newItemValue = addElement.value;
    if (newItemValue === "") return;

    toDoList.push(newItemValue);
    localStorage.setItem("toDoList", JSON.stringify(toDoList));

    renderToDoList();

    addElement.value = "";
  }
};

addElement.addEventListener("keyup", addElementToList);

// Dodaj nasłuchiwanie dla kliknięcia przycisku
const addButton = document.getElementById("addButton");
addButton.addEventListener("click", addElementToList);
