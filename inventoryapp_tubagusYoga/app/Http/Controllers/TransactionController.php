<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transactions;
use App\Models\Products;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
            $transactions = Transactions::get();
        } else {
            $transactions = Transactions::where('user_id', $user->id)->get();
        }
        return view ('transaction.index', ['transactions' => $transactions]);
    }

    public function create()
    {
        $products = Products::get();
        $users = User::get();
        return view('transaction.create', [
            'products' => $products
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'type' => 'required|in:in,out',
            'amount' => 'required|numeric',
            'notes' => 'nullable|string'
        ]);

        $id_user = Auth::id();

        $product = Products::findOrFail($request->input('product_id'));
        if ($request->input('type') === 'out') {
            if ($product->stock < $request->input('amount')) {
                return redirect('/transaction/create')->with('error', 'Stok tidak mencukupi untuk transaksi keluar.');
            }
            $product->decrement('stock', $request->input('amount'));
        } else {
            $product->increment('stock', $request->input('amount'));
        }

        // Mendapatkan ID pengguna yang sedang login
        $transactions = new Transactions();
        $transactions->product_id = $request->input('product_id'); // Menggunakan input() untuk mengambil nilai product_id;
        $transactions->user_id = $id_user; // Menggunakan ID pengguna yang sedang login
        $transactions->type = $request->input('type');
        $transactions->amount = $request->input('amount');
        $transactions->notes = $request->input('notes');
        $transactions->save();

        return redirect('/transaction')->with('success', 'Transaksi berhasil ditambahkan.');
    }
}
