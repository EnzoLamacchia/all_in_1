<?php

namespace Elamacchia\Excelimport\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class FlexibleExcelimport implements ToCollection
{
    protected $tableName;
    protected $schema;

    public function __construct($tableName, $schema)
    {
        $this->tableName = $tableName;
        $this->schema = $schema;
    }

    public function collection(Collection $rows)
    {
        $header = $rows->shift();

        foreach ($rows as $row) {
            $data = [];
            foreach ($header as $index => $column) {
                if (isset($this->schema[$column])) {
                    $data[$column] = $row[$index];
                }
            }
            DB::table($this->tableName)->insert($data);
        }
    }
}
