const search = document.querySelector('input[placeholder="search topic"]');
const topicContainer = document.querySelector((".topics"));
const projectsContainer = document.querySelector(".images");
search.addEventListener("keyup", function (event){
    console.log("Halo")
    if(event.key === "Enter"){

        event.preventDefault();

        const  data= {search: this.value};

        fetch("/search", {
            method: "POST",
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        }).then(function (response) {
            console.log("Halo1");
            return response.json();
        }).then(function (topics) {
            console.log("Halo2");
            topicContainer.innerHTML = "";
            loadProjects(topics)
        });
    }
});

function loadProjects(topics){
    topics.forEach(topic => {
        console.log(topic)
        createTopic(topic)
    })
}

function createTopic(topic){
    const template = document.querySelector("#topicTemplate");
    const clone = template.content.cloneNode(true);

    const topicName = clone.querySelector("b");
    topicName.innerHTML = topic.topic;
    const topicStartDate = clone.querySelector(".topicStartDate");
    topicStartDate.innerHTML = topic.start_date.toString();
    const topicEndDate = clone.querySelector(".topicEndDate");
    topicEndDate.innerHTML = topic.end_date.toString();

    clone.querySelector("b").addEventListener("click", function() {
        console.log("Kliknięto temat:", topic);
        const topicNameDisplay = document.getElementById("topicNameDisplay");
        topicNameDisplay.innerHTML = topic.topic;
        displayProjectsForTopic(topic);
    });

    console.log("Event listener added to topic:", topic);

    topicContainer.appendChild(clone)
}

function displayProjectsForTopic(topic) {
    console.log("works0")
    // Fetch related projects
    fetch(`/competitionImages?topicId=${topic.id_topic}`, {
        method: "GET",
        headers: {
            'Content-Type': 'application/json'
        }
    }).then(function (response) {
        console.log("works1")
        return response.json();
    }).then(function (projects) {
        // Clear existing projects display
        console.log(projects)
        projectsContainer.innerHTML = "";

        // Add each project to the display
        projects.forEach(project => {
            createImageElement(project);
        });
    });
}

function createImageElement(project) {
    const template = document.querySelector("#project-template");

    const clone = template.content.cloneNode(true);
    const div = clone.querySelector("div");
    div.id = project.id_competition_image;
    const image = clone.querySelector("img");
    image.src = `/app/iuploadsTMP/${project.img}`;
    const description = clone.querySelector("p");
    description.innerHTML = project.description;
    const like = clone.querySelector(".fa-heart");
    like.innerText = project.likes;
    const dislike = clone.querySelector(".fa-minus-square");
    dislike.innerText = project.unlikes;

    projectsContainer.appendChild(clone);
}