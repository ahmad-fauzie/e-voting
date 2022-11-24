const passInput = document.querySelector("#input-password input");
const toggleIcon = document.querySelector("#input-password .toggle");
const ground = document.querySelector("#input-password .ground");
const persenBar = document.querySelector(".pass-persen span");
const passLabel = document.querySelector(".pass-label");

passInput.addEventListener("input", handlePassInput);
toggleIcon.addEventListener("click", togglePassInput);

function handlePassInput(e){
    if(passInput.value.length === 0){
        passLabel.innerHTML = "Strength";
        addClass();
    } else if(passInput.value.length <= 4){
        passLabel.innerHTML = "Weak";
        addClass("weak");
    } else if(passInput.value.length <= 7){
        passLabel.innerHTML = "Not Bad";
        addClass("average");
    }else {
        passLabel.innerHTML = "Strong";
        addClass("strong");
    }
}

function addClass(className){
    persenBar.classList.remove("weak");
    persenBar.classList.remove("average");
    persenBar.classList.remove("strong");
    if(className){
        persenBar.classList.add(className);
    }
}

function togglePassInput(e){
    const type = passInput.getAttribute("type");
    if(type === "password"){
        passInput.setAttribute("type", "text");
        toggleIcon.innerHTML = "X";
        ground.style.cssText = `
        border-radius: 4px;
        width: 100%;
        height: 100%;
        right: 0;
        z-index: -1;
        `;
        passInput.style.color = "#000";
        // passInput.style.background = "transparent";
        passInput.style.background = "#fff";
        toggleIcon.style.fontSize = "27px";
    } else{
        passInput.setAttribute("type", "password");
        toggleIcon.innerHTML = "O";
        toggleIcon.style.cssText = "25px";
        ground.style.cssText = `
        border-radius: 50px;
        width: 35px;
        height: 35px;
        right: 10px;
        z-index: 1;
        `;
        passInput.style.color = "#fff";
        passInput.style.background = "#112d37";
    }
}