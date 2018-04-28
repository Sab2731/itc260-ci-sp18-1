<?php
//application/controller/News.php
class News extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->model('news_model');
                $this->load->helper('url_helper');
                $this->config->set_item('banner','News Banner');
        }
// default for index
        public function index()
        {
                $data['news'] = $this->news_model->get_news();
                //$data['title'] = 'News archive';
                
                //var_dump($data['news']);
                //dies;        

                $this->config->set_item('title','News Title');
            
                $this->load->view('news/index', $data);
                
        }//end of index

       public function view($slug = NULL)
        {
                $data['news_item'] = $this->news_model->get_news($slug);

                if (empty($data['news_item']))
                {
                        show_404();
                }

                $data['title'] = $data['news_item']['title'];

                $this->load->view('news/view', $data);
                
        }//end of view
    
    
    
           public function create()
{
            $this->load->helper('form');
            $this->load->library('form_validation');

            $data['title'] = 'Create a news item';

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('text', 'Text', 'required');

            if ($this->form_validation->run() === FALSE)
            {
        
                $this->load->view('news/create', $data);
            }
            else
            {
                //$this->news_model->set_news();
                
                $slug = $this->news_model->set_news();
                
                
                if($slug !== false)
                {//data has been entered - show page   
                feedback('News Item successfully entered!!!','info');
                redirect('/news/view/' . $slug);
                    
                }else{//problem - show warning
                    
                    feedback('News item NOT created!!!','error');
                    redirect('/news/view/create');
                }
        
            }// end of create() 
               
               
}
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}