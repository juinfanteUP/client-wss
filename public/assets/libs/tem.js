var app = new Vue({
    el: '#app',
    data: {
        profile: { 
            name: '', 
            picture: 'assets/images/default-profile.jpg', 
            tenant_id: '', 
            email: '', 
            contact_no: '', 
            id: '',
            password: null,
            password_confirmation: null
        },
        channels: {},
        users: {},
        messages: {},
        allMessages: {},
        chatbox: '',

        imageFile: { name: '' },
        file: { name: '' },

        isSubmitting: false,

        searchChannel: '',
        searchUser: '',
        selectedChannel: {
            id: 1,
            name: ""
        },
        editChannelData: {
            id: 0,
            name: "",
            descriptiom: ""
        },
        channelMembers: {},
        nonMembers: {},
        newMembers: {},
        removeMembers: {}
    },

    mounted: function mounted() {
        this.getProfile();
        this.getChannels();
        this.getUsers();
        this.getMessages();
        this.getUserInput();
      
        Echo.private('channel.' + 1)
        .listen('MessagePost', (msg) => {
                this.allMessages.push(msg);
                if (msg.channel_id == this.selectedChannel.id) {
                    this.messages.push(msg);
                    scrollToBottom();
                }
            })
    },

    computed: {
        // currentChannel() {
        //     console.log('Change channel');
        //     let cid = this.selectedChannel.id;
        //     return Echo.private('App.User.1') //('channel.' + cid);
        // },

        resultChannelQuery: function resultChannelQuery() {
            var _this = this;

            if (this.searchChannel) {
                return this.channels.filter(function(item) {
                    return _this.searchChannel.toLowerCase().split(' ').every(function(v) {
                        return item.name.toLowerCase().includes(v);
                    });
                });
            }

            return this.channels;
        },
        
        resultUserQuery: function resultUserQuery() {
            var _this = this;

            if (this.searchUser) {
                return this.users.filter(function(item) {
                    return _this.searchUser.toLowerCase().split(' ').every(function(v) {
                        return item.name.toLowerCase().includes(v);
                    });
                });
            }

            return this.users;
        },

        disableSend: function disableSend() {
            return this.isSubmitting || !((this.chatbox && this.chatbox != "") || this.file?.name != "");
        }
    },
    
    methods: {

        // ************************ Manipulate Socket Methods ************************ //
        
        // listen: function listen() {
        //     var _this = this;
        //     let cid = _this.selectedChannel.id;

        //     console.log(`Get messages in ${cid}`);
        //     this.currentChannel.listen('MessagePost', function(msg) {
        //         _this.allMessages.push(msg);
        //         if (msg.channel_id == cid) {
        //             _this.messages.push(msg);
        //             scrollToBottom();
        //         }
        //     });
        // },

        selectChannel: function selectChannel(id = 1) {
            var ind = this.channels.findIndex((c) => c.id == id);

            if (ind >= 0) {
                this.selectedChannel = this.channels[ind];
                let cid = this.selectedChannel.id;
                //this.listen();

                this.messages = _.filter(this.allMessages, (m) => m.channel_id == cid );                   
                this.$forceUpdate();
                scrollToBottom();
            }
        },
        
        // ************************ Manipulate Channels ************************ //
        
        getChannels: function getChannels() {
            var _this = this;
            axios.get('/api/channel').then(function(response) {
                _this.channels = response.data;

                if (_this.channels.length > 0) {
                    _this.selectedChannel = _this.channels[0];

                    _this.$forceUpdate();
                }
            })["catch"](function(error) {
                handleError(error);
            });
        },

        createChannel: function createChannel(submitEvent) {
            var _this = this;

            if (confirm('Are you sure you want to create a new channel?')) {
                showLoader();
                axios.post('/api/channel/', {
                    name: submitEvent.target.elements.name.value,
                    description: submitEvent.target.elements.description.value
                }).then(function(response) {
                    showLoader(false);
                    hideModal();
                    _this.getChannels();

                    alert('Channel was created successfully.');

                })["catch"](function(error) {
                    handleError(error);
                });
            }
        },

        openEditChannel: function openEditChannel(item) {
            this.editChannelData = {
                id: item.id,
                name: item.name,
                description: item.description
            };

            $('#edit-channel-modal').modal('show');
        },

        editChannel: function editChannel(submitEvent) {
            var _this = this;

            if (confirm('Are you sure you want to update this channel?')) {
                showLoader();
                axios.put('/api/channel/', {
                    id: submitEvent.target.elements.id.value,
                    name: submitEvent.target.elements.name.value,
                    description: submitEvent.target.elements.description.value
                }).then(function(response) {

                    _this.getChannels();
                    showLoader(false);
                    hideModal();

                    alert('Channel was updated successfully.');

                })["catch"](function(error) {
                    handleError(error);
                });
            }
        },

        deleteChannel: function deleteChannel(id, name) {
            var _this = this;

            if (confirm("Are you sure you want to delete ".concat(name, "?"))) {
                showLoader();
                axios["delete"]("/api/channel?channel_id=".concat(id)).then(function(response) {
                    showLoader(false);

                    _this.getChannels();

                    alert('Channel was deleted successfully.');
                })["catch"](function(error) {
                    handleError(error);
                });
            }
        },

        // ************************ Manipulate Members ************************ //

        openMembersChannel: function openMembersChannel(item) {
            var _this = this;

            this.editChannelData = {
                id: item.id,
                name: item.name,
                description: item.description
            };

            showLoader();
            axios.get("/api/members?channel_id=".concat(item.id)).then(function(response) {
                _this.channelMembers = response.data;
                _this.nonMembers = [];

                _this.users.forEach(function(user) {
                    var ind = _this.channelMembers.findIndex(function(c) {
                        return c.id == user.id;
                    });

                    if (ind == -1) {
                        _this.nonMembers.push(user);
                    }
                });

                _this.$forceUpdate();
                showLoader(false);
                $('#channel-members-modal').modal('show');

            })["catch"](function(error) {
                handleError(error);
            });
        },

        addMember: function addMember(user) {
            var ind = this.nonMembers.findIndex(function(c) {
                return c.id == user.id;
            });

            if (ind >= 0) {
                this.channelMembers.push(this.nonMembers[ind]);
                this.nonMembers.splice(ind, 1);
                this.$forceUpdate();
            }
        },

        removeMember: function removeMember(user) {
            var ind = this.channelMembers.findIndex(function(c) {
                return c.id == user.id;
            });

            if (ind >= 0) {
                this.nonMembers.push(this.nonMembers[ind]);
                this.channelMembers.splice(ind, 1);
                this.$forceUpdate();
            }
        },

        updateChannelMembers: function updateChannelMembers(submitEvent) {
            var _this = this;

            if (confirm('Are you sure you want to save changes')) {
                showLoader();
                
                axios.put("/api/members?channel_id=".concat(this.editChannelData.id), { user_list: this.channelMembers.map((obj) => obj.id) })
                .then(function(response) {

                    _this.getChannels();
                    showLoader(false);
                    hideModal();
                    alert('Member list was updated successfully.');

                })["catch"](function(error) {
                    handleError(error);
                });
            }
        },

        // ************************ Manipulate Users ************************ //

        getProfile: function getProfile() {
            var _this = this;

            axios.get('/api/user/profile').then(function(response) {
                _this.profile = response.data;
            })["catch"](function(error) {
                handleError(error);
            });
        },

        getUsers: function getUsers() {
            var _this = this;

            axios.get('/api/user').then(function(response) {
                _this.users = response.data;
            })["catch"](function(error) {
                handleError(error);
            });
        },

        editProfile: function editProfile(submitEvent) {
            var _this = this;

            if (confirm('Are you sure you want to update your profile?')) {
                showLoader();
                axios.put('/api/user/profile', {
                    name: submitEvent.target.elements.name.value,
                    email: submitEvent.target.elements.email.value,
                    contact_no: submitEvent.target.elements.contact_no.value
                }).then(function(response) {

                    showLoader(false);
                    var res = response.data;
                    _this.profile.name = res.name;
                    _this.profile.email = res.email;
                    _this.profile.contact_no = res.contact_no;

                    alert('Your profile has been updated successfully.');

                })["catch"](function(error) {
                    handleError(error);
                });
            }
        },

        editPassword: function editPassword(submitEvent) {
            var _this = this;

            if (submitEvent.target.elements.password.value != submitEvent.target.elements.password_confirmation.value) {
                this.profile.password_confirmation = "";
                alert('Confirmation password does not match. Please try again.');
            } else if (confirm('Are you sure you want to update your password?')) {
                    
                axios.put('/api/user/profile', { password: submitEvent.target.elements.password.value })
                .then(function(response) {
                    var user = response.data;
                    _this.profile.password = "";
                    _this.profile.password_confirmation = "";

                    alert('Your profile has been updated successfully.');
                })["catch"](function(error) {
                    handleError(error);
                });
            }
        },

        // ************************ Manipulate Messages ************************ //
        
        getMessages: function getMessages() {
            var _this = this;

            showLoader();
            var currentChannelId = this.selectedChannel.id;
            axios.get("/api/message?channel_id=".concat(currentChannelId))
            .then(function(response) {
                _this.allMessages = response.data;
                _this.selectChannel();
                showLoader(false);

            })["catch"](function(error) {
                handleError(error);
            });
        },

        postMessage: function postMessage() {
            if (!((this.chatbox && this.chatbox != "") || this.file?.name != "") || this.isSubmitting) {
                alert('dave')
                return;
            }

            if (this.chatbox.length > 255) {
                alert('Message cannot exceed 255 characters');
                return;
            }

            var _this = this;

            var msg = {
                "message": this.chatbox,
                "attachment_id": 0,
                "name": this.profile.name,
                "user_id": this.profile.id,
                "channel_id": this.selectedChannel.id,
                "created_dtm": new Date().toISOString().slice(0, 19).replace('T', ' '),
                "picture": this.profile.picture,
                "file_name": "",
                "mb_size": 0
            };

            // Handle message with attachment
            if (this.file?.name != "") 
            {
                let formData = new FormData();
                formData.append('file', this.file);
                formData.append('document', JSON.stringify(msg));

                this.isSubmitting = true;
                this.$forceUpdate();

                axios.post("/api/message/upload?channel_id=".concat(this.selectedChannel.id), 
                formData, {headers: { 'Content-Type': 'multipart/form-data'} })
                .then(function(response) {
                    _this.isSubmitting = false;
                    _this.chatbox = "";
                    _this.messages.push(response.data);
                    _this.allMessages.push(response.data);
                    _this.cancelUpload();
                    scrollToBottom();

                }).catch(function(error) {
                    handleError(error);
                });
            } 

            // Handle plain message
            else 
            {
                this.chatbox = "";
                this.messages.push(msg);
                this.allMessages.push(msg);
                scrollToBottom();

                axios.post("/api/message?channel_id=".concat(this.selectedChannel.id), {                               
                    message: msg.message,
                    file_name: msg.file_name,
                    mb_size: msg.mb_size,

                }).then(function(response) {
                    _this.$forceUpdate();
                })["catch"](function(error) {
                    handleError(error);
                });
            }
        },


        // ************************ Utility Functions ************************ //

        formatBytes: function formatBytes(bytes) {
            if (!(bytes || bytes > 0)) return '0 Bytes';    
                                  
            const k = 1024;
            const i = Math.floor(Math.log(bytes) / Math.log(k));
        
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'][i];
        },

        getUserInput: function getUserInput() {
            var _this = this;
            setInterval(() => {
                let inp = $("#chat-input").val();
                _this.chatbox = inp;
            }, 200);
        },

        handleFileUpload: function handleFileUpload() {
            this.file = this.$refs.file.files[0]
        },

        handleImageUpload: function handleImageUpload() {
            if(confirm('Are you sure you want to update your profile picture?')){
                _this = this;
                this.imageFile = this.$refs.img.files[0]

                let formData = new FormData();
                formData.append('file', this.imageFile);

                showLoader();
                axios.post("/api/user/picture", formData, {headers: { 'Content-Type': 'multipart/form-data'} })
                .then(function(response) {
                    showLoader(false);

                    _this.profile.picture = response.data;
                    _this.$refs.img.value = null;
                    _this.imageFile = { name: '' };
                    _this.$forceUpdate();

                }).catch(function(error) {
                    handleError(error);
                });
            }
            else{
                this.$refs.img.value = null;
                this.imageFile = { name: '' };
            }
        },

        cancelUpload: function cancelUpload() {
            this.$refs.file.value = null;                             
            this.file = { name: '' };
        },
                
        downloadAttachment: function downloadAttachment(id) {
            window.open('/api/message/download?id=' + id, '_blank')
        }
    }
});