let flag = 1;
let alert = document.getElementsByClassName('error');
const upperlowercase = new RegExp("^[A-Z][a-z]+$");
const onlylowercase = new RegExp("^[a-z]+$");
const uppercase = new RegExp("(?=.*?[A-Z])");
const lowercase = new RegExp("(?=.*?[a-z])");
const digit = new RegExp("(?=.*?[0-9])");
const specialChar = new RegExp("(?=.*?[#?!@$%^&*-])");
const eightChar = new RegExp(".{8,}");
const email = new RegExp("^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$");
const white = new RegExp("\\s");

function check1(data){
    if(data.length > 0){
        if(white.test(data) == 1){
            alert[0].innerText="Do not enter white space";
            flag = 0;
        }  
        else if(uppercase.test(data) == 0){
            alert[0].innerText="Enter atleast 1 uppercase letter";
            flag = 0;
        }   
        else if(lowercase.test(data) == 0){
            alert[0].innerText="Enter atleast 1 lowercase letter";
            flag = 0;
        }   
        else if(digit.test(data) == 0){
            alert[0].innerText="Enter atleast 1 digit";
            flag = 0;
        }   
        else if(specialChar.test(data) == 0){
            alert[0].innerText="Enter atleast 1 special character";
            flag = 0;
        }   
        else if(eightChar.test(data) == 0){
            alert[0].innerText="Enter atleast 8 character";
            flag = 0;
        }   
        else{
            alert[0].innerText="";
            flag = 1;
        }
    }
    else{
        alert[0].innerText="";
        flag = 0;
    }
}

function check2(data){
    var pass = document.getElementById("password").value;
    if(data.length > 0){
        if(data != pass){
            alert[1].innerText = "Incorrect confirm password";
            flag = 0;
        }
        else{
            alert[1].innerText = "";
            flag = 1;
        }
    }
    else{
        alert[1].innerText = "";
        flag = 0;
    }
}

function validate(){
    if(flag == 1){
        return true;
    }
    else{
        return false;
    }
}

let x = document.getElementById("password");
let y = document.getElementById("eyeClose");

function toggle() {
    if (x.type == "password") {
        x.type = "text";
        y.classList.add("fa-eye");  
        y.classList.remove("fa-eye-slash");
    }
    else {
        x.type = "password";
        y.classList.add("fa-eye-slash");
        y.classList.remove("fa-eye");
    }
}

function remove(event){
    let parent = event.parentElement;
    parent.remove();
}
