document.addEventListener("DOMContentLoaded", function() {
    let about = document.getElementsByClassName("about")[0];
    if (about) {
        about.addEventListener("click", function() {
            window.location.href = "about.php";
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let films = document.getElementsByClassName("films")[0];
    if (films) {
        films.addEventListener("click", function() {
            window.location.href = "films.php";
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let signup = document.getElementsByClassName("signup")[0];
    if (signup) {
        signup.addEventListener("click", function() {
            window.location.href = "signup.php";
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let characters = document.getElementsByClassName("characters")[0];
    if (characters) {
        characters.addEventListener("click", function() {
            window.location.href = "characters.php";
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let login = document.getElementsByClassName("login")[0];
    if (login) {
        login.addEventListener("click", function() {
            window.location.href = "login.php";
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let register = document.getElementsByClassName("register")[0];
    if (register) {
        register.addEventListener("click", function() {
            window.location.href = "action.php";
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let haveacc = document.getElementsByClassName("haveacc")[0];
    if (haveacc) {
        haveacc.addEventListener("click", function() {
            window.location.href = "login.php";
        });
    }
});

document.addEventListener("DOMContentLoaded", function() {
    let dhaveacc = document.getElementsByClassName("dhaveacc")[0];
    if (dhaveacc) {
        dhaveacc.addEventListener("click", function() {
            window.location.href = "signup.php";
        });
    }
});