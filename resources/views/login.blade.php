<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style2.css')}}">
    <link rel="shortcut icon" href="{{asset('assets/img/RPL.png')}}" type="image/x-icon">
</head>
<body>
<div class="main">  	
    <Div class="login">
    <h1>Halam login</h1></Div>
    
    <br>
    @if (session('berhasil'))
        <p style="color: rgb(0, 4, 255)">{{session('berhasil')}}</p>
    @endif
    <form action="{{route('login-baru')}}" method="POST">
    @csrf 
    <div class="email">
    Email   :         <input type="email" name="email" placeholder="Masukin email">
    <br>
   Password : <input type="password" name="password" placeholder="Masukan password">
    <br>
    <button type="submit">login</button></div>
    <br>
    </div>
    @if (session('error'))
            {{session('error')}}
    @endif

    @if (session('islogin'))
    {{session('islogin')}}
@endif

        </form>
    </body>
</html>