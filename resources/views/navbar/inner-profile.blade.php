<!-- My Profile -->
<div class="tab-pane" id="pills-profile" role="tabpanel">
    <div class="pt-4">
        <h5 class="px-3">My Profile</h5>

        <!-- Profile Image -->
        <div class="text-center p-3 border-bottom">
            <div id="profile-details" class="mb-3 profile-user">
                <img :src="profile.picture" class="rounded-circle avatar-lg img-thumbnail user-profile-image" alt="user-profile-image">
                <div class="avatar-xs p-0 rounded-circle profile-photo-edit">
                    <input id="profile-img-file-input" type="file" class="profile-img-file-input">
                    <input type="file" id="image-uploader" ref="img" v-on:change="handleImageUpload()" accept="image/png, image/jpeg" hidden/>
                    <label for="profile-img-file-input" class="profile-photo-edit avatar-xs">
                        <span class="avatar-title rounded-circle bg-light text-body">
                            <i class="bx bxs-camera" title="Click to update profile picture" onclick="document.getElementById('image-uploader').click()"></i>
                        </span>
                    </label>
                </div>
            </div>

            <h5 class="m-0">@{{ profile.name }}</h5>
            <p class="small text-muted">User Id #@{{ profile.tenant_id }}</p>

        </div>

        
        <div class="user-setting" data-simplebar>
            <div id="settingprofile" class="accordion accordion-flush">
                @include('navbar.update-profile')
                @include('navbar.update-password')
            </div>
        </div>
    </div>
</div>


