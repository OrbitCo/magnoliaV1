
function GoogleMapsv3_Geocoder(defOptions)
{
    this.properties = {
        site_url: '',
    }

    var _self = this;

    this.init = function (options) {
        _self.properties = $.extend(_self.properties, options);
    }

    this.geocodeLocation = function (location, callback) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({address: location}, function (result, status) {
            _self.wait_requests--;
            if (status == google.maps.GeocoderStatus.OK) {
                var lat = result[0].geometry.location.lat();
                var lon = result[0].geometry.location.lng();
                if (callback) {
                    callback(lat, lon);
                }
            }
        });
    }

    this.geocodeCoordinates = function (latitude, longitude, callback) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({location: new google.maps.LatLng(latitude, longitude)}, function (result, status) {
            _self.wait_requests--;
            if (status == google.maps.GeocoderStatus.OK) {
                if (callback) {
                    callback(result[0].address_components.long_name);
                }
            }
        });
    }

    this.getLocationFromAddress = function (country, region, city, address, zip) {
        var location = [];
        //if(zip) location.push(zip);
        if (country) {
            location.push(country);
        }
        if (region) {
            location.push(region);
        }
        if (city) {
            location.push(city);
        }
        if (address) {
            location.push(address);
        }
        return location.join(', ');
    }

    _self.init(defOptions);

    return _self;
}


if (typeof exports === 'object') {
    exports.__esModule = true;
    exports.GoogleMapsv3_Geocoder = GoogleMapsv3_Geocoder;
}
