<template>
    <div class="row mt-3 mb-3">
        <div v-for="message in messages">
            <div v-if="message.type === 'in'" class="col-12 d-flex flex-column mb-3 align-items-start">
<!--                <span data-testid="tail-in" data-icon="tail-in" class="p0s8B"><svg viewBox="0 0 8 13" height="13" width="8" preserveAspectRatio="xMidYMid meet" class="" version="1.1" x="0px" y="0px" enable-background="new 0 0 8 13" xml:space="preserve"><path opacity="0.13" fill="#fffff" d="M1.533,3.568L8,12.193V1H2.812 C1.042,1,0.474,2.156,1.533,3.568z"></path><path fill="#ffff" d="M1.533,2.568L8,11.193V0L2.812,0C1.042,0,0.474,1.156,1.533,2.568z"></path></svg></span>-->
                <div class="bg-white p-4 pt-3 pb-3 rounded-3 message-left">
                    {{ message.text }}
                </div>
                <p class="text-muted d-block mt-1" style="font-size: 10px;float: right;">{{ message.created_at }}</p>
            </div>
            <div v-else class="col-12 d-flex flex-column mb-3 align-items-end">
                <div class="bg-white p-4 pt-3 pb-3 rounded-3 message-right">
                    {{ message.text }}
                </div>
                <p class="text-muted d-block mt-1" style="font-size: 10px;float: right;">{{ message.created_at }}</p>
            </div>
        </div>

        <div class="bg-white col-12">
            <div class="form-group">
            </div>
        </div>

        <div class="col-12 g-0 shadow-sm">

            <div class="bg-white d-flex flex-column layout-wrapper rounded-top">
                <fieldset class="mb-3" data-async="">
                    <div class="bg-white rounded shadow-sm p-4 py-4 d-flex flex-column">
                        <div class="form-group">
                            <label for="field-userpassword-6a1787ef0b983574f42b674f4633383e90c4e5d1" class="form-label">Текст</label>
                            <div data-controller="text">
                                <textarea name="" v-model="messageField" id="" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div class="bg-light px-4 py-3 d-flex justify-content-end rounded-bottom">
                <div class="">
                    <div class="form-group mb-0">
                        <button data-controller="button" data-turbo="true" class="btn  btn-default" type="submit" v-on:click="sendMessage()">
                            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" width="1em" height="1em" viewBox="0 0 32 32" class="me-2" role="img" fill="currentColor" path="check" componentname="orchid-icon">
                                <path d="M16 0c-8.836 0-16 7.163-16 16s7.163 16 16 16c8.837 0 16-7.163 16-16s-7.163-16-16-16zM16 30.032c-7.72 0-14-6.312-14-14.032s6.28-14 14-14 14 6.28 14 14-6.28 14.032-14 14.032zM22.386 10.146l-9.388 9.446-4.228-4.227c-0.39-0.39-1.024-0.39-1.415 0s-0.391 1.023 0 1.414l4.95 4.95c0.39 0.39 1.024 0.39 1.415 0 0.045-0.045 0.084-0.094 0.119-0.145l9.962-10.024c0.39-0.39 0.39-1.024 0-1.415s-1.024-0.39-1.415 0z"></path>
                            </svg>
                            Отправить
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'dataChatId'
    ],
    data: function () {
        return {
            chatId: this.dataChatId,
            messages: [],
            messageField: '',
        }
    },
    mounted() {
        this.getMessages();
        setInterval(() => {
            this.getMessages();
        }, 4000);
    },
    methods: {
        getMessages() {
            axios.get('/api/chats/' + this.chatId, {

            }).then(response => {
                this.messages = response.data.data;
                console.log(this.messages);
            });
        },
        sendMessage() {
            axios.post('/api/bot/send', {
                chat_id: this.chatId,
                message: this.messageField,
            }).then(response => {
                this.getMessages();
                this.messageField = '';
            });
        }
    }
}
</script>
