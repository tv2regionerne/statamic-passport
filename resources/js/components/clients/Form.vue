<template>
    
    <div>
        <modal name="passport-client-form">
            <header class="text-lg font-semibold px-5 py-3 bg-gray-200 rounded-t-lg flex items-center justify-between border-b">
                {{ values.id ? __('Edit Client') : __('Create Client') }}
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
                <div class="form-group w-full">
                    <label v-text="__('Redirect URL')" />
                    <div class="flex items-center">
                        <input
                            type="url"
                            v-model="values.redirect"
                            class="input-text" />
                    </div>
                    <small
                        class="help-block text-red-500 mt-2 mb-0"
                        v-if="errors.redirect"
                        v-text="errors.redirect[0]" />
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

    props: {
        initialValues: {
            type: Object,
            default: () => {
                return {
                    id: null,
                    name: '',
                    redirect: '',
                }
            }
        },
    },

    data() {
        return {
            values: this.initialValues,
            errors: {},
        }
    },

    methods: {

        save() {
            const method = this.values.id ? 'put' : 'post';
            const url = this.values.id ? `/passport/clients/${this.values.id}` : '/passport/clients';
            this.$axios[method](url, this.values)
                .then(response => {
                    this.$toast.success(this.values.id ?__('Client updated successfully') :  __('Client created successfully'));
                    this.$emit('saved');
                })
                .catch(e => {
                    this.$toast.error(e.response.data.message);
                    this.errors = e.response.data.errors;
                })
        },

    },

}
</script>