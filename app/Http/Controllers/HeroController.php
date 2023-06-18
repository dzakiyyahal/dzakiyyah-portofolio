<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper\CRUD;
use Illuminate\Support\Facades\Auth;

class HeroController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $heroes = Hero::all();

        return view('admin/hero', compact('user', 'heroes'));
    }

    public function store(Request $request)
    {
        $insertedData = [
            'nama' => ''
        ];

        if ($request->hasFile('foto')) {
            $logo_sekolah = $request->file('foto');
            $image_name = $logo_sekolah->getClientOriginalName();
            $logo_sekolah->storeAs('public/foto', $image_name);

            $insertedData["nama"] = $image_name;
        }

        Hero::create($insertedData);

        return redirect()->route('admin-hero')->with('success', 'Hero has been added.');
    }

    public function edit($id)
    {
        $data = Hero::find($id)->first();

        return view('admin/edit-hero', compact('data'));
    }

    public function editProses(Request $request, $id)
    {
        $data = Hero::find($id);

        $insertedData = [
            'nama' => ''
        ];

        if ($request->hasFile('foto')) {
            $logo_sekolah = $request->file('foto');
            $image_name = $logo_sekolah->getClientOriginalName();
            $logo_sekolah->storeAs('public/foto', $image_name);

            $insertedData["nama"] = $image_name;
        }

        $data->update($insertedData);

        return redirect()->route('admin-hero')->with('success', 'Hero has been added.');
    }

    public function delete($id)
    {
        $data = Hero::find($id);
        $data->delete();

        return redirect()->route('admin-hero')->with('success', 'Hero has been deleted.');
    }
}