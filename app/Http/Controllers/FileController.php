<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function store(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        if (Storage::disk('public')->exists('images/' . $file->getClientOriginalName())) {
            $filename = time() . $file->getClientOriginalName();
        }

        $path = $file->storeAs('images', $filename, 'public');

        $file = File::create([
            'path' => $path,
        ]);
        return response()->json($file->toArray());
    }

    public function destroy(Request $request, File $file)
    {
        if (!$file) {
            return $this->sendError('File not found', 404);
        }
        $path = $file->path;
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
            if (ProjectImage::where('file_id', $file->id)->exists()) {
                ProjectImage::where('file_id', $file->id)->delete();
            }
            $file->delete();
            return $this->sendResponse('File deleted successfully');
        }

        return $this->sendError('File not found', 404);
    }
}
