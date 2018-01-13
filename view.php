<?php  
	session_start();

	$logged_in 	= ((isset($_SESSION['logged_in']) && $_SESSION['logged_in'] != '')?htmlentities($_SESSION['logged_in']):'');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Buy this php Online | Etiendahan Dagupan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name=viewport content="width=device-width, initial-scale=1">

	<meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
	<meta property="og:type"               content="article" />
	<meta property="og:title"              content="When Great Minds Don’t Think Alike" />
	<meta property="og:description"        content="How much does culture influence creative thinking?" />
	<meta property="og:image"              content="https://cfshopeeph-a.akamaihd.net/file/31a0944aada3b99fd34778ff7118f669_tn" />
	
	<!-- link inner -->
	<?php  
		include 'header-link.php';
	?>

</head>
<body>
	
	<a id="return-to-top"><i class="fa fa-chevron-up"></i></a>
	<div id="view-product-page" class="main-container">
		<div class="main-wrapper">
			<div class="main">
				
				<!-- header inner -->
				<?php  
					include 'header.php';
				?>				

				<!-- VIEW PAGE -->
				<div id="etiendahan-view-product-page">
					<nav aria-label="breadcrumb" role="navigation">
						<ol class="breadcrumb">
							<div class="container">
								<li class="breadcrumb-item"><a href="/etiendahan/" title="Back to the frontpage"><i class="fa fa-home"></i>Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">this php</li>
							</div>
						</ol>
					</nav>

					<div class="container view-product">
						<div class="row">
							<div class="col-md-6">
								<div class="row">
									<div class="col-md-3">
										<div id="carouselViewPage" class="carousel vertical slide pull-left" data-ride="carousel" data-interval="false">
											<a class="left carousel-control" href="#carouselViewPage" role="button" data-slide="prev">
												<i class="fa fa-caret-square-o-left" aria-hidden="true"></i>
												<span class="sr-only">Previous</span>
											</a>

											<!-- <div class="custom-carousel-inner carousel-inner">
												<div class="carousel-item active">
													<img class="d-block w-100" src="http://via.placeholder.com/200x200/" alt="First slide">
												</div>
												<div class="carousel-item">
													<img class="d-block w-100" src="http://via.placeholder.com/200x200/" alt="Second slide">
												</div>
												<div class="carousel-item">
													<img class="d-block w-100" src="http://via.placeholder.com/200x200/" alt="Third slide">
												</div>
											</div> -->

											<!-- Carousel items -->
											<div class="custom-carousel-inner carousel-inner">
												<div class="carousel-item active">
													<div class="row-fluid">
														<table>
															<tr>
																<td>
																	<div class="span3" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/31a0944aada3b99fd34778ff7118f669_tn);" data-display="https://cfshopeeph-a.akamaihd.net/file/31a0944aada3b99fd34778ff7118f669_tn"></div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="span3" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/28583ba5a3e35a1a3216a0d7b1b7b184_tn);" data-display="https://cfshopeeph-a.akamaihd.net/file/28583ba5a3e35a1a3216a0d7b1b7b184_tn"></div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="span3" style="background-image: url(http://placehold.it/550);" data-display="http://placehold.it/550"></div>
																</td>
															</tr>
														</table>
													</div><!--/row-fluid-->
												</div><!--/item-->

												<div class="carousel-item">
													<div class="row-fluid">
														<table>
															<tr>
																<td>
																	<div class="span3" style="background-image: url(http://placehold.it/505);" data-display="http://placehold.it/505"></div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="span3" style="background-image: url(http://placehold.it/500);" data-display="http://placehold.it/500"></div>
																</td>
															</tr>
															<tr>
																<td>
																	<div class="span3" style="background-image: url(http://placehold.it/550);" data-display="http://placehold.it/550"></div>
																</td>
															</tr>
														</table>
													</div><!--/row-fluid-->
												</div><!--/item-->
											</div><!--/carousel-inner--> 

											<a class="right carousel-control" href="#carouselViewPage" role="button" data-slide="next">
												<i class="fa fa-caret-square-o-right" aria-hidden="true"></i>
												<span class="sr-only">Next</span>
											</a>
										</div>
									</div>

									<div class="col-md-9">
										<div id="data-display">
										    <a class="magnifier-thumb-wrapper pull-left single-container">
										        <img id="thumb" src="https://cfshopeeph-a.akamaihd.net/file/31a0944aada3b99fd34778ff7118f669_tn"
										        data-large-img-wrapper="preview">
										    </a>
										</div>

										<!-- <div id="DataDisplay" class="pull-left single-container" style="background-image: url(https://cfshopeeph-a.akamaihd.net/file/a6bb16c296f4b5d3c837521cc164b61e_tn);"></div> -->

										<!-- <div id="data-display">
											<img id="thumb" class="magnifier-thumb-wrapper pull-left single-container" src="https://cfshopeeph-a.akamaihd.net/file/a6bb16c296f4b5d3c837521cc164b61e_tn"
									        data-large-img-wrapper="preview">
										</div> -->


									</div>
								</div>
							</div>

							<div class="col-md-6">
	 							<div class="product-shop-wrapper">
	 								<div class="product-name-wrapper">
		 								<div class="product-name">
		 									Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, consectetur. Lorem ipsum dolor sit amet, consectetur adipisicing elit.
		 								</div>
		 							</div>

	 								<div class="product-detail">
	 									<div class="product-price">₱150.00</div>
	 									<div class="product-rating">
											<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
										</div>
	 									<!-- <div class="product-share">Share:</div> -->
	 								</div>

	 								<div class="product-seller pull-right">
	 									<span>John Doe</span>
										<a href="/etiendahan/seller-shop/">
											<button class="btn btn-primary">view shop</button>
										</a>
	 								</div>

	 								<div class="product-button">
	 									<div class="quantity">
	 										<div class="input-group">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number" disabled="disabled" data-type="minus" data-field="quant[1]">
														<span class="fa fa-minus"></span>
													</button>
												</span>
								          		<input type="text" name="quant[1]" class="form-control input-number" value="1" min="1" max="10">
												<span class="input-group-btn">
													<button type="button" class="btn btn-default btn-number" data-type="plus" data-field="quant[1]">
														<span class="fa fa-plus"></span>
													</button>
												</span>
									      	</div>
	 									</div>
	 									<button class="btn btn-primary" type="submit">Add to Cart</button>
	 									<div class="product-add-to-wishlist"><a id="wishlist-toggle"><i class="fa fa-heart-o" title="Add to wishlists"></i></a></div>
	 								</div>
	 							</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<nav class="nav nav-tabs" id="myTab" role="tablist">
									<a class="nav-item nav-link active" id="nav-information-tab" data-toggle="tab" href="#nav-information" role="tab" aria-controls="nav-information" aria-selected="true">Information</a>
									<a class="nav-item nav-link" id="nav-reviews-tab" data-toggle="tab" href="#nav-reviews" role="tab" aria-controls="nav-reviews" aria-selected="false">Reviews</a>
								</nav>
								<div class="tab-content" id="nav-tabContent">
									<div class="tab-pane fade show active" id="nav-information" role="tabpanel" aria-labelledby="nav-information-tab">
										<div class="lang1"><meta charset="utf-8">
											<p><span></span><span>Coupling a blended linen construction with tailored style, the River Island HR Jasper Blazer will imprint a touch of dapper charm into your after-dark wardrobe. Our model is wearing a size medium blazer, and usually takes a size medium/38L shirt. He is 6’2 1/2” (189cm) tall with a 38” (96 cm) chest and a 31” (78 cm) waist.</span></p>
											<li>Length: 74cm</li>
											<li>Regular fit</li>
											<li>Notched lapels</li>
											<li>Twin button front fastening</li>
											<li>Front patch pockets; chest pocket</li>
											<li>Internal pockets</li>
											<li>Centre-back vent</li>
											<span>Please refer to the garment for care instructions.</span>
											<li>Length: 74cm</li>
											<li>Material: Outer: 50% Linen &amp; 50% Polyamide; Body Lining: 100% Cotton; Lining: 100% Acetate</li>
										</div>
									</div>
									<div class="tab-pane fade" id="nav-reviews" role="tabpanel" aria-labelledby="nav-reviews-tab">
										<div class="rating-header">
											<div class="head">Customer Reviews</div>
											<div class="rate-reviews"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i> Based on 2 reviews</div>
											<div class="write-a-review pull-right"><a data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="collapseExample">Write a review</a></div>
											<div class="collapse" id="review">
												<div class="card card-body">
													<div class="write-a-review">Write a review</div>
													<form>
														<div class="form-group">
															<label for="examplName">Name</label>
															<input type="text" class="form-control" id="examplName" placeholder="Enter your name" required>
														</div>

														<div class="form-group">
															<label for="exampleInputEmail">Email address</label>
															<input type="email" class="form-control" id="exampleInputEmail" placeholder="john.smith@example.com" required>														
														</div>

														<div class="form-group">
															<label for="exampleRating">Rating</label>
													  		<!-- Rating Stars Box -->
															<div class='rating-stars'>
																<ul id='stars'>
																	<li class='star' title='1 star' data-value='1'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='2 stars' data-value='2'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='3 stars' data-value='3'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='4 stars' data-value='4'>
																		<i class='fa fa-star'></i>
																	</li>
																	<li class='star' title='5 stars' data-value='5'>
																		<i class='fa fa-star'></i>
																	</li>
																</ul>
															</div>
															
														</div>													

														<div class="form-group">
															<label for="exampleReviewTitle">Review title</label>
															<input type="text" class="form-control" id="exampleReviewTitle" placeholder="Give your review a title">														
														</div>

														<div class="form-group">
															<label for="exampleFormControlTextarea">Body of Review (1500)</label>
															<textarea class="form-control" id="exampleFormControlTextarea" rows="10" maxlength="1500" placeholder="Write your comments here"></textarea>
														</div>

														<button type="submit" class="btn btn-primary pull-right">Submit Review</button>
													</form>
												</div>
											</div>
										</div>

										<div class="rate">
											<div class="rate-reviews"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
											<div class="rate-title">Title</div>
											<div class="rate-name-and-date"><strong>Allan Drake Paladin Dulay</strong> on <strong>Dec 06, 2017</strong></div>
											<div class="rate-body">this is a body</div>
										</div>

										<div class="rate">
											<div class="rate-reviews"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i></div>
											<div class="rate-title">Title</div>
											<div class="rate-name-and-date"><strong>Allan Drake Paladin Dulay</strong> on <strong>Dec 06, 2017</strong></div>
											<div class="rate-body">this is a body</div>
										</div>

										<!-- no reviews yet -->
										<!-- <div class="rating-header">
											<div class="head">Customer Reviews</div>
											<div class="rate-reviews">Be the first to review this item</div>
											<div class="write-a-review pull-right"><a data-toggle="collapse" href="#review" aria-expanded="false" aria-controls="collapseExample">Write a review</a></div>
										</div>

										<div class="collapse" id="review">
											<div class="card card-body">
												<div class="write-a-review">Write a review</div>
												<form>
													<div class="form-group">
														<label for="examplName">Name</label>
														<input type="text" class="form-control" id="examplName" placeholder="Enter your name" required>
													</div>

													<div class="form-group">
														<label for="exampleInputEmail">Email address</label>
														<input type="email" class="form-control" id="exampleInputEmail" placeholder="john.smith@example.com" required>														
													</div>

													<div class="form-group">
														<label for="exampleRating">Rating</label>
														<div class='rating-stars'>
															<ul id='stars'>
																<li class='star' title='1 star' data-value='1'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='2 stars' data-value='2'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='3 stars' data-value='3'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='4 stars' data-value='4'>
																	<i class='fa fa-star'></i>
																</li>
																<li class='star' title='5 stars' data-value='5'>
																	<i class='fa fa-star'></i>
																</li>
															</ul>
														</div>
														
													</div>													

													<div class="form-group">
														<label for="exampleReviewTitle">Review title</label>
														<input type="text" class="form-control" id="exampleReviewTitle" placeholder="Give your review a title">														
													</div>

													<div class="form-group">
														<label for="exampleFormControlTextarea">Body of Review (1500)</label>
														<textarea class="form-control" id="exampleFormControlTextarea" rows="10" maxlength="1500" placeholder="Write your comments here"></textarea>
													</div>

													<button type="submit" class="btn btn-primary pull-right">Submit Review</button>
												</form>
											</div>
										</div> -->
									</div>
								</div>
							</div>
						</div>

						<!-- SECTION 3 - Homepage related products -->
						<div id="etiendahan-section-3" class="etiendahan-section">
							<div class="container">
								<div class="title-name">
									<a href="">See all<i class="fa fa-chevron-right fa-fw"></i></a>
									<h3><span class="wow pulse" data-wow-delay="1000ms">RELATED PRODUCTS</span></h3>
								</div>

								<div class="owl-carousel">
									<div class="item">
										<a href="/etiendahan/view/">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="https://cfshopeeph-a.akamaihd.net/file/cb12fe688e868322f7a4bcac62354d1f_tn"></div>
												<div class="card-body">
													<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, consectetur.</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="https://cfshopeeph-a.akamaihd.net/file/9886ae399cd7e8e90f12754faaca791f_tn"></div>
												<div class="card-body">
													<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Necessitatibus, ut!</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tenetur, odio.</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
									<div class="item">
										<a href="https://www.google.com">
											<div class="card">
												<div class="card-image img-fluid owl-lazy" data-src="http://via.placeholder.com/200x200/"></div>
												<div class="card-body">
													<div class="product-name">Abercrombie Board shorts goodrombie Board shorts good</div>
													<div class="product-price">₱150.00</div>
													<div class="product-rating">
														<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span><span style="margin-left: 4px;">(400)</span>
													</div>
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
						<!-- END OF SECTION 3 -->
					</div>
				</div>
				<!-- END OF VIEW PAGE -->

<!-- footer inner -->
<?php  
	include 'footer.php';
?>
</html>