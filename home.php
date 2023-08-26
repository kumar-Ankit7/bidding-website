<?php 
include 'admin/db_connect.php'; 
?>
<style>
    #cat-list li{
        cursor: pointer;
    }
       #cat-list li:hover {
        color: white;
        background: #007bff8f;
    }
    .prod-item p{
        margin: unset;
    }

    .bid-tag {
    position: absolute;
    right: .5em;
    }
  

    nav#mainNav {
        background-color: #131212;
        left: 0;
        position: fixed;
        right: 0;
        top: 0;
        box-shadow: 1px 1px 4px 6px rgb(0 0 0 / 10%);
    }
    .row {
        display: flex;
        flex-wrap: wrap;
        background:url('back.jpg');
        margin-top:2em;
       
    }
    .prod-item{
        padding-left:10px;
        background:#0E5E6F;
        color:#fff;
        padding-bottom: 16px;
    }

    .py-3 {
    padding-bottom: 2.5rem !important;
}

    .col-md-3{
        position: relative;
        width: 100%;
        padding-right: 10px;
        padding-left: 0px;
        padding-top:0px;
    }

    .truncate{
        color:#f8f9fa;
    }


    .card-body {
        flex: 1 1 auto;
        min-height: 1px;
        padding: 0px;
        background: #F7F7F7;

     
    }

    .card-img, .card-img-top, .card-img-bottom {
        /* flex-shrink: 0;*/
        width: 21vw;
        overflow: hidden;
        height: 33vh;
        padding-left: 1.3em;
        padding-top: 2em;
        padding-right: 2.9em;
        border-radius: 40px;
    }
    .list-group-item{
        padding-right:12em;
    }

    .car-side{
        height:100vh;
        box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
    }

    .btn-primary{
        background:#decdb2;
        color:#000;
        border:none;
    }



    .card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-clip: border-box;
    border: 0px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
    }

    .card#side-nav{
        padding-top: 1.5em;
        margin-top:3.3em;
        position: fixed;
        height:100vh;
    }

    .card#aside{
        margin-top:1.5em;
    }

    .card #card-side{
        box-shadow: 5px 5px 30px 7px rgba(0,0,0,0.25), -5px -5px 30px 7px rgba(0,0,0,0.22);
        border-radius: 40px;
        width:20vw;
        margin-bottom:2.5rem; 
        transition:0.5s;
        transform:scale(0.89, 0.89) perspective(800px) rotateY(0deg);
        background-color: #e8dcc8;
        
    }

    .card#card-side:hover {
        box-shadow: 5px 5px 30px 15px rgba(0,0,0,0.25), -5px -5px 30px 15px rgba(0,0,0,0.22);
        transform: scale(0.97, 0.97) perspective(700px) rotateY(17deg);
        
}
.butn{
    margin:5px;

}

  
</style>

<?php


?>
<?php 
$cid = isset($_GET['category_id']) ? $_GET['category_id'] : 0;
?>
<div class="contain-fluid" style="z-index:-100;">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-3">
                <div class="card" id="side-nav"  style="z-index:2;">
                    <div class="card-header"><img id="log" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACQAAAAkCAYAAADhAJiYAAAAAXNSR0IArs4c6QAAAeRJREFUWEelWNG2wyAI0y/f2Ze709pWkURC16d7O4gQArjV8jy1lNLGv6//UnBqqaXB0w5v+yh4LNjL9xXE6XQEGj55eOcxvwBw68dXSMzSmjOqT5Bs7CDyzpAMxAyFtEV5TgHJUcEis6rEqNZCYAgcdQkQdyWznwvBma4DO87lqW5QobBPNgZCl2nw23S0XLucNy1qZSiLBAw9zGht6L0ckEbU1mo5q0/BZrW1K1nz48AhJEYG3Anay7CvlX0ji2ou8b06WN0ApQvHdsonxDvnNNzqLOo8WuyRLTFdrvFRocblkvnLBsP+3B9sOvHxdcObD+O76t8+V6wh7bJaSvP7MD+iN0SBtu/hsdZ94okLaIchm6FLKSAZ00t37FOyAeTpRdM21Fc3+Bq7Sf9WBwpaTNnrUeZpUxQsB52PfLc6UlmKuglT8dt+nr1BgmbCkq81YQR3TyENLc6wy7JFwPZnV1Z0zfY3xoEAr+VyQLEhkItZrhNnPRQQkFVK7iuRu7jZgISS2U0uiwHvccX9mNBCl8Xca4cBK7KJNDx5PvEfEpSDDEOsI4ac/jlMY5oEpDmzHcdUpKASDWkTEU9nzZeVrwd0Yri2T62OmK0AX2/7l22s5bckbdpeqTAncybZUcsqAJx+Yd3WL+0KHT4AAAAASUVORK5CYII="/>&nbsp Categories</div>
                    
                    <div class="card-side">
                        
                        <ul class='list-group' id='cat-list'>
                            <li class='list-group-item' data-id='all' data-href="index.php?page=home&category_id">All</li>
                            <?php
                                $cat = $conn->query("SELECT * FROM categories order by name asc");
                                while($row=$cat->fetch_assoc()):
                                    $cat_arr[$row['id']] = $row['name'];
                             ?>
                            <li class='list-group-item' data-id='<?php echo $row['id'] ?>' data-href="index.php?page=home&category_id=<?php echo $row['id'] ?>"><?php echo ucwords($row['name']) ?></li>

                            <?php endwhile; ?>
                        </ul> 
                    </div>
                </div>
            </div>
            <section class="overlay"></section>

            <div class="col-md-9">
                <div class="card" id="aside">
                    <div class="card-body">
                        <div class="row">
                            <?php
                                $where = "";
                                if($cid > 0){
                                    $where  = " where category_id =$cid ";
                                }
                                    $cat = $conn->query("SELECT * FROM products $where order by name asc");
                            
                                if($cat->num_rows <= 0){
                                    echo "<center><h4><i>No Available Product.</i></h4></center>";
                                } 
                                while($row=$cat->fetch_assoc()):
                             ?> 
                             
                             <div class="col-sm-4" >
                                 
                                <div class="card" id="card-side">
                                     
                                     <div class="float-right align-top bid-tag">
                                         <span class="badge badge-pill badge-primary text-white"><i class="fa fa-tag"></i> <?php echo number_format($row['start_bid']) ?></span>
                                     </div>
                                     
                                     <img class="card-img-top" src="admin/assets/uploads/<?php echo $row['img_fname'] ?>" alt="Card image cap">
                                      <div class="float-right align-top d-flex">
                                         <span class="badge badge-pill badge-warning text-white"><i class="fa fa-hourglass-half"></i> <?php echo date("M d,Y h:i A",strtotime($row['bid_end_datetime'])) ?></span>
                                     </div>
                                     
                                     <div class=" prod-item">
                                         <p><?php echo $row['name'] ?></p>
                                         <p><small><?php echo $cat_arr[$row['category_id']] ?></small></p>
                                         <p class="truncate"><?php echo $row['description'] ?></p>
                                    <div class="butn">
                                        <?php if($row['bid_end_datetime']>= date("Y-m-d H:i:s") || !isset($_SESSION['login_id'])) : ?>
                                        <button class="btn btn-primary btn-md view_prod" type="button" data-id="<?php echo $row['id'] ?>"> View</button>
                                        <button class="btn btn-primary btn-md bid_prod" type="button" data-id="<?php echo $row['id'] ?>"> Bid</button>

                                        <?php else : ?>
                                        <button class="btn btn-primary btn-md view_prod" type="button" data-id="<?php echo $row['id'] ?>"> View</button>
                                        <?php endif; ?>

                                </div>
                                     </div>
                                 </div>
                             </div>
                            <?php endwhile; ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
       
<script>
    $('#cat-list li').click(function(){
        location.href = $(this).attr('data-href')
    })
     $('#cat-list li').each(function(){
        var id = '<?php echo $cid > 0 ? $cid : 'all' ?>';
        if(id == $(this).attr('data-id')){
            $(this).addClass('active')
        }
    })
     $('.bid_prod').click(function(){
        uni_modal_right('Bid Product','bid_prod.php?id='+$(this).attr('data-id'))
     })

     $('.view_prod').click(function(){
        location.href='view_prod.php?id='+$(this).attr('data-id')
     })

</script>