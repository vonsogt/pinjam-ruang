<?php

use App\Enums\ApprovalStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_rooms', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('borrower_id');
            $table->foreignId('room_id')->constrained();
            $table->dateTime('borrow_at');
            $table->dateTime('until_at');
            $table->unsignedInteger('lecturer_id');
            $table->tinyInteger('lecturer_approval_status')->default(ApprovalStatus::Pending());
            $table->unsignedInteger('admin_id')->nullable();
            $table->tinyInteger('admin_approval_status')->nullable();
            $table->dateTime('processed_at')->nullable();
            $table->dateTime('returned_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('borrower_id')
                ->references('id')->on('admin_users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
            $table->foreign('lecturer_id')
                ->references('id')->on('admin_users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
            $table->foreign('admin_id')
                ->references('id')->on('admin_users')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('borrow_rooms');
    }
}
