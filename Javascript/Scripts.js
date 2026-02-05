'use strict';
//Fixing Browser Error
document.addEventListener("DOMContentLoaded", function () {
    // Enable tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl)
    })
});

// Hero Section Height Adjustment
function heroSectionHeight() {
    const nav = document.getElementById('navbar');
    const navHeight = nav.offsetHeight;
    const heroSection = document.querySelector('.hero-section');
    heroSection.style.minHeight = `calc(100vh - ${navHeight}px - 15px) `;
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
let signUpShown = false;
function dataFormsStartup() {
    const showbtn = document.getElementById('showSignUp');
    const loginForm = document.getElementById('login');
    const registerForm = document.getElementById('register');
    if (window.innerWidth < 768) {
        if(signUpShown === false){
            registerForm.style.position = "absolute";
            registerForm.style.top = `-${registerForm.offsetHeight + 20}px`;
            registerForm.style.left = `0px`;
            loginForm.style.position = "relative";
            loginForm.style.top = `0px`;
            showbtn.style.top = `-85px`;
        }
    }else{
        registerForm.style.position = "relative";
        registerForm.style.top = `0px`;
        loginForm.style.position = "relative";
        loginForm.style.top = `0px`;
        showbtn.style.top = `-85px`;
        signUpShown = false;
    }
}

function showSignUpForm() {    
    const loginForm = document.getElementById('login');
    const showbtn = document.getElementById('showSignUp');
    const registerForm = document.getElementById('register');
    if (signUpShown === false) {
        registerForm.style.position = "relative";
        registerForm.style.top = `0px`;
        loginForm.style.position = "absolute";
        loginForm.style.top = `${registerForm.offsetHeight + 20}px`;
        showbtn.style.top = `${loginForm.offsetHeight - 85}px`;
        signUpShown = true;
    }
    else {
        loginForm.style.position = "relative";
        loginForm.style.top = `0px`;
        registerForm.style.position = "absolute";
        registerForm.style.top = `-${loginForm.offsetHeight + 20}px`;
        showbtn.style.top = `-85px`;
        signUpShown = false;
    }
}

let isLoginVisible = true;
function toggleDataForms() {
    const overlay = document.getElementById('overlay');
    if (isLoginVisible) {
        overlay.innerHTML = `<h1>Hello, Friend!</h1>
        <p>Dont Have an Account? Sign Up Now!</p>
        <button class="submitBtn" onclick="toggleDataForms();" value="SignUP">Sign UP</button>`;
        overlay.style.right = `0px`;
        overlay.style.setProperty('--bg-pos', 'right');
        isLoginVisible = false;
    }
    else {
        overlay.innerHTML = `<h1>Welcome Back!</h1>
        <p>Already Have an Account? Sign In Now!</p>
        <button class="submitBtn" onclick="toggleDataForms();" value="SignIN">Sign IN</button>`;
        overlay.style.right = `${overlay.offsetWidth}px`;
        overlay.style.setProperty('--bg-pos', 'left');
        isLoginVisible = true;
    }
}

function adjustDataFormsOnResize(){
    if(isLoginVisible == true){
        console.log('resize detected');
        overlay.style.right = `${overlay.offsetWidth}px`;
    }
}

// Add Task
try{
    const form = document.getElementById('addTaskForm')
    const modalEl = document.getElementById("addTaskModal");
    const modal = bootstrap.Modal.getOrCreateInstance(modalEl);
    modalEl.addEventListener("show.bs.modal", () => {
        form.reset();
        form.classList.remove("was-validated");
    });

    form.addEventListener('submit', (e) => {
        if (!form.checkValidity()) {
            e.preventDefault();
            e.stopPropagation();
            form.reportValidity();
        }
        else{
            e.preventDefault()
            form.requestSubmit(); // validates + submits
            modal.hide(); 
            addTask(form);
        }

        form.classList.add('was-validated')
    }, false)
}
catch{
    console.log("No Form")
}

function addTask(form){
    const tasks = document.getElementById('tasks')

    let data = new FormData(form)
    let tName = data.get('taskname').toString()
    let dateFrom = data.get('taskdatefrom').toString()
    let dateTo = data.get('taskdateto').toString()
    let timeFrom = data.get('tasktimefrom').toString()
    let timeTo = data.get('tasktimeto').toString()
    let description = data.get('description').toString()

    console.log(tName)
    console.log(dateFrom)
    console.log(dateTo)
    console.log(timeFrom)
    console.log(timeTo)
    console.log(description)

    tasks.innerHTML += `
        <div>
            <div class="task">
                <div class="taskNumber">
                    <div class="shape">
                        <h1 class="num"><span>01</span></h1>
                    </div>
                </div>
                <div class="taskContent">
                    <div class="text">
                        <h2 class="mb-3">${tName}</h2>
                        <div class="mb-2">
                            <h5>Date / Time</h5>
                            <p>From: ${timeFrom} To: ${timeTo}</p>
                            <p>From: ${dateFrom} To: ${dateTo}</p>
                        </div>
                        <div class="d-flex">
                            <p>${description}</p>
                        </div>
                    </div>
                    <div class="btns">
                        <button class="btn btn-primary"><i class="bi bi-check2-circle"></i></button>
                        <button class="btn btn-danger" onclick="rmTask(this);"><i class="bi bi-x-octagon"></i></button>
                    </div>
                </div>
            </div>
        </div> 
    `
}

function rmTask(btn){
    btn.parentElement.parentElement.parentElement.parentElement.remove()
}