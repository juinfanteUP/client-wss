<div id="channel-pane" class="w-100">
    <div class="container table-responsive pt-5"> 
        <div class="page-content">
            <div class="container-fluid">

                <div class="card mt-3">
                    <div class="card-body">

                        <!-- Header and Search -->
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="card-title pt-1">
                                    Manage Channels
                                </h4>
                            </div>
                            <div class="col-sm-10 col-md-4">
                                <div class="input-group search-panel mb-3">
                                    <input type="text" class="form-control bg-light border-0" placeholder="Search here">
                                    <button class="btn btn-light p-0" type="button" id="searchbtn-addon">
                                        <i class='bx bx-search align-middle'></i>
                                    </button>

                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-info" type="button" data-bs-toggle="modal" data-bs-target="#create-channel-modal">
                                    <i class='bx bx-plus'></i> Create Channel
                                </button>  
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="table-responsive mt-3">
                            <table class="table table-editable table-nowrap align-middle table-edits">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Date Modified</th>
                                        <th style="width: 300px"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-bind:id="'channel-list-' + channel.id" v-for="(channel, index) in resultChannelQuery">
                                        <td>@{{ channel.name }}</td>
                                        <td>@{{ channel.description }}</td>
                                        <td>@{{ channel.modified_dtm }}</td>
                                        <td>
                                            <div v-show ="index > 0">
                                                <a class="btn btn-success btn-sm edit mx-1" @click="openMembersChannel(channel)" href="javascript:" title="Manage Users">
                                                    <i class="ri-group-line"></i> Members
                                                </a>
    
                                                <a class="btn btn-info btn-sm edit mx-1" @click="openEditChannel(channel)" href="javascript:" title="Edit">
                                                    <i class="ri-edit-line"></i> Edit
                                                </a>
    
                                                <a class="btn btn-danger btn-sm edit mx-1" @click="deleteChannel(channel.id, channel.name)" href="javascript:" title="Delete">
                                                    <i class="ri-delete-bin-2-line"></i> Delete
                                                </a>
                                            </div>
                                        </td>
                                    </tr>                     
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="row justify-content-end mt-2">
                            <div class="col">
                                <p>
                                    Page 1 of 1 
                                    <span class="mx-1">(@{{ resultChannelQuery.length }} Items)</span>
                                </p>
                            </div>
                            <div class="col-auto">     
                                <span class="btn-toolbar" role="toolbar">

                                    <!-- Prev -->
                                    <div class="btn-group mx-1" role="group">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        <i class="ri-arrow-left-s-line"></i> 
                                    </button>
                                    </div>

                                <!-- Next -->
                                <div class="btn-group mx-1" role="group">
                                    <button type="button" class="btn btn-primary btn-sm">
                                    <i class="ri-arrow-right-s-line"></i> 
                                    </button>
                                    </div>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>