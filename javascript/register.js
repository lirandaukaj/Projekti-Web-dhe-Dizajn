const name = document.getElementById("name")
const lastName = document.getElementById("lastname")
const email = document.getElementById("email")
const password = document.getElementById("password")
const buttoni=document.getElementById("buttoni");
const form=document.getElementById("form");



const nameValidim = (name)=>{
  const nameRegex=/^([A-Za-z])+$/;
  return nameRegex.test(name);
}
const lastNameValidim = (lastName)=>{
  const lastNameRegex=/^([A-Za-z])+$/;
  return lastNameRegex.test(lastName);
}
const emailValidim=(email)=>{
  const emailRegex = /^([A-Za-z0-9_\-.])+@([A-Za-z0-9_\-.])+\.([A-Za-z]{2,4})$/;
  return emailRegex.test(email.toLowerCase());
  }
  const passwordValidim=(password)=>{
    const passwordRegex = /^([A-Za-z0-9@$!%*?&]){8,}$/;
    return passwordRegex.test(password);
    }

function formValidation(event){
event.preventDefault();

if(name.value===""){
  alert("Please enter your name");
  name.focus();
  return false;
}
if(lastName.value===""){
  alert("Please enter your surname");
  lastName.focus();
  return false;
}
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
if(!nameValidim(name.value)){
  alert("Please write a valid name with alphabetic symbols");
  name.focus();
  return false;
}
if(!lastNameValidim(lastName.value)){
  alert("Please write a valid last name with alphabetic symbols");
  lastName.focus();
  return false;
}

if(!emailValidim(email.value)){
  alert("Please write a valid email using specific symbols");
  email.focus();
  return false;
}
if(!passwordValidim(password.value)){
  alert("Please write a valid password,the password must be at least 8 characters long,contain at least one uppercase letter,lowercase letters, a number and special character");
  password.focus();
  return false;
}

window.location.href = "homePage.html";
return true;
}
form.addEventListener('submit',formValidation);
