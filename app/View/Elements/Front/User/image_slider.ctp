<style>
.new_model {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content_new {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}
.mySlides_new {
  display: none;
}

/* Next & previous buttons */
.prev_new,
.next_new {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: black;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next_new button" to the right */
.next_new {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev_new:hover,
.next_new:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

#myModal_new{

z-index: 30;
}
</style>

<div id="myModal_new" class="modal new_model">
  <div class="modal-content_new">
 <div class="delete_btn">
 <button type="button" class="close" onclick="closeModal()" style="right:1px" data-dismiss="modal">×</button></div>

    <div class="mySlides_new">     
        <img src="<?php echo SITE_URL.'/uploads/static/st1.jpg' ?>" style="width:100%">
    </div>

    <div class="mySlides_new">     
       <img src="<?php echo SITE_URL.'/uploads/static/st2.jpg' ?>" style="width:100%">
    </div>

    <div class="mySlides_new">     
        <img src="<?php echo SITE_URL.'/uploads/static/st3.jpg' ?>" style="width:100%">
    </div>

    <div class="mySlides_new">    
        <img src="<?php echo SITE_URL.'/uploads/static/st4.jpg' ?>" style="width:100%">
    </div>  
	
	<div class="mySlides_new">		
        <img src="<?php echo SITE_URL.'/uploads/static/st5.jpg' ?>" style="width:100%">
    </div>

    <a class="prev_new" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next_new" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container_new">
      <p id="caption"></p>
    </div>

    
  </div>
</div>


<script>
function openModal() {
  document.getElementById('myModal_new').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal_new').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides_new");
  var dots = document.getElementsByClassName("mySlides_new");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
