<?php

use App\Enums\RoleTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->default(DB::raw('(UUID())'))->primary();
            $table->string('name')->index();
            $table->string('details')->nullable();
            $table->boolean('is_permanent')->default(false);
            $table->boolean('is_admin')->default(false);
            $table->boolean('is_registered')->default(false)->comment("after first time register, user will assign this role, if is_registered true");
            $table->enum('type', array_keys(RoleTypeEnum::getRoleType()))->default(RoleTypeEnum::GLOBAL);
            $table->uuid('created_by')->nullable()->index();
            $table->uuid('updated_by')->nullable()->index();
            $table->uuid('deleted_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
