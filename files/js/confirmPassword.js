let confirmPasswordSection = document.querySelector(".confirmPasswordSection");
let userConfirmForm = document.querySelector("#userConfirmForm");
let closeBtn = document.querySelector("#closeBtn");
let confirmUpdateDetails = document.querySelector("#confirmUpdateDetails");

closeBtn.addEventListener("click",()=>{
    if (workingPage=="changeDetails") {
        window.location = "changeDetails.php";
    }
    else if(workingPage=="changePassword"){
        window.location = "changePassword.php";
    }
    
})




