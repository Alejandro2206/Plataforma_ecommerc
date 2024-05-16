<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->integer('quantity');
            $table->decimal('total_amount', 10, 2);
            $table->decimal('discount', 10, 2)->default(0); // Nuevo campo de descuento
            $table->string('reference_number');
            $table->enum('status', ['Pagado', 'Deuda'])->default('Deuda');
            $table->timestamps();

            // Claves foráneas para conectar con las tablas de productos y clientes
           
            $table->foreign('client_id')->references('id')->on('clientes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
};
