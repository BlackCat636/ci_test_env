<?php
/**
 * Created by PhpStorm.
 * User: WhiteCat636
 * Date: 11.04.19
 * Time: 18:36
 */

class Comments extends MY_Controller
{
    protected $response_data;

    public function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->load->model('News_comments_model');
        $this->load->library('form_validation');

        $this->response_data = new stdClass();
        $this->response_data->status = 'success';
        $this->response_data->error_message = '';
        $this->response_data->data = new stdClass();

        if (ENVIRONMENT === 'production')
        {
            die('Access denied!');
        }
    }
    /**
     * create comment from news
     * @return void
     */
    public function create()
    {
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('text', 'text', 'trim|required');
        $this->form_validation->set_rules('news_id', 'news_id', 'trim|required|numeric');

        $this->response_data->data = new stdClass();
        $this->response_data->data->patch_notes = '';

        if ($this->form_validation->run() !== TRUE)
        {
            $this->response_data->status = 'error';
            $this->response_data->error_message = implode(',', $this->form_validation->error_array());
            $this->response($this->response_data);
            return false;
        }

        $comment = [
            'text' => $this->input->post('text'),
            'news_id' => $this->input->post('news_id'),
        ];

        $comment_model = News_comments_model::create($comment);
        $comment['id'] = $comment_model->get_id();
        $this->response_data->data->comment = $comment ;
        $this->response($this->response_data);
        return false;
    }

    /**
     * delete comment
     *
     * @param int $comment_id
     * @return void
     */
    public function delete()
    {

        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('id', 'id', 'trim|required|numeric|callback_exist');
        $this->response_data->data = new stdClass();
        $this->response_data->data->patch_notes = '';
        if ($this->form_validation->run() !== TRUE)
        {
            $this->response_data->status = 'error';
            $this->response_data->error_message = implode(',', $this->form_validation->error_array());
            $this->response($this->response_data);
            return false;
        }
        $comment_id =$this->input->post('id');
        $comment_model = News_comments_model::delete($comment_id);
        if($comment_model){
            $this->response_data->data->comments = $comment_model;
            $this->response($this->response_data);
            return false;
        }
        $this->response_data->status = 'error';
        $this->response_data->error_message = 'error delete comment № '.$comment_id;
        $this->response($this->response_data);
        return false;
    }

    public function exist($id)
    {
        $exist = News_comments_model::check_id($id);
        if (!$exist)
        {
            $this->form_validation->set_message('exist', 'The {id} comment doesn\'t exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }



}
