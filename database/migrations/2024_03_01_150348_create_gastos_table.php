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
        Schema::create('gastos', function (Blueprint $table) {
            $table->id();
            $table->string('categoria');
            $table->decimal('valor', 10, 2);
            $table->text('concepto');
            $table->string('metodo_pago');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->date('fecha_gasto');
            $table->enum('estado', ['Deuda', 'Pagado'])->default('Deuda');
            $table->timestamps();

            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos');
    }
};
