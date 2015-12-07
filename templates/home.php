<html>
	<head>
		<base href="/Blog-It/" />
		<meta charset="utf-8">
		<title>Home</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<a href="index.php" class="navbar-brand">Blog It!</a>
				<ul class="nav navbar-nav navbar-left">
					<?php
            if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
              $uid = $_SESSION['user_id'];
          ?>
              <li>
                <a href="author/<?php echo $uid; ?>">My Posts</a>
              </li>
          <?php
            }
          ?>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<form class="navbar-form" role="search" action="index.php" method="POST">
							<div class="form-group">
								<input type="text" name="tag-search" class="form-control" placeholder="Search Posts By Tag">
							</div>
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-search"></span>
							</button>
						</form>
			    </li>
	        <li>
	          <a href="new-post">Add a new Post</a>
	        </li>
	        <?php
	          if($loggedIn) {
	            $uid = $_SESSION['user_id'];
	        ?>
	            <li><a href="logout">Logout</a></li>
	        <?php
	          }
	          else {
	        ?>
	            <li><a href="login">Login</a></li>
	            <li><a href="signup">Signup</a></li>
	        <?php
	          }
	        ?>
	      </ul>
	    </div>
	  </nav>

			<div class="container">
			<?php
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
						
			?>
		        <div id="post">
		          <div id="post-head">
		            <h3 id="post-title"><?php echo $title ?></h3>
								<small>
					        by <a href="author/<?php echo $author_id ?>"><?php echo $name ?></a>.
					        Posted at <?php echo $date ?>
					      </small>

									
								<br>
		          </div>

							<div class="container" id="post-body">
								<h5>
									<?php echo $body ?>...<a href="post/<?php echo $id ?>">Read more</a>
								</h5>
							</div>
		        </div><br>
		        <div class="container col-md-2">
		        <small> <a href="post/<?php echo $id ?>">Comments : </a><?php echo $c_count ?></small></div>
  					<div class = "container col-md-2">
  						<?php echo $upvote ?>
  						<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
  					</div>
  					<div class="container col-md-2">
  						<?php echo $downvote ?>
  						<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
  					</div><hr>
					<?php
						}
					?>
				</div>;
			<?php
				}
			?>
			<?php
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
						$tag_result=$tag->getTagsByPostId($id);
			?>
        		<div id="post">
          		<div id="post-head">
            		<h3 id="post-title"><?php echo $title ?></h3>
            		<small id="post-date"><?php echo $date ?></small>
								
          		</div>
							<div id="post-body"><?php echo $body?>...
								<a href="post/<?php echo $id ?>">Read more</a>
        			</div><br>
        		<div class="container col-md-2">
        			<small> <a href="post/<?php echo $id ?>">Comments : </a>  <?php echo $c_count ?> </small>
  					</div>
  					<div class = "container col-md-2">
  						<?php echo $upvote ?>
  						<span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
  					</div>
  					<div class="container col-md-2">
  						<?php echo $downvote ?>
  						<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
						</div>
						<hr>
				</div>
		<?php
				}
			}
    ?>
	</body>
</html>
