const token = localStorage.getItem('token');


function verifyToken() {
    if (!token) {
        window.location.href = 'http://localhost/Proyecto/dashboard';
    }
}

verifyToken();

function logout() {
    localStorage.removeItem('token');
    window.location.href = 'http://localhost/Proyecto/dashboard';
}

const logoutButton = document.getElementById('logout');
logoutButton.addEventListener('click', logout);

const addUsersButton = document.getElementById('add-user');
addUsersButton.addEventListener('click', () => {
    window.location.href = 'http://localhost/Proyecto/dashboard/views/add-user.html';
});

