<?php

declare(strict_types = 1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddForeignKeysToHcGalleriesResourcesConnectionsTable
 */
class AddForeignKeysToHcGalleriesResourcesConnectionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('hc_galleries_resources_connections', function (Blueprint $table) {
            $table->foreign('gallery_id', 'fk_hc_galleries_resources_connections_hc_galleries1')
                ->references('id')
                ->on('hc_galleries')
                ->onUpdate('NO ACTION')
                ->onDelete('NO ACTION');
            $table->foreign('resource_id', 'fk_hc_galleries_resources_connections_hc_resources1')
                ->references('id')
                ->on('hc_resources')
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
        Schema::table('hc_galleries_resources_connections', function (Blueprint $table) {
            $table->dropForeign('fk_hc_galleries_resources_connections_hc_galleries1');
            $table->dropForeign('fk_hc_galleries_resources_connections_hc_resources1');
        });
    }

}
