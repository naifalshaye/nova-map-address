Nova.booting((Vue, router) => {
    Vue.component('index-map_address', require('./components/IndexField'));
    Vue.component('detail-map_address', require('./components/DetailField'));
    Vue.component('form-map_address', require('./components/FormField'));
})
