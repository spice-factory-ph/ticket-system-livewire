<?php

use App\Models\Priority;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('priorities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('order');
            $table->timestamps();
        });

        Priority::insert([
            [
                'name' => 'low',
                'order' => 1,

            ],
            [
                'name' => 'medium',
                'order' => 2,
            ],
            [
                'name' => 'high',
                'order' => 3,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('priorities');
    }
};
