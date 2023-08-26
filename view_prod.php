<?php include 'admin/db_connect.php' ?>

<?php
    session_start();
    if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM products where id= ".$_GET['id']);
    foreach($qry->fetch_array() as $k => $val){
	    $$k=$val;
    }
    $cat_qry = $conn->query("SELECT * FROM categories where id = $category_id");
    $category = $cat_qry->num_rows > 0 ? $cat_qry->fetch_array()['name'] : '' ;
    }

?>
<head>
  <title>Thamel Bazar</title>
  <link href="css/styles.css" rel="stylesheet" />
        <link type="text/css" rel="stylesheet" href="admin/assets/css/jquery-te-1.4.0.css">

         <link href="admin/assets/css/select2.min.css" rel="stylesheet">

        <script src="admin/assets/vendor/jquery/jquery.min.js"></script>
        <script src="admin/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript" src="admin/assets/js/select2.min.js"></script>

    <script type="text/javascript" src="admin/assets/js/jquery.datetimepicker.full.min.js"></script>
    <script type="text/javascript" src="admin/assets/js/jquery-te-1.4.0.min.js" charset="utf-8"></script>

<style>
@import url("https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,700&family=Montserrat:wght@500;700&display=swap");

*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0;
  height: 100vh;
  font-family: "Montserrat", sans-serif;
  font-size: 0.8rem;
  color: hsl(228, 12%, 48%);
  background-color: hsl(30, 38%, 92%);
}

.card {
  display: flex;
  flex-direction: column;
  width: 20rem;
  height: auto;
  margin: 0 auto;
  border-radius: 10px;
  background-color: #fff;
  overflow: hidden;
}

.card__img__container {
  height: 70%;
  width: auto;
}

.card__img {
    margin-left:2.5em;
    margin-top:4em;
}

.card__content {
  height: 55%;
  padding: 1.75rem;
  padding-top: 1.25rem;
}

.item-tag {
  font-size: 0.7rem;
  font-weight: lighter;
  text-transform: uppercase;
  letter-spacing: 0.35em;
}

.item-name p {
  margin-top: 0.1em;
  margin-bottom: 0.5em;
  color: hsl(212, 21%, 14%);
  font-family: "Fraunces", serif;
  font-size: 1.85rem;
  line-height: 1em;
}

p{
    font-size:16px;
}
.item-desc {
  opacity: 0.9;
  line-height: 1.5em;
  font-size:16px;
}

.item-price {
  display: flex;
  align-items: center;
  font-size:16px;
}

.price--original {
  color: hsl(158, 36%, 37%);
  font-family: "Fraunces", serif;
  font-size: 15px;
}

.price--discount {
  margin-left: 1em;
  text-decoration: none;
  font-size: 16px;
  opacity: 1;
}

.cta-btn {
  cursor: pointer;
  display: block flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  padding: 1em 2em;
  margin-top: 12px;
  border: none;
  border-radius: 8px;
  color: #fff;
  background-color: hsl(158, 36%, 37%);
  font-family: "Montserrat", sans-serif;
  font-weight: 700;
  font-size:18px;

}
.cta-btn a{
  text-decoration:none;
  color:#fff;
}

.cta-btn:hover {
  background-color: hsl(158, 36%, 25%);
}


.attribution {
  position: absolute;
  top: 0;
}

@media (min-width: 600px) {
  .card {
    display: flex;
    flex-direction: row;
    width: 55rem;
    height: 45rem;
    margin: 0 auto;
    border-radius: 10px;
    background-color: #fff;
    overflow: hidden;
  }

  .card__img__container {
    width: 70%;
    height: auto;
  }

  .card__img {
    height: 100%;
  }

  .card__content {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 80%;
    height: auto;
    padding: 1.75rem;
  }

  .item-name {
    margin-bottom: 0;
  }
}
.head{
  padding:20px;
  font-size:25px;
}

.cta-btn{

}


</style>
</head>

<body>
  <main class="card">
    <picture class="card__img__container">
    <h2 class="head">Product Details</h2>
      <img class="card__img" style='height: 50%;width: 90%;' src="admin/assets/uploads/<?php echo $img_fname ?>" alt="product">
    </picture>
    <div class="card__content" style="padding:-2rem;">
      <span class="item-tag"><p>Category: <b><?php echo $category ?></b></p></span>
      <h1 class="item-name"><p>Name: <large><b><?php echo $name ?></b></large></p></h1>
      <p>Until: <b><?php echo date("m d,Y h:i A",strtotime($bid_end_datetime)) ?></b></p>
      <p class="item-desc">Description:<p class=""><small><i><?php echo $description ?></i></small></p></p>
      <div class="item-price">
        <span class="price--discount"><p>Starting Amount: <b><?php echo number_format($start_bid,2) ?></b></p></span>
        <span class="price--original sr-only"><p>Highest Bid: <b id="hbid"><?php echo number_format($start_bid,2) ?></b></p></span>
      </div>

                
                


    

        <?php $books = $conn->query("SELECT b.*, u.name as uname,p.name,p.bid_end_datetime bdt FROM bids b inner join users u on u.id = b.user_id inner join products p on p.id = b.product_id ");
								while($row=$books->fetch_assoc()):
									$get = $conn->query("SELECT * FROM bids where product_id = {$row['product_id']} order by bid_amount desc limit 1 ");
									$uid = $get->num_rows > 0 ? $get->fetch_array()['user_id'] : 0 ;
								?>
                <?php if(isset($_SESSION['login_id'])) : ?>
								<?php if($_SESSION['login_name']==$row['uname']  && $_GET['id']== $row['product_id']): ?>				
									
										<?php if($row['status'] == 1): ?>
										<?php if(strtotime(date('Y-m-d H:i')) < strtotime($row['bdt'])): ?>
										<p class=" btn btn-lg btn-info ">You are in a bidding stage</p>
										<?php else: ?>
										<?php if($uid == $row['user_id']): ?>
                      <p class=" btn btn-lg btn-success">You have won the bidding</p>
                      <button class="cta-btn">
                          <a href="payment.php"><span>Proceed to Payment</span></a>
                      </button>
										
										<?php else: ?>
										<p class=" btn btn-lg btn-danger">You have lost the Bidding</p>
										<?php endif; ?>
										<?php endif; ?>
										<?php endif; ?>
                    <?php endif; ?>
                    
                      
                    <?php endif; ?>
  
								<?php endwhile; ?>
        </div>
  </main>
  
  </body>