function toggleMenu() {
    const menu = document.getElementById("menuList");
    menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
}

// Toggle visibility of the download menu
function toggleDownloadMenu() {
    const menu = document.getElementById("downloadMenuList");
    menu.style.display = (menu.style.display === "none" || menu.style.display === "") ? "block" : "none";
}

function markDone(checkbox) {
    if (checkbox.checked) {
        checkbox.parentElement.parentElement.style.textDecoration = "line-through";
    } else {
        checkbox.parentElement.parentElement.style.textDecoration = "none";
    }
}

function editItem(id, name, qty) {
    const newName = prompt("Edit item name:", name);
    const newQty = prompt("Edit quantity:", qty);

    if (newName !== null && newQty !== null) {
        fetch("../php/updateItem.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `item_id=${id}&item_name=${encodeURIComponent(newName)}&item_qty=${newQty}`
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") location.reload();
            else alert("Failed to update item.");
        });
    }
}

function deleteItem(id) {
    if (confirm("Are you sure you want to delete this item?")) {
        fetch("../php/deleteItem.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `item_id=${id}`
        })
        .then(res => res.text())
        .then(data => {
            if (data.trim() === "success") location.reload();
            else alert("Failed to delete item.");
        });
    }
}

function renameList() {
    const newName = prompt("Enter new list name:");
    if (newName && newName.trim() !== "") {
        fetch("../php/renameList.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `new_name=${encodeURIComponent(newName.trim())}`
        })
        .then(response => response.text())
        .then(data => {
            if (data.trim() === "success") {
                document.getElementById("currentListName").textContent = newName.trim();
                alert("List renamed successfully!");
            } else {
                alert("Failed to rename the list.");
            }
        });
    }
}

function newList() {
    window.location.href = "adminHomePage.php";
}

function openList() {
    const listDropdown = document.getElementById("list");
    alert("Select List name form dropdown to Open List.");
    listDropdown.focus();

    listDropdown.style.outline = "2px solid #4CAF50";
    setTimeout(() => {
        listDropdown.style.outline = "";
    }, 1000);
}

function closeList() {
    fetch("../php/closeList.php")
        .then(res => res.text())
        .then(response => {
            if (response.trim() === "success") {
                alert("List closed.");
                window.location.href = "adminHomePage.php";
            } else {
                alert("Unable to close list.");
            }
        });
}

function toggleDone(itemId, checkboxElement) {
    const isDone = checkboxElement.checked ? 1 : 0;

    fetch('../php/updateDoneStatus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `item_id=${itemId}&is_done=${isDone}`
    })
    .then(response => response.text())
    .then(result => {
        const row = checkboxElement.closest("tr");
        if (isDone) {
            row.style.textDecoration = "line-through";
        } else {
            row.style.textDecoration = "none";
        }
    });
}

function downloadListAsExcel() {
    let wb = XLSX.utils.book_new();
    let ws_data = [["Item Name", "Item Type", "Quantity"]]; 

    const rows = document.querySelectorAll("#listDisplay table tr");
    let currentType = "";

    rows.forEach(row => {
        const cols = row.querySelectorAll("td");
        if (cols.length === 1) {
            currentType = cols[0].innerText; // Store item type
        } else if (cols.length === 3) {
            const itemName = cols[0].innerText;
            const qty = cols[1].innerText;
            ws_data.push([itemName, currentType, qty]); // Swapped order
        }
    });

    const ws = XLSX.utils.aoa_to_sheet(ws_data);
    XLSX.utils.book_append_sheet(wb, ws, "Grocery List");

    const listName = document.getElementById("currentListName").innerText.trim() || "Grocery_List";
    XLSX.writeFile(wb, `${listName}.xlsx`);
}

function downloadListAsPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const listName = document.getElementById("currentListName").innerText.trim() || "Grocery List";

    doc.setFontSize(16);
    doc.text(listName, 14, 20);

    const rows = document.querySelectorAll("#listDisplay table tr");
    let data = [];
    let currentType = "";

    rows.forEach(row => {
        const cols = row.querySelectorAll("td");
        if (cols.length === 1) {
            currentType = cols[0].innerText;
        } else if (cols.length === 3) {
            const itemName = cols[0].innerText;
            const qty = cols[1].innerText;
            data.push([itemName, currentType, qty]); // Swapped order
        }
    });

    doc.autoTable({
        head: [["Item Name", "Item Type", "Quantity"]],
        body: data,
        startY: 30
    });

    doc.save(`${listName}.pdf`);
}
