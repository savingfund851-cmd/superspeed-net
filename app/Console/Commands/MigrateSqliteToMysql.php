<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class MigrateSqliteToMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:migrate-sqlite-to-mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate data from sqlite_old database to the primary mysql database safely';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting database migration from SQLite to MySQL...');

        // Get all tables from SQLite
        $tables = DB::connection('sqlite_old')->select("SELECT name FROM sqlite_master WHERE type='table' AND name NOT LIKE 'sqlite_%'");
        $tableNames = array_map(function ($table) {
            return $table->name;
        }, $tables);

        // Exclude migrations table as we already ran migrate:fresh
        $tableNames = array_filter($tableNames, function ($name) {
            return $name !== 'migrations';
        });

        // Disable foreign key checks on MySQL
        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=0;');

        foreach ($tableNames as $table) {
            $this->info("Migrating table: {$table}");
            
            // Clear existing data in MySQL for this table just in case
            DB::connection('mysql')->table($table)->truncate();

            // Fetch records from SQLite and insert into MySQL
            $count = 0;
            DB::connection('sqlite_old')->table($table)->orderBy('id')->chunk(500, function ($records) use ($table, &$count) {
                $data = [];
                foreach ($records as $record) {
                    $data[] = (array) $record;
                }
                
                if (!empty($data)) {
                    DB::connection('mysql')->table($table)->insert($data);
                    $count += count($data);
                }
            });

            $this->info("Inserted {$count} records into {$table}.");
        }

        // Re-enable foreign key checks
        DB::connection('mysql')->statement('SET FOREIGN_KEY_CHECKS=1;');

        $this->info('Migration completed successfully!');
        
        // Clear caches just in case
        $this->call('cache:clear');
    }
}
