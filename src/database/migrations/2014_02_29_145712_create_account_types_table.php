<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('account_types', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->integer("price")->default(0);
            $table->integer("limit")->default(10);
            $table->string("description", 512);
        });

        $this->createType();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('account_types');
    }

    /**
     * create account type
     */
    private function createType(): void
    {
        DB::table("account_types")->insert([
            [
                "name" => "starter",
                "limit" => 10,
                "price" => 0,
                "description" => "nghèo"
            ],
            [
                "name" => "starter",
                "limit" => 50,
                "price" => 29,
                "description" => "50 thôi"
            ],
            [
                "name" => "starter",
                "limit" => -1,
                "price" => 99,
                "description" => "thoải mái"
            ],
        ]);
    }
};
