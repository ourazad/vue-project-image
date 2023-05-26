<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\FileUpload;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{   

    public function index()
    {
        $fileUpload = FileUpload::all();
        return response()->json($fileUpload);     
    }

      public function store(Request $request){
            
            $request->validate([
               'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            $fileUpload = new FileUpload;
    
            if($request->file()) {
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
    
                // $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
                $fileUpload->path = '/storage/' . $file_path;
            }

            $fileUpload->name = $request->name;
            $fileUpload->save();
                return response()->json(['success'=>'File uploaded successfully.']);
    }
      public function update(Request $request, $id){
            
            $request->validate([
               'file' => 'required|mimes:jpg,jpeg,png,csv,txt,xlx,xls,pdf|max:2048'
            ]);
    
            $fileUpload = FileUpload::find($id);
    
            if($request->file()) {
                $file_name = time().'_'.$request->file->getClientOriginalName();
                $file_path = $request->file('file')->storeAs('uploads', $file_name, 'public');
    
                // $fileUpload->name = time().'_'.$request->file->getClientOriginalName();
                $fileUpload->path = '/storage/' . $file_path;
            }

            $fileUpload->name = $request->name;
            // dd( $fileUpload);
            $fileUpload->save();
                return response()->json(['success'=>'File uploaded successfully.']);
    }
    public function destroy($id)
    {
        $student = FileUpload::find($id);
        $student->delete();
        return response()->json('deleted message from Controller!');
    }
}