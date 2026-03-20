<?php

namespace Elamacchia\Excelimport\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TableManagementService
{
    public function findMatchingTable($schema)
    {
        $tables = DB::table('imported_tables_meta')->get();
        foreach ($tables as $table) {
            if ($this->compareSchema(json_decode($table->schema, true), $schema)) {
                return $table->table_name;
            }
        }
        return null;
    }

    public function createTable($schema)
    {
        $tableName = 'imported_data_' . time();
        Schema::create($tableName, function ($table) use ($schema) {
            $table->id();
            foreach ($schema as $column => $type) {
                $table->string($column)->nullable();
            }
            $table->timestamps();
        });

        DB::table('imported_tables_meta')->insert([
            'table_name' => $tableName,
            'schema' => json_encode($schema),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $tableName;
    }

    public function truncateTable($tableName)
    {
        DB::table($tableName)->truncate();
    }

    public function getAllTables()
    {
        return DB::table('imported_tables_meta')->get();
    }

    public function deleteTable($tableName)
    {
        Schema::dropIfExists($tableName);
        DB::table('imported_tables_meta')->where('table_name', $tableName)->delete();
    }

    public function getTableData($tableName)
    {
        return DB::table($tableName)->get();
    }

    public function getTableColumns($tableName)
    {
        return Schema::getColumnListing($tableName);
    }

    public function getRecord($tableName, $id)
    {
        return DB::table($tableName)->where('id', $id)->first();
    }

    public function updateRecord($tableName, $id, $data)
    {
        DB::table($tableName)->where('id', $id)->update($data);
    }

    protected function compareSchema($schema1, $schema2)
    {
        return count($schema1) === count($schema2) &&
            empty(array_diff_key($schema1, $schema2)) &&
            empty(array_diff_key($schema2, $schema1));
    }
}
