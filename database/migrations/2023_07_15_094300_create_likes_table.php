<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	/**
	 * Run the migrations.
	 */
	// public function up(): void
	// {
	// 	Schema::create('likes', function (Blueprint $table) {
	// 		$table->id();
	// 		$table->foreignId('user_id')->constrained()->onDelete('cascade');

	// 		$table->foreignId('post_id')->nullable();
	// 		$table->foreignId('comment_id')->nullabel();
	// 		$table->timestamps();

	// 		// Agregar restricciones para eliminar likes cuando se elimine un post o un comentario
	// 		Schema::table('likes', function (Blueprint $table) {
	// 			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
	// 			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
	// 		});
	// 	});
	// }

	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('likes', function (Blueprint $table) {
			$table->id();
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->unsignedBigInteger('post_id')->nullable();
			$table->unsignedBigInteger('comment_id')->nullable();
			$table->timestamps();
		});

		// Modificar la tabla para hacer que ambos campos sean "not null"
		//  DB::statement('ALTER TABLE likes MODIFY post_id INT NOT NULL');
		//  DB::statement('ALTER TABLE likes MODIFY comment_id INT NOT NULL');

		// Agregar restricciones para asegurar que solo se pueda establecer post_id o comment_id, pero no ambos
		Schema::table('likes', function (Blueprint $table) {
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');

			// Restricción personalizada para verificar que solo una de las claves foráneas tenga valor
			// $table->unique(['post_id', 'comment_id']);
			// $table->checkConstraint('post_id is not null xor comment_id is not null');

			DB::statement('ALTER TABLE likes ADD CONSTRAINT check_either_post_or_comment CHECK (post_id IS NOT NULL XOR comment_id IS NOT NULL)');
		});
	}


	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('likes');
	}
};
