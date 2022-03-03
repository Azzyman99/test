<html>
<head>
<title>NBA Teams Web Service Demo</title>
<style>
  body {font-family:georgia;}
  .team{
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

  .pic img{
    max-width:70px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js" type="text/javascript"></script>

<script type="text/javascript">

function nbaTemplate(team){
  return `<div class="team">
      <b>Title: <b> ${team.Name}<br />
      <b>Location: <b> ${team.Location}<br />
      <b>Division: <b> ${team.Division}<br />
      <b>Championships: <b> ${team.Championships}<br />
      <b>Last Championship: <b> ${team.LastChip}<br />

      <div class="pic"><img src="thumbnails/${team.Image}"/></div>
    </div>`;
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
        $("#nbatitle").html(data.title);

        // clears the previous films
        $("#nbateams").html("");
        
        // loops through films and adds to page
        $.each(data.teams, function(key,value){

          let str = nbaTemplate(value); // is the array

          $("<div></div>").html(str).appendTo("#nbateams");
          
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
	<h1>NBA Teams Web Service</h1>
		<a href="year" class="category">NBA Teams</a><br />
		<a href="box" class="category">NBA Teams By Championships</a>
		<h3 id="nbatitle">Title Will Go Here</h3>
		<div id="nbateams">
			<p>NBA Teams will go here</p>
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