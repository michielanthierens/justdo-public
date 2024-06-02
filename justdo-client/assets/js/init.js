"use strict"

const USERNAME_FIELD = document.querySelector("#usernameInput");
const PASSWORD_FIELD = document.querySelector("#passwordInput")
const BUTTONS = document.querySelector("#buttons")
const LOGIN_BUTTON = document.querySelector("#login_button");
const REGISTER_BUTTON = document.querySelector("#register_button");
const FORM_PAGE = document.querySelector("#form");
const GO_BACK_BUTTON_FORM = document.querySelector("#go_back_button_form")
const FORM = document.querySelector("form");
let LOGIN_TYPE = "login";

document.addEventListener("DOMContentLoaded", init)

function init() {
    setEventHandlers()
}


function setEventHandlers() {
    LOGIN_BUTTON.addEventListener("click", showForm)
    REGISTER_BUTTON.addEventListener("click", showForm)
    GO_BACK_BUTTON_FORM.addEventListener("click", showButtons)
}

function showButtons(e) {
    e.preventDefault();

    BUTTONS.classList.remove("hidden");
    FORM_PAGE.classList.add("hidden");
}


function showForm(e) {
    e.preventDefault()
    if (e.target.id === "login_button") {
        LOGIN_TYPE = "login"
    } else {
        LOGIN_TYPE = "register"
    }
    console.log(LOGIN_TYPE)
    BUTTONS.classList.toggle("hidden")
    FORM_PAGE.classList.toggle("hidden")
    FORM.addEventListener("submit", submitLoginForm)
}


function submitLoginForm(e) {
    e.preventDefault();
    console.log(`fetch: http://fit.michiel/${LOGIN_TYPE}`)
    fetch(`http://fit.michiel/${LOGIN_TYPE}`, {
        method: "POST",
        headers: {"Content-Type": "application/json"},
        body: JSON.stringify(getLoginData())
    })
        .then(response => response.json())
        .then(res => {
            console.log(res)
            //todo if authentication was successful, go to other page
        })
        .catch(error => {
            if ("errors" in error) {
                displayErrors(error.errors);
            } else {
                console.log(error)
            }
        })


}


function getLoginData() {
    return {
        username: USERNAME_FIELD.value,
        password: PASSWORD_FIELD.value
    }

}

function displayErrors(errors) {
    const $ul = document.querySelector("#errors");

    for (const field in errors) {
        for (const error of errors[field]) {
            const li = `<li>${error}</li>`;
            $ul.innerHTML += li;
        }
    }
}