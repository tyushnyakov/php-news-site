<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8" />
  <title>HTML5</title>
</head>
 <body>
  <p>Привет, мир</p>

    <?php foreach ($newsList as $newsItem);?>
        <div>
            <h2><?php echo $newsItem['h1']; ?></h2>
            <p><?php echo $newsItem['date']; ?></p>
            <p><?php echo $newsItem['short_content']; ?></p>
            <a href="/news/<?php echo $newsItem['id']; ?>">More</a>
        </div>
    <?php endforeach;?>

 </body>
</html>
