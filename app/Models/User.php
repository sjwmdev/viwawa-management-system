<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\CommonMigrationColumns;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements MustVerifyEmail
{
    use Auditable, CommonMigrationColumns, HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone_number',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'first_name' => 'string',
        'middle_name' => 'string',
        'last_name' => 'string',
        'phone_number' => 'integer',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * Check if the user has the default password.
     *
     * @return bool
     */
    public function hasDefaultPassword()
    {
        // The default password in plain text
        $defaultPassword = $this->phone_number;

        // Check if the hashed password in the database matches the default password
        return Hash::check($defaultPassword, $defaultPassword);
    }

    /**
     * Set the password attribute and encrypt the value.
     *
     * @param string $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    /**
     * Check and return the default password or a message.
     *
     * @param string $hashedPassword
     * @return string
     */
    public function getPasswordStatus($hashedPassword)
    {
        $defaultPassword = 'nenosiri';
        return Hash::check($defaultPassword, $hashedPassword) ? $defaultPassword : 'Mtumiaji alibadilisha nenosiri lake';
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        $fullName = $this->first_name;

        if ($this->middle_name) {
            $fullName .= ' ' . $this->middle_name;
        }

        $fullName .= ' ' . $this->last_name;

        return ucwords($fullName);
    }

    /**
     * Get the phone number without the Tanzania country code.
     *
     * @return string|null
     */
    public function getPhoneNumberWithoutCountryCode()
    {
        $phoneNumber = $this->phone_number;

        // Check if phone number is null
        if (is_null($phoneNumber)) {
            return null;
        }

        // Remove the '255' country code if it is at the beginning of the phone number
        if (strpos($phoneNumber, '255') === 0) {
            return substr($phoneNumber, 3);
        }

        return $phoneNumber;
    }

    /**
     * Set the user's phone number.
     *
     * @param string $value
     * @return void
     */
    public function setPhoneNumberAttribute($value)
    {
        $this->attributes['phone_number'] = $this->processPhoneNumber($value);
    }

    /**
     * Process a validation logic to a phone number before it gets stored in the DB.
     *
     * @param string $phoneNumber
     * @return string
     */
    private function processPhoneNumber($phoneNumber)
    {
        if (strpos($phoneNumber, '+255') === 0) {
            $phoneNumber = substr($phoneNumber, 1); // Remove the '+' character
        } elseif (strpos($phoneNumber, '0') === 0) {
            $phoneNumber = '255' . substr($phoneNumber, 1); // Replace leading 0 with 255
        } elseif (strpos($phoneNumber, '255') !== 0) {
            $phoneNumber = '255' . $phoneNumber; // Append 255 if not already present
        }

        return str_pad($phoneNumber, 12, '0', STR_PAD_LEFT);
    }

    /**
     * A one-to-many relationship.
     * A user generates one or many logs.
     */
    public function logs()
    {
        return $this->hasMany(Log::class, 'user_id');
    }

    /**
     * A one-to-many relationship.
     * A user receives one or many notifications.
     */
    public function notifications()
    {
        return $this->hasMany(Notification::class, 'auth_id');
    }

    /**
     * Get the unread notifications for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function unreadNotifications()
    {
        return $this->notifications()->whereNull('read_at');
    }

    /**
     * A one-to-many relationship.
     * A user has one or many login/logout activities.
     */
    public function loginlogoutActivities()
    {
        return $this->hasMany(UserLoginLogoutActivity::class);
    }

    /**
     * A one-to-one relationship with the Member model.
     */
    public function member()
    {
        return $this->hasOne(Member::class);
    }
}
