<?php
namespace App\Services;

use Illuminate\Support\Facades\DB;

class InitialSeeder
{
    protected array $tables = ['clients', 'cars', 'services'];

    public function runIfTablesEmpty(): void
    {
        foreach ($this->tables as $table) {
            if (DB::table($table)->count() === 0) {
                $this->seedTable($table);
            }
        }
    }

    protected function seedTable(string $table): void
    {
        if (!file_get_contents(base_path("database/seeders/seeds/{$table}.json"))) {
            logger()->warning("Seed file for {$table} not found.");
            return;
        }

        $json = file_get_contents(base_path("database/seeders/seeds/{$table}.json"));
        $data = json_decode($json, true);

        if (!is_array($data)) {
            logger()->error("Invalid JSON structure in seeds/{$table}.json");
            return;
        }

        DB::table($table)->insert($data);
        logger()->info("Seeded {$table} table from JSON.");
    }
}
