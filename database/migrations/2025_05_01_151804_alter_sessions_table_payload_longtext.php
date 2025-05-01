<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AlterSessionsTablePayloadLongtext extends Migration
{
    public function up()
    {
        DB::statement("ALTER TABLE sessions MODIFY payload LONGTEXT");
    }

    public function down()
    {
        // Optional: revert back
        DB::statement("ALTER TABLE sessions MODIFY payload TEXT");
    }
}
