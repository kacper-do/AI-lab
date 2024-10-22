class Todo {
    constructor() {
        this.tasks = JSON.parse(localStorage.getItem('tasks')) || [];
        this.term = "";
        this.taskListElement = document.getElementById("taskList");


        document.getElementById("addBtn").addEventListener("click", () => this.addTask());
        document.getElementById("searchInput").addEventListener("input", e => this.setSearchTerm(e.target.value));


        this.draw();
    }

    addTask() {
        const taskText = document.getElementById("taskInput").value.trim();
        const taskDate = document.getElementById("dateInput").value;


        if (taskText.length < 3 || taskText.length > 255) {
            alert("Zadanie musi mieć od 3 do 255 znaków.");
            return;
        }


        const currentDate = new Date().toISOString().split("T")[0];
        if (taskDate && taskDate <= currentDate) {
            alert("Data musi być w przyszłości.");
            return;
        }


        this.tasks.push({ text: taskText, date: taskDate });
        this.saveTasks();
    }

    //ustawienie frazy wyszukiwanie i rysowanie
    setSearchTerm(term) {
        this.term = term.toLowerCase();
        this.draw();
    }

    saveTasks() {
        localStorage.setItem('tasks', JSON.stringify(this.tasks));
        this.draw();
    }

    modifyElement(element, index, isDate) {
        const input = document.createElement("input");
        input.type = isDate ? "date" : "text";
        input.value = isDate ? this.tasks[index].date : this.tasks[index].text;
        element.replaceWith(input);
        input.focus();

        input.addEventListener("blur", () => {
            this.tasks[index][isDate ? "date" : "text"] = input.value;
            this.saveTasks();
        });
    }
    draw() {
        this.taskListElement.innerHTML = "";

        //filitracja min 2 znaki
        const filteredTasks = this.term.length >= 2
            ? this.tasks.filter(task => task.text.toLowerCase().includes(this.term))
            : this.tasks;

        for (let i = 0; i < filteredTasks.length; i++) {
            const task = filteredTasks[i];
            const li = document.createElement("li");

            const taskText = this.createElement("span", { innerHTML: this.highlightTerm(task.text) }, () => {
                this.modifyElement(taskText, i, false);
            });

            const taskDate = this.createElement("span", { innerText: task.date }, () => {
                this.modifyElement(taskDate, i, true);
            });

            const deleteBtn = this.createElement("button", { innerHTML: "🗑️" }, () => {
                this.tasks.splice(i, 1);
                this.saveTasks();
            });

            li.append(taskText, taskDate, deleteBtn);
            this.taskListElement.appendChild(li);
        }
    }
    createElement(type, properties, eventListener) {
        const el = document.createElement(type);
        Object.assign(el, properties);
        if (eventListener) el.addEventListener("dblclick", eventListener);
        return el;
    }
    //wyroznienie
    highlightTerm(text) {
        return this.term ? text.replace(new RegExp(`(${this.term})`, "gi"), "<mark>$1</mark>") : text;
    }
}
document.addEventListener("DOMContentLoaded", () => new Todo());
