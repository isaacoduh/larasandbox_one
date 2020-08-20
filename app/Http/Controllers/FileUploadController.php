<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\File;
use App\Image;

class FileUploadController extends Controller
{
    public function createForm()
    {
        return view('file-upload');
    }

    public function fileUpload(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt,xlx,xls,pdf|max:2048']);
        $fileModel = new File;
        if($request->file()){
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads',$fileName, 'public');

            $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = '/storage/'.$filePath;
            $fileModel->save();
            return back()->with('success','File has been uploaded')->with('file', $fileName);
        }
    }

    public function createMultipleForm()
    {
        return view('multifile-upload');
    }

    public function multipleFileUpload(Request $request)
    {
        $this->validate($request,[
            'imageFile' => 'required|max:2048',
            'imageFile.*' => 'mimes:jpg,jpeg,png,gif'
        ]);

        if($imageFiles = $request->file('imageFile')){
            foreach($imageFiles as $file){
                $name = $file->getClientOriginalName();
                $path = $file->storeAs('photos',$name);
                if($file->move($path,$name)){
                    $save = Image::create(['name' => $name, 'image_path' => $path]);
                }
            }
            return back()->with('success', 'File has been uploaded');
        }
    }
}
