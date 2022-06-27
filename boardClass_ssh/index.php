<?php
  require_once("signupConfig.php");
  require_once("page.php");
  require_once('objectInfo.php');
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>게시판</title>
  <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" href="./css/index.css">

</head>
<body>
<div id="get_data"></div>

<table width=100 border="1">
<td style="text-align:center;"><a href="write.php">글쓰기</td>
</table>
<div id="paging" class="paging"></div>


<script>
$(document).ready(function(){

  fetch_data();
  function fetch_data(page){
    $.ajax({
      url: "sendData.php",
      method: "POST",
      async: false,
      data: {
        page:page
      },
      dataType:"JSON",
      success: function(response){  
        $('#get_data').html(response.list);
        $('#paging').html(response.page);

      },
      failure: function(msg) {
        alert(msg);
      }
    })
  }

  $(document).on("click",'.page-link', function(){
    var page = $(this).attr("id");
    fetch_data(page);
  })
})
</script>
</body>
</html>
