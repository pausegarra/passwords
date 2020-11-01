<?php

namespace App\Rules;

use Adldap\Laravel\Validation\Rules\Rule;

class CanAccess extends Rule
{
    /**
     * Determines if the user is allowed to authenticate.
     *
     * @return bool
     */   
    public function isValid()
    {
      return $this->user->inGroup('acl_passwords');
    }
}