<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    /**
     * Atributos que são atribuíveis a massa.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'display_name', 'description'
    ];

    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            config('auth.providers.users.model'),
            config('entrust.role_user_table'),
            config('entrust.user_foreign_key'),
            config('entrust.role_foreign_key')
        );
    }

    /**
     * Retorna o nome do papel.
     *
     * @return string
     */
    public function getDisplayNameAttribute()
    {
        // O atributo existe?
        if (!isset($this->attributes['display_name'])) {
            return null;
        }


        return $this->attributes['display_name'];
    }
}