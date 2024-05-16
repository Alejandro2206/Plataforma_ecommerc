<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Cart;
use Illuminate\Support\Facades\Log;

class CheckoutComponent extends Component
{
    public $name;
    public $cartItems;
    public $cartTotal;


    public $whatsAppLink;

      /*  // Generar el código JavaScript para abrir la URL en una nueva pestaña
       $javaScript = "window.open('$this->whatsAppLink', '_blank');";

       // Emitir el código JavaScript para ser ejecutado en la vista
       $this->emit('openWhatsApp', $javaScript); */

    protected $listeners = ['orderSent'];

    public function procesarCompra()
    {
        // Lógica para procesar la compra aquí...
    }

    public function sendOrderByWhatsApp()
    {

        if ($this->cartItems->isEmpty()) {
            // Emitir evento de error si el carrito está vacío
            $this->emit('errorMessage', 'No hay productos en el carrito. Agrega productos antes de enviar el pedido por WhatsApp.');
            return;
        }
        
        if (empty (trim($this->name))) {
            // El campo de nombre está vacío, emitir evento de error
            $this->emit('errorMessage', 'Por favor, ingresa tu nombre antes de enviar el pedido por WhatsApp.');
            return;
        }

        // El campo de nombre no está vacío, proceder con el envío del pedido por WhatsApp
        $name = $this->name;
        // Número de teléfono de la empresa
        $companyPhone = '4471256711';

          // Limpia el formulario
          $this->name = '';
    
    
          // Clear the cart (if needed)
         

        // Construir el mensaje de WhatsApp solicitando los productos
        $message = "Hola, mi nombre es $name y quiero comprar los siguientes productos:\n\n";
        $cartItems = Cart::instance('cart')->content();
        $totalAmount = 0; // Variable para calcular el total de los productos
        foreach ($cartItems as $item) {
            $productName = $item->model->name;
            $productQty = $item->qty;
            $productCode = $item->model->SKU;
            $productPrice = $item->price;
            $productTotal = $item->subtotal;
            $totalAmount += $productTotal; // Suma el subtotal al total
            $message .= "Producto: $productName\n";
            $message .= "Cantidad: $productQty\n";
            $message .= "Código: $productCode\n";
            $message .= "Precio unitario: $productPrice\n";
            $message .= "Total: $productTotal\n\n";
        }
        // Agregar el total de los productos al mensaje
        $message .= "Total de productos: $totalAmount\n";

        // Construir el enlace de WhatsApp con el esquema de URL
        $whatsAppLink = "https://wa.me/$companyPhone?text=" . urlencode($message);

        Cart::instance('cart')->destroy();

        // Redireccionar al enlace de WhatsApp
         return redirect()->away($whatsAppLink);
          
    }

    public function render()
    {
        // Asigna los productos a $this->cartItems
        $this->cartItems = Cart::instance('cart')->content();
        // Asigna el total del carrito a $this->cartTotal
        $this->cartTotal = Cart::instance('cart')->subtotal();

        return view('livewire.checkout-component');
    }
}
