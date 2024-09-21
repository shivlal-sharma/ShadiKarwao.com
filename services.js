document.addEventListener('DOMContentLoaded', () => {
    const heartIcons = document.querySelectorAll('.heart');

    heartIcons.forEach(icon => {
        icon.addEventListener('click', () => {
            if (icon.classList.contains('active')) {
                icon.classList.remove('active');
                localStorage.setItem('heartColor','white');
            } else {
                icon.classList.add('active');
                localStorage.setItem('heartColor','red');
            }
        });
    });
});

function remove(event){
    let parent = event.parentElement;
    parent.remove();
}