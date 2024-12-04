token = localStorage.getItem('token');
if (!token) {
    window.location.href = 'http://localhost/Proyecto/dashboard/';
}

console.log(token);

async function getSkills(){
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    myheaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'getSkills',
            method : 'GET',
            token : localStorage.getItem('token')
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const skills = data;
        const skillsSelect1 = document.getElementById('skills-set-1');
        const skillsSelect2 = document.getElementById('skills-set-2');
        const skillsSelect3 = document.getElementById('skills-set-3');
        skills.forEach(skill => {
            const option = document.createElement('option');
            option.value = skill.id;
            option.innerHTML = skill.skill;
            skillsSelect1.appendChild(option);
            skillsSelect2.appendChild(option.cloneNode(true));
            skillsSelect3.appendChild(option.cloneNode(true));
        });
    })
}

async function getStrengths(){
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    myheaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'getStrengths',
            method : 'GET',
            token : localStorage.getItem('token')
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const strengths = data;
        const strengthsSelect1 = document.getElementById('strengths-set-1');
        const strengthsSelect2 = document.getElementById('strengths-set-2');
        const strengthsSelect3 = document.getElementById('strengths-set-3');
        const strengthsSelect4 = document.getElementById('strengths-set-4');
        strengths.forEach(strength => {
            const option = document.createElement('option');
            option.value = strength.id;
            option.innerHTML = strength.strength;
            strengthsSelect1.appendChild(option);
            strengthsSelect2.appendChild(option.cloneNode(true));
            strengthsSelect3.appendChild(option.cloneNode(true));
            strengthsSelect4.appendChild(option.cloneNode(true));
        });
    })
}

async function getProjects(){
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    myheaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'getProjects',
            method : 'GET',
            token : localStorage.getItem('token')
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const projects = data;
        const projectsSelect1 = document.getElementById('projects-set-1');
        const projectsSelect2 = document.getElementById('projects-set-2');
        const projectsSelect3 = document.getElementById('projects-set-3');
        projects.forEach(project => {
            const option = document.createElement('option');
            option.value = project.id;
            option.innerHTML = project.project_name;
            projectsSelect1.appendChild(option);
            projectsSelect2.appendChild(option.cloneNode(true));
            projectsSelect3.appendChild(option.cloneNode(true));
        });
    })
}

getSkills();
getStrengths();
getProjects();

async function addSkill(){
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    myheaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'addSkill',
            method : 'POST',
            skill : document.getElementById('skill-name').value,
            token : localStorage.getItem('token')
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const message = data.message;
        alert(message);
        getSkills();
        document.getElementById('skill-name').value = '';
    })
}

const addSkillButton = document.getElementById('add-skill');


addSkillButton.addEventListener('click', addSkill);



async function addStrength(){
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    myheaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'addStrength',
            method : 'POST',
            strength : document.getElementById('strength-name').value,
            token : localStorage.getItem('token')
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const message = data.message;
        alert(message);
        getStrengths();
        document.getElementById('strength-name').value = '';
    })
}

const addStrengthButton = document.getElementById('add-strength');

addStrengthButton.addEventListener('click', addStrength);

async function addProject(){
    const myheaders = new Headers();
    myheaders.append('Content-Type', 'application/json');
    myheaders.append('Authorization', `Bearer ${localStorage.getItem('token')}`);
    const requestOptions = {
        method : 'POST',
        headers : myheaders,
        body : JSON.stringify({
            endpoint : 'addProject',
            method : 'POST',
            project : document.getElementById('project-name').value,
            description : document.getElementById('project-description').value,
            token : localStorage.getItem('token')
        }),
        redirect : 'follow'
    };
    await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const message = data.message;
        alert(message);
        getProjects();
        document.getElementById('project-name').value = '';
        document.getElementById('project-description').value = '';
    })
}

const addProjectButton = document.getElementById('add-project');

addProjectButton.addEventListener('click', addProject);


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
    await fetch('http://localhost/Proyecto/dashboard/php/login.php', requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const token = data.token;
        const message = data.message;
        if (token) {
            alert(message);
            localStorage.setItem('token', token);
            window.location.href = 'http://localhost/Proyecto/dashboard/views/home.html';
        } else {
            alert(message);
        }
    })
}