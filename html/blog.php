<?php
include_once('includes/header.php');
?>

		<div class="container"><!-- Container for all content begins here! -->
					<p style="text-align:center;
			 font: 200 50px/1.3 'Arizonia', Helvetica, sans-serif;
			text-shadow: 4px 4px 0px rgba(0,0,0,0.1);
			color:#000; font-weight:bold;">Blog</p></center></br><hr><br>

<div class="row">

				<div class="col-md-8 animated slideInUp"> 
					<?php foreach ($blogPosts  as $blogPost ){?>
				<div class="well" style="">
					<p ><em><?php echo strtoupper($blogPost['post_category']); ?> :</em></p>
				<center><h4><strong><?php echo strtoupper($blogPost['post_title']); ?></strong></h4></center><hr><br>
				<center><img src="uploads/<?php echo $blogPost['image']; ?>" class="img-responsive "></center><br><br>
				<P class="post_author"><img style="width: 40px !important; height: 40px !important; border-radius: 100% !important; margin-right: 10px !important;" src="uploads/<?php echo $blogPost['image']; ?>"><em> By <strong><?php echo $blogPost['post_author']; ?></strong>, <?php echo $blogPost['timestamp']; ?></em></P><br>
					
					<p><?php $post = $blogPost['post_textual_content'];echo substr($post, 0, 150)."...";?></p>
					<center><a class="btn btn-primary" href="blog_post?id=<?php echo $blogPost['id'];?>-<?php echo create_slug($blogPost['post_title']); ?>">Read More Here<span class="glyphicon glyphicon-chevron-right"></span></a>

				</div>
				<?php }?>
				<br><hr><br>
					
				</div>


			<div class="col-md-4 animated slideInUp">
				
				<div class="well">
					<center><h5><strong><u>RECENT POSTS</u></strong></h5></center><br>
					<?php foreach ($blogPostRecentSections  as $blogPostRecentSection ){?> 
						<div class="well">
							<a href="blog_post?id=<?php echo $blogPostRecentSection['id'];?>-<?php echo create_slug($blogPostRecentSection['post_title']); ?>"><center><h4><strong><?php echo strtoupper($blogPostRecentSection['post_title']); ?></strong></h4><br>
					<img src="uploads/<?php echo $blogPostRecentSection['image']; ?>" class="img-responsive "></center></a>
						</div>
					<?php }?>
				</div>

				<div class="well">
					<center><h5><strong><u>MOST READ POST</u></strong></h5></center>
					<?php foreach ($blogPostMostReads  as $blogPostMostRead ){?> 
						<div class="well">
							<a href="blog_post?id=<?php echo $blogPostMostRead['id'];?>-<?php echo create_slug($blogPostRecentSection['post_title']); ?>"><center><h4><strong><?php echo strtoupper($blogPostMostRead['post_title']); ?></strong></h4><br>
					<img src="uploads/<?php echo $blogPostMostRead['image']; ?>" class="img-responsive "></center></a>
						</div>
					<?php }?>
				</div>
					
			</div>

</div>
</div>

		<?php
//include header';
include_once'includes/footer.php';
?>