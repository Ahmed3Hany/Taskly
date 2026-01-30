'use strict';

// Hero Section Height Adjustment
function heroSectionHeight() {
    const nav = document.getElementById('navbar');
    const navHeight = nav.offsetHeight;
    const heroSection = document.querySelector('.hero-section');
    if(window.innerHeight >= 700){
        heroSection.style.minHeight = `calc(100vh - ${navHeight}px - 15px) `;
    }
    else{
        heroSection.style.minHeight = `100vh`;
    }
}

// Dark Mode Toggle with State Persistence
const checkbox = document.getElementById("Mode");
// Load saved state when page opens
const savedState = localStorage.getItem("checkboxState");
checkbox.checked = savedState === "true";
// Save state when checkbox changes
checkbox.addEventListener("change", () => {
    localStorage.setItem("checkboxState", checkbox.checked);
});

// Responsive Data Forms Display
const overlay = document.getElementById('overlay');
function dataFormsStartup(){
    const loginForm = document.getElementById('login');
    const registerForm = document.getElementById('register');
    if(window.innerWidth < 768){
        registerForm.style.display = "none";
        overlay.style.display = "none";
        loginForm.style.display = "flex";
    }
    else{
        registerForm.style.display = "flex";
        loginForm.style.display = "flex";
        overlay.style.display = "flex";
    }
}

let isLoginVisible = true;
function toggleDataForms(){
    if(isLoginVisible){
        overlay.innerHTML = `<h1>Hello, Friend!</h1>
        <p>Dont Have an Account? Sign Up Now!</p>
        <button class="submitBtn" onclick="toggleDataForms();" value="SignUP">Sign UP</button>`;
        overlay.style.right = `0px`;
        overlay.style.backgroundPosition = 'right';
        isLoginVisible = false;
    }
    else{
        overlay.innerHTML = `<h1>Welcome Back!</h1>
        <p>Already Have an Account? Sign In Now!</p>
        <button class="submitBtn" onclick="toggleDataForms();" value="SignIN">Sign IN</button>`;
        overlay.style.right = `${overlay.offsetWidth}px`;
        overlay.style.backgroundPosition = 'left';
        isLoginVisible = true;
    }
}

function adjustDataFormsOnResize(){
    if(isLoginVisible == true){
        console.log('resize detected');
        overlay.style.right = `${overlay.offsetWidth}px`;
    }
}