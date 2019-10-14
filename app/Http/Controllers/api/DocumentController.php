<?php

namespace App\Http\Controllers\api;

use App\Document;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ApiResponser;

    public function index()
    {
        if(empty($_GET['page']) || $_GET['page']==''){
            $documents = Document::where('status', 0)->latest()->get();
            foreach ($documents as $document){
                switch ($document->category){
                    case 1:
                        $document->category = 'HR';
                        break;
                    case 2:
                        $document->category = 'MANAGEMENT';
                        break;
                    case 3:
                        $document->category = 'Announcement';
                        break;
                    case 4:
                        $document->category = 'Social';
                        break;
                    case 5:
                        $document->category = 'Other';
                        break;
                }
                $document->owner = $document->user->name;
                unset($document->user);
                switch ($document->type)
                {
                    case 'picture':
                        $document->display = $document->path;
                        break;
                    case 'excel':
                        $document->display = 'uploads/documents/icons/excel.png';
                        break;
                    case 'adobe':
                        $document->display = 'uploads/documents/icons/art.png';
                        break;
                    case 'document':
                        $document->display = 'uploads/documents/icons/word.png';
                        break;
                    case 'pdf':
                        $document->display = 'uploads/documents/icons/pdf.png';
                        break;
                    case 'archive':
                        $document->display = 'uploads/documents/icons/archive.png';
                        break;
                    case 'other':
                        $document->display = 'uploads/documents/icons/other.png';
                        break;
                }
            }
        }else{
            $documents = Document::where('status', 0)->latest()->paginate(15);
            foreach ($documents as $document){
                switch ($document->category){
                    case 1:
                        $document->category = 'HR';
                        break;
                    case 2:
                        $document->category = 'MANAGEMENT';
                        break;
                    case 3:
                        $document->category = 'Announcement';
                        break;
                    case 4:
                        $document->category = 'Social';
                        break;
                    case 5:
                        $document->category = 'Other';
                        break;
                }
                $document->owner = $document->user->name;
                unset($document->user);
                switch ($document->type)
                {
                    case 'picture':
                        $document->display = $document->path;
                        break;
                    case 'excel':
                        $document->display = 'uploads/documents/icons/excel.png';
                        break;
                    case 'adobe':
                        $document->display = 'uploads/documents/icons/art.png';
                        break;
                    case 'document':
                        $document->display = 'uploads/documents/icons/word.png';
                        break;
                    case 'pdf':
                        $document->display = 'uploads/documents/icons/pdf.png';
                        break;
                    case 'archive':
                        $document->display = 'uploads/documents/icons/archive.png';
                        break;
                    case 'other':
                        $document->display = 'uploads/documents/icons/other.png';
                        break;
                }
            }
            return response()->json(['data' => $documents, 'state' => 1], 200);
        }
        return $this->showAll($documents);
    }

    public function userDocuments(User $user)
    {
        if(empty($_GET['page']) || $_GET['page']==''){
            $documents = Document::where('user_id', $user->id)->where('status', 0)->latest()->get();
            foreach ($documents as $document){
                switch ($document->category){
                    case 1:
                        $document->category = 'HR';
                        break;
                    case 2:
                        $document->category = 'MANAGEMENT';
                        break;
                    case 3:
                        $document->category = 'Announcement';
                        break;
                    case 4:
                        $document->category = 'Social';
                        break;
                    case 5:
                        $document->category = 'Other';
                        break;
                }
                $document->owner = $document->user->name;
                unset($document->user);
                switch ($document->type)
                {
                    case 'picture':
                        $document->display = $document->path;
                        break;
                    case 'excel':
                        $document->display = 'uploads/documents/icons/excel.png';
                        break;
                    case 'adobe':
                        $document->display = 'uploads/documents/icons/art.png';
                        break;
                    case 'document':
                        $document->display = 'uploads/documents/icons/word.png';
                        break;
                    case 'pdf':
                        $document->display = 'uploads/documents/icons/pdf.png';
                        break;
                    case 'archive':
                        $document->display = 'uploads/documents/icons/archive.png';
                        break;
                    case 'other':
                        $document->display = 'uploads/documents/icons/other.png';
                        break;
                }
            }
        }else{
            $documents = Document::where('user_id', $user->id)->where('status', 0)->latest()->paginate(15);
            foreach ($documents as $document){
                switch ($document->category){
                    case 1:
                        $document->category = 'HR';
                        break;
                    case 2:
                        $document->category = 'MANAGEMENT';
                        break;
                    case 3:
                        $document->category = 'Announcement';
                        break;
                    case 4:
                        $document->category = 'Social';
                        break;
                    case 5:
                        $document->category = 'Other';
                        break;
                }
                $document->owner = $document->user->name;
                unset($document->user);
                switch ($document->type)
                {
                    case 'picture':
                        $document->display = $document->path;
                        break;
                    case 'excel':
                        $document->display = 'uploads/documents/icons/excel.png';
                        break;
                    case 'adobe':
                        $document->display = 'uploads/documents/icons/art.png';
                        break;
                    case 'document':
                        $document->display = 'uploads/documents/icons/word.png';
                        break;
                    case 'pdf':
                        $document->display = 'uploads/documents/icons/pdf.png';
                        break;
                    case 'archive':
                        $document->display = 'uploads/documents/icons/archive.png';
                        break;
                    case 'other':
                        $document->display = 'uploads/documents/icons/other.png';
                        break;
                }
            }
            return response()->json(['data' => $documents, 'state' => 1], 200);
        }
        return $this->showAll($documents);
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
            'user_id' => 'required|integer|exists:users,id',
            'title'=>'required',
            'category'=>'required|in:1,2,3,4,5',
            'description'=>'sometimes',
            'file'=>'required',
        ]);

        if($request->file) {
            $file = $request->file;
            $image_filename = 'document' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/documents/'), $image_filename);
            $imageExtension = array('jpg', 'jpeg', 'png', 'gif');
            $excelExtension = array('csv', 'xlsx');
            $adobeExtension = array('psd', 'ai');
            $documentExtension = array('docx', 'txt', 'doc');
            $archiveExtension = array('rar', 'zip');
            $pdfExtension = array('pdf');


            if (in_array(strtolower($file->getClientOriginalExtension()), $imageExtension)) {
                $type = 'picture';
            } elseif (in_array(strtolower($file->getClientOriginalExtension()), $excelExtension)) {
                $type = 'excel';
            } elseif (in_array(strtolower($file->getClientOriginalExtension()), $adobeExtension)) {
                $type = 'adobe';
            } elseif (in_array(strtolower($file->getClientOriginalExtension()), $documentExtension)) {
                $type = 'document';
            } elseif (in_array(strtolower($file->getClientOriginalExtension()), $pdfExtension)) {
                $type = 'pdf';
            } elseif (in_array(strtolower($file->getClientOriginalExtension()), $archiveExtension)) {
                $type = 'archive';
            } else {
                $type = 'other';
            }

            $document = Document::create([
                'title' => $request->title,
                'description' => $request->description,
                'category' => $request->category,
                'path' => 'uploads/documents/' . $image_filename,
                'type' => $type,
                'user_id' => $request->user_id
            ]);
            return $this->userDocuments(User::find($request->user_id));
        }else{
            return response()->json(['data'=>'error uploading file', 'state'=>0]);
        }
    }


    public function deleteDocument(Request $request, User $user){
        $this->validate($request, [
            'document' => 'required| exists:documents,id'
        ]);

        $document = Document::find($request->document);

        if($user->id == $document->user_id)
        {
            if (file_exists($document->path)) {
                @unlink($document->path);
            }

            $document->delete();

            return response()->json(['data'=> 'Document Deleted Successfully ', 'state'=> 1]);
        }else{
            return response()->json(['data'=>'you can not delete this file', 'state'=>0]);
        }
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
