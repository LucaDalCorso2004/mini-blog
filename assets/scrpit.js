function searchBlog(title) {

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("txtHint").innerHTML = this.responseText;

        }
    };
    xmlhttp.open("GET", "ajax/search_post.php?q=" + encodeURIComponent(title), true);


    xmlhttp.send();
}

window.onload = function () {
    searchBlog(""); // Leerer String → ruft PHP-Funktion all() auf
};


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

    xmlhttp.open("GET", "ajax/add_kom.php?" + params, true);
    xmlhttp.send();
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

            // Noch nicht sichtbar → einblenden & laden
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

