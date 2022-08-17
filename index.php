<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GSA Assemble</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

    <link rel="stylesheet" href="assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
</head>

<body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            if(window.location.search.indexOf('?page=') !== -1){
                const url = new URL(window.location);
                let page = url.searchParams.get('page')
                history.pushState(null, null, `/${page}.html`);
                $.ajax({
                    url: `/ajax/${page}.html`,
                    beforeSend: function(){
                        $('.page-content').html('<p>불러오는 중...</p>');
                    },
                    error : function(){
                        window.location.href = "/error.html";
                    },
                    success: function(data){
                        $('.page-content').html(data);
                    },
                    timeout: 5000,
                });
            }else{
                history.pushState(null, null, "/home.html");
                $.ajax({
                    url: "/ajax/home.html",
                    beforeSend: function(){
                        $('.page-content').html('<p>불러오는 중...</p>');
                    },
                    success: function(data){
                        $('.page-content').html(data);
                    },
                    error: function(){
                        window.location.href = "/error.html";
                    },
                    timeout: 5000,
                });
            }
        })
    </script>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="/index.php"><img src="/assets/images/logo/logo.png" alt="Logo" style="width:200px; height: 50px;"></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu" id="sidebarRender">
                        <!-- <li class="sidebar-title">메뉴</li>

                        <li class="sidebar-item active ">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Home</span>
                            </a>
                        </li> -->

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>광주과학고등학교 통합 웹사이트에 오신 걸 환영합니다!</h3>
            </div>
            <div class="page-content">
                
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2022 R&E Project</p>
                    </div>
                    <div class="float-end">
                        <p>설채환 만세!</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="/assets/js/main.js"></script>
    <script>
        let data = {"메뉴": {"Home" : "home.html","TimeTable" : "timetable.html","Schedule" : "schedule.html"},"도움이 필요하세요?" : {"문의하기" : "ask.html","버그 제보하기" : "bug.html"}};
        let sidebarRow = document.getElementById('sidebarRender');
        for(let i = 0; i < Object.keys(data).length; i++){
            // title : console.log(Object.keys(data)[i]);
            let title = document.createElement('li');
            title.className = 'sidebar-title';
            title.innerHTML = Object.keys(data)[i];
            let items = Object.values(data)[i];
            sidebarRow.appendChild(title);
            for(let j = 0; j < Object.keys(items).length; j++){
                // item : console.log(Object.keys(items)[j], Object.values(items)[j]);
                let item = document.createElement('li');
                item.className = 'sidebar-item';
                let link = document.createElement('a');
                link.className = 'sidebar-link';
                link.onclick = function(){
                    history.pushState(null, null, "/" + Object.values(items)[j]);
                    $.ajax({
                        url: "/ajax/" + Object.values(items)[j],
                        beforeSend: function(){
                            $('.page-content').html('<p>불러오는 중...</p>');
                        },
                        success: function(data){
                            $('.page-content').html(data);
                        },
                        error: function(){
                            window.location.href = "/error.html";
                        },
                        timeout: 5000,
                    });
                }
                link.innerHTML = `<i class="bi bi-grid-fill"></i><span>${Object.keys(items)[j]}</span>`;
                item.appendChild(link);
                sidebarRow.appendChild(item);
            }
        }
    </script>
</body>

</html>