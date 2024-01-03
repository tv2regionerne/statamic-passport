import ClientListing from './components/clients/Listing.vue';
import TokenListing from './components/tokens/Listing.vue';

Statamic.booting(() => {
    Statamic.component('passport-client-listing', ClientListing);
    Statamic.component('passport-token-listing', TokenListing);
})
