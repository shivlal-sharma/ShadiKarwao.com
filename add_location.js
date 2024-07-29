var flag = 1;
var alert = document.getElementsByClassName('error');
const upperlowercase = new RegExp("^[A-Z][a-z]");
const digit = new RegExp("(?=.*?[0-9])");
const tenChar = new RegExp(".{6,}");
const threeChar = new RegExp(".{3,}");
const white = new RegExp("\\s");

function check(data){
    if(data.length > 0){
        if(digit.test(data) == 1){
            alert[0].innerText="Do not enter digit";
            flag = 0;
        }   
        else if(upperlowercase.test(data) == 0){
            alert[0].innerText="First letter should be uppercase";
            flag = 0;
        }   
        else if(threeChar.test(data) == 0){
            alert[0].innerText="Enter atleast 3 character";
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

// function check1(data){
//     if(data.length > 0){
//         if(white.test(data) == 1){
//             alert[1].innerText="Please do not Enter White Space";
//             flag = 0;
//         }  
//         if(digit.test(data) == 1){
//             alert[1].innerText="Enter atleast 3 digit";
//             flag = 0;
//         }   
//         else{
//             alert[1].innerText="";
//             flag = 1;
//         }
//     }
//     else{
//         alert[1].innerText="";
//         flag = 0;
//     }
// }


// function check2(data){
//     if(data.length > 0){
//         if(white.test(data) == 1){
//             alert[2].innerText="Please do not Enter White Space";
//             flag = 0;
//         }  
//         if(digit.test(data) == 0){
//             alert[2].innerText="Please Enter atleast 6 digit";
//             flag = 0;
//         }   
//         else{
//             alert[2].innerText="";
//             flag = 1;
//         }
//     }
//     else{
//         alert[2].innerText="";
//         flag = 0;
//     }
// }

function check3(data){
    if(data.length > 0){
        if(upperlowercase.test(data) == 0){
            alert[3].innerText="First letter should be uppercase";
            flag = 0;
        }   
        else if(threeChar.test(data) == 0){
            alert[3].innerText="Please Enter atleast 3 Character";
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
