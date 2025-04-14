let confirmPasswordSection = document.querySelector(".confirmPasswordSection");
let userConfirmForm = document.querySelector("#userConfirmForm");
let closeBtn = document.querySelector("#closeBtn");
let confirmUpdateDetails = document.querySelector("#confirmUpdateDetails");

closeBtn.addEventListener("click",()=>{
    if (document.referrer.includes("changeDetails.php")) {
        window.location = "changeDetails.php";
    }
    else if(document.referrer.includes("changePassword.php")){
        window.location = "changePassword.php";
    }
    
})




