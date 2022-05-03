<div class="modal fade" id="edit-channel-modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-header-colored border-0">
            <div class="modal-header">
                <h5 class="modal-title text-white fs-16" id="addgroup-exampleModalLabel">
                    Edit Channel
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" ></button>
            </div>

            <form @submit.prevent="editChannel">
                <div class="modal-body p-4">
                    <input v-model="editChannelData.id" name="id" type="hidden">


                    <!-- Channel Name -->
                    <div class="mb-4">
                        <label class="form-label">Channel Name</label>
                        <input v-model="editChannelData.name" name="name" type="text" class="form-control" placeholder="Enter Group Name" required >
                    </div>

                    <!-- Channel Name -->
                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea v-model="editChannelData.description" name="description" class="form-control" rows="3" placeholder="Enter Description"></textarea>
                    </div>
                </div>
                
                <!-- Modal Button -->
                <div class="modal-footer border-top justify-content-center">
                    <button type="submit" class="btn btn-primary m-0">
                        Update Changes
                    </button>  
                </div>
            </form>
        </div>
    </div>
</div>