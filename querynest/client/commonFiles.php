<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
<link rel="stylesheet" href="./public/style.css" />
<script>
    (function () {
        if (window.darkModeLoaded) return;
        window.darkModeLoaded = true;

        document.addEventListener("DOMContentLoaded", function () {
            const toggleBtn = document.getElementById("darkToggle");
            if (!toggleBtn) return;

            const body = document.body;

            // Load saved theme
            if (localStorage.getItem("theme") === "dark") {
                body.classList.add("dark-mode");
                toggleBtn.textContent = "☀️";
            }

            toggleBtn.addEventListener("click", function () {
                body.classList.toggle("dark-mode");

                if (body.classList.contains("dark-mode")) {
                    localStorage.setItem("theme", "dark");
                    toggleBtn.textContent = "☀️";
                } else {
                    localStorage.setItem("theme", "light");
                    toggleBtn.textContent = "🌙";
                }
            });
        });
    })();
</script>