<template>
    <default-field :field="field">
        <template slot="field">
            <div class="google-map" :id="mapName"></div><br>
            <input :id="field.name" type="text"
                   class="w-full form-control form-input form-input-bordered"
                   :class="errorClasses"
                   :placeholder="field.name"
                   v-model="value"
            />
            <p v-if="hasError" class="my-2 text-danger">
                {{ firstError }}
            </p>

        </template>
    </default-field>
</template>
<style scoped>
    .google-map {
        width: 720px;
        height: 300px;
        margin: 0 auto;
        background: gray;
        border:solid 1px #ccc;
    }
</style>
<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova'

    export default {
        name: 'google-map',
        mixins: [FormField, HandlesValidationErrors],
        props: ['resourceName', 'resourceId', 'field'],
        data: function () {
            return {
                mapName: this.name + "-map",
            }
        },
        mounted: function () {

            const element = document.getElementById(this.mapName);
            const options = {
                zoom: this.field.zoom || 4,
                center: new google.maps.LatLng(this.field.lat || 40.730610 , this.field.lng || -98.935242)
            }
            const map = new google.maps.Map(element, options);
            var previousMarker;
            var address = this;

            google.maps.event.addListener(map, 'click', function(event) {
                if (previousMarker) {
                    previousMarker.setMap(null);
                }
                previousMarker = new google.maps.Marker({
                    position: event.latLng,
                    map: map
                });
                var geocoder = new google.maps.Geocoder;
                geocoder.geocode({'location': event.latLng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            address.value = results[0].formatted_address;
                        } else {
                            window.alert('No results found');
                        }
                    } else {
                        window.alert('Geocoder failed due to: ' + status);
                        error = false;

                    }
                });
            });
        },
        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || ''
            },
            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                formData.append(this.field.attribute, this.value || '')
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            }
        },
    }
</script>