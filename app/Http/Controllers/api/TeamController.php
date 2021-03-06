<?php

namespace App\Http\Controllers\api;

use App\Team;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
    use ApiResponser;
    /**
     *
     * @SWG\Get(
     *      tags={"Teams"},
     *      path="/departments",
     *      summary="Get all teams",
     *
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function index()
    {


        //
        if(empty($_GET['page']) || $_GET['page']==''){
            $teams = Team::where('active', 1)->get();
            foreach($teams as $team) {
                foreach ($team->skills->pluck('name') as $skills) {

                }
                $skills = $team->skills;
                unset($team->skills);
                $team->skills = $skills->map(function ($skills) {
                    return collect($skills->toArray())
                        ->only(['id', 'name'])
                        ->all();
                });
            }
        }else{
            $teams = Team::where('active', 1)->paginate(10);
            foreach($teams as $team) {
                foreach ($team->skills->pluck('name') as $skills) {

                }
                $skills = $team->skills;
                unset($team->skills);
                $team->skills = $skills->map(function ($skills) {
                    return collect($skills->toArray())
                        ->only(['id', 'name'])
                        ->all();
                });
            }
            return response()->json(['data' => $teams, 'state' => 1], 200);
        }
        return $this->showAll($teams);

    }
    /**
     *
     * @SWG\Get(
     *      tags={"Teams"},
     *      path="/department/{department}/users",
     *      summary="Get all users in specific team/Department",
     *       @SWG\Parameter(
     *         name="team",
     *         in="path",
     *         required=true,
     *         type="integer",
     *         format="integer",
     *      ),
     *      @SWG\Response(response=200, description="objects"),
     * )
     */
    public function teamUsers(Team $team){


        if(empty($_GET['page']) || $_GET['page']==''){
            $users = $team->users()->where('active', 1)->get();
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
            $users = $team->users()->where('active', 1)->paginate(10);
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

    public function teamForms(Team $team)
    {
        $rows = $team->requestsForm;
        return $this->showAll($rows);
    }
}
