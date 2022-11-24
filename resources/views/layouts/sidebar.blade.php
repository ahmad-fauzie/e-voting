<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sidebar 5</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./styles.css" />
</head>

<body>
    <button type="button" class="burger" onclick="toggleSidebar()"></button>
    <div class="background"></div>
    <aside class="sidebar">
        <button type="button">
            <i class="material-symbols-outlined">home</i>
            <span>Home</span>
        </button>
        <div>
            <button type="button">
                <i class="material-symbols-outlined">search</i>
                <span>Explorer</span>
            </button>
            <button type="button">
                <i class="material-symbols-outlined">settings</i>
                <span>Settings</span>
            </button>
            <button type="button">
                <i class="material-symbols-outlined">account_circle</i>
                <span>Account</span>
            </button>
        </div>
        <button type="button">
            <i class="material-symbols-outlined">logout</i>
            <span>Logout</span>
        </button>
    </aside>
    <script type="text/javascript">
        const toggleSidebar = () => document.body.classList.toggle("open");
    </script>
</body>

</html>
