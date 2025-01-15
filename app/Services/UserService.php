<?php

namespace App\Services;

use App\Enums\UserState;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function store(array $data): ?User
    {
        $user = new User();
        $user = $this->assignAttributes($user, $data);

        return $user->fresh();
    }

    private function assignAttributes(User $user, array $data): ?User
    {
        $user->username = $data['username'] ?? $user->username ?? $this->generateUsername();
        $user->email = $data['email'] ?? $user->email;
        $user->phone = $data['phone'] ?? $user->phone;

        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if (!empty($data['role_id']) && auth()->user()->checkAbility('admin.role.edit')) {
            $user->role_id = $data['role_id'];
        } else if ($user->role_id === null || empty($data['role_id'])) {
            $user->role_id = RoleService::defaultRole()?->id;
        }

        if ($user->id === null && $user->state === null && $user->isAdmin()) {
            $user->state = UserState::ACTIVE;
        }

        $user->state = $user->state ?? UserState::PENDING;

        $user->save();

        $this->fillProfile($user, $data);

        return $user->fresh();
    }

    private function generateUsername(): string
    {
        $userName = 'esnafarabam' . rand(100, 999) . rand(100, 999) . rand(100, 999);

        if (User::where('username', $userName)->exists()) {
            return $this->generateUsername();
        }

        return $userName;
    }

    private function fillProfile(User $user, array $data): void
    {
        if ($user->profile) {
            $profile = $user->profile;
        } else {
            $profile = new Profile();
            $profile->user_id = $user->id;
        }

        $profile->name = $data['name'] ?? $profile->name;
        $profile->surname = $data['surname'] ?? $profile->surname;
        $profile->company = $data['company'] ?? $profile->company;
        $profile->company_phone = $data['company_phone'] ?? $profile->company_phone;
        $profile->address = $data['address'] ?? $profile->address;
        $profile->tax_identity = $data['tax_identity'] ?? $profile->tax_identity;
        $profile->province_id = $data['province_id'] ?? $profile->province_id;
        $profile->district_id = $data['district_id'] ?? $profile->district_id;

        $profile->save();
    }

    public function update(User $user, array $data): ?User
    {
        $user = $this->assignAttributes($user, $data);

        return $user->fresh();
    }

    public function delete(User $user): ?bool
    {
        return $user->delete();
    }

    public function approveUser(User $user): bool
    {
        try {
            $user->state = UserState::ACTIVE;
            $user->save();

            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }

    public function updatePassword(User $user, array $data): bool
    {
        if (Hash::check($data['old_password'], $user->password)) {
            $user->password = Hash::make($data['password']);
            $user->save();

            return true;
        }

        return false;
    }
}
