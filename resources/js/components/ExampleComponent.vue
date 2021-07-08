<template>
    <div class="main-content container">
        <div class="layout-px-spacing">

            <div class="chat-section layout-top-spacing">
                <div class="row">

                    <div class="col-xl-12 col-lg-12 col-md-12">

                        <div class="chat-system">
                            <div class="hamburger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu mail-menu d-lg-none">
                                    <line x1="3" y1="12" x2="21" y2="12"></line>
                                    <line x1="3" y1="6" x2="21" y2="6"></line>
                                    <line x1="3" y1="18" x2="21" y2="18"></line>
                                </svg>
                            </div>
                            <div class="user-list-box">
                                <div class="search">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                    </svg>
                                    <input type="text" class="form-control" placeholder="Search"/>
                                </div>
                                <div class="people">

                                    <div class="person" v-for="user in users" @click="selectUser(user)">
                                        <div class="user-info">
                                            <div class="f-head">
                                                <img :src="user.photo" alt="avatar">
                                            </div>
                                            <div class="f-body">
                                                <div class="meta-info">
                                                    <span class="user-name" data-name="Nia Hillyer" v-text="user.name"></span>
                                                    <span class="user-meta-time"></span>
                                                </div>
                                                <span class="preview" v-text="user.phone">How do you do?</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="chat-box">
                                <div class="chat-box-inner d-flex flex-column " style="height: 100%">
                                    <div class="chat-meta-user chat-active" v-if="selectedUser!=''">
                                        <div class="current-chat-user-name"><span><img :src="selectedUser.photo" alt="dynamic-image"><span class="name" v-text="selectedUser.name"></span></span></div>
                                    </div>
                                    <div class="chat-conversation-box">
                                        <div id="chat-conversation-box-scroll" class="chat-conversation-box-scroll">

                                            <div class="chat d-block">

                                                <div v-for="message in messages" v-text="message.message" :class="message.from_id == selectedUser.id ? 'you' : 'me'" class="bubble"></div>

                                            </div>

                                        </div>

                                    </div>
                                    <div class="chat-footer d-block" v-if="selectedUser != ''">
                                        <div class="chat-input">
                                            <div class="chat-form">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square">
                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                                </svg>
                                                <input type="text" class="mail-write-box form-control" placeholder="Message" v-model="newMessage" @keypress.enter="sendMessage()"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
export default {
    name: 'example',
    data: function () {
        return {
            users: [],
            selectedUser: '',
            messages: [],
            newMessage: '',
            authUser: '',
        }
    },
    methods: {
        selectUser(user) {
            this.selectedUser = user;
            this.newMessage = '';

            window.Echo.private('message-' + this.selectedUser.id + '-' + this.authUser.id)
                .listen('SentMessagesEvent', e => {
                    this.messages.push(e.message);
                });

            window.Echo.private('message-' + this.authUser.id + '-' + this.selectedUser.id)
                .listen('SentMessagesEvent', e => {
                    this.messages.push(e.message);
                });

            window.axios.get('/user/' + this.selectedUser.id + '/get-messages')
                .then((res) => {
                    this.messages = res.data;
                    this.messages.sort((a, b) => new Date(a.created_at) - new Date(b.created_at));
                });
        },
        sendMessage() {
            let data = {
                message: this.newMessage,
            }
            window.axios.post('/user/' + this.selectedUser.id + '/send-message', data).then((res) => {
                this.newMessage = '';
                this.messages.push(res.data);
            })
        }
    },
    mounted() {
        window.axios.get('/users').then((res) => {
            this.users = res.data.data;
        });
        window.axios.get('/auth-user').then((res) => {
            this.authUser = res.data;
        })
    },
}
</script>
