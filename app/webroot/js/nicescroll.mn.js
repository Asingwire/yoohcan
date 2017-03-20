 var response;
 var ingest;
 var rtmp;
 var url;
 var streamname;
 var injestUrl;
 var user;
 var currentVideoDeviceConfig;
 var currentAudioDeviceConfig;
 var hls_live_url;
 var rtmp_live_url;
 var streamname;

 
 
  // entry point
  require(['nano.webrtc.require'], function() {
 
	// create user object
    user = new window.nanowebrtc.user();
    
 
    // configure server settings
    user.setConfig(
      "https://rtc1.nanocosmos.de/p/prod",
      "myName", // choose any
      "myRoom", // choose any
      // 3 possible ways to authenticate with the server:
      "",      // auth method 1
      "",   // auth method 2
      "",   // auth method 2
      "WwVdl8IdXb3dKpbSR9SmRBOKqVUurLiKGen7z9vTnXChTpYLBCDnWw8PQaSgtKjPQI9ABvwkc9aUW2ob" // auth method 3
    );
 
    // get devices
    user.addLocalMedia("local", 0, true, false);
    user.getDevices("local");
 
    // devices have been gathered
    user.on("ReceivedDeviceList", function(event){
 
      // available devices will be listed in "event.data":
      var audioDevices = event.data.devices.audiodevices;
      var videoDevices = event.data.devices.videodevices;
	  
	  //console.dir(videoDevices);
	 
	  
	  
	  if(videoDevices.length > 0){
	  
	      
		  for (i = 0; i < videoDevices.length; i++){ 
				if(i == 0){
				$('#video_sources_f').append( '<option value="'+i+'" selected>'+videoDevices[i].id+'</option>' );
				}else{
				$('#video_sources_f').append( '<option value="'+i+'">'+videoDevices[i].id+'</option>' );
				}
		  }
		  
		  for (k = 0; k < videoDevices.length; k++){ 
			
			var config = {
			device: k,
			width: 640,
			height: 480,
			framerate: 30
			};
			
			user.setVideoDevice('local', config);
			
		  }
		  
		  
	 }
	 
	 
	
	
		
      // we choose the first video device:
      var videoDeviceConfig = {device: 0};
	  currentVideoDeviceConfig = videoDeviceConfig;
 
      // we choose the first audio device:
      var audioDeviceConfig = {device: 0};
	  currentAudioDeviceConfig = audioDeviceConfig;
 
      // we start the preview in a video element:
 
      var videoElement = "video-local"; // id of <video> tag for preview
 
      user.startPreview("local", 
        videoDeviceConfig,
        audioDeviceConfig,
        videoElement
      );
 
    });
 
    user.on("StartPreviewSuccess", function(event) {  
      // preview succeeded
    });
 
    user.on("StartPreviewError", function(evt) {
      // handle error
    });
	
	$('#video_sources_f').on('change', function(){
		
		
		
	  if(!isNaN(this.value)){
			
		  var videoDeviceConfig = {device: this.value};
	 
		  // we choose the current audio device: currentAudioDeviceConfig
	 
		  // we start the preview in a video element:
	 
		  var videoElement = "video-local"; // id of <video> tag for preview
	 
		  user.startPreview("local", 
			videoDeviceConfig,
			currentAudioDeviceConfig,
			videoElement
		  );
	  
	  }
	  
	  
	  
	});
 
    document.getElementById("btn-startbroadcast").addEventListener("click", function(){
	
		var bintu = new Bintu("WwVdl8IdXb3dKpbSR9SmRBOKqVUurLiKGen7z9vTnXChTpYLBCDnWw8PQaSgtKjPQI9ABvwkc9aUW2ob", "https://bintu.nanocosmos.de", true, true);
 
        var bintuTags = ['yoohcan-dev, test3, webrtc']; // optionally add tags to the stream
		
		
		
        bintu.createStream(bintuTags, function success(request) {
            response = JSON.parse(request.responseText);
            ingest = response.ingest;
            rtmp = ingest.rtmp;
            url = rtmp.url;
            streamname = rtmp.streamname;
            injestUrl = url + '/' +streamname;
			console.log("stream created");
			console.dir(response);
			hls_live_url = response.playout.hls[0].url;
			streamname = response.playout.hls[0].streamname;
			rtmp_live_url = response.playout.hls[0].url;

			$('#stream_info').html("<h2>HLS LIVE URL</h2><div>"+hls_live_url+"/"+streamname+"</div><h2>RTMP LIVE URL</h2><div>"+rtmp_live_url+"</div>");
			
			var broadcastConfig = {
				transcodingTargets: {
					output: injestUrl // example bintu rtmp url
				}
			};
			
			console.log(injestUrl);
			console.log("broadcast is starting...");
			// start the broadcast
			user.startBroadcast(broadcastConfig);
			
        }, function onerror(error) {
            console.log(error);
        });
		
		
		
		
 
      
 
    });
 
    document.getElementById("btn-stopbroadcast").addEventListener("click", function(){
 
      // stop the broadcast
      user.stopBroadcast();
 
    });
 
    user.on("StartBroadcastSuccess", function(evt){
      // broadcast has started
		  console.log('broadcast successful');
		  console.dir(evt);

		  $('#btn-startbroadcast').hide();
	      $('#record_off_f').hide();
	      $('#btn-stopbroadcast').show();
	      $('#record_on_f').show();
		  
	  
    });
 
    user.on("StartBroadcastError", function(evt){
      // handle error
	  console.log("broadcast failure "+evt);
    });
	
	user.on("StopBroadcastSuccess", function(evt){
      // broadcast has stopped
	  user.stopPreview("local");
	  console.log("broadcast stopped successfully");
	  console.dir(evt);

		$('#btn-stopbroadcast').hide();
	    $('#record_on_f').hide();
	    $('#btn-startbroadcast').show();
	    $('#record_off_f').show();
    });
 
});
