const form = document.getElementById('login-form');
const username = document.getElementById('username');
const password = document.getElementById('password');
const submitButton = document.getElementById('login-button');
const togglePassword = document.getElementById('toggle-password');

function enableSubmitButton() {
    if (username.value.trim().length > 0 && password.value.trim().length > 0) {
        submitButton.disabled = false;
        submitButton.classList.remove('disabled');  
    } else {
        submitButton.disabled = true;
        submitButton.classList.add('disabled');  
    }
}

username.addEventListener('input', enableSubmitButton);
password.addEventListener('input', enableSubmitButton);

togglePassword.addEventListener('click', function () {
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);

    this.classList.toggle('fa-eye');
    this.classList.toggle('fa-eye-slash');
});

enableSubmitButton();

async function login() {
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'login',
            method : 'POST',
            credentials : {
                username : username.value,
                password : password.value
            }
        }),
        redirect : 'follow'
    };
    console.log(username.value);
    console.log(password.value);
    await fetch('http://localhost/Proyecto/dashboard/php/login.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const token = data.token;
        const message = data.message;
        if (token) {
            alert(message);
            localStorage.setItem('token', token);
            window.location.href = 'http://localhost/Proyecto/dashboard/views/AdminView.html';
        } else {
            alert(message);
        }
    })
}

form.addEventListener('submit', (event) => {
    event.preventDefault();
    login();
});