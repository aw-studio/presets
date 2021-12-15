const merge = require('lodash.merge');
const tailwindConfig = require('@macramejs/admin-config');

module.exports = merge(tailwindConfig, {
    // purge: [
    //     './resources/admin/js/**/*.vue',
    //     './packages/admin/packages/admin-react/src/**/*.vue',
    //     './packages/admin/packages/admin-vue3/src/**/*.vue',
    // ],
});
