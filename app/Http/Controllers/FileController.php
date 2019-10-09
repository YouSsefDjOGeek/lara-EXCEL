<?php

namespace App\Http\Controllers;
use App\FileData;
use Excel;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $files = File::all();
        $count= $files->count();


//        return view('vendor.voyager.tickets.browse')->with('tickets',$tickets)->with('count',$count);
        return view('vendor.voyager.files.browse')->with('files',$files)->with('count',$count);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('vendor.voyager.files.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//
//        $request->validate([
//            'file_pathURL' => 'required',
//        ]);


        $fileData = $request->except('_token');
        //--- File Name
        $File = new File();

        $hasfile= 0;
        if ($request->file('file_pathURL') != '') {
            $hasfile= 1;
        }
        if ($hasfile == 1) {
            $File->filename = time().'_'.$request->file('file_pathURL')->getClientOriginalName();
            $date = new \DateTime(null);
            $File->slug = "YZK-".$date->format('dmYis');
            $File->comment = $fileData['details'];
           $File->filesize = $request->file('file_pathURL')->getSize()/1024;
            $File->id_uploader = Auth::user()->id;
            $fileName = time().'_'.$request->file('file_pathURL')->getClientOriginalName();

            $request->file('file_pathURL')->store(('').$fileName);


        }
        //------ Dealing with uploaded file

//            $file->file_pathURL;
        $request->file('file_pathURL')->move(public_path('/uploads/xls/'),$fileName );
        $File->path = '/uploads/xls/'.$fileName;


        $File->save();
        $xlFile = public_path('uploads/xls/').$fileName;
        $data = Excel::load($xlFile, function ($reader){})->get();
        if(!empty($data)&&  $data->count()>0) {

            foreach ($data as $key => $value) {

                $fileData = new FileData();
                $fileData->id= $File->id;
                $fileData->DAT_MaterialNumber = $value->dat_materialnumber;
                $fileData->DAT_RemainOrderQty = $value->dat_remainorderqty;
                $fileData->DAT_Revesion_level = $value->dat_revesion_level;
                $fileData->DAT_work_center = $value->dat_work_center;
                $fileData->DAT_Released_On = $value->dat_released_on;
                $fileData->DAT_Relased_by = $value->dat_relased_by;
                $fileData->save();
            }
        }

        return redirect()->route('browseFiles')->with('success','Fichier Téléchargé avec success');
    }

    public function compareFiles ($file1, $file2 ) {
        $fDetials1 = DB::table('file_data')->where('id', $file1)->get();
        $fDetials2 = DB::table('file_data')->where('id', $file2)->get();
//        @dd($filedetails2);

        return view("vendor.voyager.files.compare")->with('fDetials1',$fDetials1)->with('fDetials2',$fDetials2);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
          $filedetials = DB::table('file_data')->where('id', $id)->get();
        return view("vendor.voyager.files.details")->with('filedetials',$filedetials);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $file)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $file = File::findOrFail($id);
        $file->delete();
        return redirect()->route('browseFiles')->with('success', 'Fichier supprimé avec success');
    }
}
