function saveListName() {
    const listName = document.getElementById("listNameInput").value;
    if (listName.trim() === "") {
        alert("Please enter a valid list name.");
        return;
    }
}

let closeBtn = document.querySelector("#closeBtn");

closeBtn.addEventListener("click",()=>{
        window.location = "groceryList.php";
})
