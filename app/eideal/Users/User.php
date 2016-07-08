<?php namespace eideal\Users;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laracasts\Commander\Events\EventGenerator;
use Eloquent, Hash;


class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait, EventGenerator;

	/**
	 * Which fields might be mass assigned
	 *
	 * @var array
	 */
	protected $fillable = ['username', 'password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /**
     * Passwords must always be hashed
     * @param $password
     */
    public  function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


    /**
     * Register a user to metro
     *
     * @param $username
     * @param $password
     * @return static
     */
    public static function register($username, $password)
    {
        $user = new static(compact('username', 'password'));

        return $user;
    }





    /**
     *
     * Determine if the given user is the same as the current one
     *
     * @param User $user
     * @return bool
     */
    public function is(User $user)
    {
        return $this->username == $user->username;
    }



}
