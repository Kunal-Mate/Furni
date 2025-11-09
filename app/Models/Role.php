<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Exceptions\RoleAlreadyExists;
use Illuminate\Database\Eloquent\Model;

class Role extends SpatieRole
{
    protected $fillable = ['name', 'guard_name', 'adminId', 'description'];


    public static function create(array $attributes = [])
    {
        $guardName = $attributes['guard_name'] ?? config('auth.defaults.guard');
        $adminId = $attributes['adminId'] ?? auth()->id();
        $name = $attributes['name'];

        // Check for existing role for same admin
        $existing = static::where('name', $name)
            ->where('guard_name', $guardName)
            ->where('adminId', $adminId)
            ->first();

        if ($existing) {
            throw RoleAlreadyExists::create($name, $guardName);
        }

        $attributes['guard_name'] = $guardName;
        $attributes['adminId'] = $adminId;

        return static::query()->create($attributes);
    }


}
