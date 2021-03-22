<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\File;
use File as FileO;
use ZipArchive;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pelanggan = Pelanggan::orderBy('updated_at', 'desc')->get();
        
        return view('pelanggan.index', compact('pelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            "file1.max" => "Maksimal 3 file."
         ];
        
        $request->validate([
            'nomor_so' => 'required',
            'nama' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:255',
            'ptl' => 'required',
            'file1.*' => 'mimes:pdf|max:5000',
            'file1' => 'max:3', 
        ], $messages);

        $input = $request->only(['nomor_so','nama', 'alamat', 'status', 'ptl', 'file1']);
        $input['activator_id'] = auth()->user()->id;

        if ($request->hasFile('file1')) {
            foreach ($request->file('file1') as $key => $pdf) {
                $name = rand().$key.'.'.$pdf->getClientOriginalExtension();
                $pdf->move(public_path('asset/file'), $name);
                $data[] = $name;
            }
        }
        $input['file1'] = json_encode($data);

        // dd($input);
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
        $data = Pelanggan::find($id);
        return view('pelanggan.edit', compact('data'));
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
        $messages = [
            "file1.max" => "Maksimal 3 file."
         ];

        $request->validate([
            'nomor_so' => 'required',
            'nama' => 'required|min:3|max:255',
            'alamat' => 'required|min:3|max:255',
            'status' => 'required',
            'ptl' => 'required',
            'file1.*' => 'mimes:pdf|max:5000',
            'file1' => 'max:3', 
        ], $messages);
        
        $pelanggan = Pelanggan::find($id);
        $input = $request->all();
        // dd($input);

        $old_file1 = $pelanggan->file1;
        if($request->hasFile('file1')) {
            if($old_file1 != null) {
                foreach (json_decode($old_file1) as $key => $pdf) {
                    File::delete('asset/file/'.$pdf);
                }
            }
            foreach ($request->file('file1') as $key => $pdf) {
                $name = rand().$key.'.'.$pdf->getClientOriginalExtension();
                $pdf->move(public_path('asset/file'), $name);
                $data[] = $name;
            }
            $input['file1'] = json_encode($data);
        } else {
            unset($input['file1']);
        }

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
        if($pelanggan->file1 != null) {
            foreach (json_decode($pelanggan->file1) as $key => $pdf) {
                File::delete('asset/file/'.$pdf);
            }
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan.index')->with('status', 'Pelanggan berhasil dihapus');
    }

    public function getDownload(Pelanggan $pelanggan)
    {
        $headers = ["Content-Type"=>"application/zip"];
        $fileName = $pelanggan->nama.'-'.rand().'.zip';

        $zip = new ZipArchive;
   
   
        if ($zip->open(public_path($fileName), ZipArchive::CREATE) === TRUE)
        {
            $files = [];
            
            foreach(json_decode($pelanggan->file1) as $key => $value){
                $files[] = public_path(). "/asset/file/". $value;
            }

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
             
            $zip->close();
        }
    
        return response()->download(public_path($fileName), $fileName, $headers);
    }
}
