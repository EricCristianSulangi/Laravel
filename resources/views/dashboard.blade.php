@extends('layout')
@section('content')

@if(session('add'))
<h2>
    <b>
        <i>
            {{ session('add') }}
        </i>
    </b>
</h2>
@endif

<br>
<a href="{{route('logout')}}" style="color :blue text-style:underline">Logout</a>
<br>
{{auth()-> user()->username}}
{{auth()-> user()->email}}


<h1>Selamat datang di halam dashboard</h1>

@if(session('isGuest'))
<h2>
    <b>
        <i>
            {{ session('isGuest') }}
        </i>
    </b>
</h2>
@endif
@endsection