<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ImageController extends Controller
{
    public function index()
  {
    return response()->json(Image::all());
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
  ]);

  if ($validator->fails()) {
      return response()->json(['error' => $validator->errors()], 400);
  }

  $image = $request->file('file');
  $name = time().'.'.$image->getClientOriginalExtension();
  $path = $image->storeAs('public/images', $name);

  Image::create([
      'path' => $path,
  ]);

  return response()->json(['message' => 'Image uploaded successfully.'], 201);
  }

  public function show(Image $image)
  {
    return response()->json($image);
  }

  public function update(Request $request, $id)
  {
    $image = Image::findOrFail($id);
    $path = $request->file('path')->store('public/images');
    $image->update([
        'path' => Storage::url($path)
    ]);
    return response()->json($image);
  }

  public function destroy($id)
  {
    $image = Image::findOrFail($id);
    Storage::delete($image->path);
    $image->delete();

    return response()->json(null, 204);
  }
}