<template>
    
    <div>
        <div class="flex items-end justify-between mb-4">
            <h2>{{ __('Personal Access Tokens') }}</h2>
            <button class="btn btn-sm btn-primary px-3" @click="createToken">Create Token</button>
        </div>
        <div class="card p-0">
            <div v-if="initializing" class="flex items-center justify-center text-center py-16">
                <loading-graphic :inline="true" />
            </div>
            <div v-if="!tokens.length" class="flex items-center justify-center text-center py-16 text-gray-700">
                {{ __('No tokens') }}
            </div>
            <table class="data-table" v-if="!initializing && tokens.length">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="token in tokens" :key="token.id">
                        <td>
                            {{ token.name }}
                        </td>
                        <td class="flex justify-end">
                            <dropdown-list>
                                <dropdown-item :text="__('Delete')" class="warning" @click="deleteToken(token)" />
                            </dropdown-list>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <TokenForm
            v-if="showToken"
            @saved="viewNewToken"
            @closed="closeToken"
            />
        <TokenView
            v-if="showNewToken"
            :token="newToken"
            @closed="closeNewToken"
            />
    </div>

</template>

<script>
import TokenForm from './Form.vue';
import TokenView from './View.vue';

export default {

    components: {
        TokenForm,
        TokenView,
    },

    data() {
        return {
            initializing: true,
            loading: true,
            tokens: [],
            showToken: false,
            showNewToken: false,
            newToken: null,
        }
    },
    
    mounted() {
        this.loadTokens();
    },

    methods: {

        loadTokens() {
            this.loading = true;
            this.$axios.get(passport_url('personal-access-tokens'))
                .then(response => {
                    this.tokens = response.data;
                    this.loading = false;
                    this.initializing = false;
                })
                .catch(e => {
                    this.$toast.error(e.response ? e.response.data.message : __('Something went wrong'), { duration: null });
                })
        },

        deleteToken(token) {
            this.$axios.delete(passport_url(`personal-access-tokens/${token.id}`))
                .then(response => {
                    this.loadTokens();
                })
                .catch(e => {
                    this.$toast.error(e.response ? e.response.data.message : __('Something went wrong'), { duration: null });
                })
        },

        createToken() {
            this.showToken = true;
        },

        closeToken() {
            this.showToken = false;
            this.loadTokens();
        },

        viewNewToken(token) {
            this.newToken = token;
            this.showToken = false;
            this.showNewToken = true;
            this.loadTokens();
        },

        closeNewToken() {
            this.showNewToken = false;
            this.newToken = null;
        },

    }

}
</script>