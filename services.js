function heart(obj){
    if(obj.style.color == "red"){
        obj.style.color = "white";
    }
    else{
        obj.style.color = "red";
    }
}

function remove(event){
    let parent = event.parentElement;
    parent.remove();
}