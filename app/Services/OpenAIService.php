<?php

namespace App\Services;

use GuzzleHttp\Client;

class OpenAIService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://api.openai.com/v1/chat/completions',
            'headers' => [
                'Authorization' => 'Bearer ' . env('OPENAI_API_KEY'),
            ],
        ]);
    }

    private function getContextAndExamples($name)
    {
        return "Tu eres un asistente virtual de un ERP. Solo puedes responder con cosas relacionadas a un ERP, 
        contabilidad, ventas, Compras y cosas relacionadas a negocios, inventarios, recursos humanos
         , tambien reseteo de contraseñas, problemas de logueo, incluso si te piden redactar correos podrias ayudar , 
        , etc. Si la pregunta no es adecuada puedes responder algo similar a 
        'Solo puedo responder preguntas relacionadas sobre ERP, contabilidad y demás temas.' ,
        pero la respuesta podrias variarla para que no sea tan generica.
         Aqui hay algunos ejemplos de preguntas y sus respuestas:\n\n" .
               "Q: Como puedo resetear mi contraseña?\nA: Por el momento debes solicitar al administrador.\n\n" .
               "Q: Puedo cambiar mi correo?\nA: Por el momento debes solicitar al administrador.\n\n".
               "Q: Puedo modificar algo del perfil?\nA: Si solo el nombre, lo puedes ubicar en la sección de perfil.\n\n".
               "Q: hay configuraciones que debo hacer?\nA: Si en la barra superior a la par del boton que administra
               los equipos encontratas un icono de configuración, en ella puedes modificar configuraciones iniciale,
               de la datatable entre otros.\n\n
               recuerda que son ejemplos pueden preguntar algo mas especifico, lo mejor seria
               que intentes responderlo en base a tu conocimiento o ideas pero si no puedes decir que
               aun no tienes conocimiento de ello y que notificaras al administrador para que haga una 
               retroalimentación, tampoco seas tan cerrado, trata de ayudar en todo
               lo relacionado a ERP o temas empresariales,\n Como dato extra te proporcionare
               el nombre del usuario para que puedas tratarlo de manera mas personalizada: ". $name;
    }

    private function isRelevantQuestion($prompt)
    {
        // Lista de palabras clave relacionadas con el ERP
        $keywords = ['contraseña', 'login', 'logeo', 'erp', 'account', 'support', 'ERP', 'data entry', 'system'];

        foreach ($keywords as $keyword) {
            if (stripos($prompt, $keyword) !== false) {
                return true;
            }
        }

        return false;
    }

    public function getChatResponse($prompt, $name)
    {
       /* if (!$this->isRelevantQuestion($prompt)) {
            return ['choices' => [['text' => "I can only assist with ERP-related questions."]]];
        }*/

        $contextAndExamples = $this->getContextAndExamples($name);
        $fullPrompt = $contextAndExamples;

        $response = $this->client->post('completions', [
            'json' => [
                'model' => 'gpt-3.5-turbo-0125',
                'messages' =>  [ ['role'=> 'system','content'=>$fullPrompt], ['role'=> 'user','content'=>$prompt]]
                ,
                'max_tokens' => 150,
            ],
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}