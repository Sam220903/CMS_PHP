token = localStorage.getItem('token');
admin_id = localStorage.getItem('admin_id');
if (!token) {
    window.location.href = 'http://localhost/Proyecto/dashboard/';
}

console.log(token);
console.log(admin_id);

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



/*
{
    "user_data" : {
        "name" : "Juan",
        "last_name" : "Gabriel",
        "profession" : "Cantautor",
        "biography" : "Alberto Aguilera Valadez, conocido como Juan Gabriel, nació en Parácuaro, Michoacán, México, el 7 de enero de 1950. De origen humilde, enfrentó grandes adversidades antes de alcanzar la fama como uno de los compositores e intérpretes más icónicos de la música mexicana. Su estilo único fusionó baladas, rancheras y música pop, ganándose el apodo de 'El Divo de Juárez'",
        "motivation" : "Transmitir emociones profundas a través de la música y llevar un mensaje de amor y esperanza a quienes más lo necesitan.",
        "phone" : 6565559090, 
        "email" : "juangabriel@divodemexico.mx",
        "adress" : "Av. Juárez 123, Ciudad Juárez",
        "admin_id" : 1
    },
    "skills" : [{
        "skill_id" : 3,
        "intensity" : 6
        },{
            "skill_id" : 5,
            "intensity" : 4
        },{
            "skill_id" : 8,
            "intensity" : 5
        }
    ],
    "projects" : [{
            "project_id" : 6
        },{
            "project_id" : 9
        },
        {
            "project_id" : 1
    }],
    "goals" : [{
        "goal" : "Romper barreras en la música popular."
    }, {
        "goal" : "Inspirar a las nuevas generaciones de artistas."
    }, {
        "goal" : "Preservar la cultura musical mexicana."
    }, {
        "goal" : "Crear un legado de amor y aceptación."
    } , {
        "goal" : "Ayudar a quienes enfrentan dificultades sociales."
    }],
    "strengths" : [{
        "strength_id" : 5,
        "value" : 58
    },{
        "strength_id" : 6,
        "value" : 95
    },{
        "strength_id": 8,
        "value" : 85
    },{
        "strength_id" : 2,
        "value" : 78
    }]

}

*/

function getBase64(file) {
    return new Promise((resolve, reject) => {
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => resolve(reader.result);
        reader.onerror = error => reject(error);
    });
}


async function addUser() {
    const form = document.getElementById('create-user-form'); 
    const formData = new FormData(form);

    let user_photo =  await getBase64(formData.get('photo'));

    const userData = {
        user_data: {
            name: formData.get('name'),
            last_name: formData.get('last-name'),
            profession: formData.get('profession'),
            biography: formData.get('biography'),
            motivation: formData.get('motivation'),
            photo : user_photo,
            phone: formData.get('phone'),
            email: formData.get('email'),
            adress: formData.get('address'), 
            admin_id: localStorage.getItem('admin_id')
        },
        skills: [
            { skill_id: formData.get('skills-set-1'), intensity: formData.get('skill1-level') },
            { skill_id: formData.get('skills-set-2'), intensity: formData.get('skill2-level') },
            { skill_id: formData.get('skills-set-3'), intensity: formData.get('skill3-level') }
        ],
        projects: [
            { project_id: formData.get('projects-set-1') },
            { project_id: formData.get('projects-set-2') },
            { project_id: formData.get('projects-set-3') }
        ],
        goals: [
            { goal: formData.get('goal1') },
            { goal: formData.get('goal2') },
            { goal: formData.get('goal3') },
            { goal: formData.get('goal4') },
            { goal: formData.get('goal5') }
        ],
        strengths: [
            { strength_id: formData.get('strengths-set-1'), value: formData.get('str1-level') },
            { strength_id: formData.get('strengths-set-2'), value: formData.get('str2-level') },
            { strength_id: formData.get('strengths-set-3'), value: formData.get('str3-level') },
            { strength_id: formData.get('strengths-set-4'), value: formData.get('str4-level') }
        ]
    };

    console.log('User data:', userData);

    // Prepare request options
    const requestOptions = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        },
        body: JSON.stringify({
            endpoint: 'addUser',
            method: 'POST',
            user: userData,
            token: localStorage.getItem('token')
        }),
        redirect: 'follow'
    };

    try {
        // Fetch and handle response
        const response = await fetch('http://localhost/Proyecto/dashboard/php/intermediary.php', requestOptions);
        const result = await response.text();
        const data = JSON.parse(result);

        // Show message and reset form
        alert(data.message);
        form.reset(); // Use form.reset() instead of manually clearing each field
    } catch (error) {
        console.error('Error adding user:', error);
        alert('An error occurred while adding the user.');
    }
}


const addUserButton = document.getElementById('create-user-btn');

addUserButton.addEventListener('click' , (e) => {
    e.preventDefault();
    addUser();
});

