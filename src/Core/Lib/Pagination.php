<?php


namespace Core\Lib;


class Pagination
{

    protected static $_todos_par_page = 5; //Limit of data that we want to show par page

    public static function getPagination($data, $totalCount, $currentPage = 0){

        $pagination = array();

        if(!empty($data)){
            $pagination['totalPage'] = ceil((int)$totalCount/self::$_todos_par_page);
            $pagination['currentPage'] = $currentPage;
            $pagination['nextPage'] = $currentPage + 1;
            if($currentPage !== 0){
                $pagination['prevPage'] = $currentPage - 1;
            }
        }

        return $pagination;
    }

}