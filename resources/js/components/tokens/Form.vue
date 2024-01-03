<template>
    
    <div>
        <modal name="passport-token-form">
            <header class="text-lg font-semibold px-5 py-3 bg-gray-200 rounded-t-lg flex items-center justify-between border-b">
                {{ __('Create Token') }}
            </header>
            <div class="publish-fields p-2">
                <div class="form-group w-full">
                    <label v-text="__('Name')" />
                    <div class="flex items-center">
                        <input
                            type="text"
                            v-model="values.name"
                            class="input-text" />
                    </div>
                    <small
                        class="help-block text-red-500 mt-2 mb-0"
                        v-if="errors.name"
                        v-text="errors.name[0]" />
                </div>
            </div>
            <div class="px-5 py-3 bg-gray-200 rounded-b-lg border-t flex items-center justify-end text-sm">
                <button class="text-gray hover:text-gray-900" @click="$emit('closed')">{{ __('Cancel') }}</button>
                <button class="ml-4 btn-primary" @click="save">{{ __('Save') }}</button>
            </div>
        </modal>
    </div>

</template>

<script>
export default {

    data() {
        return {
            values: {
                id: null,
                name: '',
            },
            errors: {},
        }
    },

    methods: {

        save() {
            const method = 'post';
            const url = passport_url('personal-access-tokens');
            this.$axios[method](url, this.values)
                .then(response => {
                    this.$toast.success(__('Token created successfully'));
                    this.$emit('saved', response.data);
                })
                .catch(e => {
                    this.$toast.error(e.response.data.message);
                    this.errors = e.response.data.errors;
                })
        },

    },

}
</script>