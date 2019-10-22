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
        mixins: [FormField, HandlesValidationErrors],
        props: ['resourceName', 'resourceId', 'field'],
        data: function () {
            return {
                mapName: "google-map-" + new Date().getTime(),
            }
        },
        mounted: function () {
            var map;
            const element = document.getElementById(this.mapName);
            var lat = 40.730610;
            var lng = -98.935242;

            if (this.field.lat && this.field.lng){
                lat = this.field.lat;
                lng = this.field.lng;
            }
            if (this.value){
               var latlng =  this.value.split("|");
               latlng = latlng[1].split(",");
                lat = latlng[0];
                lng = latlng[1];
                if (previousMarker) {
                    previousMarker.setMap(null);
                }
            }
            const options = {
                zoom: this.field.zoom || 4,
                center: new google.maps.LatLng(lat, lng)
            };
            map = new google.maps.Map(element, options);
            var previousMarker;
            var address = this;
            previousMarker = new google.maps.Marker({
                position: new google.maps.LatLng(lat, lng),
                map: map
            });
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
                            address.value = results[0].formatted_address+'|'+event.latLng.lat().toFixed(6)+','+event.latLng.lng().toFixed(6);
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
