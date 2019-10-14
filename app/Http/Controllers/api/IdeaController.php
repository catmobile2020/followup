<?php

namespace App\Http\Controllers\api;

use App\Idea;
use App\Traits\ApiResponser;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class IdeaController extends Controller
{
    use ApiResponser;

    public function getIdeas(User $user)
    {
        if($user->team->id == 1){
            $ideas = $user->ideass()->orderBy('id','desc')->get();
        }else{
            $ideas = $user->ideas()->orderBy('id','desc')->get();
        }

        foreach ($ideas as $idea)
        {
            $username = $idea->user->name;
            $idea->username = $username;
            $idea->replies;
            foreach ($idea->replies as $reply)
            {
               $reply->username = $reply->user->name;
                unset($reply->user);
                unset($reply->user_id);
                foreach ($reply->attaches as $attach)
                {
                    unset($attach->imageable_id);
                    unset($attach->imageable_type);
                    unset($attach->created_at);
                    unset($attach->updated_at);
                    unset($attach->id);
                }
            }
            unset($idea->pivot);
            unset($idea->user);
            unset($idea->updated_at);
            unset($idea->user_id);
            foreach ($idea->attaches as $attach)
            {
                unset($attach->imageable_id);
                unset($attach->imageable_type);
                unset($attach->created_at);
                unset($attach->updated_at);
                unset($attach->id);
            }

        }

        return response()->json(['data' => $ideas, 'state' => 1], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject'=>'required',
            'managers'=>'required',
            'user_id'=>'required'
        ]);


        $idea = Idea::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'user_id' => $request->user_id
        ]);

                $image_filename = 'idea' . $idea->id . time() . '.' . $request->file('attaches')->getClientOriginalExtension();
                $request->file('attaches')->move(public_path('uploads'), $image_filename);
                $idea->attaches()->create(['path' => 'uploads/' . $image_filename]);





        $idea->users()->attach($request->managers);

        return response()->json(['data' => $idea, 'state' => 1], 200);
    }

    public function deleteIdea(Request $request, User $user){
        $this->validate($request, [
            'idea' => 'required| exists:ideas,id'
        ]);

        $idea = Idea::find($request->idea);

        if($user->id == $idea->user_id)
        {
            foreach ($idea->attaches as $attach)
            {
                if (file_exists($attach->path)) {
                    @unlink($attach->path);
                }
            }

            foreach ($idea->replies as $reply)
            {
                foreach ($reply->attaches as $attach) {
                    if (file_exists($attach->path)) {
                        @unlink($attach->path);
                    }
                }

                $reply->attaches->delete();
            }

            $idea->attaches()->delete();
            $idea->users()->sync(null);

            $idea->replies()->delete();

            $idea->delete();

            return response()->json(['data'=> 'Idea Deleted Successfully ', 'state'=> 1]);
        }else{
            return response()->json(['data'=>'you can not delete this Idea', 'state'=>0]);
        }
    }
    public function viewIdea(Request $request, Idea $idea){
        $this->validate($request, [
            'user' => 'required| exists:users,id'
        ]);

        $user = User::find($request->user);

        if($user->id == $idea->user_id || in_array($idea->id, $user->ideass->pluck('id')->toArray()))
        {
            $username = $idea->user->name;
            $idea->username = $username;
            $idea->replies;
            foreach ($idea->replies as $reply)
            {
                $reply->username = $reply->user->name;
                unset($reply->user);
                unset($reply->user_id);
                foreach ($reply->attaches as $attach)
                {
                    unset($attach->imageable_id);
                    unset($attach->imageable_type);
                    unset($attach->created_at);
                    unset($attach->updated_at);
                    unset($attach->id);
                }
            }
            unset($idea->pivot);
            unset($idea->user);
            unset($idea->updated_at);
            unset($idea->user_id);
            foreach ($idea->attaches as $attach)
            {
                unset($attach->imageable_id);
                unset($attach->imageable_type);
                unset($attach->created_at);
                unset($attach->updated_at);
                unset($attach->id);
            }

            return $this->showOne($idea);
        }else{
            return response()->json(['data'=>'you doesn\'t authorize to enter this page', 'state'=>0]);
        }
    }

    public function reply(Request $request, Idea $idea)
    {
        $this->validate($request, [
            'description'=>'required',
            'user_id'=>'required|exists:users,id'
        ]);

        $reply = $idea->replies()->create([
            'description'=>$request->description,
            'user_id'=>$request->user_id
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

        return response()->json(['data' => $idea->with('replies'), 'state' => 1], 200);
    }
}
