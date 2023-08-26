<!DOCTYPE html>
<html lang="en">
    <?php
    session_start();
    include('admin/db_connect.php');
    ob_start();
        $query = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
         foreach ($query as $key => $value) {
          if(!is_numeric($key))
            $_SESSION['system'][$key] = $value;
        }
    ob_end_flush();
    include('header.php');

	
    ?>

    <style>
      #main-field{
        margin-top: 5rem!important;
      }


      nav#mainNav {
          background-color: #1b262c;
          left: 0;
          position: fixed;
          right: 0;
          top: 0;
          box-shadow: 1px 1px 4px 6px rgb(0 0 0 / 10%);
      }

      #mainNav .navbar-nav .nav-item .nav-link{
        padding-right:0.6rem;
        
      }

      #mainNav.navbar-scrolled {
        box-shadow: 0 0.5rem 1rem rgb(0 0 0 / 15%);
        background-color: #1b262c;
        color: white !important;
      }

      #mainNav .navbar-brand{
        padding-left: 1rem;
        margin-left: 1rem;
      }

      .container {
         max-width: 1750px;
      }

      .navbar#mainNav{
        background:#1b262c;
      }

      .container b{
        font-size: 16px;
      }
      
      .navbar-nav .nav-item b{
        font-size: 18px;
        font-weight:bold;
        padding-right:1em;
      }

      #mainNav .navbar-nav .nav-item .nav-link:hover {
        color: rgba(255, 135, 100, 0.9);
      }

      .my-lg-0 {
        margin-top: 1.5em !important;
      }

 

     p {

       font-size:18px;
       font-family: "Poppins";
       text-transform: uppercase;
       text-align: justify;
     }

     .fixed_footer {
         width: 100%;
         height: 310px;
         background: #f9f7f0;
         position: relative;
         left: 0;
         bottom: 0;
         z-index: -100;
     }

     .navfooter {
             display: flex;
             justify-content: space-between;
             padding-left:10em;
             padding-top:3em;

      }

     li {
         list-style: none;
         font-family: "Poppins";
         text-transform: uppercase;
         font-size: 1em;
         letter-spacing: 0.1px;
         line-height: 30px;
     }

     .col li:first-child {
           padding-right:1em;
     }

     .col p{
       padding-right:0em;
     }

     .copyright {
          display: flex;
          justify-content: space-between;
          font-family: "Monument Extended";
          text-transform: uppercase;
          font-size: 0.8em;
          letter-spacing: 0.1px;
          line-height: 30px;
          opacity: 0.5;
          margin: 6em 0 0 0;
          padding-left:65em;
    }


    </style>
    <body id="page-top">
        <!-- Navigation-->
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white">
        </div>
      </div>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="./"><img src="log.png" width="240px" height="65px"> <?php/*echo $_SESSION['system']['name']*/ ?></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto my-2 my-lg-0">
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="frontpage.php"><b>Home</b></a></li>
                        
                        <li class="nav-item"><a class="nav-link js-scroll-trigger" href="index.php?page=feedba"><b>Feedback</b></a></li>
                        
                        <?php if(isset($_SESSION['login_id'])): ?>
                          <span><li class="nav-item"><a class="nav-link js-scroll-trigger" href="admin/ajax.php?action=logout2"><?php echo "<b>Welcome". " " ."(".$_SESSION['login_name'].")</b>"?>&nbsp&nbsp<b><i class="fa fa-power-off"></i></b></a></span></li>
                        <?php else: ?>
                          <li class="nav-item"><a class="nav-link js-scroll-trigger" href="javascript:void(0)" id="login_now"><b>Login</b></a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>
  <main id="main-field">
        <?php 
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';
        include $page.'.php';
        ?>
       
</main>
<div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
  <div id="preloader"></div>
        <footer class="fixed_footer" style="background:#1b262c; z-index:4;color:#fff;">
            <?php /*<div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2 class="mt-0 text-white">Contact us</h2>
                        <hr class="divider my-4" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                        <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                        <div class="text-white"><?php echo $_SESSION['system']['contact'] ?></div>
                    </div>
                    <div class="col-lg-4 mr-auto text-center">
                        <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                        <!-- Make sure to change the email address in BOTH the anchor text and the link target below!-->
                        <a class="d-block" href="mailto:<?php echo $_SESSION['system']['email'] ?>"><?php echo $_SESSION['system']['email'] ?></a>
                    </div>
                </div>
            </div>
            <br>
            */?>
        <div class="content">
        <div class="content_inner">
          <div class="navfooter">
            
            <div class="col-para">
              <h2>Thamel Bazar</h2>
              <p id="par">Thamel Bazar is the secondary e-commerce website. <br>It is based on the bazar present in the </p>
            </div>
            &emsp;&emsp;&emsp;&emsp;
            <div class="col">
              <li>Shop</li>
              <li>Products</li>
              <li>Digitals</li>
              <li>FAQs</li>
              <li>Reviews</li>
            </div>
            <div class="col">
              <li>Projects</li>
              <li>Tutorial</li>
            </div>
            <div class="col">
              <li>Contacts</li>
              <li>+91 8072371521</li>
              <li>+91 8077711456</li>
              <li>+91 8056342345</li>
              <li>+91 8097384362</li>
            </div>
          </div>
          <div class="copyright">
            <center><span>2022. All rights reserved.</span></center>
          </div>
        </div>
      </div>

            <?php include('footer.php') ?>
            
          </footer>
       
    </body>
     
    <script type="text/javascript">
      $('#login').click(function(){
        uni_modal("Login",'login.php')
      })
      $('.datetimepicker').datetimepicker({
          format:'Y-m-d H:i',
      })
      $('#find-car').submit(function(e){
        e.preventDefault()
        location.href = 'index.php?page=search&'+$(this).serialize()
      })

    </script>
    <?php $conn->close() ?>

</html>
