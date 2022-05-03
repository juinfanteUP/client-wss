<div class="tab-pane show active" id="pills-chat" role="tabpanel">
    <!-- Start chats content -->
    <div>
        <div class="px-4 pt-4">
            <div class="d-flex align-items-start">
                <div class="flex-grow-1">
                    <h4 class="mb-4">Let's Kinect</h4>
                </div>
            </div>
            <form>
                <div class="input-group search-panel mb-3">
                    <input type="text" class="form-control bg-light border-0" id="searchChatUser" v-model="searchChannel"
                        title="Enter something to search a channel" placeholder="Search " autocomplete="off">
                    <button class="btn btn-light p-0" type="button" id="searchbtn-addon"><i
                            class='bx bx-search align-middle'></i></button>
                </div>
            </form>
        </div> <!-- .p-4 -->

        <div data-simplebar>


            <div class="d-flex align-items-center px-4 mt-3 mb-2">
                <div class="flex-grow-1">
                    <h4 class="mb-0 fs-11 text-muted text-uppercase">Public Channel</h4>
                </div>
            </div>

            <div class="chat-message-list">
                <ul class="list-unstyled chat-list chat-user-list mb-3" id="genChat">

                    <li @click="selectChannel(1)" id="channel-1" v-show ="index === 0"  v-for="(channel, index) in channels" :class="[selectedChannel.id == 1 ? 'bg-gray' : '']">                
                        <a href="javascript: void(0);" class="unread-msg-user">                     
                            <div class="d-flex align-items-center">                        
                                <div class="flex-shrink-0 me-2">                            
                                    <div class="chat-user-img online align-self-center">                            
                                        <img src="assets/images/chat-rooms-profile.png" class="rounded-circle avatar-xs" alt="">                            
                                    </div>                        
                                </div>                        
                                <div class="flex-grow-1 overflow-hidden">                            
                                    <h6 class="text-truncate mb-0">@{{ channel.name }}</h6>                                               
                                </div>                                           
                            </div>                
                        </a>            
                    </li>

                </ul>
            </div>

            <div class="d-flex align-items-center px-4 mt-5 mb-2">
                <div class="flex-grow-1">
                    <h4 class="mb-0 fs-11 text-muted text-uppercase">My Private Channels</h4>
                </div>
                <div class="flex-shrink-0">
                    <div data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" title="Create a private channel">

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#create-channel-modal">
                            <i class="bx bx-plus align-middle"></i>
                        </button>
                    </div>
                </div>
            </div>

            <div class="chat-message-list">
                <ul class="list-unstyled chat-list chat-user-list mb-3" id="channelList">

                    <li  @click="selectChannel(channel.id)" v-show ="channel.id > 1"  v-bind:id="'channel-' + channel.id" v-for="channel in resultChannelQuery" :class="[channel.id == selectedChannel.id ? 'bg-gray' : '']">                
                        <a href="javascript: void(0);" class="unread-msg-user">                     
                            <div class="d-flex align-items-center">                        
                                <div class="flex-shrink-0 me-2">                            
                                    <div class="chat-user-img online align-self-center">                            
                                        <img src="assets/images/chat-rooms-profile.png" class="rounded-circle avatar-xs" alt="">                            
                                    </div>                        
                                </div>                        
                                <div class="flex-grow-1 overflow-hidden">                            
                                    <h6 class="text-truncate mb-0">@{{ channel.name }}</h6>                                                    
                                </div>                                           
                            </div>                
                        </a>            
                    </li>

                </ul>
            </div>
        </div>
    </div>
</div>