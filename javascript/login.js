const email = document.getElementById("email");
const password = document.getElementById("password");
const form = document.querySelector("form");

const emailValidimi =(email)=>{
    const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
    return emailRegex.test(email.toLowerCase());
}
const passwordValidimi =(password)=>{
    const passwordRegex = /^([A-Za-z0-9@$!%*?&]){8,}$/;
    return passwordRegex.test(password);
}

function formaValidation(event){
    event.preventDefault();
    if(email.value===""){
        alert("Please enter your email");
        email.focus();
        return false;
    }
    if(password.value===""){
        alert("Please enter your password");
        password.focus();
        return false;
    }
    if(!emailValidimi(email.value)){
        alert("Please write a valid email using specific symbols");
        email.focus();
        return false;
    }
    if(!passwordValidimi(password.value)){
        alert("The password must be at least 8 characters long,contain at least one uppercase letter,lowercase letters, a number and special character");
        password.focus();
        return false;
    }
    window.location.href = "homePage.html";
    return true;
}
form.addEventListener('submit',formaValidation);