function toggleMenu() {
    const menu = document.getElementById("menuList");
    menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
}

// Toggle visibility of the download menu
function toggleDownloadMenu() {
    const menu = document.getElementById("downloadMenuList");
    menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
}

// Close menus when clicking outside
window.onclick = function(event) {
    const menu = document.getElementById("menuList");
    const downloadMenu = document.getElementById("downloadMenuList");

    if (!event.target.matches('.menu button')) {
        if (menu.style.display === "block") {
            menu.style.display = "none";
        }
    }

    if (!event.target.matches('#downloadBtn') && !event.target.matches('#downloadMenuList button')) {
        if (downloadMenu.style.display === "block") {
            downloadMenu.style.display = "none";
        }
    }
}
// Create a new list (reset the current list)
function newList() {
    document.getElementById("currentListName").innerText = "";
    document.getElementById("listDisplay").innerHTML = "";
    showListNamePopup();
}

// Open an existing list (this can be modified to load data from server)
function openList() {
    alert("Open an existing list functionality to be implemented.");
}

// Rename the current list
function renameList() {
    const newListName = prompt("Enter a new name for the list:", document.getElementById("currentListName").innerText);
    if (newListName && newListName.trim() !== "") {
        document.getElementById("currentListName").innerText = newListName;
    }
}

// Share the current list (functionality can be implemented as per requirements)
function shareList() {
    alert("Share functionality to be implemented.");
}

// Close the current list
function closeList() {
    document.getElementById("groceryApp").style.display = "none";
    showListNamePopup();
}

// Add an item to the list
function addItem(event) {
    event.preventDefault();
    
    const itemName = document.getElementById("itemName").value;
    const itemType = document.getElementById("itemType").value;
    const itemQty = document.getElementById("itemQty").value;

    if (!itemName || !itemType || !itemQty) {
        alert("All fields are required.");
        return;
    }

    // Create a new table row for the item
    const row = document.createElement("tr");

    const nameCell = document.createElement("td");
    nameCell.textContent = itemName;

    const typeCell = document.createElement("td");
    typeCell.textContent = itemType;

    const qtyCell = document.createElement("td");
    qtyCell.textContent = itemQty;

    const actionCell = document.createElement("td");

    // Add edit, mark as done, and remove buttons
    const editBtn = document.createElement("button");
    editBtn.textContent = "Edit";
    editBtn.onclick = () => editItem(row);

    const doneBtn = document.createElement("button");
    doneBtn.textContent = "Done";
    doneBtn.onclick = () => markAsDone(row);

    const removeBtn = document.createElement("button");
    removeBtn.textContent = "Remove";
    removeBtn.onclick = () => removeItem(row);

    actionCell.append(editBtn, doneBtn, removeBtn);

    row.append(nameCell, typeCell, qtyCell, actionCell);

    // Append the row to the list
    document.getElementById("listDisplay").querySelector("table").append(row);

    // Clear the input fields
    document.getElementById("itemName").value = "";
    document.getElementById("itemType").value = "";
    document.getElementById("itemQty").value = "";
}

// Edit an existing item
function editItem(row) {
    const name = row.children[0].textContent;
    const type = row.children[1].textContent;
    const qty = row.children[2].textContent;

    const newName = prompt("Edit item name:", name);
    const newType = prompt("Edit item type:", type);
    const newQty = prompt("Edit item quantity:", qty);

    if (newName && newType && newQty) {
        row.children[0].textContent = newName;
        row.children[1].textContent = newType;
        row.children[2].textContent = newQty;
    }
}

// Mark an item as done
function markAsDone(row) {
    row.style.backgroundColor = "#d4edda"; // Light green for completed
}

// Remove an item from the list
function removeItem(row) {
    row.remove();
}

// Download the grocery list as Excel
function downloadListAsExcel() {
    const table = document.getElementById("listDisplay").querySelector("table");
    const wb = XLSX.utils.table_to_book(table, { sheet: "Grocery List" });
    XLSX.writeFile(wb, "grocery_list.xlsx");
}

// Download the grocery list as PDF
function downloadListAsPDF() {
    const doc = new jsPDF();
    const table = document.getElementById("listDisplay").querySelector("table");
    doc.autoTable({ html: table });
    doc.save("grocery_list.pdf");
}
