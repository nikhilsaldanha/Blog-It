<html>
  <head>
    <base href="/Blog-It/" />
    <meta charset="utf-8">
    <title>
      <?php
        echo $post['title'];
      ?>
    </title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
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
            $__id=$post['id'];
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

    <div class="post container">
      <h1 class="post-title"><?php echo $post['title']; ?></h1>
      <small class="author-name post-date">
        by <a href="author/<?php echo $post['author_id'];?>"><?php echo $name; ?></a>.
        Posted at <?php echo $post['date'];?>
      </small>
      <hr>
      <div class="post-body">
        <h5>
          <?php echo $post['body']?>
        </h5>
      </div>
      <br>
      <div class="comment-count container col-md-2">
        Comments :<?php echo $comment->num_rows; ?>
      </div>

      <div class = "upvotes container col-md-2">
        <?php
          $upvote = $post['upvote'];
          if($loggedIn){
        ?>
            <form action="post/<?php echo $post['id'] ?>#up" method="POST">
                <button type="submit" class="btn btn-default" name="upvote" value="1">
                  <?php echo $upvote; ?>
                  <span id="up" class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                </button>
            </form>
        <?php
          }
          else {
            echo $upvote;
        ?>
            <span id="up" class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
        <?php
          }
        ?>
      </div>

      <div class = "downvotes container col-md-2">
        <?php
          $downvote = $post['downvote'];
          if($loggedIn){
        ?>
            <form action="post/<?php echo $post['id'] ?>#down" method="POST">
              <button type="submit" class="btn btn-default" name="downvote" value="1">
                <?php echo $downvote; ?>
                <span id="down" class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
              </button>
            </form>
        <?php
          }
          else {
            echo $downvote;
        ?>
            <span id="down" class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
        <?php
          }
        ?>
      </div>
      <br><br><hr>
      <table class="comments table table-striped">
        <tbody>
          <?php
            #User comment on the post
            #if comment exist
            if($comment->num_rows != 0) {
              while ($c=$comment->fetch_assoc()) {
                $body=$c['comment_body'];
                $author = $c['author_id'];
                $name=$user->getName($author)->fetch_array()[0];
                $cid = $c['id'];
          ?>
                <tr class="warning">
                  <td>
                    <div class="comment-author container col-md-8">
                      <a href="author/<?php echo $author ?>"> <?php echo $name; ?> </a>says :
                      <?php
                        echo $body;
                      ?>
                    </div>
                    <?php
                      ##upvote and downvote
                      $upvote=$c['upvote'];
                      $downvote=$c['downvote'];
                    ?>
                    <div class="comment-votes container">

                      <div class = "comment-upvote container col-md-1">
                        <?php
                          if($loggedIn) {
                        ?>
                            <form action="post/<?php echo $post['id'] ?>#up-<?php echo $cid; ?>" method="POST">
                              <button type="submit" class="btn btn-default" name="upvote-comment-<?php echo $cid; ?>" value="1">
                                <?php echo $upvote; ?>
                                <span id="up-<?php echo $cid; ?>" class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                              </button>
                            </form>
                        <?php
                          }
                          else {
                        ?>
                            <?php echo $upvote; ?>
                            <span id="up-<?php echo $cid; ?>" class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
                        <?php
                          }
                        ?>
                      </div>

                      <div class = "comment-downvote container col-md-1">
                        <?php
                          if($loggedIn) {
                        ?>
                            <form action="post/<?php echo $post['id'] ?>#down-<?php echo $cid ?>" method="POST">
                              <button type="submit" class="btn btn-default" name="downvote-comment-<?php echo $cid; ?>" value="1">
                                <?php echo $downvote; ?>
                                <span id="down-<?php echo $cid ?>" class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                              </button>
                            </form>
                        <?php
                          }
                          else {
                        ?>
                            <?php echo $downvote; ?>
                            <span id="down-<?php echo $cid ?>" class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
                        <?php
                          }
                        ?>
                      </div>
                      <?php
                        if($loggedIn) {
                      ?>
                          <div class="delete-comment col-md-1">
                            <form action="delete-comment/<?php echo $cid ?>" method="POST">
                              <button type="submit" class="btn btn-default" name="delete-comment" value="<?php echo $__id ?>">
                                <span id="down" class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                              </button>
                            </form>
                          </div>
                      <?php
                        }
                       ?>
                    </div>
                  </td>
                </tr>
          <?php
              }//while
            }//if
          ?>
        </tbody>
      </table>

      <!-- #Add new comment here -->
        <?php
          if($loggedIn) {
        ?>
            <div class="new-comment container col-md-12">
              <br>
              <form class="form-horizontal" action="post/<?php echo $__id ?>" method="POST">
                <div class="form-group">
                  <div class="col-md-6">
                    <textarea class="form-control" name="body" rows="5" placeholder="What do you feel about this post..." required></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-10">
                    <input type="submit" name="new-comment" class="btn btn-primary" value="Comment">
                  </div>
                </div>
              </form>
            </div>
        <?php
          }
          else {
        ?>
            <div class="container">
              You must be logged in to leave a comment
            </div>
        <?php
          }
        if(isset($err) && $err==1) {
          echo "Error adding your comment ... Please try again later";
        }
        ?>
      </div>
  </body>
</html>
