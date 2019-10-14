<?php

namespace App\Http\Controllers;

use App\Idea;
use App\Team;
use App\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdeaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::findOrFail(Auth::id());
        if($user->team->id == 1){
            $ideas = $user->ideass()->orderBy('id','desc')->get();
        }else{
            $ideas = $user->ideas()->orderBy('id','desc')->get();
        }

        return view('ideas.index', compact('ideas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team = Team::where('name','Management')->firstOrFail();
        $managers = $team->users;
        return view('ideas.create', compact('managers'));
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
            'subject'=>'required',
            'managers'=>'required'
        ]);

        $idea = Idea::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'user_id' => Auth::user()->id
        ]);

        if($request->attaches) {
            $x = 1;
            foreach ($request->attaches as $attach) {
                $image_filename = 'idea' . $x . $idea->id . time() . '.' . $attach->getClientOriginalExtension();
                $attach->move(public_path('uploads'), $image_filename);
                $idea->attaches()->create(['path' => 'uploads/' . $image_filename]);
                $x++;
            }
        }


        $idea->users()->attach($request->managers);

        return redirect('/admin/idea')->with('status', 'Your Message has been sent');
    }


    public function reply(Request $request, Idea $idea)
    {
        $this->validate($request, [
            'description'=>'required',
            'idea'=>'required|exists:ideas,id'
        ]);

        $idea = Idea::findOrFail($request->idea);
        $reply = $idea->replies()->create([
            'description'=>$request->description,
            'user_id'=>Auth::id()
        ]);

        if($request->attaches) {
            $x = 1;
            foreach ($request->attaches as $attach) {
                $image_filename = 'idea-reply' . $x . $reply->id . time() . '.' . $attach->getClientOriginalExtension();
                $attach->move(public_path('uploads'), $image_filename);
                $reply->attaches()->create(['path' => 'uploads/' . $image_filename]);
                $x++;
            }
        }

        return redirect('/admin/idea')->with('status', 'Your Reply has been sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function show(Idea $idea)
    {
        return view('ideas.show', compact('idea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function edit(Idea $idea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Idea $idea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Idea  $idea
     * @return \Illuminate\Http\Response
     */
    public function destroy(Idea $idea)
    {
        //
    }
}
