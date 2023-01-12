<html>
    <head>
        <style>
            .mySlides {display:none;}
        </style>
    </head>
    
    <body>
    
        <div class="w3-content w3-section" style="width:100%">
        <img class="mySlides" src="{% static 'home/assets/img/COOP1.png' %}" style="width:100%">
        <img class="mySlides" src="{% static 'home/assets/img/COOP2.png' %}" style="width:100%">
        <img class="mySlides" src="{% static 'home/assets/img/COOP3.png' %}" style="width:100%">
        </div>
    
        <script>
            var myIndex = 0;
            carousel();
            
            function carousel() {
            var i;
            var x = document.getElementsByClassName("mySlides");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
            }
            myIndex++;
            if (myIndex > x.length) {myIndex = 1}    
            x[myIndex-1].style.display = "block";  
            setTimeout(carousel, 5000); // Cambia cada 5 segundos
            }
        </script>
    
    </body>
</html>