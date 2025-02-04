document.addEventListener("DOMContentLoaded",()=>{
     document.querySelector('.close').style.right = '10px';
});

document.querySelector(".menu").addEventListener('click', () => {
     document.querySelector('.main-section').style.translate = '250px';
     document.querySelector('.close').style.right = '-44px';
});

document.querySelector(".close").addEventListener('click', () => {
     document.querySelector('.main-section').style.translate = '-250px';
     document.querySelector('.close').style.right = '10px';
});