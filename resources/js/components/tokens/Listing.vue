<template>
    
    <div>
        <div class="flex items-end justify-between mb-4">
            <h2>Tokens</h2>
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
                        <th>ID</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="token in tokens" :key="token.id">
                        <td>
                            {{ token.name }}
                        </td>
                        <td>
                            {{ token.id }}
                        </td>
                        <td>
                            <dropdown-list>
                                <dropdown-item :text="__('Delete')" class="warning" @click="deleteToken(token)" />
                            </dropdown-list>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>

export default {

    data() {
        return {
            initializing: true,
            loading: true,
            tokens: [],
        }
    },
    
    mounted() {
        this.loadTokens();
    },

    methods: {

        loadTokens() {
            this.loading = true;
            this.$axios.get('/passport/tokens')
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
            this.$axios.delete(`/passport/tokens/${token.id}`)
                .then(response => {
                    this.loadTokens();
                })
                .catch(e => {
                    this.$toast.error(e.response ? e.response.data.message : __('Something went wrong'), { duration: null });
                })
        },

    }

}
</script>