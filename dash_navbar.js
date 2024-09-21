document.addEventListener('DOMContentLoaded',function(){
    let hamburger = document.getElementById('hamburger');
    let cancel = document.querySelector('.cancel');
    let modal = document.querySelector('.modal');
    let sidebar = document.getElementById('sidebarMenu');

    hamburger.addEventListener('click',()=>{
        modal.style.display = "block";
        hamburger.style.display = "none";
        setTimeout(() => {
            sidebar.style.left = "0%";
        }, 10);
    });

    cancel.addEventListener('click',()=>{
        hamburger.style.display = "block";
        sidebar.style.left = "-100%";
        setTimeout(() => {
            modal.style.display = "none";
        }, 500);
    });

    window.addEventListener('click',(e)=>{
        if(e.target === modal){
            cancel.click();
        }
    })
});