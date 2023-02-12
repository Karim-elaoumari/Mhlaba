@extends('app')
@section('content')

<nav class="navbar navbar-expand-lg bg-body-tertiary w-100" style="width:100%">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{route('home')}}">Mhlaba</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Pages
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">My Porfile</a></li>
              <li><a class="dropdown-item" href="#">My Store</a></li>
            </ul>

          </li>
          <li class="nav-item">
            <a class="nav-link active" href="#">Plats</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another </a></li>
              <li><a class="dropdown-item" href="#">Another </a></li>
              <li><a class="dropdown-item" href="#">Another </a></li>
            
              
            </ul>

          </li>
          
          @guest
          
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('login')}}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{route('register')}}">Register</a>
          </li>
          @endguest
          
          
        </ul>
        @auth
        

                <a class="nav-link active ps-3 pe-4" aria-current="page" href="{{ route('logout')}}">Logout</a>
        
          @endauth
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
        

      </div>
    </div>
  </nav>
  <nav style="min-width:100%;" class="bg-white row p-3" aria-label="breadcrumb">
    <ol class="breadcrumb col ms-2">
      <li class="breadcrumb-item"><a href="{{route('store')}}">Dashboard</a></li>
      <li class="breadcrumb-item active" aria-current="page">Users</li>
    </ol>
    @auth
       
    <span class="nav-link active col-7 fs-3 " aria-current="page" href="#"> Welcome {{Auth::user()->username}}</span>


   

@endauth
  </nav>
  <section>
    <div class="d-flex">
        <h4 class="ms-3 col">All Users:</h4>
            <button type="button" class="  btn btn-primary btn-rounded text-end me-3 " data-bs-toggle="modal" data-bs-target="#exampleModal">+ Add Plat</button>
    </div>
      <div class="table-responsive p-3">
      <table class="table bg-black text-white">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Status</th>
            <th scope="col "class="text-end pe-5">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($plats as $plat)
            <tr>
                <th scope="row">{{ $loop->index+1}}</th>
                <td>{{$plat->title}}</td>
                <td>{{$plat->price}}</td>
                <td>{{$plat->categorie->name}}</td>
                <td class="text-end"><button type="button"  data-id="{{ $plat->id }}" id="edit-plat" class="btn btn-success btn-sm me-2" style="width:60px" id="edit-plat">Edit</button><button type="button"   data-id="{{ $plat->id }}"  class="btn btn-danger btn-sm" id="delete-plat">Delete</button></td>
            </tr>
            @endforeach

        </tbody>
      </table>
      {!!$plats->links()!!}
    </div>
  </section>


@include('modals.add_plat',['categories'=>$categories])
@include('modals.edit_plat',['categories'=>$categories])
@include('ajax.store')


@endsection