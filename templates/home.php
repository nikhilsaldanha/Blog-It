<html>
	<head>
		<meta charset="utf-8">
		<title>Home</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
    <?php
			if($loggedIn) {
						$uid = $_SESSION['user_id'];
		        echo "<nav class=\"navbar navbar-default\">
		          <div class=\"container-fluid\">
		            <a href=\"index.php\" class=\"navbar-brand\">Blog It!</a>
								<ul class=\"nav navbar-nav navbar-left\">
									<li>
										<a href=\"author/$uid\">My Posts</a>
									</li>
								</ul>
		            <ul class=\"nav navbar-nav navbar-right\">
									<li>
										<form class=\"navbar-form\" role=\"search\" action=\"/\" method=\"POST\">
											<div class=\"form-group\">
												<input type=\"text\" name=\"tag-search\" class=\"form-control\" placeholder=\"Search Posts By Tag\">
											</div>
											<button type=\"submit\" class=\"btn btn-default\">
												<span class=\"glyphicon glyphicon-search\"></span>
											</button>
										</form>
									</li>
		              <li><a href=\"new-post\">Add a new Post</a></li>
		              <li><a href=\"logout\">Logout</a></li>
		            </ul>
		          </div>
		        </nav>";
			}
			else {
				echo "<nav class=\"navbar navbar-default\">
					<div class=\"container-fluid\">
						<a href=\"index.php\" class=\"navbar-brand\">Blog It!</a>
						<ul class=\"nav navbar-nav navbar-right\">
							<li>
								<form class=\"navbar-form\" role=\"search\" action=\"/\" method=\"POST\">
									<div class=\"form-group\">
										<input type=\"text\" name=\"tag-search\" class=\"form-control\" placeholder=\"Search Posts By Tag\">
									</div>
									<button type=\"submit\" class=\"btn btn-default\">
										<span class=\"glyphicon glyphicon-search\"></span>
									</button>
								</form>
							</li>
							<li><a href=\"new-post\">Add a new Post</a></li>
							<li><a href=\"login\">Login</a></li>
							<li><a href=\"signup\">Signup</a></li>
						</ul>
					</div>
				</nav>";
			}
			echo "<div class=\"container\">";
			// echo "<h1> Blog it </h1>";
			if(isset($result)) {
				while($result_set=$result->fetch_assoc()) {
	        $title = $result_set['title'];
	        $body = substr($result_set['body'], 0, 200);
	        $author_id = $result_set['author_id'];
	        $date = $result_set['date'];
					$id = $result_set['id'];
					$name = $user->getName($author_id)->fetch_array()[0];
				$upvote=$result_set['upvote'];
				$downvote=$result_set['downvote'];
				$c_count=$comment->getCommentCount($id)->fetch_array()[0];

        echo "
        <div id=\"post\">
          <div id=\"post-head\">
            <h3 id=\"post-title\">$title</h3>
						<small>
			        by <a href=\"author/$author_id\">$name</a>.
			        Posted at $date
			      </small>
						<br>
          </div>

					<div class=\"container\" id=\"post-body\">
						<h5>
							$body...<a href=\"post/$id\">Read more</a>
						</h5>
					</div>
        </div><br>
        <div class=\"container col-md-2\">
        <small> <a href=\"post/$id\">Comments : </a>  $c_count </small></div>";
        if($loggedIn){
			echo "
  			<div class = \"container col-md-2\">
  			$upvote
  			<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span>
  			</div>
  			<div class=\"container col-md-2\">
  			$downvote
  			<span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span>
  			</div>
        <hr>";

      }
  }
			echo "</div>";

	  		}


			if(isset($tag_search_result)) {
				foreach ($tag_search_result as $index => $post) {
					$post = $post->fetch_assoc();
					$title = $post['title'];
	        $body = substr($post['body'], 0, 200);
	        $author_id = $post['author_id'];
	        $date = $post['date'];
					$id = $post['id'];

				$upvote=$post['upvote'];
				$downvote=$post['downvote'];
				$c_count=$comment->getCommentCount($id)->fetch_array()[0];

        echo "
        <div id=\"post\">
          <div id=\"post-head\">
            <h3 id=\"post-title\">$title</h3>
            <small id=\"post-date\">$date</small>
          </div>
					<div id=\"post-body\">$body...</div>
					<a href=\"post/$id\">Read more</a>
        </div><br>
        <div class=\"container col-md-2\">
        <small> <a href=\"post/$id\">Comments : </a>  $c_count </small> ";
        if($loggedIn){
        	echo "
  			</div>
  			<div class = \"container col-md-2\">
  			$upvote
  			<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span>
  			</div>
  			<div class=\"container col-md-2\">
  			$downvote
  			<span class=\"glyphicon glyphicon-thumbs-down\" aria-hidden=\"true\"></span>

  			</div>
        ";
      	}
				echo "<hr>";
  }
			echo "</div>";

			}
    ?>
	</body>
</html>
