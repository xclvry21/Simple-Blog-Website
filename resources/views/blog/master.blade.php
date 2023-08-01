<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{config('app.name')}}</title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('images') }}/blog.ico">
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('blog_home_page') }}/css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{route('blog.index')}}">{{config('app.name')}}</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @if (Auth::user())
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="{{route('post.index')}}">Dashboard</a></li>
                            <form action="{{ url('logout') }}" method="POST">
                                @csrf
                                <input type="submit" value="Logout">
                            </form>
                        </ul>
                    @else
                        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                            <li class="nav-item"><a class="nav-link" href="{{route('login')}}">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="{{route('register')}}">Register</a></li>
                        </ul>
                    @endif
                </div>
            </div>
        </nav>
        
        @yield('blog_contents')
        <!-- End Page-content -->

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; {{config('app.name')}} 2023</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
