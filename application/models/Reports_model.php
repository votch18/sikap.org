<?php
class Reports_model extends CI_Model{

    public function get_monthly_posts(){
        $sql = "SELECT 
                a.id, 
                substr(ifnull(b.year, 2019), 3,5) as year,
                a.abbr as month, 
                IFNULL(b.posts, 0) as posts,
                IFNULL(c.comments, 0) as comments
                FROM t_months a
                LEFT JOIN 
                    (SELECT COUNT(a.id) as posts,                   
                    year(a.date) as year, 
                    month(a.date) as month
                    FROM t_posts a GROUP BY year(a.date), month(a.date)) b ON a.id = b.month      
                LEFT JOIN 
                    (SELECT COUNT(x.id) as comments,                   
                    year(x.date) as year, 
                    month(x.date) as month
                    FROM t_comments x GROUP BY year(x.date), month(x.date)) c ON a.id = c.month                 
                GROUP BY a.id, b.year, a.abbr
                ORDER BY b.year, a.id
            ";
  
        $query = $this->db->query($sql);
        return $query->result_array();
    
    }
}

 