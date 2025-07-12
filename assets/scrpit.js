function searchBlog(title) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            var hintElem = document.getElementById("txtHint");
            if (hintElem) {
                hintElem.innerHTML = this.responseText;
            }
        }
    };
    xmlhttp.open("GET", "ajax/search_post.php?q=" + encodeURIComponent(title), true);


    xmlhttp.send();
}

window.onload = function () {
    searchBlog(""); // Leerer String → ruft PHP-Funktion all() auf
};





function deleteBlog(postId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);

            if (this.responseText.includes("erfolgreich")) {
                // Beitrag sofort aus dem DOM entfernen
                var postElement = document.getElementById("post_" + postId);
                if (postElement) {
                    postElement.remove();
                }
            } else {
                alert("Fehler beim Löschen: " + this.responseText);
            }
        }
    };

    var params = "id=" + encodeURIComponent(postId);
    xmlhttp.open("GET", "ajax/delete_Blog.php?" + params, true);
    xmlhttp.send();
}


function komant(answer, id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Hier kannst du etwas mit der Antwort machen
            console.log(this.responseText);
        }
    };

    // Beide Parameter korrekt encodieren
    var params = "q=" + encodeURIComponent(answer) + "&id=" + encodeURIComponent(id);

    xmlhttp.open("GET", "ajax/create_Comment.php?" + params, true);
    xmlhttp.send();
}


function updateBlog(title, content, id) {
    console.log("Blog-Funktion aufgerufen mit:", title, content, id);

    if (!title || !content || !id) {
        alert("Alle Felder müssen ausgefüllt sein!");
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {
            if (this.status == 200) {
                console.log("Erfolgreiche Antwort:", this.responseText);
                // Hier kannst du z.B. deine Anzeige aktualisieren, z.B. nochmal searchBlog("");
                // oder nur eine Erfolgsmeldung anzeigen
                alert(this.responseText);
            } else {
                console.error("Fehler beim Request:", this.status);
            }
        }
    };
    var params = "title=" + encodeURIComponent(title) +
        "&id=" + encodeURIComponent(id) +
        "&content=" + encodeURIComponent(content);

    xmlhttp.open("POST", "ajax/update_Blog.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}


function Blog(title, content, id) {
    console.log("Blog-Funktion aufgerufen mit:", title, content, id);

    if (!title || !content || !id) {
        alert("Alle Felder müssen ausgefüllt sein!");
        return;
    }

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4) {

            if (this.status == 200) {
                console.log("Erfolgreiche Antwort:", this.responseText);

                // Wenn du nicht zwingend etwas anzeigen musst, kannst du das auskommentieren oder entfernen:
                // document.getElementById("txtHint").innerHTML = this.responseText;

                window.location.href = "index.php";
            }
            else {
                console.error("Fehler beim Request:", this.status);
            }
        }
    };


    var params = "title=" + encodeURIComponent(title) +
        "&id=" + encodeURIComponent(id) +
        "&content=" + encodeURIComponent(content);

    xmlhttp.open("POST", "ajax/create_Blog.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(params);
}




function viewkomant(_, postId) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let commentsContainer = document.getElementById("comments_" + postId);
            if (commentsContainer && commentsContainer.style.display === "block") {
                commentsContainer.style.display = "none";
                return;
            }

            commentsContainer.style.display = "block";

            if (!commentsContainer) return;
            var comments = JSON.parse(this.responseText);
            if (comments.length === 0) {
                commentsContainer.innerHTML = "<em>Keine Kommentare vorhanden.</em>";
            } else {
                commentsContainer.innerHTML = "";
                comments.forEach(c => {
                    commentsContainer.innerHTML += `
                        <div style="margin:5px 0;padding:5px;border-left:3px solid #ccc;">
                            <strong>${c.name}</strong>: ${c.content} <br><small>${c.created_at}</small>
                        </div>`;
                });
            }
        }
    };

    xmlhttp.open("GET", "ajax/get_comments.php?post_id=" + encodeURIComponent(postId), true);
    xmlhttp.send();
}

const loginform = document.getElementById('loginform')
if (loginform) {
    loginform.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'login');
        fetch('ajax/login_User.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(formData)
        })
            .then(res => res.text())
            .then(result => {
                console.log("Antwort vom Server:", result);

                if (result.trim() === 'login') {
                    alert("Login erfolgreich!");
                    window.location.href = 'index.php';
                } else {
                    alert("Fehler: " + result);
                }
            })
            .catch(err => {
                alert("Netzwerkfehler beim Login");
                console.error(err);
            });
    });
}



const registrierenform = document.getElementById('registrierenform');


if (registrierenform) {

    registrierenform.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);
        formData.append('action', 'registrieren');

        fetch('ajax/create_User.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams(formData)
        })
            .then(res => res.text())
            .then(result => {

                if (result.trim() === 'registriert') {
                    alert("Registrierung erfolgreich!");
                    window.location.href = 'login.php';
                } else {
                    alert("Fehler: " + result);
                }
            })
            .catch(() => alert("Netzwerkfehler beim Registrieren"));
    });
}
