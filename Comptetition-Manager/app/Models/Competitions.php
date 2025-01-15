<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitions extends Model
{
    use HasFactory;

    protected $primaryKey = ['comp_name', 'comp_year'];
    public $incrementing = false;

    /**
     * Set the keys for a save update query.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    protected function setKeysForSaveQuery($query)
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return parent::setKeysForSaveQuery($query);
        }

        return $query->where('comp_name', $this->getAttribute('comp_name'))
            ->where('comp_year', $this->getAttribute('comp_year'));
    }

    /**
     * Get the primary key value for a save query.
     *
     * @param mixed $keyName
     * @return mixed
     */
    protected function getKeyForSaveQuery($keyName = null)
    {
        if (is_null($keyName)) {
            $keyName = $this->getKeyName();
        }

        if (isset($this->original[$keyName])) {
            return $this->original[$keyName];
        }

        return $this->getAttribute($keyName);
    }

    public function getKeyName()
    {
        return $this->primaryKey;
    }

    protected $fillable = [
        'comp_name',
        'comp_year',
        'prize',
        'description',
        'address',
        'comp_start',
        'comp_end',
        'languages',
        'comp_limit',
        'entry_fee',
    ];
    public $timestamps = false;
}
