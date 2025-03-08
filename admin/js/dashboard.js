let changeDetails = document.querySelector(".changeDetails");
let changePassword = document.querySelector(".changePassword");
let changeDetailsForm = document.querySelector(".changeDetailsForm");
let changePasswordForm = document.querySelector(".changePasswordForm");
let closeBtn = document.querySelector("#closeBtn");

function popup(divname){
    divname.style.display = divname.style.display === 'block' ? 'none' : 'block';
    document.querySelector(".userInfoSection").style.filter = "blur(8px)";
    document.querySelector(".recentLists").style.filter = "blur(8px)";
    document.querySelector(".shareingInfo").style.filter = "blur(8px)";
    document.querySelector(".header").style.filter = "blur(8px)";
    document.querySelector(".footer").style.filter = "blur(8px)";
}

changeDetails.addEventListener("click",()=>{popup(changeDetailsForm);});
changePassword.addEventListener("click",()=>{popup(changePasswordForm);});

closeBtn.addEventListener("click",()=>{
    changeDetailsForm.style.display = "none";
    document.querySelector(".userInfoSection").style.filter = "none";
    document.querySelector(".recentLists").style.filter = "none";
    document.querySelector(".shareingInfo").style.filter = "none";
    document.querySelector(".header").style.filter = "none";
    document.querySelector(".footer").style.filter = "none";

})