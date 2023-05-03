<?php

/**
 * Paginator
 * 
 * Data for selecting a page of records
 */
class Paginator
{
    /**
     * Number of records to return
     */
    public int $limit;
    /**
     * Number of records to skip before the page
     */
    public int $offset;

    /**
     * Previous page number
     * 
     * @var int
     */
    public $previous;

    /**
     * Next page number
     * 
     * @var int
     */
    public $next;

    /**
     * Constructor
     * 
     * @param integer $page Page number
     * @param integer $records_per_page Number of records per page
     * 
     * @return void
     */
    public function __construct($page, $records_per_page, $total_records){
        $this->limit = $records_per_page;

        $page = filter_var($page, FILTER_VALIDATE_INT, [
            'options' => [
                'default' => 1,
                'min_range' => 1
            ]
        ]);
        
        if($page >1){
            $this->previous = $page - 1;
        }else{
            $this->previous = null;
        }

        $total_records = 10;
        $total_pages = ceil($total_records / $records_per_page);

        if($page < $total_pages){
            $this->next = $page + 1;
        }else{
            $this->next = null;
        }  

        $this->offset = $records_per_page * ($page - 1);
    }
}