
function YandexMapsv2_Geocoder(defOptions)
{
    this.properties = {
        site_url: '',
    }

    var _self = this;

    this.init = function (options) {
        _self.properties = $.extend(_self.properties, options);
    }

    this.geocodeLocation = function (location, callback) {
        var geocoder = ymaps.geocode(location, {results:1});
        geocoder.then(function (result) {
            _self.wait_requests--;
            if (result.geoObjects.getLength()) {
                var location = result.geoObjects.get(0).geometry.getCoordinates();
                if (callback) {
                    callback(location[0], location[1]);
                }
            }
        }, function (e) {
            alert('error');
            _self.wait_requests--;
        });
    }

    this.geocodeCoordinates = function (latitude, longitude, callback) {
        var geocoder = ymaps.geocode([latitude, longitude], {results: 1});
        geocoder.then(function (result) {
            _self.wait_requests--;
            result.geoObjects.get(0).properties.get('name');
            if (callback) {
                callback(name);
            }
        }, function (e) {
            _self.wait_requests--;});
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
    exports.YandexMapsv2_Geocoder = YandexMapsv2_Geocoder;
}
