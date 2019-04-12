<?php
/**
 * Created by PhpStorm.
 * User: WhiteCat636
 * Date: 12.04.19
 * Time: 0:39
 */

class Likes extends MY_Controller
{

    protected $response_data;

    public function __construct()
    {
        parent::__construct();

        $this->CI =& get_instance();
        $this->load->model('likes_model');
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
    public function like()
    {
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('entity_id', 'entity_id', 'trim|required|numeric');
        $this->form_validation->set_rules('entity', 'entity', 'trim|required|callback_no_exist_like['.$this->input->post
            ('entity_id').']|in_list[news,comments]');

        $this->response_data->data = new stdClass();
        $this->response_data->data->patch_notes = '';

        if ($this->form_validation->run() !== TRUE)
        {
            $this->response_data->status = 'error';
            $this->response_data->error_message = implode(',', $this->form_validation->error_array());
            $this->response($this->response_data);
            return false;
        }

        $like = [
            'entity' => $this->input->post('entity'),
            'entity_id' => $this->input->post('entity_id'),
            'user_id' => TEST_USER,
        ];

        $likes_model = Likes_model::create($like);
        $like['id'] = $likes_model->get_id();
        $this->response_data->data->like = $like ;
        $this->response($this->response_data);
        return false;
    }
    /**
     * create comment from news
     * @return void
     */
    public function unlike()
    {
        $data = $this->input->post();
        $this->form_validation->set_data($data);
        $this->form_validation->set_rules('entity_id', 'entity_id', 'trim|required|numeric');
        $this->form_validation->set_rules('entity', 'entity', 'trim|required|callback_exist_like['.$this->input->post
            ('entity_id').']|in_list[news,comments]');

        $this->response_data->data = new stdClass();
        $this->response_data->data->patch_notes = '';

        if ($this->form_validation->run() !== TRUE)
        {
            $this->response_data->status = 'error';
            $this->response_data->error_message = implode(',', $this->form_validation->error_array());
            $this->response($this->response_data);
            return false;
        }

        $like = [
            'entity' => $this->input->post('entity'),
            'entity_id' => $this->input->post('entity_id'),
            'user_id' => TEST_USER,
        ];

        $likes_model = Likes_model::delete($like);
        if($likes_model){
            $this->response_data->data->like = $like ;
            $this->response($this->response_data);
            return false;
        }

        $this->response_data->status = 'error';
        $this->response_data->error_message = 'error unlike '.$like['entity'].' №'.$like['entity_id'];
        $this->response($this->response_data);
        return false;
    }

    /**
     * @return int count
     *
     */
    public function get_count($entity,$entity_id)
    {
        return $this->id;
    }

    public function no_exist_like($entity,$entity_id)
    {
        $exist = $this->check_like($entity,$entity_id);

        if (!$exist)
        {
            $this->form_validation->set_message('no_exist_like', 'This '.$entity.' №'.$entity_id.' already like');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    public function exist_like($entity,$entity_id)
    {
       $exist = $this->check_like($entity,$entity_id);

        if ($exist)
        {
            $this->form_validation->set_message('exist_like', 'This '.$entity.' №'.$entity_id.' no like');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    private function check_like($entity,$entity_id)
    {
        $exist = Likes_model::check($entity,$entity_id);

        if ($exist)
        {
            $this->form_validation->set_message('exist', 'This '.$entity.' №'.$entity_id.' already like');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}