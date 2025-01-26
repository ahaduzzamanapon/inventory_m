
@php
    $setting = DB::table('sitesettings')->first();
@endphp

<div class="row" style="align-items: center;display: flex;flex-direction: column;">
        <img style="height: 60px;" src="{{ asset($setting->logo) }}" alt="Logo" />
    <h3 >
        {{ $setting->name ?? '' }} - {{ $setting->slogan ?? '' }}
    </h3>
</div>
