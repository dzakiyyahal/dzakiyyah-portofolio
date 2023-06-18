<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();

        return view('admin/product', compact('user', 'products'));
    }

    public function store(Request $request)
    {
        $insertedData = [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'detail' => $request->input('detail'),
            'foto' => ''
        ];

        if ($request->hasFile('foto')) {
            $logo_sekolah = $request->file('foto');
            $image_name = $logo_sekolah->getClientOriginalName();
            $logo_sekolah->storeAs('public/foto', $image_name);

            $insertedData["foto"] = $image_name;
        }

        Product::create($insertedData);

        return redirect()->route('admin-product')->with('success', 'Product has been added.');
    }

    public function edit($id)
    {
        $data = Product::find($id)->first();

        return view('admin/edit-product', compact('data'));
    }

    public function editProses(Request $request, $id)
    {
        $data = Product::find($id);

        $insertedData = [
            'nama' => $request->input('nama'),
            'harga' => $request->input('harga'),
            'detail' => $request->input('detail'),
            'foto' => $data->foto
        ];

        if ($request->hasFile('foto')) {
            $logo_sekolah = $request->file('foto');
            $image_name = $logo_sekolah->getClientOriginalName();
            $logo_sekolah->storeAs('public/foto', $image_name);

            $insertedData["foto"] = $image_name;
        }

        $data->update($insertedData);

        return redirect()->route('admin-product')->with('success', 'Product has been added.');
    }

    public function delete($id)
    {
        $data = Product::find($id);
        $data->delete();

        return redirect()->route('admin-product')->with('success', 'Product has been deleted.');
    }
}