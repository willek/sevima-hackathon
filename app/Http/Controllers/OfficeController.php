<?php

namespace App\Http\Controllers;

use App\Models\Office;
use Illuminate\Http\Request;

class OfficeController extends Controller
{
    public function index() {
        $data['offices'] = Office::orderBy('created_at', 'desc')->get();

        return view('pages.offices.index', $data);
    }

    public function create() {
        return view('pages.offices.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'lat' => 'nullable',
            'lng' => 'nullable'
        ]);

        Office::create($request->all());

        return redirect()->route('offices.index');
    }


    public function edit($id) {
        $data['data'] = Office::findOrFail($id);

        return view('pages.offices.edit', $data);
    }

    public function update(Request $request, $id) {
        $office = Office::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'lat' => 'nullable',
            'lng' => 'nullable'
        ]);

        $office->update($request->all());

        return redirect()->route('offices.index');
    }

    public function destroy($id) {
        Office::where('id', $id)->delete();

        return redirect()->route('offices.index');
    }
}
