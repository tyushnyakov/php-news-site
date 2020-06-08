<?php

include_once ROOT.'/models/News.php';

class NewsController 
{
    public function actionIndex() 
    {
        $newsList = array();
        $newsList = News::getNewsList();

        require_once(ROOT.'/views/index.php');

        echo '<pre>';
        print_r($newsList);
        echo '</pre>';

        return true;
    }

    public function actionView($id) 
    {
        if($id) {
            $newsItem = News::getNewsItemById($id);
            echo '<pre>';
            print_r($newsItem);
            echo '</pre>';

            echo 'actionView';
        }
        
        
    }
}