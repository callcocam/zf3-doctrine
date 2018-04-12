<?php session_start();?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Hello, world!</title>
    <script src="axios/jquery-3.2.1.slim.min.js"></script>

    <script>
    	let AUTH_TOKEN ="Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNvbnRhdG9Ac2lnYXNtYXJ0LmNvbS5iciIsInBhc3N3b3JkIjoiU2VjdXJpdHkifQ.OK05Tio-lBuNa8ieQ0il3-Tcq8uB5ruwdIfAVu2QXSs";
    </script>
  </head>
  <body>
  	<div class="container">

    <h1>Hello, world!</h1>
<form name="logar" method="post" action="/auth">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password"  name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
     <script type="text/javascript" src="axios/axios.min.js" ></script>
     <script type="text/javascript" src="axios/local-storage.js" ></script>
	<script type="text/javascript" src="axios/axios.login.js" ></script>
  </body>
</html>