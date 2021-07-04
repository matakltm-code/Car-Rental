<div class="list-group ">
    <a href="/profile"
        class="list-group-item list-group-item-action <?=(Route::current()->uri() == 'profile' ? 'active':'')?>">
        Profile
    </a>
    <a href="/profile/edit"
        class="list-group-item list-group-item-action <?=(Route::current()->uri() == 'profile/edit' ? 'active':'')?>">
        Edit Profile
    </a>
    <a href="/profile/change-password"
        class="list-group-item list-group-item-action <?=(Route::current()->uri() == 'profile/change-password' ? 'active':'')?>">
        Change password
    </a>

    @if (auth()->user()->is_driver)
    <a href="/profile/driver-license"
        class="list-group-item list-group-item-action <?=(Route::current()->uri() == 'profile/driver-license' ? 'active':'')?>">
        Driver License
    </a>
    @endif

</div>
