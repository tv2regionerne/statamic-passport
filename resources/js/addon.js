import ClientListing from './components/clients/Listing.vue';
import TokenListing from './components/tokens/Listing.vue';

Statamic.booting(() => {
    Statamic.component('passport-client-listing', ClientListing);
    Statamic.component('passport-token-listing', TokenListing);
});

window.passport_url = function(url) {
    url = Statamic.$config.get('passport.url') + '/' + url;
    return tidy_url(url);
};