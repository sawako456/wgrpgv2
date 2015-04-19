<?php namespace Cryptic\Wgrpg\Contracts\Entities;

use Cryptic\Wgrpg\Contracts\Entities\Eloquent as EloquentEntityContract;

interface User extends EloquentEntityContract
{
    /**
     * Get a gravatar url based on user email.
     * Uses the mystery man default if no avatar is found.
     *
     * @return string
     */
    public function getGravatarAttribute();

    /**
     * Roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}
