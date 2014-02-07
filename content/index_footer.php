<!-- End row
================================================== -->
</div>
<!-- End container
================================================== -->
</div>

  
<!-- End container_14
================================================== -->
</div>




    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/slider/js/bjqs-1.3.js"></script>
    <script src="assets/js/google-code-prettify/prettify.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <script src="assets/js/bootstrap-button.js"></script>
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="assets/js/bootstrap-affix.js"></script>
    <script src="assets/js/application.js"></script>
    
     <!--  Attach the plug-in to the slider parent element and adjust the settings as required -->
    <script>
      $(document).ready(function() {
        
        $('#banner').bjqs({
          'animation' : 'fade',
          'width' : 980,
          'height' : 250,
		  'useCaptions' : true,
          'keyboardNav' : true,
		  'nexttext' : '<img src="content/assets/slider/img/forward.png" width="61px" height="50px" /> ', // Text for 'next' button (can use HTML)
          'prevtext' : '<img src="content/assets/slider/img/back.png" width="61px" height="50px" />', // Text for 'previous' button (can use HTML)
        });
        
      });
    </script>
    
  <script>
     function show(ele) {
         var srcElement = document.getElementById(ele);
         if(srcElement != null) {
	   if(srcElement.style.display == "block") {
     		  srcElement.style.display= 'none';
   	    }
            else {
                   srcElement.style.display='block';
            }
            return false;
       }
  }
  </script>
  <script>
     function hide(ele) {
         var srcElement = document.getElementById(ele);
         if(srcElement != null) {
	   if(srcElement.style.display == "block") {
     		  srcElement.style.display= 'none';
			  clearTimeout(ele);
   	    }
            else {
                   srcElement.style.display='block';
            }
            return false;
       }
  }
  </script>  
  
  <script>
$('#clicknews').click(function() {
  $('#news').slideToggle('slow',function() {
    // Animation complete.
  });
});
</script>
<script>
$('#clicktravel').click(function() {
  $('#travel').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>

<script>
$('#clickcompetition').click(function() {
  $('#competition').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>
<script>
$('#clickwildside').click(function() {
  $('#wildside').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>

<script>
$('#clickall').click(function() {
  $('#all').slideToggle('slow', function() {
    // Animation complete.
  });
});
</script>
<script>
$('.dropdown-toggle').dropdown()
</script>


    <!-- Footer
    ================================================== -->
<?php include("http://www.wildsidesa.co.za/content/footer.php"); ?> 
</body>
</html>
