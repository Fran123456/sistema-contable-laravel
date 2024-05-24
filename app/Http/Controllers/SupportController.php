<?php
namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;
use App\Help\Help;
use App\Models\SupportPrincipal;
class SupportController extends Controller
{
    protected $openAIService;

    public function __construct(OpenAIService $openAIService)
    {
        $this->openAIService = $openAIService;
    }

    public function ask(Request $request)
    {
        $prompt = $request->input('prompt');
        $usuario = Help::usuario();
        $response = $this->openAIService->getChatResponse($prompt, $usuario->name);

        return response()->json($response);
    }


    public function askChat(Request $request)
    {
        $data = SupportPrincipal::where('usuario_id', Help::usuario()->id)->get();
        return response()->json($data);
    }

    public function askView(){
        return view('support.support');
    }
}