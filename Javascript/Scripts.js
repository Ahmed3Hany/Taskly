// Hero Section Height Adjustment
function heroSectionHeight() {
    const nav = document.getElementById('navbar');
    const navHeight = nav.offsetHeight;
    const heroSection = document.querySelector('.hero-section');
    heroSection.style.height = `calc(100vh - ${navHeight}px)`;
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
function dataFormsStartup(){
    const loginForm = document.getElementById('login');
    const registerForm = document.getElementById('register');
    if(window.innerWidth <= 768){
        registerForm.style.display = "none";
        loginForm.style.display = "flex";
    }
    else{
        registerForm.style.display = "flex";
        loginForm.style.display = "flex";
    }
}