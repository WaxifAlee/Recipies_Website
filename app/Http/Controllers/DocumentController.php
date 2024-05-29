<?php
namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{    /**
     * Display a listing of the documents.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::where('user_id', Auth::id())->get();
        return view('documents.index', compact('documents'));
    }

    /**
     * Store a newly created document in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'document' => 'required|mimes:pdf,doc,docx|max:2048',
        ]);

        $file = $request->file('document');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('documents', $fileName, 'public');

        $document = new Document();
        $document->user_id = Auth::id();
        $document->file_name = $fileName;
        $document->file_path = '/storage/' . $filePath;
        $document->save();

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully.');
    }

    /**
     * Remove the specified document from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        if ($document->file_path) {
            Storage::delete(public_path($document->file_path));
        }
        $document->delete();
        return redirect()->route('documents.index')->with('success', 'Document deleted successfully.');
    }
}
