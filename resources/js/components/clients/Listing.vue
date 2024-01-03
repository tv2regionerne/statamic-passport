<template>
    
    <div>
        <div class="flex items-end justify-between mb-4">
            <h2>Clients</h2>
            <button class="btn btn-sm btn-primary px-3" @click="createClient">Create Client</button>
        </div>
        <div class="card p-0">
            <div v-if="initializing" class="flex items-center justify-center text-center py-16">
                <loading-graphic :inline="true" />
            </div>
            <div v-if="!clients.length" class="flex items-center justify-center text-center py-16 text-gray-700">
                {{ __('No clients') }}
            </div>
            <table class="data-table" v-if="!initializing && clients.length">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>ID</th>
                        <th>Secret</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="client in clients" :key="client.id">
                        <td>
                            {{ client.name }}
                        </td>
                        <td>
                            {{ client.id }}
                        </td>
                        <td>
                            {{ client.secret }}
                        </td>
                        <td>
                            <dropdown-list>
                                <dropdown-item :text="__('Edit')" @click="editClient(client)" />
                                <dropdown-item :text="__('Delete')" class="warning" @click="deleteClient(client)" />
                            </dropdown-list>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <Form
            v-if="showClient"
            :initial-values="clientValues"
            @saved="closeClient"
            @closed="closeClient"
            />
    </div>

</template>

<script>
import Form from './Form.vue';

export default {

    components: {
        Form,
    },

    data() {
        return {
            initializing: true,
            loading: true,
            clients: [],
            showClient: false,
            clientValues: undefined,
        }
    },
    
    mounted() {
        this.loadClients();
    },

    methods: {

        loadClients() {
            this.loading = true;
            this.$axios.get('/passport/clients')
                .then(response => {
                    this.clients = response.data;
                    this.loading = false;
                    this.initializing = false;
                })
                .catch(e => {
                    this.$toast.error(e.response ? e.response.data.message : __('Something went wrong'), { duration: null });
                })
        },

        deleteClient(client) {
            this.$axios.delete(`/passport/clients/${client.id}`)
                .then(response => {
                    this.loadClients();
                })
                .catch(e => {
                    this.$toast.error(e.response ? e.response.data.message : __('Something went wrong'), { duration: null });
                })
        },

        createClient() {
            this.showClient = true;
        },

        editClient(client) {
            this.clientValues = {
                id: client.id,
                name: client.name,
                redirect: client.redirect,
            };
            this.showClient = true;
        },

        closeClient() {
            this.clientValues = undefined;
            this.showClient = false;
            this.loadClients();
        },

    }

}
</script>