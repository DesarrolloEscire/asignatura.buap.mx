<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait Searchable
{
    public function scopeSearch($query, $search)
    {
        $table = app(static::class)->getTable();
        $columns = Schema::getColumnListing($table);

        foreach ($columns as $column) {
            $query->orWhere($column, 'ILIKE', '%' . $search . '%');
        }

        return $query;
    }
}
