<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\User;
use App\Models\TeamInvitation;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use App\Help\Help;   
use App\Help\Log;

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
        $anterior = $team->name ;
        $team->name = $request->name;
        $team->save();
        Log::log('Equipos', 'Actualizar equipo', 'El usuario '. Help::usuario()->name.' actualizo el equipo '. $anterior  . ' por ' .$team->name );

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
            Log::log('Equipos', 'Enviar solicitud', 'El usuario '. Help::usuario()->name.' ha enviado una solicitud a '. $user->name );

        }else{
            Log::log('Equipos', 'Enviar solicitud', 'El usuario '. Help::usuario()->name.' intento enviar una solicitud a '. $user->name . ' pero el sistema no le permitio ya que el usuario ya tenia una invitación anteriormente' );
            $message="No se ha podido enviar la solicitud a: " . $user->name. " ya que ya posee una invitación sin aceptar";
            $typeOfMessage= 'danger';
        }

        return redirect()->route('teamMe', $id)->with($typeOfMessage, $message );
    }

    public function cancelInvitation($id, $id_user_invitation){
        TeamInvitation::destroy($id_user_invitation);
        Log::log('Equipos', 'Cancelar solicitud', 'El usuario '. Help::usuario()->name.' ha cancelado una solicitud para unirse a un equipo' );

        return back()->with('success', 'Se ha eliminado la invitación correctamente');
    }

    public function invitations(){
        $user = auth()->user();
        $invitations = TeamInvitation::where('email', $user->email)->get();
        return view('me.team.team-invitations', compact('invitations'));
    }

    public function aceptingInvitation($id){
        $invitation= TeamInvitation::find($id);
        $team = Team::find($invitation->team_id);
        $user = Auth::user();
        $team->users()->save($user,['role'=>'editor']);
        $invitation->delete();
        Log::log('Equipos', 'Aceptar invitación', 'El usuario '. Help::usuario()->name.' acepto una solicitud para uniser al equipo ' .$team->name);

        return back()->with('success', 'Se ha aceptado la solicitud correctamente');
    }

    public function removeUser($id, $user_id){ //id = id del team

        $team = Team::find($id);
        $team->users()->detach($user_id);
        $usuarioRemovido = User::find($user_id);
        Log::log('Equipos', 'Eliminar invitación', 'El usuario '. Help::usuario()->name.' elimino una solicitud enviada del equipo ' .$team->name . ' que se le envio a ' . $usuarioRemovido->name);

        return back()->with('success','Usuario eliminado del equipo correctamente');
    }
}
