<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'address',
        'dob',
        'status',
        'isConfirmed',
        'captcha',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
//    public function role()
//    {
//        return $this->belongsTo(Role::class);
//    }


    // Quan hệ nhiều nhiều
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin()
    {
        return $this->roles->contains('name', 'admin');
    }

//    public function getAllRoleAttribute(){
//        $role = $this->roles()->pluck('name')->toArray();
//        //Luôn có role_id mặc định
//
//        $defaultRole = Role::find($this->role_id);
//        if($defaultRole && !in_array($defaultRole->name, $role)){
//            array_push($role, $defaultRole->name);
//        }
//        return $role;
//    }
//    // Kiểm tra xem user có role với tên cụ thể hay ko?
//    // exists() giúp truy vấn nhanh không ần lấy toàn bộ dự liệu
    public function hasRole($roleName){
        return $this->roles()->where('name', $roleName)->exists();
    }
//    public function assignRole($roleName)
//    {
//        // Gắn 1 vai trò có tên là $roleName cho user hiện tại
//        $role = Role::where('name', $roleName)->first();
//        // Nếu role đó tồn tại && user chưa có role nào
//        if ($role && !$this->hasRole($roleName)) {
//            $this->roles()->attach($role);
//        }
//    }
//
//    public function removeRole($roleName){
//        $role = Role::where('name', $roleName)->first();
//        //Xóa role khoi user, nếu role đó tồn tại, Ko cần ktra user có role đó hay ko?
//        // detach() sẽ ử lý an toàn
//        if($role){
//            $this->roles()->detach($role);
//        }
//    }

}
