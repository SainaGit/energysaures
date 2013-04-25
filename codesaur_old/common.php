<?php
require_once 'configu.php';
require_once 'database.php';                            

function getPagingQuery($sql, $itemPerPage = 10)
{
    if (isset($_GET['page']) && (int)$_GET['page'] > 0) 
        $page = (int)$_GET['page'];
    else 
        $page = 1;
  
    $offset = ($page - 1) * $itemPerPage;
    
    return $sql . " LIMIT $offset, $itemPerPage";
}

function getPagingLink($sql, $itemPerPage = 10, $strGet = '')
{
    $result        = dbQuery($sql);
    $pagingLink    = '';
    $totalResults  = dbNumRows($result);
    $totalPages    = ceil($totalResults / $itemPerPage);
    
    $numLinks      = 10;
            
    if ($totalPages > 1)
    {
    
        $self = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'] ;
        

        if (isset($_GET['page']) && (int)$_GET['page'] > 0)
            $pageNumber = (int)$_GET['page'];
        else
            $pageNumber = 1;
   
        if ($pageNumber > 1)
        {
            $page = $pageNumber - 1;
            if ($page > 1)
                $prev = "<li> <a href=\"$self?page=$page&$strGet\" class=\"page\">[Өмнөх]</a> </li>";
            else
                $prev = "<li> <a href=\"$self?$strGet\" class=\"page\">[Өмнөх]</a> </li>";
                
            $first = "<li> <a href=\"$self?$strGet\" class=\"page\">[Эхний хуудас]</a> </li>";
        } 
        else
        {
            $prev  = ''; 
            $first = ''; 
        }
    
        if ($pageNumber < $totalPages)
        {
            $page = $pageNumber + 1;
            $next = "<li> <a href=\"$self?page=$page&$strGet\" class=\"page\">[Дараах]</a> </li>";
            $last = "<li> <a href=\"$self?page=$totalPages&$strGet\" class=\"page\">[Сүүлийн хуудас]</a> </li>";
        } 
        else 
        {
            $next = '';
            $last = '';
        }

        $start = $pageNumber - ($pageNumber % $numLinks) + 1;
        $end   = $start + $numLinks - 1;        
        
        $end   = min($totalPages, $end);
        
        $pagingLink = array();
        for($page = $start; $page <= $end; $page++)
        {
            if ($page == $pageNumber)
                $pagingLink[] = "<li class=\"current\"> <a>$page</a> </li>"; 
            else 
            {
                if ($page == 1)
                    $pagingLink[] = "<li> <a href=\"$self?$strGet\">$page</a> </li>";
                else
                    $pagingLink[] = "<li> <a href=\"$self?page=$page&$strGet\">$page</a> </li>";
            }
        }
        
        $pagingLink = implode(' ', $pagingLink);
        
        $pagingLink = $first . $prev . $pagingLink . $next . $last;
    }
    return $pagingLink;
}  
?>