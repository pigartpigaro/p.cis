{{-- <!DOCTYPE html>
<html>
<head>
<link rel="icon" href="img/LogoNami.svg">
<title>P.CIS</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="/css/main.css">
<link rel="stylesheet" href="/css/bar.css">
  <script src="/js/post.js"></script>
  <script src="/js/search.js"></script>
  <script src="/js/alert.js"></script>
</head>
</html>

  @include('template.sidebar')
    
  <div class="container mt-2">
  @yield('container')
  </div> --}}
@extends('template.main')
@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h4">Welcome back, {{ auth()->user()->name }}</h1>
</div> 
@endsection
  

