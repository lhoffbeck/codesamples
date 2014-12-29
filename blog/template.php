	
<h3 id="desc">this is a</h3><br/>
<h1 id="title">Blog</h1>
<nav class="main">
    <ul>
      <li><a id="homeLink" href="index.php">Home</a></li>
      <li><a id="progLink" href="index.php?page=prog">Programming</a></li>
      <li><a id="foodLink" href="index.php?page=food">Food</a></li>
      <li><a id="travLink" href="index.php?page=travel">Travel</a></li>
      <li><a id="randLink" href="index.php?page=other">Random</a></li>
      <li><a id="aboutLink" href="about.html">About</a></li>
    </ul>
  </nav>

    <div id="wrapper">
      <div id="content">
        {{#posts}}
          <article>
            <h2 class='postTitle'>{{title}}</h2>  
            {{& post_body}}
            <br/>
            <br/>
            <hr />
            <br/>
            <br/>
          </article>
        {{/posts}}
      </div>
    </div>
  <footer>
  	Lars and Libby made this for you.
  </footer>

  <!--<script type="text/javascript">
    switch(getUrlParameter("page")) {
      /*case "food":
          $("#foodLink").css({"border-top": 2px solid #000000;});
          break;
      case "travel":
          $("#travLink").css({"border-top": 2px solid #000000;});
          break;    
      case "other":
          $("#randLink").css({"border-top": 2px solid #000000;});
          break;*/
      default:
        //$('#homeLink').css({"border-top": "2px solid #000000"});
        $('#homeLink').css("background","black");
        //$("#homeLink").css({"border-top": "2px solid #000000"});
          break;
        }
  </script>-->