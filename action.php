<?php

session_start();

require('config/databaseConfig.php');

$user_id = $_SESSION['userid'];

if(isset($_GET["like_id"]))
{
   $id = $_GET['like_id'];
   $query="insert into liked_videos(user_id,video_id) values('$user_id','$id') ";
   
     mysqli_query($conn, $query);
}

if(isset($_GET["fav_id"]))
{
   $id = $_GET['fav_id'];
   $query="insert into watch_later(user_id,video_id) values('$user_id','$id') ";
   
     mysqli_query($conn, $query);
}







if(isset($_GET["remove_id"]))
{
   $id = $_GET['remove_id'];
   $query="delete from liked_videos where id=?";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}
if(isset($_GET["delete_id"]))
{
   $id = $_GET['delete_id'];
   $query="delete from watch_later where id=?";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}

if(isset($_GET["event_id"]))
{
   $id = $_GET['event_id'];
   $query="delete from event where id=?";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}






if(isset($_GET["athleteid"]))
{
   $id = $_GET['athleteid'];
   $query="delete from user where id='$id'";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}
if(isset($_GET["activityid"]))
{
   $id = $_GET['activityid'];
   $query="delete from Activity where id='$id'";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}
if(isset($_GET["locationid"]))
{
   $id = $_GET['locationid'];
   $query="delete from Locations where id='$id'";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}


if(isset($_GET["bioid"]))
{
   $id = $_GET['bioid'];
   $query="delete from bio where id='$id'";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}







if(isset($_GET["userid"]))
{
   $id = $_GET['userid'];
   $query="delete from user where id='$id'";
   $st=$conn->prepare($query);
   $st->bind_param('i',$id);
   $st->execute();
}
?>