<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;


class ComprobanteController extends Controller
{
    /**
     * Envía el comprobante por WhatsApp.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function enviarComprobante(Request $request)
    {
        // Obtener los datos del formulario
        $numeroCliente = $request->input('numero_cliente');
        $comprobanteHtml = $request->input('comprobante_html');

        // Lógica para enviar el comprobante por WhatsApp
        try {
            // Código para enviar el comprobante por WhatsApp usando Twilio
            $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN')); // Configura tus credenciales de Twilio aquí

            // Envía el mensaje de WhatsApp
            $twilio->messages->create(
                "whatsapp:+524471157701", // Número de WhatsApp al que enviar el mensaje
                [
                    "from" => "whatsapp:" . env('TWILIO_FROM'), // Número de WhatsApp desde el que enviarás el mensaje
                    "body" => $comprobanteHtml, // Mensaje a enviar (en este caso, el comprobante HTML)
                ]
            );

            // Si se envió correctamente, redirige con un mensaje de éxito
            return redirect()->back()->with('success', 'El comprobante se envió correctamente por WhatsApp.');
        } catch (\Exception $e) {
            // Si ocurrió un error al enviar el mensaje, redirige con un mensaje de error
            return redirect()->back()->with('error', 'Error al enviar el comprobante por WhatsApp: ' . $e->getMessage());
        }
    }

}
