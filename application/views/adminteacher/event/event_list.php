<div class="main-panel">
   <div class="content">
      <div class="row">
         <div class="container" style="padding-right:110px;padding-bottom:20px;">
            <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right">Go Back</button>
         </div>
      </div>
      <div class="card">
         <?php $sat=$result['status'];  if($sat=="success"){ foreach($result['eventview'] as $rows1) {} ?>
         <div class="typo-line1">
            <blockquote>
               <h5><?php echo $rows1->event_name; ?></h5>
               <p>
                  <?php echo $rows1->event_details; ?>   
               </p>
               <small>
               <?php echo $new_date = date('d-m-Y', strtotime($rows1->event_date)); ?>
               </small>
            </blockquote>
         </div>
         <?php }else{
            } ?>
      </div>
   
   </div>
</div>
<script>
   $('#calendermenu').addClass('collapse in');
   $('#calendar').addClass('active');
   $('#calendar2').addClass('active');
   
</script>
<style>
   .info a{color: #000;}
   .info a:hover{color: blue;}
   .event-list {
   list-style: none;
   font-family: 'Lato', sans-serif;
   margin: 0px;
   padding: 0px;
   }
   .event-list > li {
   background-color: rgb(255, 255, 255);
   box-shadow: 0px 0px 5px rgb(51, 51, 51);
   box-shadow: 0px 0px 5px rgba(51, 51, 51, 0.7);
   padding: 0px;
   margin: 0px 0px 20px;
   }
   .event-list > li > time {
   display: inline-block;
   width: 100%;
   color: rgb(255, 255, 255);
   background-color: rgb(197, 44, 102);
   padding: 5px;
   text-align: center;
   text-transform: uppercase;
   }
   .event-list > li:nth-child(even) > time {
   background-color: rgb(165, 82, 167);
   }
   .event-list > li > time > .day {
   display: block;
   font-size: 50pt;
   font-weight: 100;
   line-height: 1;
   }
   .event-list > li time > .month {
   display: block;
   font-size: 24pt;
   font-weight: 900;
   line-height: 1;
   }
   .event-list > li > img {
   width: 100%;
   }
   .event-list > li > .info {
   padding-top: 5px;
   text-align: center;
   }
   .event-list > li > .info > .title {
   font-size: 17pt;
   font-weight: 700;
   margin: 0px;
   }
   .event-list > li > .info > .desc {
   font-size: 13pt;
   font-weight: 300;
   margin: 0px;
   }
   .event-list > li > .info > ul,
   .event-list > li > .social > ul {
   display: table;
   list-style: none;
   margin: 10px 0px 0px;
   padding: 0px;
   width: 100%;
   text-align: center;
   }
   .event-list > li > .social > ul {
   margin: 0px;
   }
   .event-list > li > .info > ul > li,
   .event-list > li > .social > ul > li {
   display: table-cell;
   cursor: pointer;
   color: rgb(30, 30, 30);
   font-size: 11pt;
   font-weight: 300;
   padding: 3px 0px;
   }
   .event-list > li > .info > ul > li > a {
   display: block;
   width: 100%;
   color: rgb(30, 30, 30);
   text-decoration: none;
   }
   .event-list > li > .social > ul > li {
   padding: 0px;
   }
   .event-list > li > .social > ul > li > a {
   padding: 3px 0px;
   }
   .event-list > li > .info > ul > li:hover,
   .event-list > li > .social > ul > li:hover {
   color: rgb(30, 30, 30);
   background-color: rgb(200, 200, 200);
   }
   @media (min-width: 768px) {
   .event-list > li {
   position: relative;
   display: block;
   width: 100%;
   height: 120px;
   padding: 0px;
   }
   .event-list > li > time,
   .event-list > li > img  {
   display: inline-block;
   }
   .event-list > li > time,
   .event-list > li > img {
   width: 120px;
   float: left;
   }
   .event-list > li > .info {
   background-color: rgb(245, 245, 245);
   overflow: hidden;
   }
   .event-list > li > time,
   .event-list > li > img {
   width: 120px;
   height: 120px;
   padding: 0px;
   margin: 0px;
   }
   .event-list > li > .info {
   position: relative;
   height: 120px;
   text-align: left;
   padding-right: 40px;
   }
   .event-list > li > .info > .title,
   .event-list > li > .info > .desc {
   padding: 0px 10px;
   }
   .event-list > li > .info > ul {
   position: absolute;
   left: 0px;
   bottom: 0px;
   }
   .event-list > li > .social {
   position: absolute;
   top: 0px;
   right: 0px;
   display: block;
   width: 40px;
   }
   .event-list > li > .social > ul {
   border-left: 1px solid rgb(230, 230, 230);
   }
   .event-list > li > .social > ul > li {
   display: block;
   padding: 0px;
   }
   .event-list > li > .social > ul > li > a {
   display: block;
   width: 40px;
   padding: 10px 0px 9px;
   }
   }
</style>

