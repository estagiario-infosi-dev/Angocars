<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Model\Brand;
use App\Model\Models;  // ← corrigido aqui

class FetchFipeData extends Command
{
    protected $signature = 'fipe:fetch';
    protected $description = 'Busca dados de marcas e modelos da API FIPE, salva em JSON e popula o banco de dados';

    public function handle()
    {
        $vehicleType = 'carros';
        $baseUrl = "https://parallelum.com.br/fipe/api/v1/{$vehicleType}";

        $brandsResponse = Http::get("{$baseUrl}/marcas");
        if ($brandsResponse->failed()) {
            $this->error('Falha ao buscar marcas da API FIPE.');
            return 1;
        }

        $brands = $brandsResponse->json();

        $brandsJsonPath = storage_path('app/fipe_brands.json');
        file_put_contents($brandsJsonPath, json_encode($brands, JSON_PRETTY_PRINT));
        $this->info('JSON de marcas salvo em: ' . $brandsJsonPath);

        foreach ($brands as $brandData) {
            $brand = Brand::updateOrCreate(
                ['fipe_code' => $brandData['codigo']],
                [
                    'name' => $brandData['nome'],
                    'date' => now()->format('Y-m-d'),
                    'description' => 'Importado da API FIPE',
                ]
            );

            $modelsResponse = Http::get("{$baseUrl}/marcas/{$brandData['codigo']}/modelos");
            if ($modelsResponse->failed()) {
                $this->warn("Falha ao buscar modelos para a marca {$brandData['nome']}.");
                continue;
            }

            $modelsData = $modelsResponse->json()['modelos'] ?? [];

            $modelsJsonPath = storage_path("app/fipe_models_{$brandData['codigo']}.json");
            file_put_contents($modelsJsonPath, json_encode($modelsData, JSON_PRETTY_PRINT));
            $this->info("JSON de modelos para marca {$brandData['codigo']} salvo em: " . $modelsJsonPath);

            foreach ($modelsData as $modelData) {
                Models::updateOrCreate(  // ← agora funciona com o use correto
                    ['fipe_code' => $modelData['codigo'], 'brand_id' => $brand->id],
                    [
                        'name' => $modelData['nome'],
                        'date' => now()->format('Y-m-d'),
                        'description' => 'Importado da API FIPE',
                    ]
                );
            }
        }

        $this->info('Dados de marcas e modelos populados no banco de dados com sucesso!');
        return 0;
    }
}