<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddForeignKeysToHcGalleriesTranslationsTable
 */
class AddForeignKeysToHcGalleriesTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_galleries_translations', function (Blueprint $table) {
            $table->foreign('record_id', 'fk_hc_galleries_translations_hc_galleries1')
                ->references('id')
                ->on('hc_galleries')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('language_code', 'fk_hc_galleries_translations_hc_languages1')
                ->references('id')
                ->on('hc_languages')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('hc_galleries_translations', function (Blueprint $table) {
            $table->dropForeign('fk_hc_galleries_translations_hc_galleries1');
            $table->dropForeign('fk_hc_galleries_translations_hc_languages1');
        });
    }

}
