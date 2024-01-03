<template>
    
    <div>
        <modal name="passport-token-view">
            <header class="text-lg font-semibold px-5 py-3 bg-gray-200 rounded-t-lg flex items-center justify-between border-b">
                {{ __('Token Created') }}
            </header>
            <div class="p-4">
                <p class="text-sm">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit placeat perferendis debitis quaerat recusandae quisquam minus facilis est pariatur ullam. Cum debitis voluptates magnam, illum est illo repellendus asperiores veniam:</p>
                <div class="input-text h-auto text-sm font-mono break-all mt-4">
                    {{ token.accessToken }}
                </div>
            </div>
            <div class="px-5 py-3 bg-gray-200 rounded-b-lg border-t flex items-center justify-end text-sm">
                <button class="ml-4 btn-primary" @click="$emit('closed')">{{ __('OK') }}</button>
            </div>
        </modal>
    </div>

</template>

<script>
export default {

    props: {
        token: {
            type: Object,
            required: true,
        },
    },

}
</script>