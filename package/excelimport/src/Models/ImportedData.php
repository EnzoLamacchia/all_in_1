<?php

namespace Elamacchia\Excelimport\Models;

use Illuminate\Database\Eloquent\Model;

class ImportedData extends Model
{
    protected $guarded = ['id'];

    public function setTableName($tableName)
    {
        $this->table = $tableName;
    }
}

