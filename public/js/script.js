
document.addEventListener("DOMContentLoaded", function() {
    // Buat tombol hamburger
    const nav = document.querySelector('nav');
    const hamburger = document.createElement('button');
    hamburger.innerHTML = "&#9776;";
    hamburger.className = "hamburger";
    hamburger.style.display = "none";
    hamburger.style.background = "none";
    hamburger.style.border = "none";
    hamburger.style.fontSize = "2em";
    hamburger.style.color = "#fff";
    hamburger.style.cursor = "pointer";
    hamburger.style.marginLeft = "1rem";
    nav.parentNode.insertBefore(hamburger, nav);

    function checkWidth() {
        if(window.innerWidth <= 900) {
            nav.style.display = "none";
            hamburger.style.display = "block";
        } else {
            nav.style.display = "flex";
            hamburger.style.display = "none";
            // Reset style nav ke mode laptop
            nav.style.flexDirection = "";
            nav.style.background = "";
            nav.style.position = "";
            nav.style.top = "";
            nav.style.right = "";
            nav.style.width = "";
            nav.style.zIndex = "";
        }
    }

    hamburger.addEventListener("click", function() {
        if(nav.style.display === "none") {
            nav.style.display = "flex";
            nav.style.flexDirection = "column";
            nav.style.background = "#005598";
            nav.style.position = "absolute";
            nav.style.top = "60px";
            nav.style.right = "10px";
            nav.style.width = "80vw";
            nav.style.zIndex = "999";
        } else {
            nav.style.display = "none";
        }
    });

    window.addEventListener("resize", checkWidth);
    checkWidth();
});

function checkWidth() {
    if(window.innerWidth <= 900) {
        nav.style.display = "none";
        hamburger.style.display = "block";
    } else {
        nav.style.display = "flex";
        hamburger.style.display = "none";
        // Reset style nav ke mode laptop
        nav.style.flexDirection = "";
        nav.style.background = "";
        nav.style.position = "";
        nav.style.top = "";
        nav.style.right = "";
        nav.style.width = "";
        nav.style.zIndex = "";
    }
}
