<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\File;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(auth()->user()->hasRole('sales')){
        //     return 'ok';
        // }
        $pelanggan = Pelanggan::all();

        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:255',
        ]);

        $input = $request->only(['nama', 'alamat', 'status', 'file1']);
        $input['sales_id'] = auth()->user()->id;

        Pelanggan::create($input);

        return redirect()->route('pelanggan.index')->with('status', 'Pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        if(auth()->user()->hasRole('activator')){
        $request->validate([
            'status' => 'required',
            'file1' => 'required|mimes:pdf|max:10000',
            ]);
        }

        if(auth()->user()->hasRole('sales')){
        $request->validate([
            'nama' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:255',
            ]);
        }

        $pelanggan = Pelanggan::find($id);
        $input = $request->all();

        if(auth()->user()->hasRole('activator')){
            $input['activator_id'] = auth()->user()->id;
        }

        $old_file1 = $pelanggan->file1;
        if($request->hasFile('file1')) {
            if($old_file1 != null) {
                File::delete('asset/file/'.$old_file1);
            }
            $input['file1'] = time().'.'.request()->file1->getClientOriginalExtension();
            request()->file1->move(public_path('asset/file'), $input['file1']);
        } else {
            $input['file1'] = $old_file1;
        }
        // dd($input);

        $pelanggan->update($input);

        return redirect()->route('pelanggan.index')->with('status', 'Data pelanggan berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        File::delete('asset/file/'.$pelanggan->file1);
        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('status', 'Pelanggan berhasil dihapus');
    }

    public function getDownload(Pelanggan $pelanggan)
{
    $file= public_path(). "/asset/file/". $pelanggan->file1;
    $headers = [
        'Content-Type' => 'application/pdf',
     ];

    return response()->download($file, 'pelanggan-'.$pelanggan->id.'.pdf', $headers);
}
}
