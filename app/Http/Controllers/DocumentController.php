<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    // Hiển thị danh sách tài liệu
    public function index(Request $request)
    {
        // Lấy tham số tìm kiếm và lọc theo định dạng từ request
        $search = $request->input('search');
        $fileExtension = $request->input('file_extension');

        // Lọc tài liệu theo tên và định dạng
        $documents = Document::query()
            ->when($search, function ($query, $search) {
                return $query->where('file_name', 'like', '%' . $search . '%')
                            ->orWhere('file_extension', 'like', '%' . $search . '%'); // Tìm kiếm cả tên và định dạng
            })
            ->when($fileExtension, function ($query, $fileExtension) {
                return $query->where('file_extension', $fileExtension);
            })
            ->get();

        // Lấy danh sách các định dạng file duy nhất từ cơ sở dữ liệu
        $fileExtensions = Document::select('file_extension')
            ->distinct()
            ->get()
            ->pluck('file_extension'); // Lấy ra mảng các phần mở rộng file

        // Trả về view và truyền dữ liệu tài liệu và danh sách định dạng
        return view('documents.index', compact('documents', 'fileExtensions'));
    }

    // Thêm tài liệu mới
    public function store(Request $request)
    {
        if ($request->hasFile('document')) {
            $file = $request->file('document');
            
            $fileName = $file->getClientOriginalName();
            
            $path = $file->storeAs('documents', $fileName, 'public');  
            
            $document = new Document();
            $document->file_name = $fileName;
            $document->file_extension = $file->extension();
            $document->file_path = $path; 
            $document->save();

            return back()->with('success', 'Tài liệu đã được thêm thành công');
        }

        return back()->with('error', 'Vui lòng chọn tệp');
    }

    // Xóa tài liệu
    public function destroy($id)
    {
        $document = Document::findOrFail($id);
        
        $filePath = $document->file_path; 

        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);  
        } 
        
        $document->delete();

        return redirect()->route('dashboard')->with('success', 'Tài liệu đã được xóa thành công!');
    }

    // Tải tài liệu xuống
    public function download($id)
    {
        $document = Document::findOrFail($id);

        $filePath = $document->file_path; 

        if (Storage::exists('public/' . $filePath)) {
            return Storage::download('public/' . $filePath);
        } else {
            return redirect()->route('dashboard')->with('error', 'Tệp không tồn tại.');
        }
    }

}
