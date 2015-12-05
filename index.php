<?php
$_ENV['SLIM_MODE'] = 'development';
require 'vendor/autoload.php';

$app = new \Slim\Slim(array(
	'debug'=>true,
	'templates.path'=>'templates/'
));

// currying. Inject $app variable into the callback using 'use'
// alternatively, I could have used the Slim::getInstance() static method
$app->get('/(index)?', function() use($app) {
  require_once 'core/user.inc.php';
  require_once 'core/post.inc.php';
  require_once 'core/comment.inc.php';
  // $db = Db::getInstance();
  $user = new User;
  $post = new Post;
  $comment = new Comment;
	$loggedIn = 0;

	session_start();
	if($user->isLoggedIn()) {
		$loggedIn = 1;
	}
	$result = $post->getTopPosts();
	$app->render('home.php', array('user'=>$user, 'loggedIn' => $loggedIn, 'result' => $result,'comment'=>$comment));
});

$app->post('/(index)?', function() use($app) {
	require_once 'core/tag.inc.php';
	require_once 'core/user.inc.php';
	require_once 'core/post.inc.php';
	require_once 'core/comment.inc.php';

	$tag = new Tag;
	$user = new User;
	$post = new Post;
	$comment = new Comment;

	$loggedIn = 0;
	$req = $app->request();
	$search_tag = $req->post('tag-search');
	$posts = array();

	session_start();
	if($user->isLoggedIn()) {
		$loggedIn = 1;
	}

	$result = $tag->getPostIdByTag($search_tag);
	while($pid = $result->fetch_array()[0]) {
		array_push($posts, $post->getPost($pid));
	}
	$app->render('home.php',array('user'=>$user, 'tag_search_result'=>$posts, 'loggedIn'=>$loggedIn, 'comment'=>$comment));
});

$app->get('/login', function() use($app) {
	session_start();
	if(isset($_SESSION['user_id'])) {
		$app->redirect('/Blog-It/index');
	}
	$app->render('login.php');
});

$app->get('/login-to-continue', function() use($app) {
	$app->render('login.php',array('new_redirect'=>1));
});

$app->post('/login', function() use($app) {
	$req = $app->request();
	$err = array('incorrect'=>0,'absent'=>0);

	if($req->post('submit')) {
		if(!empty($req->post('username')) && !empty($req->post('password'))) {
			require_once 'core/user.inc.php';

			$user = new User;
      $status = $user->login($req->post('username'), $req->post('password'));
      if($status) {
				// session_start();
				if(isset($_SESSION['current_page'])) {
					echo $_SESSION['current_page'];
					$app->redirect('/Blog-It'.$_SESSION['current_page']);
				}
				else {
					$app->redirect('/Blog-It/me');
				}
      }
      else {
        $err['incorrect'] = 1;
				$app->render('login.php', array('err'=>$err));
      }
    }
    else {
      $err['absent'] = 1;
			$app->render('login.php', array('err'=>$err));
    }
	}
});

$app->get('/signup', function() use($app) {
  $err = array('db_err'=>0, 'name'=>0,'username'=>0,'email'=>0,'password'=>0,'conf_password'=>0,'mismatch'=>0,'invalid_email'=>0,'duplicate'=>0);
  $action = 0;

	session_start();
	if(isset($_SESSION['user_id'])) {
		$app->redirect('/Blog-Its/index');
	}
	else {
		$app->render('signup.php', array('action' => $action, 'err' => $err));
	}
});

$app->post('/signup', function() use($app) {
	$req = $app->request();
	$err = array('db_err'=>0, 'name'=>0,'username'=>0,'email'=>0,'password'=>0,'conf_password'=>0,'mismatch'=>0,'invalid_email'=>0,'duplicate'=>0);
  $action = 0;

	if($req->post('signup')) {
		require_once 'core/user.inc.php';

		$user = new User;
		$name = $req->post('name');
    $username = $req->post('username');
    $password = $req->post('passwd');
    $conf_password = $req->post('con_passwd');
    $email = $req->post('email');

		if(!empty($name) && !empty($username) && !empty($email) && !empty($password) && !empty($conf_password)) {
      if($user->validEmail($email) && $password == $conf_password) {

        $user_details = array('name'=>$name, 'username'=>$username, 'password'=>$password, 'email'=>$email);
        $result = $user->addUser($user_details);

        if($result == 1) {
          //Succesful Signup, redirect to login to confirm registration
          $app->redirect('/Blog-It/login');
        }
        elseif(explode(' ', $result)[0] == 'Duplicate') {
          $err['duplicate'] = 1;
					$app->render('signup.php', array('err'=>$err, 'action'=>$action));
        }
        else {
          $err['db_err'] = 1;
					$app->render('signup.php', array('err'=>$err, 'action'=>$action));
        }
      }
      else {
        if(!($user->validEmail($email))) {
          $action = 1;
          $err['invalid_email'] = 1;
					$app->render('signup.php', array('err'=>$err, 'action'=>$action));
        }
        if($password != $conf_password) {
          $action = 1;
          $err['mismatch'] = 1;
					$app->render('signup.php', array('err'=>$err, 'action'=>$action));
        }
      }
    }

    else {
      if(empty($name)) {
        $action = 1;
        $err['name'] = 1;
      }
      if(empty($username)) {
        $action = 1;
        $err['username'] = 1;
      }
      if(empty($email)) {
        $action = 1;
        $err['email'] = 1;
      }
      if(empty($password)) {
        $action = 1;
        $err['password'] = 1;
      }
      if(empty($conf_password)) {
        $action = 1;
        $err['conf_password'] = 1;
      }
      if(!($user->validEmail($email))) {
        $action = 1;
        $err['invalid_email'] = 1;
      }
			// $req->render('signup.php', array('err'=>$err, 'action'=>$action));
    }
	}
	// $app->render('signup.php', array('err'=>$err, 'action'=>$action));
});

$app->get('/logout', function() use($app) {
	session_start();
  session_destroy();
	$app->redirect('/Blog-It/index');
});

/*
* On logging in, redirect to the profile page of the current user
*/
$app->get('/me', function() use($app) {
  require_once 'core/user.inc.php';
  require_once 'core/post.inc.php';

  $user = new User;
  $post = new Post;
	$loggedIn = 0;
	session_start();
  if($user->isLoggedIn()) {
    $loggedIn = 1;
  }
  $postDetails = $post->getTopPostsByUser($_SESSION['user_id']);
  $userDetails = $user->getUser($_SESSION['user_id']);
  $app->render('author.php', array('loggedIn' => $loggedIn, 'postDetails' => $postDetails, 'userDetails' => $userDetails, 'empty' => 0));
});

/*
* Navigate to each user's profile using their unique user_id
*/
$app->get('/author/:id', function($uid) use($app) {
  require_once 'core/user.inc.php';
  require_once 'core/post.inc.php';
  $user = new User;
  $post = new Post;

	$loggedIn = 0;
	$empty = 0;

	$postDetails = $post->getTopPostsByUser($uid);
	$userDetails = $user->getUser($uid);

	if(gettype($postDetails) == 'string') {
		$app->notFound();
	}


	if($postDetails->num_rows == 0) {
		$empty = 1;
	}

	session_start();
  if($user->isLoggedIn()) {
    $loggedIn = 1;
  }

	if(!$userDetails->num_rows == 0) {

		$app->render('author.php', array('loggedIn' => $loggedIn, 'postDetails' => $postDetails, 'userDetails' => $userDetails, 'empty' => $empty));
	}

});


$app->get('/post/:id', function($pid) use($app) {
	require_once 'core/user.inc.php';
	require_once 'core/post.inc.php';

	require_once 'core/comment.inc.php';

	$user = new User;
	$post = new Post;
	$comment = new Comment;
	$post_cur = $post->getPost($pid);

	$loggedIn = 0;
	$name;

	if($post_cur->num_rows == 0) {
		$app->notFound();
	}
	else {
		session_start();
		if($user->isLoggedIn()) {
			$loggedIn = 1;
		}
				$comments=$comment->getComments($pid);

		$post = $post_cur->fetch_assoc();
		$name = $user->getName($post['author_id'])->fetch_assoc()['name'];
		$app->render('post.php',array('post'=>$post, 'name'=>$name, 'loggedIn'=>$loggedIn,'comment'=>$comments,'user'=>$user));
	}
});

$app->post('/post/:id', function($pid) use($app) {
	require_once 'core/post.inc.php';
	$post = new Post;
	$req = $app->request();
	if($req->post('upvote')) {
		$post->upVote($pid);
		$app->redirect('/Blog-It/post/'.$pid.'#up');
	}
	elseif($req->post('downvote')) {
		$post->downVote($pid);
		$app->redirect('/Blog-It/post/'.$pid.'#down');
	}
	elseif($req->post('new-comment')) {
		require_once 'core/comment.inc.php';

		session_start();
		$comment = new Comment;
		$comment_body=$req->post('body');

		$post_id=$pid;
		$author_id=$_SESSION['user_id'];

		$result=$comment->putComment(array('body' => $comment_body,'author_id' => $author_id ,'post_id'=>$post_id ));
		if($result){
			$app->redirect("/Blog-It/post/".$pid);
		}else{
			$app->redirect("/Blog-It/post/".$pid,array('err' =>1 ));
		}
	}
	else {
		require_once 'core/comment.inc.php';
		$comment = new Comment;

		foreach ($req->post() as $comm => $val) {
			$c = explode('-',$comm);
			print_r($c);
			$up = ($c[0] == 'upvote')?1:0;

			$cid = (int)$c[2];
			if($up) {
				echo "upvote on $cid";
				$comment->upVote($cid);
			}
			else {
				echo "downvote on $cid";
				$comment->downVote($cid);
			}
			$app->redirect('/Blog-It/post/'.$pid);
		}
	}
	// elseif($app->request()->post("upvote-comment-$cid"))
});

$app->get('/new-post', function() use($app) {
	require_once 'core/user.inc.php';

	$user = new User;

	session_start();
	if($user->isLoggedIn()) {
		$app->render('new.php');
	}
	else {
		$_SESSION['current_page'] = '/new-post';
		$app->redirect('/Blog-It/login-to-continue');
	}
});

$app->post('/new-post', function() use($app) {
	$req = $app->request();

	if($req->post('new-post')) {
		require_once 'core/post.inc.php';
		require_once 'core/tag.inc.php';
		session_start();
		$post = new Post;
		$tag = new Tag;
		$title = $req->post('title');
		$body = $req->post('body');
		$tags = explode(" ", $req->post('tags'));

		$result = $post->addPost(array('title'=>$title, 'body'=>$body, 'uid'=>$_SESSION['user_id']));

		if(gettype($result) == 'integer') {
			// print_r($tags);
			$tag->addTags($result, $tags);
			$app->redirect('/Blog-It/post/'.$result);
		}
		else {
			$app->render('new.php', array('err'=>'There was an error adding your post. Please try again later.'));
		}

	}
});
/*
* Custom 404 page
*/
$app->notFound(function() use($app) {
	require_once 'core/user.inc.php';
	$user = new User;
	$loggedIn = 0;
	session_start();
	if($user->isLoggedIn()) {
		$loggedIn = 1;
	}

	$app->render('lost.php', array('loggedIn'=>$loggedIn));
});

$app->post('/delete-post/:id', function($id) use($app) {
	$req = $app->request();
	if($req->post('delete-post')) {

		require_once 'core/post.inc.php';

		$post = new Post;
		$post->deletePost($id);
		$app->redirect('/Blog-It/me');
	}
});

$app->post('/delete-comment/:id', function($id) use($app) {
	$req = $app->request();
	// echo $req->post('delete-comment');
	if($req->post('delete-comment')) {
		require_once 'core/comment.inc.php';
		$post = new Comment;
		$post->deleteComment($id);
		$app->redirect("/Blog-It/post/".$req->post('delete-comment'));
	}
});

$app->run();
?>
