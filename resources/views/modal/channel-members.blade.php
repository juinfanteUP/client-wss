<div class="modal fade" id="channel-members-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" style="min-width: 1000px;">
        <div class="modal-content modal-header-colored border-0">
            <div class="modal-header">
                <h5 class="modal-title text-white fs-16" id="addgroup-exampleModalLabel">
                    Manage Channel Members
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" ></button>
            </div>

            <form @submit.prevent="updateChannelMembers">
                <div class="modal-body p-4">

                    <!-- Channel Name -->
                    <div class="mb-4">
                        <label class="form-label">Channel Name</label>
                        <input name="name" type="text" class="form-control" v-model="editChannelData.name" placeholder="Enter Group Name" disabled >
                    </div>


                    <div class="row">
                        <div class="col">
                            <!-- Members -->
                            <h6>Members</h6>
                            <div class="table-responsive mt-3">
                                <table class="table table-editable table-nowrap align-middle table-edits">
                                    <thead>
                                        <tr>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Member Status</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="m in channelMembers">
                                            <td>@{{ m.tenant_id }}</td>
                                            <td>@{{ m.name }}</td>
                                            <td>@{{ m.email }}</td>
                                            <td>
                                                <a v-show="m.id != {{ $user->id }}" class="btn btn-danger btn-sm edit mx-1" 
                                                    @click="removeMember(m)" href="javascript:" title="Remove">
                                                    <i class="ri-delete-bin-2-line"></i> Remove
                                                </a>
                                            </td>
                                        </tr>                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <!-- Non Members -->
                            <h6>Non Members</h6>
                            <div class="table-responsive mt-3">
                                <table class="table table-editable table-nowrap align-middle table-edits">
                                    <thead>
                                        <tr>
                                            <th>User Id</th>
                                            <th>Name</th>
                                            <th>Member Status</th>
                                            <th> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="n in nonMembers">
                                            <td>@{{ n.tenant_id }}</td>
                                            <td>@{{ n.name }}</td>
                                            <td>@{{ n.email }}</td>
                                            <td>
                                                <a class="btn btn-success btn-sm edit mx-1"
                                                    @click="addMember(n)" href="javascript:" title="Add">
                                                    <i class="ri-delete-bin-2-line"></i> Add
                                                </a>
                                            </td>
                                        </tr>                     
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                
                    

                </div>
                


                <!-- Modal Button -->
                <div class="modal-footer border-top justify-content-center">
                    <button type="submit" class="btn btn-primary m-0">
                        Save Changes
                    </button>  
                </div>
            </form>
        </div>
    </div>
</div>



