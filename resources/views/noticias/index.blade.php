<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Blog Home </title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="{{ asset('css/blog-home.css') }}">
  
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Blog</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="http://127.0.0.1:8000">Portafolio</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <section class="page-section bg-secondary text-white mb-0" id="carru">
            <div class="container">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    @foreach($last_posts as $index => $post)
                       @if($index==0)
                        <div class="carousel-item active">
                            <a href="http://127.0.0.1:8000/noticas/{{$post->id}}"><img class="d-block w-100" src="{{Storage::url($post->rutaimagen)}}" alt="{{$post->titulo}}"></a>
                            <div class="carousel-caption d-none d-md-block bg-dark">
                                
                                <h5>{{$post->titulo}}</h5>
                            </div>
                        </div>
                        @else
                         <div class="carousel-item">
                            <a href="http://127.0.0.1:8000/noticas/{{$post->id}}"><img class="d-block w-100" src="{{Storage::url($post->rutaimagen)}}" alt="{{$post->titulo}}"></a>
                            <div class="carousel-caption d-none d-md-block bg-dark">
                                
                                <h5>{{$post->titulo}}</h5>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
                      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="sr-only">Previous</span>
                      </a>
                      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="sr-only">Next</span>
                      </a>
              </div>
            </div>
        </section>
  <!-- Page Content -->
  <div class="container">
        
    <div class="row">

      <!-- Blog Entries Column -->
      <div class="col-md">

        <h1 class="my-4">Más Publicaciones
          <small></small>
        </h1>


        <!-- Blog Post -->
        @foreach($posts as $index => $post)
            <div class="card mb-4 shadow-lg">
            <img class="card-img-top" style="max-height:200px"src="{{Storage::url($post->rutaimagen)}}" alt="Card image cap">
            <div class="card-body">
                <h2 class="card-title">{{$post->titulo}}</h2>
                <a href="{{route('noticia.show',$post->id)}}" class="btn btn-primary">Leer Más &rarr;</a>
            </div>
            <div class="card-footer text-muted">
                {{$post->updated_at}}, publicado por
                <a  class="stretched-link" style="position: relative" href="#">{{$post->autor}}</a>
            </div>
            <div class="card-footer text-muted">
                
                <p  class="stretched-link" style="position: relative" href="#">Visitas: {{$post->visitas}}</p>
            </div>
            </div>
        @endforeach
        <!-- Paginación -->
        {{ $posts->links() }}
        
      </div>
    
      <!-- Sidebar Widgets Column -->
     <div class="col-md-4">


        <div class="card my-4 shadow">
          <h5 class="card-header">Publicidad</h5>
          <div class="card-body">
             Publicidad proximamente..
          </div>
        </div>

      </div>

    </div>
    <!-- /.row -->
    

  </div>
  <!-- /.container -->

  <!-- Footer -->
  <footer class="py-5 bg-dark">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; Your Website 2020</p>
    </div>
    <!-- /.container -->
  </footer>

</body>
       
<script>

$('.carousel').carousel()
</script>


</html>
