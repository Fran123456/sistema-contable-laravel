<?php
namespace App\Http\Controllers;

use App\Services\OpenAIService;
use Illuminate\Http\Request;
use App\Help\Help;
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

    public function askView(){
        return view('support.support');
    }
}