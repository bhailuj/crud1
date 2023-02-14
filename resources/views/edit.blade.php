<!DOCTYPE html>
<html>
<head>
   <title></title>
   <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>


<div class="container">
   <h1 class="text-center">Update Data</h1>
   <form method="POST" action="/update/{{$posts->id}}">
       @csrf
        <div class="mb-3">
           <label><b>post title:</b></label>
           <input type="text" name="title"  class="form-control" value="{{$posts->post_title}}">
        </div>
        <div class="mb-3">
           <label><b>post author:</b></label>
           <input type="text" name="author"  class="form-control" value="{{$posts->post_author}}">
        </div>

        <div class="mb-3">
           <label><b>post address:</b></label>
           <input type="text" name="address"  class="form-control" value="{{$posts->post_address}}">
        </div>

        <div class="mb-3">
            <label><b>email</b></label>
            <input type="text" name="email"  class="form-control" value="{{$posts->email}}">
        </div>

        <div class="mb-3">
            <label><b>password</b></label>
            <input type="text" name="password"  class="form-control" value="{{$posts->password}}">
        </div>

       <input type="submit" name="update" value="Update" class="btn btn-success">
   </form>
</div>


</body>
</html>



