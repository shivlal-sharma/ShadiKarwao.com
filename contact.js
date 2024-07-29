flag = 1;
var alert = document.getElementsByClassName("error");
const name =new RegExp("^[A-Za-z\\s]+$");
const phone = new RegExp("^[0-9]{10}$");
const email = new RegExp("^([a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$");
const message = new RegExp("^[A-Za-z]$");
const white = new RegExp("\\s");
const uppercase = new RegExp("(?=.*?[A-Z])");
const lowercase = new RegExp("(?=.*?[a-z])");
const digit = new RegExp("(?=.*?[0-9])");
const specialChar = new RegExp("(?=.*?[#?!@$%^&*-])");
const threeChar = new RegExp(".{3,}");

function check(data){
    if(data.length > 0){
        if(name.test(data) == 0){
            alert[0].innerText="Please Enter Valid Name";
            flag = 0;
        }   
        else if(uppercase.test(data) == 0){
            alert[0].innerText="Enter atleast 1 Uppercase letter";
            flag = 0;
        }   
        else if(threeChar.test(data) == 0){
            alert[0].innerText="Please Enter atleast 3 letter";
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

function check1(data){
    if(data.length > 0){
        if(white.test(data) == 1){
            alert[1].innerText="Please Do Not Enter White Space";
            flag = 0;
        }  
        else if(phone.test(data) == 0){
            alert[1].innerText="Please Enter Valid Phone No.";
            flag = 0;
        }   
        else{
            alert[1].innerText="";
            flag = 1;
        }
    }
    else{
        alert[1].innerText="";
        flag = 0;
    }
}

function check2(data){
    if(data.length > 0){
        if(white.test(data) == 1){
            alert[2].innerText="Please Do Not Enter White Space";
            flag = 0;
        }  
        else if(email.test(data) == 0){
            alert[2].innerText="Please Enter Valid Email";
            flag = 0;
        }   
        else{
            alert[2].innerText="";
            flag = 1;
        }
    }
    else{
        alert[2].innerText="";
        flag = 0;
    }
}

function check3(data){
    if(data.length > 0){
        if(specialChar.test(data) == 1){
            alert[3].innerText="Do Not Enter Special Character";
            flag = 0;
        }    
        else if(uppercase.test(data) == 0){
            alert[3].innerText="Enter atleast 1 Uppercase letter";
            flag = 0;
        }   
        else if(threeChar.test(data) == 0){
            alert[3].innerText="Please Enter atleast 3 letter";
            flag = 0;
        }      
        else{
            alert[3].innerText="";
            flag = 1;
        }
    }
    else{
        alert[3].innerText="";
        flag = 0;
    }
}

function check4(data){
    if(data.length > 0){
        if(uppercase.test(data) == 0){
            alert[4].innerText="Enter atleast 1 Uppercase letter";
            flag = 0;
        }   
        else if(threeChar.test(data) == 0){
            alert[4].innerText="Please Enter atleast 3 letter";
            flag = 0;
        }     
        else{
            alert[4].innerText="";
            flag = 1;
        }
    }
    else{
        alert[4].innerText="";
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

function remove(event){
    let parent = event.parentElement;
    parent.remove();
}
