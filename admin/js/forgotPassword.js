let forgotPasswordSection = document.querySelector(".forgotPasswordSection");
let forgotPasswordForm = document.querySelector("#forgotPasswordForm");
let closeBtn = document.querySelector("#closeBtn");
let sendOtpBtn = document.querySelector("#sendOtpBtn");

closeBtn.addEventListener("click",()=>{
    if (document.referrer.includes("confirmPassword.php")) {
        window.location = "confirmPassword.php";
    }
    else if(document.referrer.includes("index.php")){
        window.location = "confirmPassword.php";
    }
    
})




