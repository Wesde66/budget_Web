<body>
<section id="navbar_top">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">Logo</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mynavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a href="http://localhost/budget/forcast_php_pages/fortnight_forcast.php" class="nav-link">Fortnight budget plan</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Link 1</a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Link 1</a>
                    </li>
                </ul>
                <form class="d-flex">

                    <h6 id="clock">
                        <script>
                            clock();
                            function clock() {
                                setTimeout(clockDisplay, 1000);
                                function clockDisplay() {
                                    var dt = new Date();
                                    var d = dt.getDate();
                                    var mm = dt.toLocaleString('default', {month: 'long'});
                                    var y = dt.getFullYear();
                                    var h = dt.getHours();
                                    var m = dt.getMinutes();
                                    var s = dt.getSeconds();

                                    var myDate = (d + " " + mm + " " + y);
                                    var myTime = (h + ":" + m +":" + s);


                                    document.getElementById('clock').innerHTML = (myDate + "  " + myTime);
                                    clock();
                                }
                            }
                        </script>
                    </h6>
                </form>
            </div>
        </div>
    </nav>
</section>
