<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    .navbar {
        background-color: #007bff;
    }

    .navbar-brand {
        color: white;
        font-weight: bold;
    }

    .navbar-toggler-icon {
        background-color: white;
    }

    .navbar-nav .nav-item {
        margin-right: 20px;
    }

    .nav-link {
        color: black;
    }

    .dropdown-menu {
        background-color: #f8f9fa;
    }

    .dropdown-item {
        color: black;
    }

    .header-info {
        display: inline-block;
        margin-left: 5px;
        color: black;
    }
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#"> Blog Site </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link active" href="#">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/user/register">Register</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/user/login">Login</a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="/images/profile/pic1.jpg" width="20" alt="">
                        <div class="header-info">
                            @if($LoggedUser)
                            <span>{{ $LoggedUser ['name'] }}</span>
                            @endif
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <form id="logout-form" action="{{ route('user.logout') }}" method="post">
                            @csrf
                            <button type="submit" class="dropdown-item ai-icon" style="border: none; background: none;">
                                <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                                    height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4">
                                    </path>
                                    <polyline points="16 17 21 12 16 7"></polyline>
                                    <line x1="21" y1="12" x2="9" y2="12"></line>
                                </svg>
                                <span class="ml-2">Logout</span>
                            </button>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container">@if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif
        <div class="container">
            <br>
            <div class="text-center">
                <h2>{{ $LoggedUser ['name'] }} Blog Posts</h2>
            </div>
            <a href="{{route('post.create')}}" class="btn btn-primary mb-3 btn-sm">Create New Blog</a>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th> <!-- Add this new column header -->
                        <th>Title</th>
                        <th>Content</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($LoggedUser->posts->count()>0)
                    @foreach($LoggedUser->posts as $post)
                    <tr>
                        <td>
                            <img src="{{ asset('storage/' . $post->img) }}" alt="Image" width="100">
                        </td>
                        <td>{{$post->title}} </td>
                        <td>{{$post->content}} </td>
                        <td>
                            <a href="{{route('post.edit',['id'=>$post->id])}}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{route('post.delete',['id' => $post->id])}}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"> Delete</button>
                        </td>
                    </tr>

                    @endforeach
                    @endif
                </tbody>
            </table>
            @if($LoggedUser->posts->count()==0)
            <p>You Dont Have Any Post Yet</p>
            @endif
        </div>

        <!-- Bootstrap JavaScript dependencies -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
