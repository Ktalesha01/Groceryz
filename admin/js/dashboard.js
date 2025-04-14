let changeDetails = document.querySelector(".changeDetails");
let changePassword = document.querySelector(".changePassword");
let logout = document.querySelector("#logout");

changeDetails.addEventListener("click",()=>{
    window.location = "changeDetails.php";
});
changePassword.addEventListener("click",()=>{
    window.location = "changePassword.php";
});
logout.addEventListener("click",()=>{
    if(confirm("Do you want to Logout ?")){
        window.location = "logout.php";
    };
});

