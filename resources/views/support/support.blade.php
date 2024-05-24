<x-app-layout>
    <x-slot:title>
        chat de soporte
    </x-slot>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Estilo personalizado para el chat */
        #chat {
            max-height: 400px;
            overflow-y: auto;
        }

        .message-container {
            display: flex;
            margin-bottom: 10px;
        }

        .message {
            max-width: 70%;
            padding: 10px;
            border-radius: 10px;
            word-wrap: break-word;
        }

        .user-message {
            background-color: #DCF8C6;
            margin-left: auto;
            margin-right: 10px;
        }

        .bot-message {
            background-color: #E5E5EA;
            margin-left: 10px;
            margin-right: auto;
        }

        .chat-card {
            border: none;
            border-radius: 15px;
        }

        .chat-header {
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
            background-color: #4CAF50; /* Green */
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }

        .support-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .support-name {
            font-weight: bold;
        }
    </style>

    
   
   <div class="col-md-12">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active" aria-current="page">Soporte</li>
    </ol>
   </div>

    <div>
        <div class="row justify-content-center">
            <div class="col-md-12">
              
                <div class="card chat-card">
                    <div class="chat-header">
                        <img src="{{ asset('assets/images/support.png') }}" alt="Support Image" class="support-image">
                        <span class="support-name">Soporte</span>
                    </div>
                    <div class="card-body" id="chat">
                        <!-- Aquí se mostrarán los mensajes -->
                    </div>
                    <form id="supportForm" class="mt-3">
                        <div class="input-group">
                            <input type="text" id="promptInput" name="prompt" class="form-control" placeholder="Escribe tu consulta de soporte...">
                            <button type="submit" class="btn btn-primary">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
 
              
                $.ajax({
                    url: '/support/chat',
                    method: 'GET',
                    success: function(response) {
                       
                        console.log(response);
                        $.each(response, function(index, message) {
                            var messageContainer = $('<div class="message-container"></div>');
                            var messageContent = $('<div class="message"></div>');
                            
                            // Determinar el estilo del mensaje basado en el campo 'gpt'
                            if (message.gpt == 1) {
                                messageContent.addClass('bot-message');
                            } else {
                                messageContent.addClass('user-message');
                            }
                            
                            messageContent.text(message.mensaje);
                            messageContainer.append(messageContent);
                            $('#chat').append(messageContainer);
                        });
                        $('#chat').scrollTop($('#chat')[0].scrollHeight);
                        
                    }
                });
            
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#supportForm').on('submit', function(e) {
                e.preventDefault();

                var prompt = $('#promptInput').val();
                $('#promptInput').val('');
                // Muestra el mensaje de "escribiendo..."
                $('#chat').append('<div class="message-container"><div class="message user-message">' + prompt + '</div></div>');
                $('#chat').append('<div class="message-container typing-indicator">Escribiendo...</div>');

                $.ajax({
                    url: '/support',
                    method: 'POST',
                    data: {
                        prompt: prompt,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Remueve el mensaje de "escribiendo..."
                        $('.typing-indicator').remove();
                        console.log(response);
                        // Añade el mensaje del usuario
                        
                        // Añade el mensaje del asistente con un pequeño retraso
                        setTimeout(function() {
                            $('#chat').append('<div class="message-container"><div class="message bot-message">' + response.choices[0].message.content + '</div></div>');
                            // Desplázate al final del chat
                            $('#chat').scrollTop($('#chat')[0].scrollHeight);
                            // Borra el contenido del input
                            $('#promptInput').val('');
                        }, 10); // Retraso de 1 segundo (simula la escritura)
                    }
                });
            });
        });
    </script>
</x-app-layout>