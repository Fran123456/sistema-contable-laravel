<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\TeamInvitation;

class TeamController extends Controller
{


    public function team(Request $request, $id){  //$id = id del equipo 
        $team = Team::find($id);
        $users = array();
        if($request->invitation){
            $users= User::where('email', $request->invitation)->get();
        }
        $usersPedingInvitation = TeamInvitation::where('team_id', $id)->get();
        return view('me.team.team', compact('team', 'users','usersPedingInvitation'));
    }

    public function updateTeam(Request $request, $id){//$id = id del equipo 
        $team = Team::find($id);
        $team->name = $request->name;
        $team->save();
        return back()->with('success','Equipo modificado correctamente');
    }

    public function sendInvitation(Request $request, $id, $user_id){
        $team = New TeamInvitation();
        $user =user::find($user_id);
        $invitation = TeamInvitation::where('email', $user->email)->get();
        $message = 'Se le ha enviado la solicitud al usuario '. $user->name. ' correctamente';
        $typeOfMessage = 'success';
        if(count($invitation)==0){
            $team->team_id = $id;
            $team->email = $user->email;
            $team->role = 'editor';
            $team->save();
        }else{
            $message="No se ha podido enviar la solicitud a: " . $user->name. " ya que ya posee una invitación sin aceptar";
            $typeOfMessage= 'danger';
        }
       
        return redirect()->route('teamMe', $id)->with($typeOfMessage, $message );
    }

    public function cancelInvitation($id, $id_user_invitation){
        TeamInvitation::destroy($id_user_invitation);
        return back()->with('success', 'Se ha eliminado la invitación correctamente');
    }

    public function invitations(){
        $user = auth()->user();
        $invitations = TeamInvitation::where('email', $user->email)->get();
        return view('me.team.team-invitations', compact('invitations'));
    }

    public function aceptingInvitation($id){
        $invitation= TeamInvitation::find($id);
        

    }
}
