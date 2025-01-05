@extends('layouts.main')

@section('body')
    <div class="space-y-6">
        <x-card title="Kullanıcı Bilgileri">
            <form action="{{ route('user.update') }}" method="post" class="space-y-5">
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Kullanıcı Adı
                    </label>
                    <div class="flex items-stretch">
                        <input
                            name="username"
                            class="form-input"
                            type="text"
                            value="{{ old('username', $user->username) }}"
                        />
                    </div>

                    @error('username')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        E-Posta Adresi
                    </label>
                    <div class="flex items-stretch">
                        <input
                            name="email"
                            class="form-input"
                            type="text"
                            value="{{ old('email', $user->email) }}"
                        />
                    </div>

                    @error('email')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Telefon Numarası
                    </label>
                    <div class="flex items-stretch">
                        <input
                            name="phone"
                            class="form-input"
                            type="text"
                            value="{{ old('phone', $user->phone) }}"
                        />
                    </div>

                    @error('phone')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Kullanıcımı Güncelle</button>
                </div>

                @csrf
            </form>
        </x-card>

        <x-card title="Şifreyi Değiştir">
            <form action="{{ route('user.password.update') }}" method="post" class="space-y-5">
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Şifre
                    </label>
                    <div class="flex items-stretch">
                        <input name="old_password" class="form-input" type="password" />
                    </div>
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Yeni Şifre
                    </label>
                    <div class="flex items-stretch">
                        <input class="form-input" type="password" />
                    </div>
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Yeni Şifre (tekrar)
                    </label>
                    <div class="flex items-stretch">
                        <input class="form-input" type="password" />
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Şifreyi Değiştir</button>
                </div>

                @csrf
            </form>
        </x-card>

        <x-card title="Profil Bilgileri">
            <form action="{{ route('user.profile.update') }}" method="post" class="space-y-5">
                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Ad
                        <span class="text-danger">*</span>
                    </label>
                    <div class="flex items-stretch">
                        <input
                            name="name"
                            class="form-input"
                            type="text"
                            value="{{ old('name', $user->profile->name) }}"
                        />
                    </div>

                    @error('old_password')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Soyad
                        <span class="text-danger">*</span>
                    </label>
                    <div class="flex items-stretch">
                        <input
                            name="surname"
                            class="form-input"
                            type="text"
                            value="{{ old('surname', $user->profile->surname) }}"
                        />
                    </div>

                    @error('surname')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Firma Adı
                    </label>
                    <div class="flex items-stretch">
                        <input
                            name="company_name"
                            class="form-input"
                            type="text"
                            value="{{ old('company_name', $user->profile->company_name) }}"
                        />
                    </div>

                    @error('company_name')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Firma Telefonu
                    </label>
                    <div class="flex items-stretch">
                        <input
                            name="company_phone"
                            class="relative z-1 w-full rounded rounded-l-none border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"
                            type="text"
                            value="{{ old('company_phone', $user->profile->company_phone) }}"
                        />
                    </div>

                    @error('company_phone')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        Adres
                    </label>
                    <textarea name="address" rows="3" class="form-input">
{{ old('address', $user->profile->address) }}</textarea
                    >

                    @error('address')
                        <div class="mt-2 text-sm text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        İl
                        <span class="text-danger">*</span>
                    </label>
                    <div class="bg-white dark:bg-form-input">
                        <select name="province" class="form-input">
                            @foreach ($provinces as $province)
                                <option
                                    class="text-body"
                                    value="{{ $province->id }}"
                                    @selected(old('province', $user->profile->province_id) === $province->id)
                                >
                                    {{ $province->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">
                        İlçe
                        <span class="text-danger">*</span>
                    </label>
                    <div class="bg-white dark:bg-form-input">
                        <select name="district" class="form-input">
                            @foreach ($user->profile->province->districts as $district)
                                <option
                                    class="text-body"
                                    value="{{ $district->id }}"
                                    @selected(old('district', $user->profile->district_id) === $district->id)
                                >
                                    {{ $district->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit" class="btn btn-primary">Profilimi Güncelle</button>
                </div>

                @csrf
            </form>
        </x-card>
    </div>
@endsection
