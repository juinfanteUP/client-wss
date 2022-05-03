<div id="user-pane" class="w-100">
    <div class="container table-responsive pt-5"> 
        <div class="page-content">
            <div class="container-fluid">

                <div class="card mt-3">
                    <div class="card-body">

                        <!-- Header and Search -->
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <h4 class="card-title pt-1">
                                    Manage Users
                                </h4>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <form>
                                    <div class="input-group search-panel mb-3">
                                        <input type="text" class="form-control bg-light border-0" id="searchChatUser" v-model="searchUser"
                                            placeholder="Search here..." autocomplete="off">
                                        <button class="btn btn-light p-0" type="button" id="searchbtn-addon"><i
                                                class='bx bx-search align-middle'></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Data Table -->
                        <div class="table-responsive mt-3">
                            <table class="table table-editable table-nowrap align-middle table-edits">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>User Id</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Date Modified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="user in resultUserQuery">
                                        
                                        <td class="user-avatar">
                                            <img :src="user.picture" width="40" alt="">
                                            @{{ user.name }}
                                        </td>
                                        <td>@{{ user.tenant_id }}</td> 
                                        <td>@{{ user.email }}</td>
                                        <td>@{{ user.contact_no }}</td>
                                        <td>@{{ user.modified_dtm }}</td>
                                    </tr>                     
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        {{-- <div class="row justify-content-end mt-2">
                            <div class="col">
                                <p>
                                    Page 1 of 1 
                                    <span class="mx-1">(@{{ resultUserQuery.length }} Items)</span>
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
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>