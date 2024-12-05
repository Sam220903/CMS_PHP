const token = localStorage.getItem('token');


const username = localStorage.getItem('username');
const admin_id = localStorage.getItem('admin_id');

if (token) {
    const adminName = document.getElementById('admin-username');
    adminName.innerHTML = username;
}


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


async function getUsers() {
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'getUsers',
            method : 'GET',
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const users = JSON.parse(result);
        const usersTable = document.getElementById('users-table-body');
        usersTable.innerHTML = '';
        users.forEach(user => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${user.id}</td>
                <td>${user.name}</td>
                <td>${user.last_name}</td>
                <td>${user.profession}</td>
                <td>${user.email}</td>
                <td>
                    <button class="btn-user-action btn-view" onclick="viewUser(${user.id})">
                        <i class="fas fa-eye"></i>
                    </button>
                    <button class="btn-user-action btn-edit">
                        <i class="fas fa-pencil"></i>
                    </button>
                    <button class="btn-user-action btn-delete" onclick="verifyDeleteUser(${user.id})">
                        <i class="fas fa-trash"></i>
                    </button> 
                </td>
            `;
            usersTable.appendChild(tr);
        });
    });
}

getUsers();

function viewUser(id) {
    window.location.href = `http://localhost/Proyecto/app/?user_id=${id}`;
}

function verifyDeleteUser(id) {
    const confirmDelete = confirm('¿Estás seguro de que deseas eliminar este usuario?');
    if (confirmDelete) {
        deleteUser(id);
    }
}

async function deleteUser(id) {
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'deleteUser',
            method : 'DELETE',
            user_id : id
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        alert(data.message);
        getUsers();
    });
}


