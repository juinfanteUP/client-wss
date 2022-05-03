                <div class="accordion-item">
                    <div class="accordion-header" >
                        <a class="accordion-button fs-14 fw-medium collapsed" data-bs-toggle="collapse" href="#passwordAccordion">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3 avatar-xs">
                                    <div class="avatar-title bg-soft-info text-info rounded">
                                        <i class="bx bxs-lock"></i>
                                    </div>
                                </div>
                                Update Password
                            </div>
                        </a>
                    </div>

                    <div id="passwordAccordion" class="accordion-collapse collapse" data-bs-parent="#settingprofile">
                        <div class="accordion-body edit-input">

                            <form @submit.prevent="editPassword">
                                <div class="mt-3">
                                    <label class="form-label text-muted fs-13">New Password</label>
                                    <input name="password" v-model="profile.password" type="password" class="form-control" placeholder="Enter New Password">
                                </div>

                                <div class="mt-3">
                                    <label class="form-label text-muted fs-13">Confirm New Password</label>
                                    <input name="password_confirmation" v-model="profile.password_confirmation" type="password" class="form-control" placeholder="Enter Confirm Password">
                                </div>

                                <div class="mt-4 text-center">
                                    <button type="submit" class="btn btn-sm btn-info">
                                        Update Password 
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>