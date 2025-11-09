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
        Schema::create('products', function (Blueprint $table) {
            $table->id('productId');
            $table->foreignId('catId')
                ->nullable()
                ->constrained('categories', 'catId')
                ->nullOnDelete();
            $table->string('productName', 100)->nullable(false);
            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('cuttedPrice', 10, 2)->nullable();
            $table->text('description')->nullable();
            $table->text('feature')->nullable();
            $table->string('thumbnail', 200)->nullable();
            $table->string('videoLink', 50)->nullable();
            $table->boolean('isVisible')->default(1);
            $table->timestamps();


        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
