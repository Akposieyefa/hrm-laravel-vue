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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('user_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\Organization::class , 'organization_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\Department::class , 'department_id')->constrained()->onDelete('cascade');
            $table->foreignIdFor(App\Models\Organization::class , 'level_id')->constrained()->onDelete('cascade');
            $table->string('phone_number');
            $table->string('address');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
