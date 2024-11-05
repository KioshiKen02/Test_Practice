<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('shopping_id')->nullable()->constrained(); // Adjust as needed
            $table->decimal('total', 10, 2);
            $table->string('status')->default('pending');
            $table->timestamps();

            // Optional: Adding indexes
            $table->index('user_id');
            $table->index('shopping_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions'); // Specify the table name to drop
    }
}