<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menenpilkan halaman awal dan semua data
        return view ('login');
    }
    
    public function data(){
        //ambil data dari table todos
        $todos = Todo::all();
        //compact untuk mengirim data ke bladenya
        //isi di compact harus sama kaya yang namanya variable
        return view('data', compact('todos'));
    }
        public function dashboard(){

        return view ('dashboard');
        }
    public function about()
    {
        return view ('about');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //menenmpilkan halaman form input tmbah data
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //mingirim data baru ke database
        $request->validate([
            'title' => 'required|min:3',
            'date'  => 'required',
            'description' => 'required|min:8',
        ]);
        Todo::create([
// yg '' nama colum
//yang $request -> value name di input
/*kenapa kirim 5 data padahalan di input ada 3 inputan ? kalau di cek di table todos itu kan ada 6 column yang harus diisi, salah satunya 
column done_date yang nullable, kalau nullable itu gausa diisi gpp jadi gk diisi dulu
*/
//user_id ngambil id dari fitur auth (history login ), supaya tau itu todo punya siapa
//column status kanboolean jd klo status si todo blm dikerjaain =0
            'title'=> $request ->title,
            'date' => $request->date,
            'description' => $request->description,
            'user_id' => Auth::User()->id,
            'status'=>0,
        ]);
        // kalau berhasil tambah db bakalan diarahin ke dalam dashboard dengan menampilkan pemberitahuan
        return redirect ('/dashboard')-> with ('add','Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //menampilkan satu data spesifik
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //memnpikan halaman form di edit
        //parameter $id mengambil data path dinamis {$id}.
        //ambil satu baris yang memililki value column id sama dengan data path dinamis id yang dikirim ke route 
        $todo = Todo::where('id', $id)->first();
        //kemudian arahkan/tampilkan file view yang bernama edit.blade
        return view('edit',compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        //mengupdate data di data   
        //validasi
        $request->validate([
            'title' => 'required|min:3',
            'date'  => 'required',
            'description' => 'required|min:8',
        ]);
        //cari baris data  yang punya value column id sama dengan id yang dikirm ke route
        Todo::where('id',$id)->update([
         'title'=> $request ->title,
        'date' => $request->date,
        'description' => $request->description,
        'user_id' => Auth::User()->id,
        'status'=>0,
        ]);
        return redirect('/data')->with('successUpdate','Berhasil update!');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //menghapus data di database
        Todo::where('id',$id)->delete();
        //kalau berhasil arahin balik kehalaman data dengan pemberitahuan
        return redirect('/data')->with('successDelete', 'berhasil menghapus data Todo');
    }
public function updateToComplated (Request $request, $id){
    //cari data yang akan diupdate
    //abru setlahnya data diupdate ke datbase melalui model 
    //status tipenya boolean(0/1) : 0(on-process) & 1 (compalted)
    //carbon package laravel yang menggelola segala hal yang berhubungan dengan date 
    //now(): mengambil tanggal hari ini 
    Todo::where('id','=',$id)->update([
        'status'=> 1,
        'done_time'=>\Carbon\Carbon::now(),
    ]);
    //jika berhasil akan dibalikan ke halaman awal (halalam tempat bittom complated berada) kembalikan dengan pemberitahuan
    return redirect()->back()->with('done','ToDo telah selesai dikerjakan');
}
}
