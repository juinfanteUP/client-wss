<div class="accordion-item">                
    <div class="accordion-header">
        <a class="accordion-button fs-14 fw-medium collapsed" data-bs-toggle="collapse" href="#profileAccordion">
            <div class="d-flex align-items-center">
                <div class="flex-shrink-0 me-3 avatar-xs">
                    <div class="avatar-title bg-soft-info text-info rounded">
                        <i class="bx bxs-user"></i>
                    </div>
                </div>
                Profile
            </div>
        </a>
    </div>
    <div id="profileAccordion" class="accordion-collapse collapse" data-bs-parent="#settingprofile">
        <div class="accordion-body edit-input">

            <form @submit.prevent="editProfile">

                <!-- Name -->
                <div>
                    <label class="form-label text-muted fs-13">
                        Name
                    </label>
                    <input name="name" type="text" class="form-control" value="{{ $user->name }}" placeholder="Enter name">
                </div>

                <!-- Email -->
                <div class="mt-3">
                    <label class="form-label text-muted fs-13">
                        Email
                    </label>
                    <input name="email" type="email" class="form-control" value="{{ $user->email }}" placeholder="Enter email">
                </div>

                <!-- Contact Number -->
                <div class="mt-3">
                    <label class="form-label text-muted fs-13">
                        Contact No
                    </label>
                    <input name="contact_no" type="tel" class="form-control" value="{{ $user->contact_no }}" placeholder="Enter contact nunber">
                </div>

                <div class="mt-4 text-center">
                    <button type="submit" class="btn btn-sm btn-info">
                        Update Profile
                    </button>
                </div>
            </form>
    
        </div>
    </div>
</div>