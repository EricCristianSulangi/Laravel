@extends('layout')

@section('content')
<form action="/update/{{$todo['id']}}" method="post" style="max-width: 500px; margin: auto">
    @if ($errors -> any())
    <div class="alert alert alert">
     <ul>
         @foreach ($errors -> all() as $error)
             <li>{{$error}}</li>
         @endforeach
     </ul>
    </div>
    @endif
    {{--mengirim data ke controller yang ditampung oleh request $request--}}
     @csrf
{{--karena atribute method pada tag form cuma bisa get/Post sedangakn buat update
data itu pake method patch jadi method "post" di form di timpa sama method patch ini --}}
     @method('PATCH')
          <div class ="d-flex flex-column">
             <label>Title</label>
              <input type="text" name="title" >
          </div>
          <div class ="d-flex flex-column">
             <label>Date</label>
             <input type="date" name="date" value="{{$todo['title']}} ">
          </div>
          <div class ="d-flex flex-column">
             <label>Description</label>
          <textarea name ="description" cols="30" rows="10">{{$todo['description']}} </textarea>
          <button type="submit">kirim</button>
      </div>
   </form>
@endsection