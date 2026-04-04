<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesController extends Controller
{
   public function create(){
       return view('category.create');
   }
   public function store(Request $request){
       $request->validate([
           'name' => 'required|min:3',
           'description' => 'required'
       ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'description.required' => 'Deskripsi kategori wajib diisi'
       ]);

       $now = Carbon::now();
       

       DB::table('categories')->insert([
           'name' => $request->name,
           'description' => $request->description,
           'created_at' => $now,
           'updated_at' => $now
       ]);
       return redirect('/category')->with('success', 'Category berhasil ditambah');
   }
    public function index(){
         $categories = DB::table('categories')->get();
         return view('category.index', ['categories' => $categories]);
    }

    public function show($id){
        $category = DB::table('categories')->find($id);
        return view('category.detail', ['category' => $category]);
    }

    public function edit($id){
        $category = DB::table('categories')->find($id);
        return view('category.edit', ['category' => $category]);
    }

    public function update($id, Request $request){
        $request->validate([
            'name' => 'required|min:3',
            'description' => 'required'
        ], [
            'name.required' => 'Nama kategori wajib diisi',
            'name.min' => 'Nama kategori minimal 3 karakter',
            'description.required' => 'Deskripsi kategori wajib diisi'
        ]);

        $now = Carbon::now();

        DB::table('categories')
        ->where('id', $id)
        ->update([
            'name' => $request->name,
            'description' => $request->description,
            'updated_at' => $now
        ]);

        return redirect('/category')->with('success', 'Category berhasil diupdate');
    }

    public function destroy($id){
        DB::table('categories')->where('id', $id)->delete();
        return redirect('/category')->with('success', 'Category berhasil didelete');
    }
}