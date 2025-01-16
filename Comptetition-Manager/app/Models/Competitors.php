<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competitors extends Model
{
    use HasFactory;

    //Primary keys
    protected $primaryKey = ['user_email', 'round_id'];

    //Disabling auto increment
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

        return $query->where('user_email', $this->getAttribute('user_email'))
            ->where('round_id', $this->getAttribute('round_id'));
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

    /**
     * Return the primarykeys
     * @return array  Primarykeys
     */

    public function getKeyName()
    {
        return $this->primaryKey;
    }

    //Columns
    protected $fillable = [
        'user_email',
        'round_id',
        'points',
        'placement',
        'correct_answ',
        'wrong_answ',
        'blank_answ',
    ];

    //Disabling the created_at, updated_at
    public $timestamps = false;
}
