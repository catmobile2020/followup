<?php

namespace App\Http\Controllers\api;

use App\Skill;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SkillController extends Controller
{
    use ApiResponser;
    /**
     *
     * @SWG\Get(
     *      tags={"Skills"},
     *      path="/skills",
     *      summary="Get all skills",
     *
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function index()
    {
        if(empty($_GET['page']) || $_GET['page']==''){
            $skills = Skill::where('active', 1)->get();
        }else{
            $skills = Skill::where('active', 1)->paginate(10);

            return response()->json(['data' => $skills, 'state' => 1], 200);
        }
        return $this->showAll($skills);

    }

    /**
     *
     * @SWG\Get(
     *      tags={"Skills"},
     *      path="/skill/{skill}/users",
     *      summary="Get all users for specific skill",
     *       @SWG\Parameter(
     *         name="skill",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="object"),
     * )
     */

    public function skillUsers(Skill $skill){


        if(empty($_GET['page']) || $_GET['page']==''){
            $users = $skill->users()->where('active', 1)->get();
            foreach($users as $user) {
                if(count($user->photos) > 0){
                    foreach ($user->photos->pluck('path') as $photo){
                        $user->photo = $photo;
                    }
                }else{
                    $user->photo = 'nophoto';
                }
                unset($user->photos);
                foreach ($user->skills->pluck('name') as $skills) {

                }

                if($user->created_by != null){
                    $creator = User::find($user->created_by)->name;
                    $user->created_by = $creator;
                }

                $skills = $user->skills;
                $teamName = $user->team->name;
                $roleName = $user->role->name;
                $user->role_name = $roleName;
                $user->team_name = $teamName;
                unset($user->skills);
                $user->skills = $skills->map(function ($skills) {
                    return collect($skills->toArray())
                        ->only(['id', 'name'])
                        ->all();
                });

                unset($user->pivot);
                unset($user->role);
                unset($user->team);
                unset($user->team_id);
                unset($user->role_id);
                unset($user->image_profile);
            }
        }else{
            $users = $skill->users()->where('active', 1)->paginate(10);
            foreach($users as $user) {
                if(count($user->photos) > 0){
                    foreach ($user->photos->pluck('path') as $photo){
                        $user->photo = $photo;
                    }
                }else{
                    $user->photo = 'nophoto';
                }
                unset($user->photos);
                foreach ($user->skills->pluck('name') as $skills) {

                }

                if($user->created_by != null){
                    $creator = User::find($user->created_by)->name;
                    $user->created_by = $creator;
                }

                $skills = $user->skills;
                $teamName = $user->team->name;
                $roleName = $user->role->name;
                $user->role_name = $roleName;
                $user->team_name = $teamName;
                unset($user->skills);
                $user->skills = $skills->map(function ($skills) {
                    return collect($skills->toArray())
                        ->only(['id', 'name'])
                        ->all();
                });

                unset($user->pivot);
                unset($user->role);
                unset($user->team);
                unset($user->team_id);
                unset($user->role_id);
                unset($user->image_profile);
            }
            return response()->json(['data' => $users, 'state' => 1], 200);
        }
        return $this->showAll($users);
    }
}
