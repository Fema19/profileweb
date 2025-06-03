<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleLinkToDescriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('descriptions', function (Blueprint $table) {
            $table->string('title')->nullable()->after('slug');
            $table->string('link')->nullable()->after('title');
        });
    }

    public function down()
    {
        Schema::table('descriptions', function (Blueprint $table) {
            $table->dropColumn(['title', 'link']);
        });
    }
}
