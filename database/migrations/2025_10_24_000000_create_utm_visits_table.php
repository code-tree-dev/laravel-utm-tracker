<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('utm_visits', function (Blueprint $table) {
            $table->id();

            // UTM parameters (padrão)
            $table->string('utm_source')->nullable();
            $table->string('utm_medium')->nullable();
            $table->string('utm_campaign')->nullable();
            $table->string('utm_term')->nullable();
            $table->string('utm_content')->nullable();

            // Extra parameters (qualquer outro parâmetro UTM personalizado)
            $table->json('utm_extra')->nullable();

            // Contexto da visita
            $table->string('page_url', 2048)->nullable();
            $table->string('referrer', 2048)->nullable();

            // Identificação opcional (não pessoal)
            $table->string('session_id')->nullable();
            $table->string('ip_address', 45)->nullable(); // IPv4/IPv6
            $table->string('user_agent', 1024)->nullable();

            // Timestamps
            $table->timestamps();

            // Indexes para performance
            $table->index(['utm_source', 'utm_campaign']);
            $table->index('session_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('utm_visits');
    }
};
