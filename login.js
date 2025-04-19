let loginFormSection= document.querySelector(".loginFormSection");
let signUpFormSection= document.querySelector(".signUpFormSection");
let loginSectionButton= document.querySelector("#loginSectionButton");
let signUpSectionButton= document.querySelector("#signUpSectionButton");

let switchToSignUp= document.querySelector("#switchToSignUp");
let switchToLogin= document.querySelector("#switchToLogin");


signUpSectionButton.addEventListener("click",
    ()=>{
    loginFormSection.classList.remove("active");
    signUpFormSection.classList.add("active");
    loginSectionButton.classList.remove("activeFormType");
    signUpSectionButton.classList.add("activeFormType");
});
loginSectionButton.addEventListener("click",
    ()=>{
    signUpFormSection.classList.remove("active");
    loginFormSection.classList.add("active");
    loginSectionButton.classList.add("activeFormType");
    signUpSectionButton.classList.remove("activeFormType");
});

switchToSignUp.addEventListener("click",()=>{
    signUpSectionButton.click();
})
switchToLogin.addEventListener("click",()=>{
    loginSectionButton.click();
})

function onPageLoad() {
    signUpSectionButton.click();
}