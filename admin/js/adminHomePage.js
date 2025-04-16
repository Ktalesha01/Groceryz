// // function toggleMenu() {
// //     var menu = document.getElementById("menuList");
// //     menu.style.display = (menu.style.display === "none") ? "block" : "none";
// // }
// // function toggleDownloadMenu() {
// //     var downloadMenu = document.getElementById("downloadMenuList");
// //     downloadMenu.style.display = (downloadMenu.style.display === "none") ? "block" : "none";
// // }

// // let currentList = [];
// // let currentListName = '';

// // function saveListName() {
// //     const nameInput = document.getElementById("listNameInput").value.trim();
// //     if (nameInput === "") {
// //         alert("Please enter a list name.");
// //         return;
// //     }

// //     currentListName = nameInput;
// //     document.getElementById("currentListName").textContent = currentListName;

// //     document.getElementById("listNamePopup").style.display = "none";
// //     document.getElementById("groceryApp").style.display = "flex";
// // }

// // function addItem(event) {
// //     event.preventDefault();

// //     const name = document.getElementById("itemName").value.trim();
// //     const type = document.getElementById("itemType").value.trim();
// //     const qty = document.getElementById("itemQty").value;

// //     if (name && type && qty > 0) {
// //         const item = { name, type, qty };
// //         currentList.push(item);
// //         displayList();
// //         document.getElementById("addItemForm").reset();
// //     } else {
// //         alert("Please fill all fields correctly.");
// //     }
// // }

// // function displayList() {
// //     const listDisplay = document.getElementById("listDisplay");
// //     listDisplay.innerHTML = "";

// //     // Group items by type
// //     const groupedItems = {};
// //     currentList.forEach(item => {
// //         const type = item.type.trim();
// //         if (!groupedItems[type]) {
// //             groupedItems[type] = [];
// //         }
// //         groupedItems[type].push(item);
// //     });

// //     // Display grouped items
// //     for (const type in groupedItems) {
// //         const typeHeader = document.createElement("h3");
// //         typeHeader.textContent = type;
// //         listDisplay.appendChild(typeHeader);

// //         const ul = document.createElement("ul");
// //         groupedItems[type].forEach(item => {
// //             const li = document.createElement("li");
// //             li.textContent = `${item.name} (Qty: ${item.qty})`;
// //             ul.appendChild(li);
// //         });

// //         listDisplay.appendChild(ul);
// //     }
// // }

// // // Placeholder functions for menu actions
// // function newList() {
// //     if (confirm("Start a new list? Unsaved data will be lost.")) {
// //         currentList = [];
// //         document.getElementById("listDisplay").innerHTML = "";
// //         saveListName(); // Optionally restart from list naming
// //     }
// // }

// // function openList() {
// //     alert("Feature to open list will be implemented.");
// // }

// // function renameList() {
// //     const newName = prompt("Enter new list name:", currentListName);
// //     if (newName) {
// //         currentListName = newName.trim();
// //         document.getElementById("currentListName").textContent = currentListName;
// //     }
// // }

// // function shareList() {
// //     alert("Feature to share list will be implemented.");
// // }

// // function closeList() {
// //     if (confirm("Close current list?")) {
// //         location.reload(); // simple reload for now
// //     }
// // }

// // function downloadList() {
// //     let content = `Grocery List: ${currentListName}\n\n`;
// //     currentList.forEach((item, index) => {
// //         content += `${index + 1}. ${item.name} (${item.type}) - Qty: ${item.qty}\n`;
// //     });

// //     const blob = new Blob([content], { type: "text/plain" });
// //     const link = document.createElement("a");
// //     link.href = URL.createObjectURL(blob);
// //     link.download = `${currentListName}.txt`;
// //     link.click();
// // }

// // async function downloadListAsPDF() {
// //     const { jsPDF } = window.jspdf;
// //     const doc = new jsPDF();

// //     doc.setFontSize(16);
// //     doc.text(`Grocery List: ${currentListName}`, 14, 20);

// //     const groupedItems = {};
// //     currentList.forEach(item => {
// //         const type = item.type.trim();
// //         if (!groupedItems[type]) {
// //             groupedItems[type] = [];
// //         }
// //         groupedItems[type].push(item);
// //     });

// //     let yPosition = 30;

// //     for (const type in groupedItems) {
// //         // Add a section heading
// //         doc.setFontSize(14);
// //         doc.text(`${type}`, 14, yPosition);
// //         yPosition += 5;

// //         // Prepare data for the table
// //         const tableData = groupedItems[type].map(item => [item.name, item.qty]);

// //         doc.autoTable({
// //             head: [['Item Name', 'Quantity']],
// //             body: tableData,
// //             startY: yPosition,
// //             theme: 'grid',
// //             styles: {
// //                 fontSize: 12,
// //                 halign: 'left',
// //                 valign: 'middle',
// //             },
// //             headStyles: {
// //                 fillColor: [22, 160, 133],
// //                 textColor: 255,
// //                 halign: 'center'
// //             },
// //             margin: { top: 10, left: 14, right: 14 },
// //             didDrawPage: function (data) {
// //                 yPosition = data.cursor.y + 10;
// //             }
// //         });

// //         yPosition += 10;
// //     }

// //     doc.save(`${currentListName}.pdf`);
// // }
// // function downloadListAsExcel() {
// //     const groupedItems = {};
// //     currentList.forEach(item => {
// //         const type = item.type.trim();
// //         if (!groupedItems[type]) {
// //             groupedItems[type] = [];
// //         }
// //         groupedItems[type].push(item);
// //     });

// //     // Flatten grouped items into rows for Excel
// //     const excelData = [];
// //     for (const type in groupedItems) {
// //         excelData.push({ ItemType: type, ItemName: '', Quantity: '' }); // Type header row

// //         groupedItems[type].forEach(item => {
// //             excelData.push({
// //                 ItemType: '',
// //                 ItemName: item.name,
// //                 Quantity: item.qty
// //             });
// //         });
// //     }

// //     const worksheet = XLSX.utils.json_to_sheet(excelData, { header: ["ItemType", "ItemName", "Quantity"], skipHeader: false });
// //     const workbook = XLSX.utils.book_new();
// //     XLSX.utils.book_append_sheet(workbook, worksheet, currentListName);

// //     XLSX.writeFile(workbook, `${currentListName}.xlsx`);
// // }

// let currentListId = null;
// let currentUserId = null; // Set this from session or a global variable
// let currentListName = "";

// function toggleMenu() {
//     const menu = document.getElementById("menuList");
//     menu.style.display = (menu.style.display === "none") ? "block" : "none";
// }

// function toggleDownloadMenu() {
//     const downloadMenu = document.getElementById("downloadMenuList");
//     downloadMenu.style.display = (downloadMenu.style.display === "none") ? "block" : "none";
// }

// function saveListName() {
//     const nameInput = document.getElementById("listNameInput").value.trim();
//     if (nameInput === "") {
//         alert("Please enter a list name.");
//         return;
//     }

//     currentListName = nameInput;
//     document.getElementById("currentListName").textContent = currentListName;
//     document.getElementById("listNamePopup").style.display = "none";
//     document.getElementById("groceryApp").style.display = "flex";

//     // Assume this is a new list and create it in DB
//     fetch("create_list.php", {
//         method: "POST",
//         headers: { "Content-Type": "application/json" },
//         body: JSON.stringify({ list_name: currentListName, user_id: currentUserId })
//     })
//     .then(res => res.json())
//     .then(data => {
//         currentListId = data.list_id;
//         fetchItems(currentListId);
//     });
// }

// function addItem(event) {
//     event.preventDefault();

//     const name = document.getElementById("itemName").value.trim();
//     const type = document.getElementById("itemType").value.trim();
//     const qty = document.getElementById("itemQty").value;

//     if (name && type && qty > 0) {
//         fetch("add_item.php", {
//             method: "POST",
//             headers: { "Content-Type": "application/json" },
//             body: JSON.stringify({
//                 user_id: currentUserId,
//                 list_id: currentListId,
//                 item_name: name,
//                 item_type: type,
//                 item_qty: qty
//             })
//         })
//         .then(res => res.json())
//         .then(data => {
//             if (data.success) {
//                 document.getElementById("addItemForm").reset();
//                 fetchItems(currentListId);
//             } else {
//                 alert("Error adding item.");
//             }
//         });
//     } else {
//         alert("Please fill all fields correctly.");
//     }
// }

// function fetchItems(listId) {
//     fetch(`get_items.php?list_id=${listId}`)
//         .then(res => res.json())
//         .then(items => displayItems(items));
// }

// function displayItems(items) {
//     const container = document.getElementById("listDisplay");
//     container.innerHTML = "";

//     const table = document.createElement("table");
//     table.classList.add("grocery-table");
//     table.innerHTML = `
//         <tr>
//             <th>Item Name</th>
//             <th>Type</th>
//             <th>Quantity</th>
//             <th>Status</th>
//             <th>Actions</th>
//         </tr>
//     `;

//     items.forEach(item => {
//         const row = document.createElement("tr");

//         row.innerHTML = `
//             <td><input value="${item.item_name}" id="name-${item.item_id}"></td>
//             <td><input value="${item.item_type}" id="type-${item.item_id}"></td>
//             <td><input type="number" value="${item.item_qty}" id="qty-${item.item_id}"></td>
//             <td>
//                 <input type="checkbox" ${item.is_done == 1 ? "checked" : ""} 
//                        onchange="markItemDone(${item.item_id}, this.checked)">
//             </td>
//             <td>
//                 <button onclick="updateItem(${item.item_id})">Update</button>
//                 <button onclick="deleteItem(${item.item_id})">Delete</button>
//             </td>
//         `;

//         table.appendChild(row);
//     });

//     container.appendChild(table);
// }

// function updateItem(itemId) {
//     const name = document.getElementById(`name-${itemId}`).value;
//     const type = document.getElementById(`type-${itemId}`).value;
//     const qty = document.getElementById(`qty-${itemId}`).value;

//     fetch("update_item.php", {
//         method: "POST",
//         headers: { "Content-Type": "application/json" },
//         body: JSON.stringify({
//             item_id: itemId,
//             item_name: name,
//             item_type: type,
//             item_qty: qty
//         })
//     })
//     .then(res => res.json())
//     .then(data => {
//         if (data.success) {
//             alert("Item updated.");
//             fetchItems(currentListId);
//         } else {
//             alert("Update failed.");
//         }
//     });
// }

// function markItemDone(itemId, isDone) {
//     fetch("mark_done.php", {
//         method: "POST",
//         headers: { "Content-Type": "application/json" },
//         body: JSON.stringify({ item_id: itemId, is_done: isDone ? 1 : 0 })
//     });
// }

// function deleteItem(itemId) {
//     if (!confirm("Are you sure you want to delete this item?")) return;

//     fetch("delete_item.php", {
//         method: "POST",
//         headers: { "Content-Type": "application/json" },
//         body: JSON.stringify({ item_id: itemId })
//     })
//     .then(res => res.json())
//     .then(data => {
//         if (data.success) {
//             alert("Item deleted.");
//             fetchItems(currentListId);
//         } else {
//             alert("Failed to delete item.");
//         }
//     });
// }

// // Placeholder menu actions
// function newList() {
//     if (confirm("Start a new list? Unsaved data will be lost.")) {
//         currentListId = null;
//         currentListName = '';
//         document.getElementById("listDisplay").innerHTML = "";
//         document.getElementById("groceryApp").style.display = "none";
//         document.getElementById("listNamePopup").style.display = "block";
//     }
// }

// function renameList() {
//     const newName = prompt("Enter new list name:", currentListName);
//     if (newName) {
//         currentListName = newName.trim();
//         document.getElementById("currentListName").textContent = currentListName;

//         // Optional: update in DB
//         fetch("rename_list.php", {
//             method: "POST",
//             headers: { "Content-Type": "application/json" },
//             body: JSON.stringify({
//                 list_id: currentListId,
//                 list_name: currentListName
//             })
//         });
//     }
// }

// function closeList() {
//     if (confirm("Close current list?")) {
//         location.reload();
//     }
// }
// Toggle visibility of the main menu

// Show popup to name the grocery list
function saveListName() {
    const listName = document.getElementById("listNameInput").value;
    if (listName.trim() === "") {
        alert("Please enter a valid list name.");
        return;
    }
}

