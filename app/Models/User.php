<?php

namespace App\Models;

use App\Models\AccountsSettings\Branch;
use App\Models\Address\Address;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use App\Models\Backend\ContactInfo\Contact;
use App\Models\FrontEnd\Review;
use App\Models\Frontend\Wishlist\Wishlist;
use App\Traits\BaseModel;
use App\Traits\DisplayNameTrait;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany; // Import the default BelongsToMany class


class User extends Authenticatable
{
    use HasProfilePhoto, Notifiable, TwoFactorAuthenticatable, SoftDeletes, BaseModel, DisplayNameTrait;
    protected $dates = ['deleted_at'];
    public $timestamps = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type', 'mobile', 'address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, "users_roles", "user_id", "role_id")->withTimestamps()->as('user_role');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permissiom::class, 'users_permissions', 'user_id', 'permission_id')->withTimestamps()->as('user_permission');
    }

    public function address()
    {
        return $this->hasMany(Address::class);
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function Branch()
    {
        return $this->belongsTo(Branch::class);
    }
    public function Contact(){
        return $this->hasOne(Contact::class);
    }
}
