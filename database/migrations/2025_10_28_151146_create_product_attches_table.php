<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('productAttch', function (Blueprint $table) {
            $table->id('AttachId');
            $table->unsignedBigInteger('productId')->nullable(false);
            $table->string('attachment', 255)->nullable(false);
            $table->boolean('isVisible')->default(1);
            $table->timestamps();

            $table->foreign('productId')
                ->references(columns: 'productId')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_attches');
    }
};
