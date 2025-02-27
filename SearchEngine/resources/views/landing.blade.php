<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SearchBook</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <script type="text/javascript" src="{{ asset('js/custom.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <header>
        <nav style="background-image: linear-gradient( 111.4deg,  rgba(122,192,233,1) 18.8%, rgba(4,161,255,1) 100.2% );" class="navbar navbar-expand-lg navbar-light bg-white shadow-sm rounded">
            <a class="navbar-brand" href="#">Book Searching</a>
        </nav>
        
    </header>
    <main role="main" style="height:200px; background-image: linear-gradient( 111.4deg,  rgba(122,192,233,1) 18.8%, rgba(4,161,255,1) 100.2% );">
        <div class="container pt-5">
            <!-- Another variation with a button -->
        <form action="#" method="GET" onsubmit="return false">
            <div class="dropdown mb-4">
            <button class="btn btn-primary dropdown-toggle" type="button" id="sortMenu" data-bs-toggle="dropdown" aria-expanded="false">
                Pilih Urutan
            </button>
            <ul class="dropdown-menu" aria-labelledby="sortMenu">
                <li><a class="dropdown-item" href="#" onclick="sortData('asc')">Urutkan: A-Z</a></li>
                <li><a class="dropdown-item" href="#" onclick="sortData('desc')">Urutkan: Z-A</a></li>
            </ul>
            </div>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search the Book" name="q" id="cari">
                <div class="col-lg-1">
                <select class="form-control" name="rank" id="rank">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                  </select>
                </div>
                <div class="input-group-append">
                <input class="btn btn-secondary fas fa-search" id="search" type="submit" value="Search">
                </div>
            </div>
        </form>
        </div>
    </main>
    <div class="row m-4" id="content">
     
    </div>

    <script>
        $(document).ready(function() {
            $("#search").click(function(){
                var cari = $("#cari").val();
                var rank = $("#rank").val();
                $.ajax({
                    url:'/search?q='+cari+'&rank='+rank,
                    dataType : "json",
                    success: function(data){
                            $('#content').html(data);
                        },
                        error: function(data){
                            (console.log(data));
                        }
                    });
                });
            });
        
        function sortData(order) {
            const list = document.getElementById('content');
            // const items = Array.from(list.getElementsByClassName('card-title'));
            const items = Array.from(list.getElementsByClassName('card-title'));

            items.sort((a, b) => {
                const valueA = a.textContent.toLowerCase();
                const valueB = b.textContent.toLowerCase();
                return order === 'asc' ? valueA.localeCompare(valueB) : valueB.localeCompare(valueA);
            });

            // Membersihkan dan menambahkan ulang item yang sudah diurutkan
            list.innerHTML = '';
            items.forEach(item => list.appendChild(item.parentElement.parentElement.parentElement.parentElement));
        }
    </script>
</body>
</html>