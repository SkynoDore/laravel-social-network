<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Group;
use Illuminate\Support\Facades\Http;

class ImportGroups extends Command
{
    protected $signature = 'import:groups {--source= : Ruta del archivo JSON o URL}';
    protected $description = 'Importa grupos desde una fuente JSON (API o archivo)';

    public function handle()
    {
        $source = $this->option('source') ?? storage_path('app/groups.json');

        $this->info("Importando grupos desde: $source");

        $raw = $this->readData($source);
        $data = $raw['@graph'] ?? [];

        if (!is_array($data)) {
            $this->error("No se pudo leer o decodificar el JSON.");
            return Command::FAILURE;
        }

        $imported = 0;

        foreach ($data as $entry) {
            if (empty($entry['id']) || empty($entry['title'])) continue;
            Group::updateOrCreate([
                'uid' => (string) $entry['id'],],[
                'title' => $entry['title'] ?? 'Sin título',
                'description' => $entry['organization']['organization-desc'] ?? null,
                'organization_name' => $entry['organization']['organization-name'] ?? null,
                'latitude' => $entry['location']['latitude'] ?? null,
                'longitude' => $entry['location']['longitude'] ?? null,
                'area' => basename($entry['address']['area']['@id'] ?? ''),
                'district' => basename($entry['address']['district']['@id'] ?? ''),
                'locality' => $entry['address']['locality'] ?? null,
                'street_address' => $entry['address']['street-address'] ?? null,
                'postal_code' => $entry['address']['postal-code'] ?? null,
                'link' => $entry['relation'] ?? null,
                'price' => $entry['price'] ?? null,
            ]);
            $imported++;
        }

        $this->info("Importación finalizada. Grupos procesados: $imported");
        return Command::SUCCESS;
    }

    protected function readData($source)
    {
        if (filter_var($source, FILTER_VALIDATE_URL)) {
            $response = Http::get($source);
            return $response->ok() ? $response->json() : null;
        }

        if (file_exists($source)) {
            $json = file_get_contents($source);
            return json_decode($json, true);
        }

        return null;
    }
}
