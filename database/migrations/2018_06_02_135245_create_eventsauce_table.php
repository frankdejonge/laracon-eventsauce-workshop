<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;

class CreateEventsauceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("CREATE TABLE IF NOT EXISTS domain_messages (
    event_id VARCHAR(36) NOT NULL,
    event_type VARCHAR(100) NOT NULL,
    aggregate_root_id VARCHAR(36) NULL,
    time_of_recording DATETIME(6) NOT NULL,
    payload TEXT NOT NULL,
    INDEX aggregate_root_id (aggregate_root_id),
    INDEX time_of_recording (time_of_recording)
) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eventsauce');
    }
}
