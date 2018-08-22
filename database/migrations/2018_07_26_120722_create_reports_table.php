<?php

use App\Enums\ReportStatuses;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('project_id')->unsigned()->index();

            $table->string('url');

            $table->string('class');
            $table->string('file');
            $table->integer('line')->unsigned();
            $table->string('message');

            $table->text('trace')->nullable()->default(null);

            $table->enum('status', ReportStatuses::getAll())
                ->default(ReportStatuses::NEW_ONE)
                ->index();

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
        Schema::dropIfExists('reports');
    }
}
