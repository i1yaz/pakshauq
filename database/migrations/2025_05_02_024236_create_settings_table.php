<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
public function up()
    {
        // Create settings table
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('value')->nullable();
            $table->string('type')->nullable();
            $table->string('group_type')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Add time_in_seconds to results table
        Schema::table('results', function (Blueprint $table) {
            $table->unsignedInteger('time_in_seconds')->default(0)->after('date');
            $table->index(['tournament_id', 'date', 'time_in_seconds'], 'idx_tournament_date_seconds');
            $table->index(['player_id', 'tournament_id', 'date', 'pigeon_number', 'time_in_seconds'], 'idx_player_tournament_date_pigeon_seconds');
        });

        // Add public_hide and type to tournaments table
        Schema::table('tournaments', function (Blueprint $table) {
            $table->tinyInteger('public_hide')->default(0)->after('status'); // replace with actual column
            $table->enum('type', ['OPEN', 'FIXED'])->default('OPEN')->collation('utf8mb4_unicode_ci')->after('public_hide');
        });

        // Insert initial settings records
        DB::table('settings')->insert([
            [
                'id' => 1,
                'key' => 'auto_update_time',
                'value' => '1',
                'type' => null,
                'group_type' => 'auto_update_time',
                'description' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'key' => 'first_7',
                'value' => '1',
                'type' => '7',
                'group_type' => 'first_winner_last_winner',
                'description' => 'First Winner Condition',
                'created_at' => '2025-05-14 23:40:33',
                'updated_at' => '2025-05-15 00:13:53',
            ],
            [
                'id' => 3,
                'key' => 'last_7',
                'value' => '3',
                'type' => '7',
                'group_type' => 'first_winner_last_winner',
                'description' => 'Last Winner Condition',
                'created_at' => '2025-05-14 23:40:33',
                'updated_at' => '2025-05-14 23:54:33',
            ],
            [
                'id' => 4,
                'key' => 'first_11',
                'value' => '1',
                'type' => '11',
                'group_type' => 'first_winner_last_winner',
                'description' => 'First Winner Condition',
                'created_at' => '2025-05-14 23:40:49',
                'updated_at' => '2025-05-14 23:40:49',
            ],
            [
                'id' => 5,
                'key' => 'last_11',
                'value' => '7',
                'type' => '11',
                'group_type' => 'first_winner_last_winner',
                'description' => 'Last Winner Condition',
                'created_at' => '2025-05-14 23:40:49',
                'updated_at' => '2025-05-14 23:40:49',
            ],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('settings');

        Schema::table('results', function (Blueprint $table) {
            $table->dropColumn('time_in_seconds');
            $table->dropIndex('idx_tournament_date_seconds');
            $table->dropIndex('idx_player_tournament_date_pigeon_seconds');
        });

        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('public_hide');
            $table->dropColumn('type');
        });
    }
};
