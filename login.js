var x = document.getElementById("password");
var y = document.getElementById("eyeClose");

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