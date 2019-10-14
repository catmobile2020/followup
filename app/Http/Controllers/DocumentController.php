<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::where('status', 0)->latest()->get();
        return view('documents.index', compact('documents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('documents.create', compact('documents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'=>'required',
            'category'=>'required',
            Auth::id() => 'exists:users,id'
        ]);

        if($request->document) {
            $file = $request->document;
            $image_filename = 'document'. time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents/'), $image_filename);
            $imageExtension = array('jpg','jpeg','png', 'gif');
            $excelExtension = array('csv','xlsx');
            $adobeExtension = array('psd','ai');
            $documentExtension = array('docx','txt','doc');
            $archiveExtension = array('rar','zip');
            $pdfExtension = array('pdf');
            if(in_array($file->getClientOriginalExtension(), $imageExtension ))
            {
                $type = 'picture';
            }elseif (in_array($file->getClientOriginalExtension(), $excelExtension ))
            {
                $type = 'excel';
            }elseif (in_array($file->getClientOriginalExtension(), $adobeExtension ))
            {
                $type = 'adobe';
            }elseif (in_array($file->getClientOriginalExtension(), $documentExtension ))
            {
                $type = 'document';
            }
            elseif (in_array($file->getClientOriginalExtension(), $pdfExtension ))
            {
                $type = 'pdf';
            }elseif (in_array($file->getClientOriginalExtension(), $archiveExtension ))
            {
                $type = 'archive';
            }else{
                $type = 'other';
            }

            $document = Document::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'path' => 'uploads/documents/'.$image_filename,
                'type' => $type,
                'user_id' => Auth::id()
            ]);

            return redirect('/admin/my-documents/'.Auth::id())->with('status', 'Your Document has been added');
        }else{
            return redirect()->back()->with('error', 'Please Enter File to upload!!');
        }





    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Document $document)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
}
