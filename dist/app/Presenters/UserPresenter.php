<?php

namespace App\Presenters;

class UserPresenter extends BasePresenter
{
    /**
     * @return null|bool
     */
    public function isSuperUser(): ?bool
    {
//        return $this->role->name === 'superuser';
        return null;
    }
}
