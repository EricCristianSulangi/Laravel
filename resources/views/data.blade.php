@extends ('layout')

@section('content')
@if (session('successUpdate'))
    <div class="alert alert-succes">{{session('successUpdate')}}</div>
@endif
<table class="table table-success table-striped">

        <tr>
            <td>No</td> 
            <td>Kegiatan</td>
            <td>Deksripsi</td>
            <td>Batas Waktu</td>
            <td>Status</td>
            <td>Aksi</td>
        </tr>

     @php
         $no = 1;
     @endphp
     @foreach ($todos as $todo)
         <tr>
            {{--tiap di looping, $no bakal ditambah 1 --}}
            <td>{{$no++}}</td>
            <td>{{$todo['title']}}</td>
            <td>{{$todo['description']}}</td>
            {{--carbon : package date pada laravel nantinya si date yang 2022-11-22 formatnya jadi 22 novembar 2022--}}
            <td>{{\Carbon\Carbon::parse($todo['date'])->format('j,F,Y')}}</td>
            {{--konsep ternary if statusnya 1 nampilin teks compalted kalo 0 nampilin teks on-procces. status tuh bololean kan?
            cuma antara 1 atau 0 --}}
            <td>{{$todo['status'] ? 'complated' : 'On-Process' }}</td>
            <td>
                <a href="/edit/{{$todo['id']}} ">edit</a> 
                {{--fitur delete harus menggunakan form lagi tombol hapusnya disimpan di tag button--}}
                <form action="/destroy/{{$todo['id']}}" method="POST">
                    @csrf
                    {{--menimpa method="POST" KARENA DI route nya menggunakan method delete--}}
                    @method('DELETE')
                    <button type="submit">HAPUS</button>
                </form>
                @if ($todo['status'] == 0)
              <form action="/complated/{{$todo['id']}}" method="POST">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-succes">Complated  </button>
            </form>
            @endif
            </td>
         </tr>
     @endforeach
    </table>
     @endsection