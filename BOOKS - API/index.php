<html>
<head>
    <title>
        Working with API
    </title>
  <?php include 'css/integrations.php'; ?>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<header>
    <img src="images/head1.jpg" class="head">
</header>
<br><br>
<h3 class="text-center">Digital Book Bank</h3><br>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
           <div class="f-box">
               <form action="get-books.php" method="GET" onsubmit="return Validate()">
                   <h4 class="text-center"><i class="fas fa-search"></i> Search here</h4>
                   <div class="form-group">
                       <label for="bname">Book name</label>
                       <input type="text" class="form-control" name="bname" id="name">
                       <p id="noname"></p>
                   </div>
                   <div class="form-group" style="display:none;">
                       <label class="col-md-3 control-label" for="startIndex">startIndex</label>
                       <div class="col-md-9">
                           <input id="startIndex" name="startIndex" type="number" placeholder="startIndex" class="form-control" value="0" required>
                       </div>
                   </div>
                   <div class="form-group">
                       <label for="filter">Filters</label>
                       <select name="filter" class="form-control" id="filter">
                           <option value="all">All</option>
                           <option value="free-ebooks">free-ebooks</option>
                           <option value="ebooks">ebooks</option>
                           <option value="full">full</option>
                           <option value="paid-ebooks">paid-ebooks</option>
                           <option value="partial">partial</option>
                       </select>
                   </div>
                   <div class="form-group">
                       <label for="order">Order by</label>
                       <select name="orderby" class="form-control" id="order">
                           <option value="relevance">Relevance</option>
                           <option value="newest">New Books</option>
                       </select>
                   </div>
                   <div class=""><button class="btn btn-info" name="submit"><i class="fas fa-search"></i> Search</button></div>
               </form>
           </div>
        </div>
        <div class="col-sm-3"></div>
    </div>
</div><br><br>
<footer class="footer text-center">
    <br><br>
    <p style="color:white;">@ Website Designed and Maintained by Kalyan Kumar Kanike</p>
    <p><i class="fa fa-facebook-square" style="color:white;font-size: 40px;"></i> &nbsp;&nbsp;<i style="color: white;font-size: 40px;" class="fa fa-whatsapp "></i>&nbsp;&nbsp;<i style="color: white;font-size: 40px;" class="fa fa-twitter "></i></p>
    <p style="color: white;">Powered By <b>Prathi Web Solutions</b></p>
    <br><br>
</footer>
</body>
</html>
<script type="text/javascript">
    function Validate() {
        var name = document.getElementById("name").value;
        if (name.length>0){
            return true;
        }
        else {
          document.getElementById("noname").innerHTML="<span style='color:red'>* Please enter book name</span>"
            return false;
        }
    }
</script>