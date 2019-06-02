<html>
<head>
    <title>Results of searched books</title>

    <?php include 'css/integrations.php'; ?>
    <link href="css/style.css" rel="stylesheet">

</head>
<body>
<header>
    <img src="images/head1.jpg" class="head">
</header>
<br>
<h2 class="text-center">Digital Book Bank</h2><br>
<div class="text-center"><a href="index.php"><button class="btn btn-success"><i class="fas fa-search"></i> Search More</button></a></div><br>
<h3 class="text-center"><i class="fas fa-search"></i> Searched Results</h3><br>
<?php
    $name = str_replace(" ","+",$_GET['bname']);
    $filter = $_GET['filter'];
    $order = $_GET['orderby'];
    $startIndex = $_GET['startIndex'];
    if ($filter == "all") {
        $url = "https://www.googleapis.com/books/v1/volumes?maxResults=20&q=".$name."&orderBy=".$order."&startIndex=".$startIndex."";
        $url_main = $url;
    } else {
        $url =  "https://www.googleapis.com/books/v1/volumes?maxResults=20&filter=".$filter."&q=".$name."&orderBy=".$order."&startIndex=".$startIndex."";
        $url_main = $url;
    }

    $result = file_get_contents($url_main);
    $json = json_decode($result, true);

    if (isset($json['items'])){
        foreach ($json['items'] as $array)
        {

            if (isset($array['volumeInfo']['authors'])){
                $authors = $array['volumeInfo']['authors'];

            }
            if (isset($array['volumeInfo']['publisher'])){
                $publisher = $array['volumeInfo']['publisher'];
            }
            if (isset($array['volumeInfo']['publishedDate'])){
                $pdate = $array['volumeInfo']['publishedDate'];
            }
            if (isset($array['volumeInfo']['imageLinks']['thumbnail'])){
                $cover  = $array['volumeInfo']['imageLinks']['thumbnail'];
            }
            if(isset($array['volumeInfo']['pageCount'])){
                $pcount = $array['volumeInfo']['pageCount'];
            }




  ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6">
                        <div class="result-box text-center">
                            <h4><?php echo $array['volumeInfo']['title'];?></h4>

                            <p><b>Publisher</b> : <?php echo $publisher; ?><br><b>Published Date</b> : <?php echo $pdate;?></p>

                            <img src="<?php echo  $cover; ?>" width="130px" height="200px" class="result-image">
                            <h6><br>Written by <?php echo $authors[0];?></h6>
                            <p><?php echo $pcount; ?> pages</p>
                            <?php
                            if (isset($array['saleInfo']['listPrice'])){
                                $mrp = $array['saleInfo']['listPrice']['amount'];
                                if (isset($array['saleInfo']['retailPrice'])){
                                    $retailprice = $array['saleInfo']['retailPrice']['amount'];
                                    ?>


                                    <?php
                                    if (isset($array['saleInfo']['buyLink'])){
                                       $buy = $array['saleInfo']['buyLink'];

                                ?>

                                        <strike><span style="color: red;"> <?php echo " ₹".$mrp;?></span></strike> <b><?php echo "₹".$retailprice."/-"; ?></b> Ebook <a href="<?php echo $buy;?>"> <button class="btn btn-info"><i class="fas fa-shopping-cart"></i> Buy Now</button></a><br><br>
                                <?php
                                    }
                                }
                            }
                            else{
                                $notsale = "Not for sale";
                                ?>
                                <p style="color: red;"><?php echo $notsale ;?></p>
                                <?php
                            }
                            ?>
                       <?php
            if (isset($array['accessInfo']['pdf'])) {
               if (isset($array['accessInfo']['pdf']['isAvailable']) == "true"){
                  if (isset($array['accessInfo']['pdf']['acsTokenLink'])){
                      $acsm = $array['accessInfo']['pdf']['acsTokenLink'];

                ?>
                <a href="<?php echo $acsm;?>"> <button class="btn btn-info">Download ACSM</button></a><br><br>
                <?php
                  }
               }
               }
            else{
                return false;
            }
                       ?>
                           <?php if (isset($array['accessInfo']['webReaderLink'])) {
                               $readonline = $array['accessInfo']['webReaderLink'];

                               ?>
                              <a href="<?php echo $readonline;?>"> <button class="btn btn-info"><i class="fas fa-book-reader"></i> Read Online</button></a>
                            <?php
                            }
                            ?>
                            <?php if (isset($array['volumeInfo']['infoLink'])) {
                                $info = $array['volumeInfo']['infoLink'];

                                ?>
                                <a href="<?php echo $info;?>"> <button class="btn btn-info">View Info</button></a>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
            </div><br>

<?php
        }
        ?>
        <div class="container">
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
            <?php
        //previous and next
	$prev=$startIndex-20;
	$next=$startIndex+20;
	if($prev>=0){
	    ?>


        <div style="float: left;">
        <a href='get-books.php?bname=<?php echo $name;?>&startIndex=<?php echo $prev;?>&filter=<?php echo $filter;?>&orderby=<?php echo $order;?>&submit='><span style='font-size:50px;'><i class='fas fa-arrow-circle-left'></i></span></button></a>
        </div>
        <?php
	}
	?>
        <div style="float: right">
<a href='get-books.php?bname=<?php echo $name;?>&startIndex=<?php echo $next;?>&filter=<?php echo $filter;?>&orderby=<?php echo $order;?>&submit='><span style='font-size:50px;'><i class='fas fa-arrow-circle-right'></i></span></button></a>
        </div>
                </div>
                <div class="col-sm-2"></div>
        </div>
</div>

        <br><br>
<?php
    }
    else{
        echo "no results found";
    }
?>

<br>
<footer class="footer text-center" style="width: 100%;">
    <br><br>
    <p style="color:white;">@ Website Designed and Maintained by Kalyan Kumar Kanike</p>
    <p><i class="fa fa-facebook-square" style="color:white;font-size: 40px;"></i> &nbsp;&nbsp;<i style="color: white;font-size: 40px;" class="fa fa-whatsapp "></i>&nbsp;&nbsp;<i style="color: white;font-size: 40px;" class="fa fa-twitter "></i></p>
    <p style="color: white;">Powered By <b>Prathi Web Solutions</b></p>

    <br><br>
</footer>

</body>
</html>
