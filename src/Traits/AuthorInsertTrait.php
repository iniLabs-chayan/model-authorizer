<?php
namespace Inilabs\ModelAuthorizer\Traits;

use Illuminate\Support\Facades\Auth;

trait AutoInsertTrait
{
    
    public static function bootAutoInsertTrait()
    {
        static::creating(function ($model) {
            if (Auth::check()) {
                $user = Auth::user();
                $model->insertUserData($user);
            } else {
                $model->insertDefaultData();
            }
        });
    }

    public function insertUserData($user)
    {
        $this->setAttribute('creator_type', 'App\Models\User');
        $this->setAttribute('creator_id', $user->id);
    }

    public function insertDefaultData()
    {
        $this->setAttribute('creator_type', 'App\Models\User');
        $this->setAttribute('creator_id', NULL);
    }
}
