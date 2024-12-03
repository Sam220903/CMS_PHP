async function getUserInfo(){
    const myHeaders = new Headers();
    myHeaders.append("Authorization", "123");
    myHeaders.append("Content-Type", "application/json");

    // Obtener el user por parámetro URL
    const user = new URLSearchParams(window.location.search).get('user_id');

    const requestOptions = {
        method: 'POST',
        headers: myHeaders,
        body: JSON.stringify({
            endpoint: 'getUserInfo', 
            method: 'GET',
            user_id: user
        }),
        redirect: 'follow'
    };

    await fetch("http://localhost/Proyecto/app/php/intermediary.php", requestOptions)
    .then((response) => response.text())
    .then((result) => {
        const data = JSON.parse(result);
        const user_info = data.data;
        console.log(user_info);
        if (data.status!=200){
            throw new Error(data.message);
        }else{
            buildHTML(user_info[0])
        }

    })
    .catch(error => console.log('error', error));
}

getUserInfo();


function buildHTML(user_info){
    
    // Poner la foto del usuario
    const user_photo = document.getElementById('user-photo');
    user_photo.src = "../api/img/"+user_info.photo;

    // Colocar el nombre del usuario
    const full_name = user_info.name + " " + user_info.last_name;
    const user_name = document.getElementById("user-name");
    user_name.innerHTML=full_name;


    // Colocar la profesión del usuario
    const profession = document.getElementById('user-profession');
    profession.innerHTML=user_info.profession;
    
    // Colocar la motivación del usuario
    const motivation = document.getElementById('user-motivation');
    motivation.innerHTML=user_info.motivation;

    // Colocar la biografía del usuario
    const biography = document.getElementById('user-biography');
    biography.innerHTML=user_info.biography;

    // Colocar los proyectos del usuario
    const projects = document.getElementById('user-projects');
    const user_projects = user_info.projects;
    let projects_HTML = "";
    for(let project of user_projects){
        projects_HTML +="<div class=\"project\">\n";
        projects_HTML +="<b>"+project.project_name+"</b>";
        projects_HTML += project.description;
        projects_HTML += "</div>";
    }
    projects.innerHTML = projects_HTML;

    // Colocar las metas del usuario
    const goals = document.getElementById('goals-list');
    const user_goals = user_info.goals;
    let goals_HTML = "";
    goals_HTML += "<ul>\n";
    for(let goal of user_goals){
        goals_HTML += "<li>"+goal.goal+"</li>\n"
    }
    goals_HTML += "</ul>";
    goals.innerHTML = goals_HTML;

    // Colocar las fortalezas del usuario
    const strengths = document.getElementById('user-strengths');
    const user_strengths = user_info.strengths;
    let strengths_HTML = "";
    for(let strength of user_strengths){
        strengths_HTML += "<b>"+strength.strength+"</b>";
        strengths_HTML += "<progress value=\""+strength.value+"\" max=\"100\"></progress>"
    }
    strengths.innerHTML = strengths_HTML;
    
    // Colocar las habilidades del usuario
    const skills = document.getElementById('user-skills');
    const user_skills = user_info.skills;
    let skills_HTML = "";
    
    for (let skill of user_skills){
        let skill_intensity = skill.intensity;
        skills_HTML += "<b>"+skill.skill+"</b>";
        skills_HTML += "<div class=\"skill-progress\">"

        for (let i = 0; i < 7; i++){
            if(skill_intensity > 0) skills_HTML += "<div class=\"filled\"></div>";
            else skills_HTML += "<div class=\"empty\"></div>";
            skill_intensity --;
        }

        skills_HTML += "</div>"
    }
    skills.innerHTML = skills_HTML;


    // Colocar el contacto del usuario
    const email = document.getElementById('user-email');
    email.innerHTML = user_info.email;

    const phone = document.getElementById('user-phone');
    phone.innerHTML = user_info.phone;

    const address = document.getElementById('user-address');
    address.innerHTML = user_info.adress;

}

