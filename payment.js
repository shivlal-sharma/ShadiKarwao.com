var flag = 1;
var alert = document.getElementsByClassName('error');
const digit = new RegExp("^[0-9]+$");
const white = new RegExp("\\s");

function check(data){
    if(data.length > 0){
        if(white.test(data) == 1){
            alert[0].innerText="Do not enter white space";
            flag = 0;
        }  
        else if(digit.test(data) == 0){
            alert[0].innerText="Enter only number";
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
            alert[1].innerText="Do not enter white space";
            flag = 0;
        }  
        else if(digit.test(data) == 0){
            alert[1].innerText="Enter only number";
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
            alert[2].innerText="Do not enter white space";
            flag = 0;
        }  
        else if(digit.test(data) == 0){
            alert[2].innerText="Enter only number";
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
        if(white.test(data) == 1){
            alert[3].innerText="Do not enter white space";
            flag = 0;
        }  
        else if(digit.test(data) == 0){
            alert[3].innerText="Enter only number";
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

function validate(){
    if(flag == 1){
        return true;
    }
    else{
        return false;
    }
}

function remove(e){
    let parent = e.parentElement;
    parent.remove();
}
