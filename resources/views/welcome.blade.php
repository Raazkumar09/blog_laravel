<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

<head>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .post-tile {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .post-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .post-content {
            font-size: 16px;
            flex-grow: 1;
        } .container {
            max-width: 1200px; 
            margin: 0 auto;
            padding: 20px;
        }

        .post-tile {
            background-color: #f3f4f6;
            border: 1px solid #e5e7eb;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .post-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .post-content {
            font-size: 16px;
            flex-grow: 1;
        } 
    
 

    </style>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><b>Blog Site</b></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Dashboard <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/user/register">Register</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="/user/login">Login</a>
      </li>
       
    </ul>
   
  </div>
</nav><main role="main" class="container">
    <div class="my-3 p-3 bg-white rounded box-shadow">
        <h1 class="mb-4 my-3 p-3 bg-white rounded box-shadow text-center">Our Blog Site</h1>
        <h6 class="border-bottom border-gray pb-2 mb-4">Recent updates</h6>

        <!-- Loop through the posts and display them as tiles -->
        <div class="row">
            @foreach ($posts as $post)
                @php
                    $user = $post->user; // Assuming there's a user relationship in your Post model
                @endphp

                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset('storage/' . $post->img) }}" alt="Image" class="card-img-top">
                        <div class="card-body">
                            @if ($user)
                                <h5 class="card-title">Created By: {{ $user->name }}</h5>
                            @else
                                <h5 class="card-title">Unknown User</h5>
                            @endif
                            <h6 class="card-subtitle mb-2 text-muted">Title: {{ $post->title }}</h6>
                            <p class="card-text">Content: {{ $post->content }}</p>
                            <p class="card-text">Created At: {{ $post->created_at }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <!-- End of posts -->
    </div>
    {{  $posts->links() }}
</main>
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
