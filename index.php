<html>
<head>
<title>Travis Scott Web Service Demo</title>
<style>
  body {font-family:georgia;}
  .album{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

function travisTemplate(album){
  return `<div class="album">
      <b>Title: <b> ${album.Title}<br />
      <b>Year: <b> ${album.Year}<br />
      <b>Label: <b> ${album.Label}<br />
      <b>Sales: <b> ${album.Sales}<br />

      <div class="pic"><img src="thumbnails/${album.Image}"/></div>
    </div>`
}
  
$(document).ready(function() {  

	$('.category').click(function(e){
        e.preventDefault(); //stop default action of the link
		cat = $(this).attr("href");  //get category from URL
  	var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
      });
      request.done(function( data ) {
       console.log(data);
        // place the title on the page
        $("#albumtitle").html(data.title);

        // clears the previous films
        $("#albums").html("");
        
        // loops through films and adds to page
        $.each(data.albums, function(key,value){

          let str = travisTemplate(value); // is the array

          $("<div></div>").html(str).appendTo("#albums");
          
        });

        //view JSON as a string
        /*
        let myData = JSON.stringify(data, null, 4);
        myData = "<pre>" + myData + "</pre>";
        $("#output").html(myData);
        */
      });
      request.fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage);
           }
    );
	});
});	

</script>
</head>
	<body>
	<h1>Travis Scott Web Service</h1>
		<a href="year" class="category">Travis Scott Albums By Year</a><br />
		<a href="box" class="category">Travis Scott Albums By Sales</a>
		<h3 id="albumtitle">Title Will Go Here</h3>
		<div id="albums">
			<p>Albums will go here</p>
		</div>
    <!-- <div class="film">
      <b>Film: <b> 1<br />
      <b>Title: <b> Dr. No<br />
      <b>Year: <b> 1962<br />
      <b>Director: <b> Terence Young<br />
      <b>Producers: <b> Harry Saltzman and Albert R. Broccoli<br />
      <b>Writers: <b> Richard Maibaum, Johanna Harwood and Berkely Mather<br />
      <b>Composer: <b> Monty Norman<br />
      <b>Bond: <b> Sean Connery<br />
      <b>Budget: <b> $1,000,000.00<br />
      <b>BoxOffice: <b> $59,567,035.00<br />

      <div class="pic"><img src="thumbnails/dr-no.jpg"/></div>
    </div> -->
		<div id="output">Results go here</div>
	</body>
</html>