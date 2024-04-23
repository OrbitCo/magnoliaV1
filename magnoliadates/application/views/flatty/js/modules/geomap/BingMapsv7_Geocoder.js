function BingMapsv7_Geocoder(defOptions)
{
    this.properties = {
        site_url: '',
    }

    var _self = this;

    this.init = function (options) {
        _self.properties = $.extend(_self.properties, options);
    }

    this.geocodeLocation = function (location, callback) {
        var geocodeRequest = 'http://dev.virtualearth.net/REST/v1/Locations?query=' + location + '&maxResults=1&output=json&jsonp=?&key=' + _self.prop.map_key;
        $.getJSON(geocodeRequest,  function (result) {
            _self.wait_requests--;
            if (result && result.resourceSets && result.resourceSets.length > 0 &&
                result.resourceSets[0].resources && result.resourceSets[0].resources.length > 0) {
                var loc = result.resourceSets[0].resources[0].point.coordinates;
                if (callback) {
                    callback(loc[0], loc[1]);
                }
            }
        });
    }

    this.geocodeCoordinates = function (latitude, longitude, callback) {
        var geocodeRequest = 'http://dev.virtualearth.net/REST/v1/Locations/' + latitude + ',' + longitude + '?maxResults=1&output=json&jsonp=?&key=' + _self.prop.map_key;
        $.getJSON(geocodeRequest,  function (result) {
            _self.wait_requests--;
            if (result && result.resourceSets && result.resourceSets.length > 0 &&
                result.resourceSets[0].resources && result.resourceSets[0].resources.length > 0) {
                if (callback) {
                    callback(result.resourceSets[0].resources[0].name);
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
    exports.BingMapsv7_Geocoder = BingMapsv7_Geocoder;
}
