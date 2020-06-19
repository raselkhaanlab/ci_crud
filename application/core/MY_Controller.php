<?php
class MY_Controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('pagination');
    }
    //create pagination link for browser 
    public function custom_pagination($model,$options)
    {
        // init params
        $params = array();
        $limit_per_page = $options['limit']?$options['limit']:5;
        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        $total_records = $this->$model->get_total();
     
        if ($total_records > 0)
        {
            // get current page records
            $params["results"] = $this->$model->get_current_page_records($limit_per_page, $page*$limit_per_page);
            $config['base_url'] = base_url($options['base_url']);
            $config['total_rows'] = $total_records;
            $config['per_page'] = $limit_per_page;
            $config["uri_segment"] = 3;
             
            // custom paging configuration
            $config['num_links'] = 2;
            $config['use_page_numbers'] = TRUE;
            $config['reuse_query_string'] = TRUE;
             
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
             
            $config['first_link'] = 'First';
            $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['first_tag_close'] ='</span></li>';
             
            $config['last_link'] = 'Last';
            $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['last_tag_close'] = '</span></li>';
             
            $config['next_link'] = '<i class="fa fa-arrow-right" aria-hidden="true"></i>';
            $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['next_tag_close'] = '</span></li>';
 
            $config['prev_link'] ='<i class="fa fa-arrow-left" aria-hidden="true"></i>';
            $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['prev_tag_close'] = '</span></li>';
 
            $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
            $config['cur_tag_close'] = '</a></li>';
 
            $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
            $config['num_tag_close'] = '</span></li>';
             
            $this->pagination->initialize($config);
                 
            // build paging links
            $params["links"] = $this->pagination->create_links();
            return $params;
        }
     
        else {
            return false;
        }
    }
}