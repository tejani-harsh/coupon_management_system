<?php ob_start();?>
<?php include './index.php'; ?>
<?php include './connection.php';?>
<div class="content-wrapper" style="padding: 30px;">
        <link href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/css/jquery.dataTables.css">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
        <!--fads-->
        
        <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.0/jquery.dataTables.min.js"></script>
        <style>
            .action{
                width: 70px;
            }
        </style>
        <table id="example" class="display" style="width:100%">
        <thead>
           
            <tr>
                <th>Sr.No</th>
                <th>Shop Details</th>
                <th>Shop Owner Details</th>
                <th>Contact Details</th>
                <th>Coupon Details</th>
                <th>Coupon Image</th>
                <!-- <th style="width: 10%; " >Image</th> -->
                <th style="width:30%;">No of Time Redeemed</th>
                <th>status</th>
                <!-- <th style="width: 10%;">expire Date</th>
                <th style="width: 10%;" > is approve</th> -->
                

            </tr>
        </thead>
                <tbody>

            <?php
        // $result="select c.fName,c.lName,c.gender,c.contactNo,c.email,s.shopName,ac.couponCode,ac.couponImage,ac.offer,rc.udate,rc.mrp,rc.discount,rc.finalAmount from tbl_customer as c inner join tbl_redeemcoupon as rc on c.cId=rc.customerId inner join tbl_coupon as ac on ac.couponId = rc.couponId inner join tbl_shop as s on ac.shopId=s.shopId";
//   $result="select s.fName,s.lName,s.contact,s.email,s.shopName,s.gst,sc.shopCategory,ac.couponCode,ac.couponImage,ac.discount,ac.offer,ac.couponDate,ac.couponExpireDate,(SELECT COUNT(*) from tbl_redeemcoupon inner join tbl_coupon on tbl_redeemcoupon.couponId=tbl_coupon.couponId where tbl_coupon.shopId=s.shopId and tbl_coupon.couponExpireDate>'".date("Y-m-d")."' and isApprove=1) as noofcr,(SELECT COUNT(*) from tbl_coupon where tbl_coupon.shopId=s.shopId and tbl_coupon.isApprove=1 and tbl_coupon.couponExpireDate>'".date('Y-m-d')."') as activeC from tbl_shopcategory as sc inner join tbl_shop as s on s.shopCategoryId=sc.shopCategoryId inner join tbl_coupon as ac on ac.shopId = s.shopId";
            $result="select s.fName,s.lName,s.contact,s.email,s.shopName,s.gst,sc.shopCategory,ac.couponCode,ac.couponImage,ac.discount,ac.offer,ac.couponDate,ac.couponExpireDate,ac.isApprove,(select count(*) from tbl_redeemcoupon where tbl_redeemcoupon.couponId=ac.couponId) as noofrc from tbl_shopcategory as sc inner join tbl_shop as s on s.shopCategoryId=sc.shopCategoryId inner join tbl_coupon as ac on ac.shopId = s.shopId ";
$sr=1;
        $query=$conn->query($result);
      while ($r= mysqli_fetch_array($query))
            {
          ?>
          <tr>
            <td><?php echo $sr;?></td>
            <td><?php echo $r["shopName"]." </br>Shop Category:".$r["shopCategory"]."</br> GST:".$r["gst"]; ?> </td>
            <td style="width:130px;"><?php echo $r["fName"]." ".$r["lName"]; ?></td>
            <td><?php echo $r["contact"]."\n". $r["email"]; ?></td>
             <td><?php echo "Coupon Code:".$r["couponCode"]."</br> offer :".$r["offer"]."</br> Discount:".$r["discount"]."</br> Creation Date:".$r["couponDate"]."</br> Expire Date:".$r["couponExpireDate"]; ?> </td>
             <td><img style=" height: 100px;" src="./image/coupons/<?php  echo $r["couponImage"];?>" alt="" srcset=""></td>
             <td><?php echo $r["noofrc"];?></td>
            <td><?php 
                if ($r["isApprove"]==1)
                {?>
                    <span class="badge bg-success">
                <?php echo "Active"; ?>
                    </span>
                <?php }
                else if($r["isApprove"]==0){
                ?>
                    <span class="badge bg-danger">  
                   <?php echo 'Expired'; ?>
                    </span>
                 <?php   
                }
                ?></td>
                </tr>
            <?php
            $sr++;
            }
        ?>
       
           
        </tbody>
    </table>
       
<script type="text/javascript">
$(document).ready(function() {
    $('#example').DataTable();
} );


</script>
</div>
<?php        ob_flush();?>