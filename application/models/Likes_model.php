<?php
/**
 * Created by PhpStorm.
 * User: WhiteCat636
 * Date: 11.04.19
 * Time: 23:24
 */


class Likes_model extends MY_Model
{
    const TABLE = 'likes';
    protected $id;
    protected $entity_id;
    protected $entity;

    protected $views;
    function __construct($id = FALSE)
    {
        parent::__construct();
        $this->class_table = self::TABLE;
        $this->set_id($id);
    }
    /**
     * @return integer
     */
    public function get_entity_id()
    {
        return (int) $this->entity_id;
    }
    /**
     * @return string
     */
    public function get_entity()
    {
        return $this->entity;
    }
    /**
     * @return mixed
     */
    public function get_time_created()
    {
        return $this->time_created;
    }
    /**
     * @param mixed $time_created
     */
    public function set_time_created($time_created)
    {
        $this->time_created = $time_created;
        return $this->_save('time_created', $time_created);
    }
    /**
     * @return int
     */
    public function get_time_updated()
    {
        return strtotime($this->time_updated);
    }
    /**
     * @param mixed $time_updated
     */
    public function set_time_updated($time_updated)
    {
        $this->time_updated = $time_updated;
        return $this->_save('time_updated', $time_updated);
    }
    /**
     *
     * @param [array] $data
     * @param [string] $preparation
     * @return void
     */
    public static function preparation($data, $preparation)
    {
        switch ($preparation) {
            case 'short_info':
                return self::_preparation_short_info($data);
            default:
                throw new Exception('undefined preparation type');
        }
    }
    /**
     * @param News_model[] $data
     * @return array
     */
    private static function _preparation_short_info($data)
    {
        $res = [];
        foreach ($data as $item) {
            $_info = new stdClass();
            $_info->id = (int)$item->get_id();
            $_info->user_id = $item->get_user_id();
            $_info->time = $item->get_time_updated();
            $res[] = $_info;
        }
        return $res;
    }
    public static function create($_insert_data){
        $CI =& get_instance();
        $res = $CI->s->from(self::TABLE)->insert($_insert_data)->execute();
        if(!$res){
            return FALSE;
        }
        return new self($CI->s->insert_id);
    }
    public static function delete($data){
        $CI =& get_instance();
        $res = $CI->s->from(self::TABLE)->where('entity',$data['entity'])->where('entity_id',$data['entity_id'])
            ->where('user_id',$data['user_id'])->delete()->execute();
        if(!$res){
            return FALSE;
        }
        return $data;
    }

    /**
     * @param $entity
     * @param $entity_id
     * @return mixed
     */
    public static function check($entity,$entity_id)
    {

        $CI =& get_instance();

        $check = $CI->s->from(self::TABLE)->where('entity',$entity)->where('entity_id',$entity_id)->where('user_id',
            TEST_USER)->count();
        return $check;
    }
}