// nano.config.js
// defines NANOCONFIG parameters, bitrate, url, etc.
// (c) 2016-2017 nanocosmos gmbh
// version 1.1

/*jslint nomen: true, maxerr:1000, white:true, vars:true, undef:true, sub:true*/
/*global console, confirm, unescape, Bintu*/

(function () {
    'use strict';

    var exports = this;

    function NANOCONFIG() {

        console.log("loading NANOCONFIG...");

        // HTTP Params / Query String
        var _HTTPParams;
        var _getHTTPParam = function (paramKey) {
            // if params dont exist, create/read them
            if (!_HTTPParams) {
                try {
                    var url = document.location.search;
                    url.replace(
                        new RegExp("([^?=&]+)(=([^&]*))?", "g"),
                        function ($0, $1, $2, $3) {
                            _HTTPParams = _HTTPParams || {};
                            _HTTPParams[unescape($1)] = unescape($3);
                        }
                    );
                } catch (e) {
                    console.log(e);
                }
            }
            // return requested param, if exists
            try {
                var p = _HTTPParams[paramKey];
                if (p) {
                    console.log("Param[" + paramKey + "]: " + p);
                }
                return p;
            } catch (e) {
                return undefined;
            }
        };

        // parse complete json string
        var _getJsonParam = function (p) {
            var r = {};
            try {
                var rr = _getHTTPParam(p);
                if (!rr) {
                    return undefined;
                }
                r = JSON.parse(rr);
            } catch (e) {
                return undefined;
            }
            return r;
        };

        // the config object
        var NANOCONFIG = {
            config: {}, // general config
            bintu: {},  // bintu api settings
            debug: {},  // debug mode
            media: {},  // media (input/output) settings
            stream: {}, // stream settings
            webrtc: {}  // webrtc specific settings
        };

        // general config
        NANOCONFIG.config = {
            // use geo location
            //useLocation: false 
            useLocation: true 
        };
        
        // bintu config
        NANOCONFIG.bintu = {
            apikey: "WwVdl8IdXb3dKpbSR9SmRBOKqVUurLiKGen7z9vTnXChTpYLBCDnWw8PQaSgtKjPQI9ABvwkc9aUW2ob", // bintu apikey
            apiurl: "https://bintu.nanocosmos.de", // bintu apiurl
            streamid: "", // bintu streamid
            tags: "yoohcan, dev" // bintu tags for the stream
        };

        // debug config
        NANOCONFIG.debug = NANOCONFIG.debug || _getHTTPParam('debug');

        // media (input settings)
        NANOCONFIG.media = {
            videosource: 0, // input videosource index (special for webrtc use 'screen' for 'nanoScreenCapture')
            width: 640, // input width
            height: 480, // input height
            colorspace: undefined, // input colorspace
            minframerate: 3,
            framerate: 30, // input framerate
            audiosource: 0, // input audiosource index
            samplerate: 44100 // input samplerate
        };

        // stream config (output settings)
        NANOCONFIG.stream = {
            url: "",    // stream url without streamname
            name: "",   // stream name
            id: "",     // complete stream url (optional to url/name)        
            auth: "",   // authentication
            width: null, // resize width
            height: null, // resize height
            videobitrate: 500000, // output videobitrate
            audiobitrate: 64000,  // input audiobitrate
            videocodec: "H264",
            videoprofile: "",     // default/baseline/main,
            keyframedistance: 50,     // TODO change to seconds
            bframes: 0,
            framerate: 30,
            audiocodec: "AAC",
            audioprofile: ""
        };

        // webrtc specific values
        NANOCONFIG.webrtc = {
            server: "https://rtc1.nanocosmos.de/p/1", // webrtc server
            serverusername: "", // webrtc server username credential
            serverpassword: "", // webrtc server password credential
            token: undefined, // webrtc security token
            role: "", // webrtc role
            username: "", // webrtc username
            room: "", // webrtc room
            iceservers: "", // webrtc iceserver config
            videocodec: "VP8", // webrtc videocodec
            videosendinitialbitrate: 0, // webrtc videosendinitialbitrate
            videosendbitrate: 0, // webrtc videosendbitrate
            audiosendinitialbitrate: 0, // webrtc audioinitialbitrate      
            audiosendbitrate: 0, // webrtc audiobitrate        
            streamlabel: "", // webrtc transcode streamlabel
            mirror: 0, // webrtc mirror mode for transcoder
            dropframes: 1, // webrtc dropframes mode
            icecastaudio: 0 // webrtc enable icecast audio
        };

        NANOCONFIG.experimental = {
            h264passthrough: 0
        };

        NANOCONFIG.h5live = {
            url: 'http://demo.nanocosmos.de/nanoplayer/release/nanoplayer.html'
        };

        // get url parameters
        // TEST:
        // chat.html?webrtc.room=nano1&webrtc.serverusername=nano&webrtc.serverpassword=nano&webrtc.username=ol&bintu={"apikey":"xyz","tags":"123,456"}&webrtc.iceservers={"url":"turn:turn1.nanocosmos.de:443%3Ftransport%3Dtcp","credential":"nano","username":"nano"}
        for (var key in NANOCONFIG) {
            try {
                // json strings?
                // e.g. http://url?bintu={"apikey":"xyz","tags":"tag1,tag2"}
                var obj = _getJsonParam(key);
                if (obj) {
                    NANOCONFIG[key] = obj;
                    console.log("NANOCONFIG[" + key + "]=" + JSON.stringify(obj));
                } else {
                    // key/value strings?
                    for (var k in NANOCONFIG[key]) {

                        // without prefix: e.g http://url?apikey=xyz
                        //var v = _getHTTPParam(k);

                        // with prefix: e.g http://url?bintu.apikey=xyz
                        var v = _getHTTPParam(key + "." + k);

                        if (v) {
                            NANOCONFIG[key][k] = v;
                            console.log("NANOCONFIG[" + key + "][" + k + "]=" + v);
                        }
                    }
                }
            } catch (e) {
                console.log(e);
            }
        }

        function isFloat(val) {
            var floatRegex = /^-?\d+(?:[.]\d*?)?$/;
            if (!floatRegex.test(val))
                return false;

            val = parseFloat(val);
            if (isNaN(val))
                return false;
            return true;
        }

        function isInt(val) {
            var intRegex = /^-?\d+$/;
            if (!intRegex.test(val))
                return false;

            var intVal = parseInt(val, 10);
            return parseFloat(val) == intVal && !isNaN(intVal);
        }

        function parseNumber(string) {
            var number;
            try {
                if (isFloat(string))
                    number = parseFloat(string);
                else if (isInt(string))
                    number = parseInt(string);
                else
                    number = string;
            } catch (e) {
                console.log(e);
                number = string;
            }
            return number;
        }

        for (var key in NANOCONFIG) {
            try {
                if ((typeof NANOCONFIG[key] === 'string' || NANOCONFIG[key] instanceof String)) {
                    if (!isNaN(NANOCONFIG[key]))
                        NANOCONFIG[key] = parseNumber(NANOCONFIG[key]);
                    if (NANOCONFIG[key] === 'true')
                        NANOCONFIG[key] = true;
                    if (NANOCONFIG[key] === 'false')
                        NANOCONFIG[key] = false;
                } else if (typeof NANOCONFIG[key] === 'object' || NANOCONFIG[key] instanceof Object) {
                    for (var k in NANOCONFIG[key]) {
                        if ((typeof NANOCONFIG[key][k] === 'string' || NANOCONFIG[key][k] instanceof String) && !isNaN(NANOCONFIG[key][k])) {
                            NANOCONFIG[key][k] = parseNumber(NANOCONFIG[key][k]);
                        }
                        if (NANOCONFIG[key][k] === 'true')
                            NANOCONFIG[key][k] = true;
                        if (NANOCONFIG[key][k] === 'false')
                            NANOCONFIG[key][k] = false;
                    }
                }
            } catch (e) {
                console.log(e);
            }
        }

        return NANOCONFIG;
    }

    exports.NANOCONFIG = new NANOCONFIG();

}).call(this);

