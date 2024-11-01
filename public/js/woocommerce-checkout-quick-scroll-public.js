jQuery(document).ready(function(){
  
  jQuery("a.go-pay").on('click', function(event) {

    
    if (this.hash !== "") {
      
      event.preventDefault();

     
      var hash = this.hash;

      
      jQuery('html, body').animate({
        scrollTop: jQuery(hash).offset().top
      }, 400, function(){
   
        
        window.location.hash = hash;
      });
    } 
  });
});